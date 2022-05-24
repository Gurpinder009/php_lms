<?php

require_once(__DIR__."/../auth_redirection_staff.php");
use Database\Models\PublisherModel;

    $publisher_id = explode("/",$_SERVER["REQUEST_URI"])[3];
    $publisher = PublisherModel::delete($publisher_id);
    if(isset($publisher["error"])){
        redirect("404",$publisher["error"]);
        
    }  

    if($publisher == 1){
        redirect("publishers");

    }