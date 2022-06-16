<?php

use Database\Models\StaffModel;
staff_auth();
if(!isset($_SESSION)){
    session_start();
}


if(!isset($_SESSION["verification_data"]["staff_data"])){
    redirect("404","Opps! something went wrong");
}
$data = $_SESSION["verification_data"]["staff_data"];
if($data["name"]){
    $result = StaffModel::insert($data);
    unset($_SESSION["verification_data"]);
    session_regenerate_id();
    if(!isset($result["error"])){
        redirect("staff_members");
        
    }
    else{
        redirect("404",$result["error"]);
    }
}