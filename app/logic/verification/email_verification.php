<?php
use Database\Models\PersonModel;

if (isset($_POST["email"]) && $_POST["email"] !== "") {
    $result = PersonModel::findUsingEmail($_POST["email"]);
    if (!isset($result["id"])) {
        redirectWithLink("Email address is not registered", "member/forget-password");
    }
    $otp = rand(10000, 99999);
    $message = "<body>
        <div>
           
          
            <h1>Password Recovery</h1>
            <p>
              Use following OTP to verify your email within 4 minutes to change password
            </p>
            <h2 id='otp'>$otp</h2>
        <div>
    </body>";

    if (sendMail($result["email"], $message)) {
        $hashed_otp = hash("sha256", $otp);
        $expire_time = new DateTime(date(""));
        $expire_time->add(new DateInterval("PT3M"));
        $data = ["id" => $result["id"], "hashedOtp" => $hashed_otp, "expire_time" => $expire_time];
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION["verification_data"] = $data;
        // $encode_url=urlencode("verify-ot");
        require_once __DIR__ . "/../../views/pages/password/otp_form.php";
    }

} else {
    redirect("edit/forget-password?error=Email%20is%20required");
}
