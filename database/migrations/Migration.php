<?php

namespace Database\Migrations;

require_once __DIR__ . "../../../vendor/autoload.php";

class Migration
{

    public static function create()
    {
        // self::$conn->exec("CREATE DATABASE IF NOT EXISTS php_project");
        //     self::$conn->exec("use php_project;");
        UsersMigration::create();
        BooksMigration::create();
        AuthorsMigration::create();
        CategoriesMigration::create();
        RolesMigration::create();
        StaffMigration::create();
        SubscriptionsMigration::create();
    }

    public static function destory(){
        UsersMigration::destory();
        BooksMigration::destory();
        AuthorsMigration::destory();
        CategoriesMigration::destory();
        RolesMigration::destory();
        StaffMigration::destory();
        SubscriptionsMigration::destory();
    }
}

Migration::create();
// Migration::destory();
