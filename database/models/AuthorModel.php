<?php
declare(strict_types=1);

namespace Database\Models;

use Config\Interfaces\ModelInterface;
use Database\DatabaseConnection;

class AuthorModel implements ModelInterface
{
    static function all()
    {
        try {
            $conn = DatabaseConnection::getInstance();
            $result = $conn->query("select * from authors;");
            return $result->fetchAll();
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    static function find($id)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("SELECT * FROM authors where id = :id");
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                return $stmt->fetch();
            }
        } catch (\PDOException $ex) {
            echo ["error" => $ex->getMessage()];
        } finally {
            unset($stmt);
        }
    }
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
            echo $ex->getMessage();
        } finally {
            unset($stmt);
        }
    }
    static function findByName($name)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select * from authors where name=:name;");
            $stmt->bindParam(":name", $name);
            if ($stmt->execute()) {
                return $stmt->fetch();
            }
            return null;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        } finally {
        }
    }

    static function delete(int $id)
    {
        $stmt = null; 
        try{
            $stmt= DatabaseConnection::getInstance()
            ->prepare("delete from authors where id = :id;");
            $stmt->bindParam(":id",$id);
            return $stmt->execute();
        }catch(\PDOException $ex){
            return ["error",$ex->getMessage];
        }
    }
    static function update($id, $data)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("INSERT INTO authors(name,contact_info) values (:name,:info);");
            $stmt->bindParam(":name", $data['name']);
            $stmt->bindParam(":info", $data['contact_info']);
            return $stmt->execute();
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        } finally {
            unset($stmt);
        }
    }
    static function count()
    {
        try {
            $result = DatabaseConnection::getInstance()
                ->query("select count(*) as author_count from authors")->fetch();
            return $result["author_count"];
        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage()];
        }
    }
}
