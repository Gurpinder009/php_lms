<?php

use Database\Models\PublisherModel;
require_once(__DIR__."/auth_redirection_staff.php");


    if(isset($_POST['name'])){
        $result = PublisherModel::insert($_POST);
        if(!isset($result["error"])){
            header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/publishers");
            die();
        }
        if($result["code"] ==23000){
            echo "<h1>Duplicate Entry</h1>Go back ?<a href='/publisher/create'> Publisher</a>";
            die();

        }
    }