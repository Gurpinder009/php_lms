<?php
namespace Database\Migrations;
use Config\Traits\MigrationTrait;
class UsersMigration
{
    use MigrationTrait;

    public static function create()
    {
        $statement = "CREATE TABLE IF NOT EXISTS users(
            user_id INT AUTO_INCREMENT,
            user_name VARCHAR(85) NOT NULL,
            user_dob DATE NOT NULL,
            user_email VARCHAR(120) NOT NULL UNIQUE,
            user_phone_num VARCHAR(30)  NOT NULL UNIQUE,
            user_password VARCHAR(85) NOT NULL,
            PRIMARY KEY users_pk(user_id)
        );";
        
        self::createTable($statement);
    }
}
