<?php
    declare(strict_types=1);
namespace Database\Models;

use Config\LoggerConfig\LogHandler;
use Database\DatabaseConnection;

class CategoryModel
{
    private function __construct(){}

    //getting all category data
     static function all()
    {
        try {
            $conn = DatabaseConnection::getInstance();
            return $conn->query("select * from categories;")->fetchAll();
        } catch (\PDOException $ex) {
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        }
    }


//inserting new category data 
     static function insert($data)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("INSERT INTO `categories`(`name`,`desc`)values(:title,:contact_info);");
            $stmt->bindParam(":title", $data['title']);
            $stmt->bindParam(":contact_info", $data['description']);
            return $stmt->execute();
        } catch (\PDOException $ex) {
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error" => $ex->getMessage(),"code"=>$ex->getCode()];
            
        } finally {
            unset($stmt);
        }
    }

    //deleting category
    static function delete (int $id){
        $stmt = null; 
        try{
            $stmt= DatabaseConnection::getInstance()
            ->prepare("DELETE FROM categories WHERE id = :id;");
            $stmt->bindParam(":id",$id);
            return $stmt->execute();
        }catch(\PDOException $ex){
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        }
    }

    //updating categories
    static function update(int $id,$data){
        $stmt = null;
        try{
            $stmt = DatabaseConnection::getInstance()
            ->prepare("update categories set name=:name,`desc`=:desc where id = :id;");
            $stmt->bindParam (":name",$data['name']);
            $stmt->bindParam(":desc",$data["description"]);
            $stmt->bindParam(":id",$id); 
            return $stmt->execute(); 

        }catch(\PDOException $ex){
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage()];
        }
    }

    //finding particular category by name
     static function findByName($name)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select * from categories where name=:name;");
            $stmt->bindParam(":name", $name);
            if ($stmt->execute()) {
                $result = $stmt->fetch();
                if(isset($result["id"])){
                    return $result["id"];
                }
                throw new \PDOException("No data found");
            }
        } catch (\PDOException $ex) {
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }

    //counting total number of categories
     static function count()
    {
        try {
            $result = DatabaseConnection::getInstance()
                ->query("select count(*) as category_count from categories;")->fetch();
            return $result["category_count"];
        } catch (\PDOException $ex) {
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        }
    }



    //finding particular category
     static function find(int $id){
        $stmt = null;
        try{
            $conn= DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select * from categories where id=:id;");
            $stmt->bindParam(":id",$id);
            if($stmt->execute()){
                $result = $stmt->fetch();
                if(isset($result["id"])){
                    return $result;
                }
                throw new \PDOException("No data found");
            }
        }catch(\PDOException $ex){
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        }finally{
            unset($stmt);
        }

    }
}
