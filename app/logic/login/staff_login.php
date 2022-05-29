<?php
use Database\Models\StaffModel;

if (isset($_POST['email']) && isset($_POST['password'])) {
    $result = StaffModel::login($_POST['email'], $_POST['password']);
    if (isset($result["error"])) {
        redirect("login",$result["error"]);
    } else {
        if(!isset($_SESSION)){
            session_start();
        }
        if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
            redirect("home");
        }
    }
}
