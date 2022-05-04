<?php
namespace Database\Migrations;
use Config\Traits\MigrationTrait;
class StaffMigration
{
    use MigrationTrait;

    public static function create()
    {
        $statement = "CREATE TABLE IF NOT EXISTS staff(
            staff_id INT AUTO_INCREMENT,
            staff_name VARCHAR(85) NOT NULL,
            staff_email VARCHAR(120) NOT NULL UNIQUE,
            staff_phone_num VARCHAR(30)  NOT NULL UNIQUE,
            staff_password VARCHAR(85) NOT NULL,
            role_id INT NOT NULL,
            PRIMARY KEY users_pk(staff_id)
        );";
        
        self::createTable($statement);
    }
}
