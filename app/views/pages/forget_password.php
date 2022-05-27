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
    <form class="registration-form" id="small-form" action="/verify-email" method="POST" autocomplete="off" onsubmit="return validateForm(this)" novalidate>
      <h1  class="form-heading">Password Recovery</h1>
      <p style="margin:2px">Enter your email address</p>
      <div class="field-container" id="small-form-field-container">
      <div class="form-field">
          <input class="input-field" type="email" name="email" placeholder="Email Address" onblur="validateEmail(this)" />
          <small class="error" id="email-error"></small>
        </div>
        <button class="btn" type="submit">Send OTP</button>
      </div>
    </form>
    <hr />
  </div>
</div>

<script src="/public/js/script.js"></script>
</body>
</html>






















<!--
<div class="form-field">
          <input class="input-field" type="password" name="password" id="signPassword" placeholder="Password"  onblur="validatePassword(this)" />
          <small class="error" id="password-error" ></small>
          <span id="show-password-toggler" onclick="toggle_password_visibility('signPassword')"
      ><svg
          xmlns="http://www.w3.org/2000/svg"
          class="icon icon-tabler icon-tabler-eye-close"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="#757575"
          fill="none"
          stroke-linecap="round"
          stroke-linejoin="round"

        >
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <circle cx="12" cy="12" r="2" />
          <path
            d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"
          /></svg
      ></span>


        </div>


        <div class="form-field">
          <input
            class="input-field"
            name="confirmPassword"
            type="password"
            placeholder="Confirm Password"
            id="confirm-password"
            onblur="validateConfirmPassword(this)"
          />
          <span id="show-password-toggler" onclick="toggle_password_visibility('confirm-password')"
      ><svg
          xmlns="http://www.w3.org/2000/svg"
          class="icon icon-tabler icon-tabler-eye-close"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="#757575"
          fill="none"
          stroke-linecap="round"
          stroke-linejoin="round"

        >
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <circle cx="12" cy="12" r="2" />
          <path
            d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"
          /></svg
      ></span>



          <small class="error" id="confirmPassword-error"></small>
        </div> -->
