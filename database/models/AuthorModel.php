<?php
namespace Database\Models;

use Config\Interfaces\ModelInterface;
use Database\DatabaseConnection;


class AuthorModel implements ModelInterface
{
    public static function all(){
        try{
            $conn = DatabaseConnection::getInstance();
            $result = $conn->query("select * from authors;");
            return $result->fetchAll(\PDO::FETCH_ASSOC);
        }catch(\PDOException $ex){
            echo $ex->getMessage();
        }
    }
    public static function find($id){}
    public static function insert($data){
        $stmt = null;
        try{
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("INSERT INTO authors(name,contact_info) values (:name,:info);");
            $stmt->bindParam(":name",$data['name']);
            $stmt->bindParam(":info",$data['contact_info']);
            return $stmt->execute();
        }catch(\PDOException $ex){
            echo $ex->getMessage();
        }finally{
            unset($stmt);
        }
    }
    public static function findByName($name){
        $stmt = null;
        try{
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select * from authors where name=:name;");
            $stmt->bindParam(":name",$name);
            if($stmt->execute()){
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            }
            return null;
        }catch(\PDOException $ex){
            echo $ex->getMessage();
        }finally{

        }
    }

    public static function delete($id){}
    public static function update($id,$data){}

}
