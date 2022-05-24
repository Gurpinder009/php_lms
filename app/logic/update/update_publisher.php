<?php

use Database\Models\PublisherModel;
require_once(__DIR__."/../auth_redirection_staff.php");

$publisher_id = explode("/", $_SERVER["REQUEST_URI"])[3];
$publisher = PublisherModel::update($publisher_id, $_POST);
if (isset($publisher["error"])) {
    redirect("404",$publisher["error"]); 
}
if ($publisher == 1) {
    redirect("publishers"); 
}
