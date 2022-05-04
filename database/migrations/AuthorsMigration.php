<?php

namespace Database\Migrations;
use Config\Traits\MigrationTrait;

class AuthorsMigration
{
    use MigrationTrait;
    public static function create()
    {
        $statement = "CREATE TABLE IF NOT EXISTS authors(
            author_id INT AUTO_INCREMENT,
            author_name VARCHAR(85) NOT NULL,
            author_info VARCHAR(225),
            PRIMARY KEY author_pk(author_id)
            );
        "; 
        self::createTable($statement);
    }
}
