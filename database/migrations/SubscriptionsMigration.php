<?php
            
namespace Database\Migrations;
use Config\Traits\MigrationTrait;

class SubscriptionsMigration
{
    use MigrationTrait;
    public static function create()
    {
        $statement = "CREATE TABLE IF NOT EXISTS subscriptions(
            subscription_id INT AUTO_INCREMENT,
            subscripton_title VARCHAR(85) NOT NULL,
            subscription_info VARCHAR(225),
            PRIMARY KEY subscriptions_pk(subscription_id)
            );"; 
        self::createTable($statement);
    }
}
