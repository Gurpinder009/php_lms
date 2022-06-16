
<?php

use Database\Models\PersonModel;
if(!isset($_SESSION)){
    session_start();
}   

if(!isset($_SESSION["verification_data"])){
    redirect("404","Something Went wrong");
}

if(isset($_POST["password"]) && $_POST["password"] !== ""){
            $result  = PersonModel::updatePassword($_SESSION["verification_data"]["id"],$_POST["password"]);
            session_destroy();
            session_regenerate_id();
            if(!isset($result["error"])){
                redirect("404","Password Changed"); 
            }
            else{
                redirect("404","Operation Failed");
            }
    }
    redirect("404","Password is not provided properly");

?>