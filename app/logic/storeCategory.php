<?php

use Database\Models\CategoryModel;
require_once(__DIR__."/auth_redirection_staff.php");



    if(isset($_POST['title'])){
        
        $result = CategoryModel::insert($_POST);
        if(!$result["error"]){
            header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/categories");
            die();
        }
        if($result["code"] ==23000){
            echo "<h1>Duplicate Entry</h1>Go back ?<a href='/category/create'> Category</a>";
            die();

        }
    }