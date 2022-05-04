<?php
namespace Database\Seeders;

use Config\Traits\SeederTrait;

class BooksSeeder
{
    use SeederTrait;
    public static function run()
    {

        $statement = "INSERT IGNORE INTO books(title,publisher,description)
                    VALUES ('Computer Graphics','Kalyani','About computer graphics'),
                    ('Data Structure','scheme outline','brief information of data structure'),
                    ('Fundamentals of DBMS','ABS Publications','ORACLE and SQL');
                ";
        self::seed($statement);
    }
}
