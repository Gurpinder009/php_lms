<?php

namespace Database\Models;

use Database\DatabaseConnection;

class BookModel
{

    private function __construct()
    {
    }

    static function all()
    {
        try {
            return DatabaseConnection::getInstance()->query(
                "select b.*,a.name as author_name,c.name as category_name,p.name as publisher_name from  
                (books b left join authors a on b.author_id=a.id ) left join publishers as p on b.publisher_id=p.id left join categories as c on b.category_id = c.id;"
            )->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage()];
        }
    }
    //  static function find(){
    //     try{
    //         return DatabaseConnection::getInstance()->
    //         query("select b.*,a.name,c.name from  authors a inner join books b on b.author_id = a.id inner join categories c on c.id = b.category_id and b.accession_no=1")
    //         ->fetch(\PDO::FETCH_ASSOC);
    //     }
    //     catch(\PDOException $ex){
    //         return ["error" => $ex->getMessage()];
    //     }
    // }

    static function find(int $id)
    {
        $stmt = null;
        try {
            $stmt = DatabaseConnection::getInstance()->prepare("select b.*,p.name as publisher_name,a.name as author_name,c.name as category_name from authors a inner join books b on b.author_id = a.id inner join categories c on c.id = b.category_id inner join publishers p on p.id=b.publisher_id where b.accession_no =:id;");
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            }
        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage()];
        } finally {
            unset($stmt);
        }
    }


    static function update()
    {
        echo "update books info";
    }
    static function delete()
    {
        echo "delete book from books";
    }

    static function count()
    {
        try {
            $result = DatabaseConnection::getInstance()
                ->query("select count(*) as book_count from books")->fetch(\PDO::FETCH_ASSOC);
            return $result["book_count"];
        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage()];
        }
    }

    static function insert($data)
    {
        $stmt = null;
        try {
            $stmt = DatabaseConnection::getInstance()
                ->prepare("INSERT INTO `books`(`accession_no`,`title`,`condition`,`language`,`edition`,`author_id`,`category_id`,`publisher_id`)values(:accession_no,:title,:condition,:language,:edition,:author_id,:category_id,:publisher_id);");
            $stmt->bindParam(":accession_no", $data["accession_no"]);
            $stmt->bindParam(":title", $data["title"]);
            $stmt->bindParam(":condition", $data["condition"]);
            $stmt->bindParam(":language", $data["language"]);
            $stmt->bindParam(":page_count", $data["page_count"]);
            $stmt->bindParam(":edition", $data["edition"]);
            $stmt->bindParam(":author_id", $data["author_id"]);
            $stmt->bindParam(":category_id", $data["category_id"]);
            $stmt->bindParam(":publisher_id", $data["publisher_id"]);
            return $stmt->execute();
        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage()];
        } finally {
            unset($stmt);
        }
    }
}
