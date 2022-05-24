<?php 
if(!isset($_SESSION)){
  session_start();
}
if(!isset($_SESSION['auth']) || $_SESSION['isStaff']!== false){
  redirect("login"); 
}

