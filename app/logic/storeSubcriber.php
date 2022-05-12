<?php
use Database\Models\SubscriberModel;



$result = subscriberModel::insert($_POST);
if(!isset($result["error"])){
    header("Location: http://" . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . "/subscribers");
    die();
}
else{
    print_r($result["error"]);
}