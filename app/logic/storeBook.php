<?php

use Database\DatabaseConnection;
use Database\Models\AuthorModel;
use Database\Models\BookModel;
use Database\Models\CategoryModel;
use Database\Models\PublisherModel;

$data = $_POST;

print_r(AuthorModel::findByName($_POST['author_id']));
$data["author_id"] = AuthorModel::findByName($_POST['author_id'])['id'];
$data["publisher_id"] = PublisherModel::findByName($_POST['publisher_id'])['id'];
$data["category_id"] =CategoryModel::findByName($_POST['category_id'])['id'];
for($i = 0;$i<$_POST['no_of_copies'];$i++){
    BookModel::insert($data);
}

echo "<br/><br/><br/><br/>-----------------------output-------------------------<br/>";
$books = BookModel::all();
foreach($books as $book){
    echo "Title ".$book["title"]." Condition ".$book["condition"]."<br/>";
    echo "no_of_copies ".$book['no_of_copies']."<br/>";
}


