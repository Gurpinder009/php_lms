<?php

use Database\Models\PersonModel;




if (isset($_POST["email"]) && $_POST["email"] !== "") {
    $isRegistered = PersonModel::findUsingEmail($_POST["email"]);
    if (!isset($isRegistered["id"])) {
        $otp = rand(10000, 99999);
        $message = "<body>
            <div>
                <h1>Email verfication</h1>
                <p>
                  Use following OTP to verify your email within 4 minutes to change password
                </p>
                <h2 id='otp'>$otp</h2>
            <div>
        </body>";

        if (sendMail($_POST["email"], $message)) {
            $hashed_otp = hash("sha256", $otp);
            $expire_time = new DateTime(date(""));
            $expire_time->add(new DateInterval("PT3M"));
            $data = ["data" => $_POST, "hashedOtp" => $hashed_otp, "expire_time" => $expire_time];
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION["verification_data"] = $data;
            require_once __DIR__ . "/../../views/pages/password/otp_form.php";
        }
    } else {
        redirect("subscriber/create", "Email is already registrated");
    }
} else {
    redirect("subscriber/create", "Necessary should be provided");
}
