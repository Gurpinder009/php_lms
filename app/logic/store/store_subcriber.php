<?php

use Database\Models\SubscriberModel;
staff_auth();

if ($_POST["name"]) {
    $result = subscriberModel::insert($_POST);
    if (!isset($result["error"])) {
        redirect("subscribers");
    } else {
        redirect("404", $result["error"]);
    }
}
