<?php 
    namespace Database\Models;

use Database\DatabaseConnection;


    class PublisherModel {
        private function __construct(){}


        //getting all publisher data 
         static function all(){
            try{
                $conn =DatabaseConnection::getInstance();
                return $conn->query("select * from publishers;")->fetchAll();

            }catch(\PDOException $ex){
                return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
            }
        }

        //inserting new publisher
         static function insert($data){
            $stmt = null;
            try{
                $stmt = DatabaseConnection::getInstance()
                ->prepare("INSERT INTO `publishers` (`name`, `contact_info`) values(:name,:info);");
                $stmt->bindParam(":name",$data["name"]);
                $stmt->bindParam(":info",$data["contact_info"]);
                return $stmt->execute();
            }catch(\PDOException $ex){
                return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];

            }finally{
                unset($stmt);
            }

        }

        //updating publisher data
        static function update($id,$data){
            $stmt = null;
            try{
                $stmt = DatabaseConnection::getInstance()
                ->prepare("UPDATE PUBLISHERS SET name = :name, contact_info = :info WHERE id = :id;");
                $stmt->bindParam(":name",$data["name"]);
                $stmt->bindParam(":info",$data["contact_info"]);
                $stmt->bindParam(":id",$id);
                return $stmt->execute();
            }catch(\PDOException $ex){
                return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
            }finally{
                unset($stmt);
            }

        }

        //finding publisher by name
         static function findByName($name){
            $stmt = null;
            try{
                $conn= DatabaseConnection::getInstance();
                $stmt = $conn->prepare("select * from publishers where name=:name;");
                $stmt->bindParam(":name",$name);
                if($stmt->execute()){
                    $result = $stmt->fetch();
                    if(isset($result["id"])){
                        return $result["id"];
                    }
                    throw new \PDOException("No data found");
                }
            }catch(\PDOException $ex){
                return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];

            }finally{
                unset($stmt);
            }
        }

        
        //finding a particular publisher
         static function find(int $id){
            $stmt = null;
            try{
                $conn= DatabaseConnection::getInstance();
                $stmt = $conn->prepare("select * from publishers where id=:id;");
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

        //counting total number of publishers
         static function count(){
            try{
                $result =DatabaseConnection::getInstance()
                ->query("select count(*) as publishers_count from publishers")->fetch(\PDO::FETCH_ASSOC);
                return $result["publishers_count"]; 
            }catch(\PDOException $ex){
                return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
            }
        }

        //delete publisher data
        static function delete(int $id){
            $stmt = null; 
            try{
                $stmt= DatabaseConnection::getInstance()
                ->prepare("DELETE FROM publishers WHERE id = :id;");
                $stmt->bindParam(":id",$id);
                return $stmt->execute();
            }catch(\PDOException $ex){
                return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
            }
        }
    }