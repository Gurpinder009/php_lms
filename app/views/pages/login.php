<?php 
  if(!isset($_SESSION)){
    session_start();
  }
  if(isset($_SESSION["auth"]) && $_SESSION["auth"]==true){
      redirect("home");
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
  <link rel="stylesheet" href="/public/css/Login-form.css" />
</head>

<body>
  <?php
  if (isset($_GET["error"])) {
    echo "<div class='alert' onclick='closeAlert(this)'>" . $_GET["error"] . "</div>";
  }
  ?>

  <div class="form-container">
    <form class="form" autocomplete="off" method="POST" action="/staff/auth" autocomplete="off" onsubmit="return validateULForm(this)">
      <div class="form-text">
        <h1 class="form-heading">Staff Login</h1>
      </div>
      <div class="form-field">
        <label class="field-label" for="u_email">Email Address</label>
        <input class="input-field" type="email" name="email" onblur="validateEmail(this)" />
        <small class="error" id="email-error"></small>
      </div>
      <div class="form-field">
        <label class="field-label" for="password">Password</label>
        <input class="input-field" type="password" name="password" id="password" onblur="validatePassword(this)" />
        <span id="show-password-toggler" onclick="toggle_password_visibility('password')"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-close" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <circle cx="12" cy="12" r="2" />
            <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
          </svg></span>
        <small id="password-error" class="error"> </small>
      </div>
      <div style="display:flex;justify-content:space-between">
        <span>Any Trouble?</span>
        <a href="/edit/forget-password">Forget password</a>
      </div>

      <button class="btn">Sign in</button>

      <div class="signup-link">
        <span>Login As Subscriber Instead? </span><a href="/subscriber/login">Subscriber Login</a>
      </div>
    </form>
  </div>
  <script src="/public/js/script.js"></script>


</body>

</html>