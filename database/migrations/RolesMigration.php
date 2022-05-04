<?php

namespace Database\Migrations;
use Config\Traits\MigrationTrait;

class RolesMigration
{
    use MigrationTrait;
    public static function create()
    {
        $statement = "CREATE TABLE IF NOT EXISTS roles(
            role_id INT AUTO_INCREMENT,
            role_title VARCHAR(85) NOT NULL,
            role_info VARCHAR(225),
            PRIMARY KEY roles_pk(role_id)
            );
        "; 
        self::createTable($statement);
    }
}
