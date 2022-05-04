<?php

namespace Database\Models;

use Database\DatabaseConnection;
class BookModel{

    private function __construct(){}

    public static function all(){
        try{
            return DatabaseConnection::getInstance()->query("select *,count(title) as no_of_copies from books group by title;")->fetchAll(\PDO::FETCH_ASSOC);
        }catch(\PDOException $ex){
            echo $ex->getMessage();
        }
    }
    public static function find(){
        echo "find book from all the books";
    }
    public static function update(){
        echo "update books info";
    }
    public static function delete(){
        echo "delete book from books";
    }

    public static function insert($data){
        $stmt = null;
        try{
            $stmt = DatabaseConnection::getInstance()
            ->prepare("INSERT INTO `books`(`title`,`condition`,`language`,`edition`,`author_id`,`category_id`,`publisher_id`)values(:title,:condition,:language,:edition,:author_id,:category_id,:publisher_id);");
            $stmt->bindParam(":title",$data["title"]);
            $stmt->bindParam(":condition",$data["condition"]);
            $stmt->bindParam(":language",$data["language"]);
            $stmt->bindParam(":edition",$data["edition"]);
            $stmt->bindParam(":author_id",$data["author_id"]);
            $stmt->bindParam(":category_id",$data["category_id"]);
            $stmt->bindParam(":publisher_id",$data["publisher_id"]);
            return $stmt->execute();
        }catch(\PDOException $ex){
            echo $ex->getMessage();
        }
        finally{
            unset($stmt);
        }
    }    

}