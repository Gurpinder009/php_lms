<?php

use Database\Models\AuthorModel;

    if(isset($_POST['name'])){
        $result = AuthorModel::insert($_POST);
        if(!isset($result["error"])){
            header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/authors");
            die();
        }
        print_r($result);
    }