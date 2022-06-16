<?php

namespace Database\Models;

use Config\LoggerConfig\LogHandler;
use Database\DatabaseConnection;

class PersonModel{
    
    private function __construct(){}

    //getting all persons
     static function all(){
        try{
            $conn = DatabaseConnection::getInstance();
            return $conn->query("select * from person")->fetchAll();
        }catch(\PDOException $ex){
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];

        }
    }

    //finding particular person
     static function find(int $id){
        $stmt = null;
        try{
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select * from person where id = :id");$stmt->bindParam(":id",$id);
            if($stmt->execute()){
                $result = $stmt->fetch();
                if(isset($result["name"])){
                    return $result;   
                }
                throw new \PDOException("No Data Available");
            }
        }catch(\PDOException $ex){
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        }    
    }

    //getting last insert id
     static function LastInsertId(){
        try{
            return DatabaseConnection::getInstance()->query("select last_insert_id() from person;")->fetch()['last_insert_id()'];
        }catch(\PDOException $ex){
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        }
    }

    //inserting new person data 
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
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];

        }
    }

    //update person password
    static function updatePassword(int $id, $password){
        $stmt = null;
        try{
            $conn = DatabaseConnection::getInstance();
            echo "<script>confirm('password');</script>";
            $stmt =$conn->prepare("update `person` set `password` = :password where id = :id;");
            $password = hash("sha256", $password);
            $stmt->bindParam(":password",$password);
            $stmt->bindParam(":id",$id);
            return $stmt->execute();
        }catch(\PDOException $ex){
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        }
    }

    //deleting person data 
    static function delete(){
        $stmt = null; 
        try{
            $stmt= DatabaseConnection::getInstance()
            ->prepare("DELETE FROM persons WHERE id = :id;");
            $stmt->bindParam(":id",$id);
            return $stmt->execute();
        }catch(\PDOException $ex){
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];

        }
    }


    static function findUsingEmail(String $email)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select * from person p  where p.email = :email ");
            $stmt->bindParam(":email", $email);
            if ($stmt->execute()) {
                $result = $stmt->fetch();
                if (isset($result)) {
                    return $result;
                }
                throw new \PDOException("No data found");
            }
        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }

        //logging out user
        static function logout()
        {
            session_start();
            if (isset($_SESSION['auth'])) {
                //logging
                LogHandler::infoLog("Logout",$_SESSION["auth_user"]["name"]." is logged out");
                unset($_SESSION['auth']);
                unset($_SESSION['auth_user']);
                session_regenerate_id();
                return true;
            }
                return true;
    
        }
    
}