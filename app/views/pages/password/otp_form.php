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
    <form class="registration-form" id="small-form" action="/<?php echo $encode_url;?>" method="POST" autocomplete="off" onsubmit="return validateForm(this)" novalidate>
      <h1  class="form-heading">Password Recovery</h1>
      <p style="margin:2px">Enter OTP sent to your email address. </p>
      <div class="field-container" id="small-form-field-container">
      <div class="form-field">
          <input class="input-field" type="number" max="6" min="5" name="otp" placeholder="000000" onblur="validateNumber(this)" />
          <small class="error" id="email-error"></small>
        </div>
        <button class="btn" type="submit">Send OTP</button>
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
















