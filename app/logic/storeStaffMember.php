<?php

use Database\Models\StaffModel;
require_once(__DIR__."/auth_redirection_staff.php");


$result = StaffModel::insert($_POST);
if(!isset($result["error"])){
    redirect("staff_members");
}
else{
    redirect("404",$result["error"]);
}