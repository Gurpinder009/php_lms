<?php

require_once __DIR__ . "../../../vendor/autoload.php";
use Database\Models\UsersModel;

if (isset($_POST['email']) && isset($_POST['password'])) {
    if (UsersModel::login($_POST['email'], $_POST['password'])) {
        echo "logged in";
    }
}

session_start();
if(isset($_SESSION['auth'])&& $_SESSION['auth']===true){
  header("Location: http://localhost:8000/home");
  die();
}



// echo "<br/>";
// if (isset($_SESSION['auth'])) {
//     echo $_SESSION['auth_user']->name . " is authenticated";

//     if (UsersModel::logout()) {
//         echo "<br/>logged out";
//     }

// }
