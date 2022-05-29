<?php 

use Database\Models\AuthorModel;
staff_auth();
if(isset($_POST["name"])){
    $author_id = explode("/",$_SERVER["REQUEST_URI"])[3];
    $author = AuthorModel::update($author_id,$_POST);
    if(isset($author["error"])){
        redirect("404",$author["error"]);
    }   
    if($author == 1){
        redirect("authors");
    }
}
   
