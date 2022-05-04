<?php
namespace Config\Traits;
use Database\DatabaseConnection;

    trait MigrationTrait{
        public static function destory(){
            try{
                $conn = DatabaseConnection::getInstance();    
                $table = strtolower(str_replace("Migration", "", explode("\\", __CLASS__)[2]));
                $conn->exec("DROP TABLE IF EXISTS ".$table.";");
                echo $table." is dropped".PHP_EOL;
            }catch(\PDOException $ex){
                print_r($ex->getMessage());
            }
        }


        public static function createTable($statement)
        {
            try {
                $conn = DatabaseConnection::getInstance();
                $result = $conn->exec($statement);                
                echo str_replace("Migration", "", explode("\\", __CLASS__)[2]) . " table is created" . PHP_EOL;
            } catch (\PDOException$ex) {
                print_r($ex->getMessage());
            }
        }
    
    }