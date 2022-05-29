<?php

use Database\Models\PublisherModel;
staff_auth();
if (isset($_POST["name"])) {

    $publisher_id = explode("/", $_SERVER["REQUEST_URI"])[3];
    $publisher = PublisherModel::update($publisher_id, $_POST);
    if (isset($publisher["error"])) {
        redirect("404", $publisher["error"]);
    }
    if ($publisher == 1) {
        redirect("publishers");
    }
}
