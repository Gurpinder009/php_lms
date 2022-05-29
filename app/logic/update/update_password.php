
<?php

use Database\Models\PersonModel;

if(isset($_POST["password"])){
    $url =explode("/",$_SERVER["REQUEST_URI"]);
        $id =end($url);
            $result  = PersonModel::updatePassword($id,$_POST["password"]);
            if(!isset($result["error"])){
                redirect("404","Password Changed"); 
            }
            else{
                redirect("404","Operation Failed");
            }
    }
?>