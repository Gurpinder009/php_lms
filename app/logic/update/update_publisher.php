<?php

use Database\Models\PublisherModel;
require_once(__DIR__."/../auth_redirection_staff.php");

$publisher_id = explode("/", $_SERVER["REQUEST_URI"])[3];
$publisher = PublisherModel::update($publisher_id, $_POST);
if (isset($publisher["error"])) {
    echo $publishser["error"];
    die();
}
if ($publisher == 1) {
    header("Location: http://" . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . "/publishers");
    die();
}
