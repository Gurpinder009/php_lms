<?php

use Database\Models\CategoryModel;
require_once(__DIR__."/../auth_redirection_staff.php");

$category_id = explode("/", $_SERVER["REQUEST_URI"])[3];
$category = CategoryModel::update($category_id, $_POST);
if (isset($category["error"])) {
    echo $category["error"];
    die();
}
if ($category == 1) {
    header("Location: http://" . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . "/categories");
    die();
}
