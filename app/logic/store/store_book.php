<?php

use Database\Models\AuthorModel;
use Database\Models\BookModel;
use Database\Models\CategoryModel;
use Database\Models\PublisherModel;
staff_auth();

if($_POST["author_id"]){

    $data = $_POST;
    
    $data["author_id"] = AuthorModel::findByName($_POST['author_id']);
    if(isset($data["author_id"]["error"])){
        $authorData = ["name"=>$_POST['author_id'],"contact_info"=>""];
       if(AuthorModel::insert($authorData)){
            echo "<script>alert('New Author is added to the system')</script>";
            $data["author_id"] = AuthorModel::findByName($_POST['author_id']);
       }
    }
    $data["publisher_id"] = PublisherModel::findByName($_POST['publisher_id']);
    if(isset($data["publisher_id"]["error"])){
        $publisherData = ["name"=>$_POST["publisher_id"],"contact_info"=>""];
       if(PublisherModel::insert($publisherData)){
            echo "<script>alert('New Publisher is added to the system')</script>";
            $data["publisher_id"] = PublisherModel::findByName($_POST["publisher_id"]);
       }
    }

    $data["category_id"] =CategoryModel::findByName($_POST['category_id']);
    if(isset($data["category_id"]["error"])){
        $categoryData = ["title"=>$_POST["category_id"],"description"=>""];
       if(CategoryModel::insert($categoryData)){
            echo "<script>alert('New Category is added to the system')</script>";
            $data["category_id"] = CategoryModel::findByName($_POST["category_id"]);
       }
    }
    
    $result = BookModel::insert($data);
    if(isset($result["error"])){
        redirect("books",$result["error"]);
    }
    if($result == 1){
        redirect("books");
    }
    
}


