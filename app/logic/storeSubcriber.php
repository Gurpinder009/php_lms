<?php
use Database\Models\SubscriberModel;


require_once(__DIR__."/auth_redirection_staff.php");


$result = subscriberModel::insert($_POST);
if(!isset($result["error"])){
    header("Location: http://" . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . "/subscribers");
    die();
}
else{
    print_r($result["error"]);
}