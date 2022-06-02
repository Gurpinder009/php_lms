<?php
declare (strict_types = 1);
namespace Config\LoggerConfig;


use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LogHandler
{

    private static  $obj = null;

    static function getInstance(){
        if(self::$obj === null){
            self::$obj = new Logger("log");
        }
        return self::$obj;
    }

    static function errorLog(string $name, $data=[]){
        $ob = self::getInstance();
        $ob->pushHandler(new StreamHandler(__DIR__."/logs/error.log"),);
        $ob->error($name,$data);        
    }

    static function warningLog(string $name,$data=""){
            $ob = self::getInstance();
            $ob->pushHandler(new StreamHandler(__DIR__."/logs/warning.log"),);
            $ob->warning($name,["message"=>$data]);        
        
    }

    static function infoLog(string $name,$data=""){
        $ob = self::getInstance();
        $ob->pushHandler(new StreamHandler(__DIR__."/logs/info.log"),);
        $ob->info($name,["message"=>$data]);        
    }
}
