<?php
    declare(strict_types=1);
namespace Database\Models;

use Database\DatabaseConnection;

class CategoryModel
{
    private function __construct()
    {
    }
     static function all()
    {
        try {
            $conn = DatabaseConnection::getInstance();
            return $conn->query("select * from categories;")->fetchAll();
        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage()];
            
        }
    }



     static function insert($data)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("INSERT INTO `categories`(`name`,`contact_info`)values(:title,:contact_info);");
            $stmt->bindParam(":title", $data['title']);
            $stmt->bindParam(":contact_info", $data['description']);
            return $stmt->execute();
        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage()];
            
        } finally {
            unset($stmt);
        }
    }


    static function update(int $id,$data){
        $stmt = null;
        try{
            $stmt = DatabaseConnection::getInstance()
            ->prepare("UPDATE CATEGORIES SET name = :name, contact_info = :info where id = :id");
            $stmt->bindParam (":name",$data['name']);
            $stmt->bindParam(":info",$data["description"]);
            $stmt->bindParam(":id",$id); 
            return $stmt->execute(); 

        }catch(\PDOException $ex){
            return ["error"=>$ex->getMessage()];
        }
    }


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
                    return $stmt->fetch()["id"];
                }
                throw new \PDOException("No data found");
            }
        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage()];
            
        } finally {
            unset($stmt);
        }
    }

     static function count()
    {
        try {
            $result = DatabaseConnection::getInstance()
                ->query("select count(*) as category_count from categories;")->fetch();
            return $result["category_count"];
        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage()];
        }
    }



    
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
            return ["error"=>$ex->getMessage()];
        }finally{
            unset($stmt);
        }

    }
}
