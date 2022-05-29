<?php
    use Database\Models\PersonModel;

    if(isset($_POST["email"])){
        $result = PersonModel::findUsingEmail($_POST["email"]);
        if(!isset($result["id"])){
            redirectWithLink("Email address is not registered","member/forget-password");
        }
        $otp = rand(10000, 99999);
        $message = "<h1>Your secret OTP for reseting your password<h1>
        <p> OTP : $otp </p> ";
        
        if(sendMail($result["email"],$message)){
            $hashed_otp = hash("sha256",$otp);
            $encode_url=urlencode("verify-otp/".$result['id']."?otp=$hashed_otp");
            require_once(__DIR__."/../../views/pages/password/otp_form.php");
        }
        

    }