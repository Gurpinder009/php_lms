<?php

use Database\Models\SubscriptionPlanModel;
require_once(__DIR__."/../auth_redirection_staff.php");

$subscription_plans_id = explode("/", $_SERVER["REQUEST_URI"])[3];
$subscription_plans = SubscriptionPlanModel::update($subscription_plans_id, $_POST);
if (isset($subscription_plans["error"])) {
    echo $subscription_plans["error"];
    die();
}
if ($subscription_plans == 1) {
    header("Location: http://" . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . "/subscription_plans");
    die();
}