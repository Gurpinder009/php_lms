<?php

namespace Database\Migrations;
use Config\Traits\MigrationTrait;

class CategoriesMigration
{
    use MigrationTrait;
    public static function create()
    {
        $statement = "CREATE TABLE IF NOT EXISTS categories(
            category_id INT AUTO_INCREMENT,
            category_title VARCHAR(85) NOT NULL,
            category_description VARCHAR(225),
            PRIMARY KEY category_pk(category_id)
            );
        "; 
        self::createTable($statement);
    }
}
