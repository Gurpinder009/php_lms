<?php

use Database\Models\BorrowBooksModel;
staff_auth();

$id = explode("/",$_SERVER["REQUEST_URI"])[2];
if(isset($id)){
    $result = BorrowBooksModel::return_book($id);
    if(isset($result["error"])){
        redirect("404",$result["error"]);
    }else{
        redirect("issued_books");
    }
}
?>