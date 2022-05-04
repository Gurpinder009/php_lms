<?php
namespace Config\Traits;
use Database\DatabaseConnection;

trait SeederTrait
{
    public static function seed($statement)
    {
        try {

            $conn = DatabaseConnection::getInstance();
            $result = $conn->exec($statement);

            echo str_replace("Seeder", "", explode("\\", __CLASS__)[2]) . " table is seeded " . $result . PHP_EOL;
        } catch (\PDOException$ex) {
            echo $ex->getMessage();
        }
    }
}
