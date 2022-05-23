<?php

use Database\Models\StaffModel;
require_once(__DIR__."/auth_redirection_staff.php");


$result = StaffModel::insert($_POST);
if(!isset($result["error"])){
    header("Location: http://" . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . "/staff_members");
    die();
}
else{
    print_r($result["error"]);
}