<?php

use Database\Models\BookModel;

if (!isset($_SESSION)) {
    session_start();
}
if(isset($_SESSION["auth"]) && $_SESSION["auth"]==true){
    if (isset($_GET['title'])) {
        $data = null;
        header("Content-Type:application/json");
        $data = BookModel::search($_GET["title"]);
        echo json_encode($data);
    }
}
else{
    redirect("login");
}