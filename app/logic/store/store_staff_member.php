<?php

use Database\Models\StaffModel;
staff_auth();
if($_POST["name"]){
    $result = StaffModel::insert($_POST);
    if(!isset($result["error"])){
        redirect("staff_members");
    }
    else{
        redirect("404",$result["error"]);
    }
}