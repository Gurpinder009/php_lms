<?php

function isActive($href)
{
  if ($href == $_SERVER["REQUEST_URI"]) {
    return "class='active-link'";
  }
}
?>


<div id="drawer">
  <?php
  if(!isset($_SESSION)){
    session_start();
  }
  if ($_SESSION["isStaff"] === true) {
    require_once __DIR__ . "/drawerStaff.php";
  } else {
    require_once __DIR__ . "/drawerSubscriber.php";
  }
  ?>


</div>