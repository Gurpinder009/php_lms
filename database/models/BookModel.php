<?php

namespace Database\Models;

use Config\LoggerConfig\LogHandler;
use Database\DatabaseConnection;

class BookModel
{

    private function __construct(){}

    //getting all boook data
    static function all()
    {
        try {
            return DatabaseConnection::getInstance()->query(
                "select b.*,a.name as author_name,c.name as category_name,p.name as publisher_name from  
                (books b left join authors a on b.author_id=a.id ) left join publishers as p on b.publisher_id=p.id left join categories as c on b.category_id = c.id;"
            )->fetchAll();
        } catch (\PDOException $ex) {
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        }
    }
    static function allAvailableBooks(){
        try {
            // select * from books where accession_no  not in (select accession_no from books b inner join borrow_books bb on b.accession_no = bb.book_id where bb.`return date` is not null);
            return DatabaseConnection::getInstance()->query(
                "select * from books where accession_no not in (select b.accession_no from books b inner join borrow_books bb on bb.book_id = b.accession_no where bb.`return date` is null);"
            )->fetchAll();
        } catch (\PDOException $ex) {
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        }
    }
  
    //getting particular book
    static function find(int $id)
    {
        $stmt = null;
        try {
            $stmt = DatabaseConnection::getInstance()->prepare("select b.*,p.name as publisher_name,a.name as author_name,c.name as category_name from authors a inner join books b on b.author_id = a.id inner join categories c on c.id = b.category_id inner join publishers p on p.id = b.publisher_id where b.accession_no =:id;");
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                $result = $stmt->fetch();
                if(isset($result["accession_no"])){
                    return $result;
                }
                throw new \PDOException("No data available");
            }
        } catch (\PDOException $ex) {
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }


    //search for books
    static function search($data){
        $stmt = null;
        try {
            $stmt =  DatabaseConnection::getInstance()->prepare(
                "select b.*,a.name as author_name,c.name as category_name,p.name as publisher_name from  
                (books b left join authors a on b.author_id=a.id ) left join publishers as p on b.publisher_id=p.id left join categories as c on b.category_id = c.id where b.title like :data or a.name like :data or c.name like :data or p.name like :data  limit 10 ;");
            $stmt->bindValue(":data","%".$data."%");
            if($stmt->execute()){
                return $stmt->fetchAll();
            }
        } catch (\PDOException $ex) {
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        }
    }

    static function allBooks($offset=0){
        $stmt = null;
        try {
            $stmt =  DatabaseConnection::getInstance()->prepare(
                "select b.*,a.name as author_name,c.name as category_name,p.name as publisher_name from  
                (books b left join authors a on b.author_id=a.id ) left join publishers as p on b.publisher_id=p.id left join categories as c on b.category_id = c.id limit 10 offset :offset ;");
            $stmt->bindParam(":offset",$offset,\PDO::PARAM_INT);
            if($stmt->execute()){
                return $stmt->fetchAll();
            }
        } catch (\PDOException $ex) {
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        }
    }


    //updating book data 
    static function update(int $id, $data)
    {
        $stmt = null;
        try {
            $stmt = DatabaseConnection::getInstance()
                ->prepare("UPDATE `books` SET `title` = :title,`year_of_publication` = :year_of_publication,`condition` = :condition,`page_count`= :page_count,`language`= :language,`volume` = :edition, author_id = :author_id, category_id = :category_id, publisher_id = :publisher_id where `accession_no` = :accession_no;");
            $stmt->bindParam(":accession_no", $id);
            $stmt->bindParam(":title", $data["title"]);
            $stmt->bindParam(":author_id", $data["author_id"]);
            $stmt->bindParam(":page_count", $data["page_count"]);
            $stmt->bindParam(":year_of_publication", $data['year_of_publication']);
            $stmt->bindParam(":category_id", $data["category_id"]);
            $stmt->bindParam(":condition", $data["condition"]);
            $stmt->bindParam(":edition", $data["edition"]);
            $stmt->bindParam(":publisher_id", $data["publisher_id"]);
            $stmt->bindParam(":language", $data["language"]);
            return $stmt->execute();
        } catch (\PDOException $ex) {
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }

    //deteting book data 
    static function delete()
    {
        $stmt = null; 
        try{
            $stmt= DatabaseConnection::getInstance()
            ->prepare("DELETE FROM books WHERE id = :id;");
            $stmt->bindParam(":id",$id);
            return $stmt->execute();
        }catch(\PDOException $ex){
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        }  
    }


    //getting book count
    static function count()
    {
        try {
            $result = DatabaseConnection::getInstance()
                ->query("select count(*) as book_count from books")->fetch();
            return $result["book_count"];
        } catch (\PDOException $ex) {
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        }
    }


    //inserting new book
    static function insert($data)
    {
        $stmt = null;
        try {
            $stmt = DatabaseConnection::getInstance()
                ->prepare("INSERT INTO `books`(`accession_no`,`title`,`year_of_publication`,`condition`,`page_count`,`language`,`volume`,`author_id`,`category_id`,`publisher_id`)values(:accession_no,:title,:year_of_publication,:condition,:page_count,:language,:edition,:author_id,:category_id,:publisher_id);");
            $stmt->bindParam(":accession_no", $data["accession_no"]);
            $stmt->bindParam(":title", $data["title"]);
            $stmt->bindParam(":author_id", $data["author_id"]);
            $stmt->bindParam(":page_count", $data["page_count"]);
            $stmt->bindParam(":year_of_publication", $data['year_of_publication']);
            $stmt->bindParam(":category_id", $data["category_id"]);
            $stmt->bindParam(":condition", $data["condition"]);
            $stmt->bindParam(":edition", $data["edition"]);
            $stmt->bindParam(":publisher_id", $data["publisher_id"]);
            $stmt->bindParam(":language", $data["language"]);
            return $stmt->execute();
        } catch (\PDOException $ex) {
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }
}
