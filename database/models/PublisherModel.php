<?php 
    namespace Database\Models;

use Database\DatabaseConnection;


    class PublisherModel {
        private function __construct(){}

         static function all(){
            try{
                $conn =DatabaseConnection::getInstance();
                return $conn->query("select * from publishers;")->fetchAll(\PDO::FETCH_ASSOC);

            }catch(\PDOException $ex){
                echo $ex->getMessage();
            }
        }

         static function insert($data){
            $stmt = null;
            try{
                $stmt = DatabaseConnection::getInstance()
                ->prepare("INSERT INTO `publishers` (`name`, `contact_info`) values(:name,:info);");
                $stmt->bindParam(":name",$data["name"]);
                $stmt->bindParam(":info",$data["contact_info"]);
                return $stmt->execute();
            }catch(\PDOException $ex){
                echo $ex->getMessage();
            }finally{
                unset($stmt);
            }

        }


         static function findByName($name){
            $stmt = null;
            try{
                $conn= DatabaseConnection::getInstance();
                $stmt = $conn->prepare("select * from publishers where name=:name;");
                $stmt->bindParam(":name",$name);
                if($stmt->execute()){
                    return $stmt->fetch(\PDO::FETCH_ASSOC);
                }
            }catch(\PDOException $ex){
                return ["error"=>$ex->getMessage()];
            }finally{
                unset($stmt);
            }
        }

         static function find(int $id){
            $stmt = null;
            try{
                $conn= DatabaseConnection::getInstance();
                $stmt = $conn->prepare("select * from publishers where id=:id;");
                $stmt->bindParam(":id",$id);
                if($stmt->execute()){
                    return $stmt->fetch(\PDO::FETCH_ASSOC);
                }
            }catch(\PDOException $ex){
                return ["error"=>$ex->getMessage()];
            }finally{
                unset($stmt);
            }
        }

         static function count(){
            try{
                $result =DatabaseConnection::getInstance()
                ->query("select count(*) as publishers_count from publishers")->fetch(\PDO::FETCH_ASSOC);
                return $result["publishers_count"]; 
            }catch(\PDOException $ex){
                return ["error"=>$ex->getMessage()];
            }
        }
    }