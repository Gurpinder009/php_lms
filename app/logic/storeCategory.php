<?php

use Database\Models\CategoryModel;

require_once(__DIR__ . "/auth_redirection_staff.php");



if (isset($_POST['title'])) {

    $result = CategoryModel::insert($_POST);
    if (!$result["error"]) {
        redirect("\categories");
    }
    if ($result["code"] == 23000) {
        redirect("404", "Duplicate Entry");
    }
}
