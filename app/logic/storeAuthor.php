<?php

use Database\Models\AuthorModel;
require_once(__DIR__."/auth_redirection_staff.php");


    if(isset($_POST['name'])){
        $result = AuthorModel::insert($_POST);
        if(!isset($result["error"])){
            redirect("authors");
        }
        if($result["code"] ==23000){
            redirect("404","Duplicate Entry");
        }
    
    }