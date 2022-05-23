<?php

use Database\Models\BorrowBooksModel;
require_once(__DIR__."/auth_redirection_staff.php");

$id = explode("/",$_SERVER["REQUEST_URI"])[2];
if(isset($id)){
    $result = BorrowBooksModel::return_book($id);
    if(isset($result["error"])){
        print_r($result["error"]);
        die();
    }else{
        header("Location: http://" . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . "/issued_books");
        die();
    }
}
?>