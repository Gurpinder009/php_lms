<?php

use Database\Models\SubscriberModel;

if (isset($_POST['email']) && isset($_POST['password'])) {
    $result = SubscriberModel::login($_POST['email'], $_POST['password']);
    if (isset($result["error"])) {
        redirect("subscriber/login?error=".$result["error"]);
    } else {
        session_start();
        if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
            redirect("userDashboard");
        }
    }
}

