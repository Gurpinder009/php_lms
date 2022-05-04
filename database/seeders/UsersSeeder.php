<?php
namespace Database\Seeders;

use Config\Traits\SeederTrait;

class UsersSeeder
{
    use SeederTrait;
    public static function run()
    {
        $statement = "INSERT IGNORE INTO  users(user_name,user_dob,user_email,user_phone_num,user_password) VALUES
            ('gurpinder singh','2000-11-15','singh@gmail.com','6283343850','password@123'),
            ('Gurjot singh','1998-05-10','saggu@gmail.com','238923829','password'),
            ('Mohammad Raja','2001-03-24','mdraja@gmail.com','23423798','password@123');";
        self::seed($statement);
    }

}
