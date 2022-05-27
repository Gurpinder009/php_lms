<?php

    $url = explode("=",urldecode($_SERVER["REQUEST_URI"]));
    $otp = end($url);
    $url =explode("?",$url[0])[0];
    $id= explode("/",$url)[2];
    if($otp === hash("sha256",$_POST["otp"])){
        $url = urlencode("change-password?id=$id");
        redirect($url);
    }
    else{
        redirect("404","Wrong otp");
    }