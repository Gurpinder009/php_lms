<?php
namespace Database\Migrations;
use Config\Traits\MigrationTrait;

class BooksMigration
{
    use MigrationTrait;
    public static function create()
    {
        $statement = "CREATE TABLE IF NOT EXISTS books(
            accession_no INT AUTO_INCREMENT,
            title VARCHAR(85) NOT NULL,
            publisher VARCHAR(85) NOT NULL,
            description VARCHAR(255),
            CONSTRAINT combine_uk UNIQUE(title,publisher,description),
            PRIMARY KEY book_pk(accession_no)
            );
        "; 
        self::createTable($statement);
    }
}
