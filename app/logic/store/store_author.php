<?php

use Database\Models\AuthorModel;
staff_auth();
    if(isset($_POST['name'])){
        $result = AuthorModel::insert($_POST);
        if(!isset($result["error"])){
            redirect("authors");
        }
        if($result["code"] ==23000){
            redirect("404","Duplicate Entry");
        }
    
    }