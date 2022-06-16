<?php
use Database\Models\SubscriberModel;

staff_auth();
if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION["verification_data"]["data"])){
    redirect("404","Opps! something went wrong");
}
$data = $_SESSION["verification_data"]["data"];
if($data["name"]){
    $result = SubscriberModel::insert($data);
    unset($_SESSION["verification_data"]);
    session_regenerate_id();
    if(!isset($result["error"])){
        redirect("subscribers");
        
    }
    else{
        redirect("404",$result["error"]);
    }
}