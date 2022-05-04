<?php
use Database\Models\UsersModel;
if (UsersModel::logout()) {
    header("Location: http://localhost:8000/home");
    die();
}


