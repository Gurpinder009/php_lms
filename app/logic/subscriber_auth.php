<?php

use Database\Models\SubscriberModel;

if (isset($_POST['email']) && isset($_POST['password'])) {
    $result = SubscriberModel::login($_POST['email'], $_POST['password']);
    if (isset($result["error"])) {
        header("Location: http://" . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . "/subscriber/login?error=".$result["error"]);
        die();
    } else {
        session_start();
        if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
            header("Location: http://" . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . "/userDashboard");
            die();
        }
    }
}

