<?php

use Database\Models\SubscriptionPlanModel;
require_once(__DIR__."/auth_redirection_staff.php");

    if(isset($_POST["title"])){
        $result = SubscriptionPlanModel::insert($_POST);
        if(isset($result["error"])){
            redirect("404",$result["error"]);
        }else{
            redirect("subscription_plans");
        }
    }
?>