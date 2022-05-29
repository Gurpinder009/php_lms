<?php

use Database\Models\SubscriptionPlanModel;
staff_auth();
if (isset($_POST["title"])) {

    $subscription_plans_id = explode("/", $_SERVER["REQUEST_URI"])[3];
    $subscription_plans = SubscriptionPlanModel::update($subscription_plans_id, $_POST);
    if (isset($subscription_plans["error"])) {
        redirect("404", $subscription_plans["error"]);
    }
    if ($subscription_plans == 1) {
        redirect("subscription_plans");
    }
}
