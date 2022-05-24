<?php
use Database\Models\SubscriberModel;


require_once(__DIR__."/auth_redirection_staff.php");


$result = subscriberModel::insert($_POST);
if(!isset($result["error"])){
    redirect("subscribers");
}
else{
    redirect("404",$result["error"]);
}