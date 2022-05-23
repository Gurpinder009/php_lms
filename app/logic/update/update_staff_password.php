<?php

use Database\Models\PersonModel;
use Database\Models\StaffModel;

    if(isset($_POST["email"]) && isset($_POST["password"])){
        $result = StaffModel::findUsingEmail($_POST["email"]);
        if(!isset($result["error"])){
            $result = StaffModel::getPersonId($result["id"]);
            $result  = PersonModel::updatePassword($result,$_POST);
            if(!isset($result["error"])){
                echo "<h1>Password Changed</h1>Goto login page <a href='/login'>login page</a>";
                die(); 
            }
            else{
                echo "<h1>Operation Failed </h1>Goto login page <a href='/login'>login page</a>";
                die();
            }
        }
        else{
            echo "<h1>Not matching data found</h1>Goto login page <a href='/login'>login page</a>";

            die();
        }        
    }
?>