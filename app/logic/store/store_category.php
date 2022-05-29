<?php

use Database\Models\CategoryModel;

staff_auth();


if (isset($_POST['title'])) {

    $result = CategoryModel::insert($_POST);
    if (!$result["error"]) {
        redirect("\categories");
    }
    if ($result["code"] == 23000) {
        redirect("404", "Duplicate Entry");
    }
}
