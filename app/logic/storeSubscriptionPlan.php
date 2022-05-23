<?php

use Database\Models\SubscriptionPlanModel;
require_once(__DIR__."/auth_redirection_staff.php");

    if(isset($_POST["title"])){
        $result = SubscriptionPlanModel::insert($_POST);
        if(isset($result["error"])){
            print_r($result["error"]);
            die();
        }else{
            header("Location: http://" . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . "/subscription_plans");

            die();
        }
    }
?>