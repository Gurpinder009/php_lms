<?php
namespace Database\Seeders;

use Config\Traits\SeederTrait;
    class AuthorsSeeder{
        use SeederTrait;
        public static function run(){
            $statement = "INSERT IGNORE INTO authors(author_name,author_email,author_phone_num)
            VALUES ('Anshuman shrama','sharma@gmail.com','9283428372'), ('parteek bhatia','parteek@gmail.com',NUll), ('demo_author',NUll,'2342352322');";
            self::seed($statement);
        }
    }