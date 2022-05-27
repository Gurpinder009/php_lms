
<?php

use Database\Models\PersonModel;
use Database\Models\SubscriberModel;
$url =explode("/",$_SERVER["REQUEST_URI"]);
$id =end($url);
    if(isset($_POST["password"])){
            $result  = PersonModel::updatePassword($id,$_POST["password"]);
            if(!isset($result["error"])){
                redirect("404","Password Changed");
                
            }
            else{
                redirect("404","Operation Failed");
            }
    }
?>