<?php
staff_auth();
use Database\Models\AuthorModel;
    $author_id = explode("/",$_SERVER["REQUEST_URI"])[3];
    $author = AuthorModel::delete($author_id);
    if(isset($author["error"])){
        redirect("404",$author["error"]);
    }  

    if($author == 1){
        redirect("authors");
    }