<?php

staff_auth();
use Database\Models\PublisherModel;

    $publisher_id = explode("/",$_SERVER["REQUEST_URI"])[3];
    $publisher = PublisherModel::delete($publisher_id);
    if(isset($publisher["error"])){
        redirect("404",$publisher["error"]);
        
    }  

    if($publisher == 1){
        redirect("publishers");

    }