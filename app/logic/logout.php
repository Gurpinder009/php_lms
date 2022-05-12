<?php
use Database\Models\SubscriberModel;
if (SubscriberModel::logout()) {
    header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/home");
    die();
}


