<?php 
if(!isset($_SESSION)){
  session_start();
}
if(!isset($_SESSION['auth']) || $_SESSION['isStaff']!== false){
  header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/login");
    die();
}

