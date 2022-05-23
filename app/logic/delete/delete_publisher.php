<?php

require_once(__DIR__."/../auth_redirection_staff.php");
use Database\Models\PublisherModel;

    $publisher_id = explode("/",$_SERVER["REQUEST_URI"])[3];
    $publisher = PublisherModel::delete($publisher_id);
    if(isset($publisher["error"])){
        print_r($publisher["error"]);
        die();
    }  

    if($publisher == 1){
        header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/publishers");
        die();
    }