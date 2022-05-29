<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    <?php
    echo (isset($title)) ? $title : "LMS";
    ?>
  </title>
  <link rel="stylesheet" href="/public/css/styles.css" />
</head>

<body>
  <?php require_once __DIR__ . "/drawer.php"; ?>
  <div class="section">
    <nav id="navbar">

      <a class="brand" href="/">LMS</a>
      <svg xmlns="http://www.w3.org/2000/svg" onclick="menu()" id="menu" class="icon icon-tabler icon-tabler-menu-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <line x1="4" y1="6" x2="20" y2="6" />
        <line x1="4" y1="12" x2="20" y2="12" />
        <line x1="4" y1="18" x2="20" y2="18" />
      </svg>

       
      <!-- Checking whether the Logged in person is staff or subscriber -->
      <?php

      if (!isset($_SESSION)) {
        session_start();
      }

      if ($_SESSION["isStaff"] === true) {
        require_once __DIR__ . "/navStaff.php";
      } else {
        require_once __DIR__ . "/navSubscriber.php";
      }
      ?>

      <span>
        <a class="link link-loggout" href="/logout">Logout</a>
      </span>
    </nav>

    <main>
      <div class="page-wrapper">