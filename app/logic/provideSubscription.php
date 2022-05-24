<?php

use Database\Models\SubscriberModel;
use Database\Models\SubscriptionPlanModel;

require_once(__DIR__ . "/auth_redirection_staff.php");

if ($_POST["subscriber_id"]) {
    $data = $_POST;
    $current_subscription_date = new DateTime(date("Y-m-d"));
    $subscriptionDetails = SubscriptionPlanModel::getSubscribedPlanInfo($data["subscriber_id"]);
    if (!isset($subscriptionDetails["error"])) {
        $date = new \DateTime($subscriptionDetails["purchase_date"]);
        $date->add(new DateInterval("P" . $subscriptionDetails["time_period"] . "D"));
        if ($date > $current_subscription_date) {
            $current_subscription_date = $date;
        }
    }
    $data["purchase_date"] = $current_subscription_date->format("Y-m-d");
    $result = SubscriberModel::subscribe($data);
    if (!isset($result["error"])) {
        redirect("subscribers");
    }
    else{
        redirect("404",$result["error"]);
    }
   
}
