<?php

namespace Database\Models;
use Database\DatabaseConnection;

class PersonModel{
    
    private function __construct(){}

     static function all(){
        try{
            $conn = DatabaseConnection::getInstance();
            return $conn->query("select * from person")->fetchAll(\PDO::FETCH_ASSOC);
        }catch(\PDOException $ex){
            return ["error"=> $ex->getMessage()];
        }
    }

     static function find(int $id){
        $stmt = null;
        try{
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select * from person where id = :id");$stmt->bindParam(":id",$id);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            if(isset($result["name"])){
                throw new \PDOException("No Data Available");
            }
            return $result;
        }catch(\PDOException $ex){
            return ["error"=> $ex->getMessage()];
        }    
    }

     static function LastInsertId(){
        try{
            return DatabaseConnection::getInstance()->query("select last_insert_id() from person;")->fetch()['last_insert_id()'];
        }catch(\PDOException $ex){
            return ["error"=> $ex->getMessage()];
        }
    }

     static function insert($data){
        $stmt = null;
        try{
            $conn = DatabaseConnection::getInstance();
            $stmt =$conn->prepare("INSERT INTO `person`(`name`,`email`,`phone_num`,`city`,`state`,`country`,`pin_code`,`dob`,`password`)VALUES(:name,:email,:phone_num,:city,:state,:country,:pin_code,:dob,:password);");
            $stmt->bindParam(":name",$data['name']);
            $stmt->bindParam(":email",$data['email']);
            $stmt->bindParam(":phone_num",$data['phone_num']);
            $stmt->bindParam(":pin_code",$data['pin_code']);
            $stmt->bindParam(":city",$data['city']);
            $stmt->bindParam(":state",$data['state']);
            $stmt->bindParam(":country",$data['country']);
            $stmt->bindParam(":dob",$data['dob']);
            $stmt->bindParam(":password",$data['password']);
            return $stmt->execute();

        }catch(\PDOException $ex){
            return ["error"=> $ex->getMessage()];
        }
    }
}