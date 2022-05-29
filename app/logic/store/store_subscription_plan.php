<?php

use Database\Models\SubscriptionPlanModel;
staff_auth();

    if(isset($_POST["title"])){
        $result = SubscriptionPlanModel::insert($_POST);
        if(isset($result["error"])){
            redirect("404",$result["error"]);
        }else{
            redirect("subscription_plans");
        }
    }
?>