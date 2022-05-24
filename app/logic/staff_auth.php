<?php

use Database\Models\StaffModel;

if (isset($_POST['email']) && isset($_POST['password'])) {
    $result = StaffModel::login($_POST['email'], $_POST['password']);
    if (isset($result["error"])) {
        redirect("login",$result["error"]);
    } else {
        session_start();
        if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
            redirect("home");
        }
    }
}







// echo "<br/>";
// if (isset($_SESSION['auth'])) {
//     echo $_SESSION['auth_user']->name . " is authenticated";

//     if (StaffModel::logout()) {
//         echo "<br/>logged out";
//     }
// }
