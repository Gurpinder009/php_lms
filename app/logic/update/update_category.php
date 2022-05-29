<?php

use Database\Models\CategoryModel;
staff_auth();
if (isset($_POST["name"])) {

    $category_id = explode("/", $_SERVER["REQUEST_URI"])[3];
    $category = CategoryModel::update($category_id, $_POST);
  
    if (isset($category["error"])) {
        redirect("404", $category["error"]);

    }
    if ($category == 1) {
        redirect("categories");
    }
}
