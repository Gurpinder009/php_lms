<?php
namespace Database\Models;
    

use Database\DatabaseConnection;

    class BorrowBooksModel {
        private function __construct(){}
    
        static function all(){
            try{
                $result = DatabaseConnection::getInstance()
                ->query("select * from borrow_books;")
                ->fetchAll();
                return $result;
            }
            catch(\PDOException $ex){
                return ["error"=>$ex->getMessage()];
            }
        }

        static function update(){
            return "update";
        }

        static function insert(){

        }

        static function delete(){
            return "delete";
        }

        static function find($id){
            $stmt = null; 
            try{
                $stmt = DatabaseConnection::getInstance()
                ->prepare("select * from borrow_books where id = :id");
                $stmt->bindParam(":id",$id);
                if($stmt->execute()){
                    $result = $stmt->fetch();
                    if(isset($result["id"])){
                        return $result;
                    }
                    throw new \PDOException("No data available");
                }
            }
            catch(\PDOException $ex){
                return ["error"=>$ex->getMessage()];
            }
            finally{
                unset($stmt);
            }
        }

    
    }

