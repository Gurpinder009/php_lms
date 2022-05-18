<?php
use Database\DatabaseConnection;
use Database\Models\BookModel;

if(isset($_GET['title'])){
        $data = null;
        header("Content-Type:application/json");
        $data =BookModel::search($_GET["title"]);
        echo json_encode($data);
    }