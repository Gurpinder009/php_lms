<?php

use Database\Models\AuthorModel;
use Database\Models\BookModel;
use Database\Models\CategoryModel;
use Database\Models\PublisherModel;
require_once(__DIR__."/auth_redirection_staff.php");


$data = $_POST;

$data["author_id"] = AuthorModel::findByName($_POST['author_id']);
$data["publisher_id"] = PublisherModel::findByName($_POST['publisher_id']);
$data["category_id"] =CategoryModel::findByName($_POST['category_id']);

$result = BookModel::insert($data);
if(isset($result["error"])){
    print_r($result);
}
if($result == 1){
    header("Location: http://".$_SERVER['SERVER_NAME'].":".$_SERVER["SERVER_PORT"]."/books");
    die();
}



