<?php
namespace Database\Models;

use Database\DatabaseConnection;

 class CategoryModel {
    private function __construct(){}
    public static function all (){
        try{
            $conn = DatabaseConnection::getInstance();
            return $conn->query("select * from categories;")->fetchAll(\PDO::FETCH_ASSOC);
        }catch(\PDOException $ex){
            echo $ex->getMessage();
        }
    }

    

    public static function insert($data){
        $stmt = null;
        try{
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("INSERT INTO `categories`(`name`,`description`)values(:title,:description);");
            $stmt->bindParam(":title",$data['title']);
            $stmt->bindParam(":description",$data['description']);
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
            $conn= DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select * from categories where name=:name;");
            $stmt->bindParam(":name",$name);
            if($stmt->execute()){
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            }
        }catch(\PDOException $ex){
            echo $ex->getMessage();
        }finally{
            unset($stmt);
        }
    }

 }

