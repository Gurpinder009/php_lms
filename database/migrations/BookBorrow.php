<?php
namespace Database\Migrations;
use Config\Traits\MigrationTrait;

class BookBorrowMigration
{
    use MigrationTrait;
    public static function create()
    {
        $statement = "CREATE TABLE IF NOT EXISTS bookborrow(
           
            );
        "; 
        self::createTable($statement);
    }
}
