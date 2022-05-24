<?php

use Database\Models\PersonModel;
use Database\Models\StaffModel;

    if(isset($_POST["email"]) && isset($_POST["password"])){
        $result = StaffModel::findUsingEmail($_POST["email"]);
        if(!isset($result["error"])){
            $result = StaffModel::getPersonId($result["id"]);
            $result  = PersonModel::updatePassword($result,$_POST);
            if(!isset($result["error"])){
                redirect("404","Password Changed"); 
            }
            else{
                redirect("404","Operation");  
            }
        }
        else{
            redirect("404","Not matching data found");
        }        
    }
?>