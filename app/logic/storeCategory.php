<?php

use Database\Models\CategoryModel;

echo " we are here";
    if(isset($_POST['title'])){
        
        $result = CategoryModel::insert($_POST);
        if(!$result["error"]){
            header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/categories");
            die();
        }
        print_r($result["error"]);
    }