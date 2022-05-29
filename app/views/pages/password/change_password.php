<?php
    $url = urldecode($_SERVER["REQUEST_URI"]);
    $url = explode("?",$url);
    $url = end($url);
    $url = explode("&",$url);
    $url = end($url);
    $id =explode("=",$url)[1];
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
    <form class="registration-form" id="small-form" action="/update/password/<?php echo $id; ?>" method="POST" autocomplete="off" onsubmit="return validateForm(this)" novalidate>
      <h1  class="form-heading">New Password</h1>
      <div class="field-container" id="small-form-field-container">
      <div class="form-field">
          <input class="input-field" type="password" name="password"  onblur="validatePassword(this)" placeholder="Password" />
          <small class="error" id="email-error"></small>
        </div>
       
        <div class="form-field">
          <input class="input-field" type="password" name="password"  onblur="validatePassword(this)" placeholder="Password Confirm" />
          <small class="error" id="email-error"></small>
        </div>

        <button class="btn" type="submit">Submit</button>
      </div>
      <div style="display:flex;justify-content:right;">
        <span>Didn't receive OTP? </span>
        <a href="/subscriber/forget-password" style="color:blue"> Resend</a>
      </div>
    </form>
    <hr />
  </div>
</div>

<script src="/public/js/script.js"></script>
</body>
</html>