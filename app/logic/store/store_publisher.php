<?php

use Database\Models\PublisherModel;
staff_auth();


    if(isset($_POST['name'])){
        $result = PublisherModel::insert($_POST);
        if(!isset($result["error"])){
            redirect("publishers");
        }
        if($result["code"] ==23000){
            redirect("404","Duplicate Entry");
        }
    }