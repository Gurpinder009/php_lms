<?php

require_once(__DIR__."/../../../logic/auth_redirection_staff.php");


$title = "Add User";

require_once __DIR__ . "/../../layout/navbar.php";?>
<link rel="stylesheet" href="../../../../public/css/forms.css">

<div class="registration-form-container">
  <div class="wrapper">
    <hr />
    <form class="registration-form" action="/subscriber/store" method="POST" onsubmit="return validateURForm(this)" autocomplete="off">
      <h1 class="form-heading">Subscriber Registration</h1>
      <div class="field-container">
        <div class="form-field">
          <input class="input-field" name="name" placeholder="Name" onblur="validateName(this)" />
          <small class="error" id="name-error"></small>
        </div>

        <div class="form-field">
          <input class="input-field" type="email" name="email" placeholder="Email Address" onblur="validateEmail(this)" />
          <small class="error" id="email-error"></small>
        </div>

        <div class="form-field">
          <input class="input-field" name="phone_num" placeholder="Phone Number" onblur="validatePhoneNum(this)" />
          <small class="error" id="phone_num-error"></small>
        </div>

        <div class="form-field">
          <input
            class="input-field"
            name="dob"
            onblur="(this.type='text'); validateDateOfBirth(this)"
            onfocus="(this.type='date')"
            placeholder="Date of Birth"
        
          />
          <small class="error" id="dob-error"></small>
        </div>



          <div class="form-field">
            <input
              class="input-field"
              name="city"
              placeholder="City"
              onblur ="validateName(this)"
            />
            <small class="error" id="city-error"></small>
          </div>

          <div class="form-field">
            <input
              class="input-field"
              name="state"
              placeholder="State"
              onblur ="validateName(this)"
            />
            <small class="error" id="state-error"></small>
          </div>


          <div class="form-field">
            <input
              class="input-field"
              name="country"
              placeholder="Country"
              onblur ="validateName(this)"

            />
            <small class="error" id="country-error"></small>
          </div>

          <div class="form-field">
            <input
              class="input-field"
              name="pin_code"
              placeholder="Pin Code"
              onblur="validatePinCode(this)"
            />
            <small class="error" id="pin_code-error"></small>
          </div>

        <div class="form-field">
          <input
            class="input-field"
            name="password"
            type="password"
            placeholder="Password"
            id="signPassword"
            onblur = "validatePassword(this)"
          />

          <span id="show-password-toggler" onmousedown="toggle_password_visibility('signPassword')"
      onmouseup="toggle_password_visibility('signPassword')"><svg
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


          <small class="error" id="password-error"></small>
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
          <span id="show-password-toggler" onmousedown="toggle_password_visibility('confirm-password')"
      onmouseup="toggle_password_visibility('confirm-password')"
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
        </div>

        <button class="btn" type="submit">Submit</button>
        <button class="btn" type="reset">Reset</button>
    </div>
    </form>
    <hr />
  </div>
</div>




<?php require_once __DIR__ . "/../../layout/footer.php";?>