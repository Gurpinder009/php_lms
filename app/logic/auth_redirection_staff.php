


<?php 
session_start();
if(!isset($_SESSION['auth']) || $_SESSION["isStaff"] !== true){
  header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/login");
    die();
}

