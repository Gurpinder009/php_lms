<?php
require_once(__DIR__."/../auth_redirection_staff.php");
use Database\Models\AuthorModel;
    $author_id = explode("/",$_SERVER["REQUEST_URI"])[3];
    $author = AuthorModel::delete($author_id);
    if(isset($author["error"])){
        print_r($author["error"]);
        die();
    }  

    if($author == 1){
        header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/authors");
        die();
    }