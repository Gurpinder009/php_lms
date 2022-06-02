<?php
declare(strict_types=1);

namespace Database\Models;

use Config\Interfaces\ModelInterface;
use Config\LoggerConfig\LogHandler;
use Database\DatabaseConnection;

class AuthorModel implements ModelInterface
{

    //getting all authors
    static function all()
    {
        try {
            $conn = DatabaseConnection::getInstance();
            $result = $conn->query("select * from authors;");
            return $result->fetchAll();
        } catch (\PDOException $ex) {
            LogHandler::errorLog("Author::all",["error"=>$ex->getMessage(),"code"=>$ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        }
    }

    //finding particular author
    static function find($id)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("SELECT * FROM authors where id = :id");
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                $result = $stmt->fetch();
                if(isset($result["id"])){
                    return $result;
                }
                throw new \PDOException("No data is available");
            }
        } catch (\PDOException $ex) {
            LogHandler::errorLog("Author::find",["error"=>$ex->getMessage(),"code"=>$ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
            
        } finally {
            unset($stmt);
        }
    }

    //adding new author information
    static function insert($data)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("INSERT INTO authors(name,contact_info) values (:name,:info);");
            $stmt->bindParam(":name", $data['name']);
            $stmt->bindParam(":info", $data['contact_info']);
            return $stmt->execute();
        } catch (\PDOException $ex) {
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }

    //finding author id from name
    static function findByName($name)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select * from authors where name=:name;");
            $stmt->bindParam(":name", $name);
            if ($stmt->execute()) {
                $result =  $stmt->fetch();
                if(isset($result["id"])){
                    return $result["id"];
                }
                throw new \PDOException("No data available");
            }
        } catch (\PDOException $ex) {
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
            
        } finally {
            unset($stmt);
        }
    }


    //deleting author information
    static function delete(int $id)
    {
        $stmt = null; 
        try{
            $stmt= DatabaseConnection::getInstance()
            ->prepare("DELETE FROM authors WHERE id = :id;");
            $stmt->bindParam(":id",$id);
            return $stmt->execute();
        }catch(\PDOException $ex){
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
            
        }
    }

    // updating author information
    static function update($id, $data)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("update authors set name=:name,contact_info=:info where id = :id;");
            $stmt->bindParam(":name", $data['name']);
            $stmt->bindParam(":info", $data['contact_info']);
            $stmt->bindParam(":id",$id);
            return $stmt->execute();
        } catch (\PDOException $ex) {
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
            
        } finally {
            unset($stmt);
        }
    }


    //counting authors 
    static function count()
    {
        try {
            $result = DatabaseConnection::getInstance()
                ->query("select count(*) as author_count from authors")->fetch();
            return $result["author_count"];
        } catch (\PDOException $ex) {
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
            
        }
    }
}
