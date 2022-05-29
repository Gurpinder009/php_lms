<?php
staff_auth();
use Database\Models\CategoryModel;

    $category_id = explode("/",$_SERVER["REQUEST_URI"])[3];
    $category = CategoryModel::delete($category_id);
    if(isset($category["error"])){
        redirect("404",$category["error"]);
    }  

    if($category == 1){
        redirect("categories");
    }