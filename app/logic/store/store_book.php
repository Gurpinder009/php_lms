<?php

use Database\Models\AuthorModel;
use Database\Models\BookModel;
use Database\Models\CategoryModel;
use Database\Models\PublisherModel;
staff_auth();

if($_POST["author_id"]){

    $data = $_POST;
    
    $data["author_id"] = AuthorModel::findByName($_POST['author_id']);
    $data["publisher_id"] = PublisherModel::findByName($_POST['publisher_id']);
    $data["category_id"] =CategoryModel::findByName($_POST['category_id']);
    
    $result = BookModel::insert($data);
    if(isset($result["error"])){
        redirect("books",$result["error"]);
    }
    if($result == 1){
        redirect("books");
    }
    
}


