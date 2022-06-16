<?php
 if (!isset($_SESSION)) {
  session_start();
}


if(!isset($_SESSION["verification_data"])){
  redirect("404","Page Is Not Found");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    Staff Login
  </title>
  <link rel="stylesheet" href="/public/css/styles.css" />
  <link rel="stylesheet" href="/public/css/forms.css">
</head>

<body>
<!-- "/update/subscriber/password" -->
<div class="registration-form-container">
  <div class="wrapper">
    <hr />
    <form class="registration-form" id="small-form" action="/update/password" method="POST" autocomplete="off" novalidate>
      <h1  class="form-heading">New Password</h1>
      <div class="field-container" id="small-form-field-container">
      <div class="form-field">
          <input class="input-field" id="signPassword" type="password" name="password"  onblur="validatePassword(this)" placeholder="Password" />
          <small class="error" id="password-error"></small>
        </div>
       
        <div class="form-field">
          <input class="input-field"  type="password" name="confirm_password"  onblur="validateConfirmPassword(this)" placeholder="Password Confirm" />
          <small class="error" id="confirm_password-error"></small>
        </div>

        <button class="btn" type="submit">Submit</button>
      </div>
      
    </form>
    <hr />
  </div>
</div>

<script src="/public/js/script.js"></script>
</body>
</html>