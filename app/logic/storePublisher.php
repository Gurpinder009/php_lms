<?php

use Database\Models\PublisherModel;

    if(isset($_POST['name'])){
        $result = PublisherModel::insert($_POST);
        if(!$result["error"]){
            header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/publishers");
            die();
        }
        print($result);
    }