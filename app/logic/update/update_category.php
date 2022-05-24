<?php

use Database\Models\CategoryModel;
require_once(__DIR__."/../auth_redirection_staff.php");

$category_id = explode("/", $_SERVER["REQUEST_URI"])[3];
$category = CategoryModel::update($category_id, $_POST);
if (isset($category["error"])) {
    redirect("404",$category["error"]);
}
if ($category == 1) {
    redirect("categories"); 
}
