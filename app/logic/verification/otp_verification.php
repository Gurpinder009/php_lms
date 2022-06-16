<?php

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["verification_data"])) {
    $data = $_SESSION["verification_data"];
    $now = new DateTime(date(""));
    if ($data["expire_time"] < $now) {
        redirect("404", "Sorry Timeout");
    }

    $otp = $data["hashedOtp"];
    if ($otp === hash("sha256", $_POST["otp"])) {
        if(isset($data["staff_data"])){
            redirect("staff/store");
        }elseif ($data["data"]){
            redirect("subscriber/store");
        }else{
            $url = urlencode("change-password?id=" . $data["id"]);
            redirect($url);
        }
    } else {
        redirect("404", "Wrong otp");
    }
} else {
    redirect("404", "Page Not found");
}
