<?php 
session_start();
if(!isset($_SESSION['auth'])){
  header("Location: http://localhost:8000/login");
  die();
}

