<?php
//type hinting will be strict
declare(strict_types=1);
namespace Database;



// class for creating single instance of the pdo 
class DatabaseConnection {

    public static ?\PDO $conn = null; 

    // to prevent mannual creation of pdo instance
    private function __construct(){}

    // to get single instance of pdo
    public static function getInstance():\PDO{
        if(self::$conn===null){
            self::$conn =  new \PDO("mysql:host=localhost;","gurpinder","password@123");
            self::$conn->exec("CREATE DATABASE IF NOT EXISTS php_project");
            self::$conn->exec("use php_project;");
            self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }

    // for testing purposes
    public static function test(){
        echo "Test Successful";
    }
}