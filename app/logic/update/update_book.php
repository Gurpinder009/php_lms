<?php

require_once(__DIR__."/../auth_redirection_staff.php");
use Database\Models\AuthorModel;
use Database\Models\BookModel;
use Database\Models\CategoryModel;
use Database\Models\PublisherModel;
    if(isset($_POST["title"])){
        $id = explode("/",$_SERVER["REQUEST_URI"])[3];

        $data = $_POST;
        $data["author_id"] = AuthorModel::findByName($_POST["author_id"]);
        if(isset($data["author_id"]["error"])){
            echo $data["author_id"]["error"];
            die();
        } 
        $data["publisher_id"] = PublisherModel::findByName($_POST["publisher_id"]);
        if(isset($data["publisher_id"]["error"])){
            echo $data["publisher_id"]["error"];
            die();
        }

        $data["category_id"] = CategoryModel::findByName($_POST["category_id"]);
        if(isset($data["category_id"]["error"])){
            echo $data["category_id"]["error"];
            die();
        }


        $result = BookModel::update($id,$data);
        if(!isset($result["error"]) && $result == 1){
            header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/books");
            die();    
        }

        print_r($result["error"]);
        die();

    
   



    }