<?php
//type hinting will be strict
declare(strict_types=1);

namespace Database;


//getting the information from .env file 

use Config\LoggerConfig\LogHandler;
use Dotenv\Dotenv as DotEnv;
use Monolog\Logger;

$dotenv = DotEnv::createImmutable(dirname(__DIR__));
$dotenv->load();


// class for creating single instance of the pdo 
class DatabaseConnection
{

    public static ?\PDO $conn = null;

    // to prevent mannual creation of pdo instance
    private function __construct()
    {
    }

    // to get single instance of pdo
    public static function getInstance(): \PDO
    {
        if (self::$conn === null) {
            self::$conn =  new \PDO("mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_DATABASE'] . ";", $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'],[
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC 
            ]);
            LogHandler::infoLog(__METHOD__, ["info" =>"Database connection is establish"]);
        }
        return self::$conn;
    }


}
