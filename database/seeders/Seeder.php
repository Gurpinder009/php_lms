<?php
namespace Database\Seeders;


require_once __DIR__."../../../vendor/autoload.php";

class Seeder{
    public static function run(){
        UsersSeeder::run();
        BooksSeeder::run();
        AuthorsSeeder::run();
    }
}
Seeder::run();