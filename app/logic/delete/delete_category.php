<?php

require_once(__DIR__."/../auth_redirection_staff.php");
use Database\Models\CategoryModel;

    $category_id = explode("/",$_SERVER["REQUEST_URI"])[3];
    $category = CategoryModel::delete($category_id);
    if(isset($category["error"])){
        print_r($category["error"]);
        die();
    }  

    if($category == 1){
        header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/categories");
        die();
    }