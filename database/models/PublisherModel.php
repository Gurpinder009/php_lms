<?php 
    namespace Database\Models;

use Database\DatabaseConnection;
use PDO;
use PDOException;

    class PublisherModel {
        private function __construct(){}

        public static function all(){
            try{
                $conn =DatabaseConnection::getInstance();
                return $conn->query("select * from publishers;")->fetchAll(PDO::FETCH_ASSOC);

            }catch(\PDOException $ex){
                echo $ex->getMessage();
            }
        }

        public static function insert($data){
            $stmt = null;
            try{
                $stmt = DatabaseConnection::getInstance()
                ->prepare("INSERT INTO `publishers` (`publisher_name`, `contact_info`) values(:name,:info);");
                $stmt->bindParam(":name",$data["name"]);
                $stmt->bindParam(":info",$data["contact_info"]);
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
                $stmt = $conn->prepare("select * from publishers where name=:name;");
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