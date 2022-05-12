<?php

require_once(__DIR__."/../../../logic/auth_redirection_staff.php");



$title ="Add Author";

require_once(__DIR__."/../../layout/navbar.php"); ?>

<link rel="stylesheet" href="../../../../public/css/forms.css">
<div class="registration-form-container">
  <div class="wrapper">
    <hr />
    <form class="registration-form" id="small-form" action="/author/store" method="POST" autocomplete="off" onsubmit="return validateAuthorForm(this)" novalidate>
      <h1 class="form-heading">Add Author</h1>
      <div class="field-container" id="small-form-field-container">
        <div class="form-field">
          <input class="input-field" name="name" onblur="validateName(this)" placeholder="Name" />
          <small class="error" id="name-error"></small>
        </div>

        <div class="form-field">
          <input class="input-field" type="email" name="contact_info" placeholder="Contact Information" />
          <small class="error"></small>
        </div>

        <button class="btn" type="submit">Submit</button>
       
      </div>
    </form>
    <hr />
  </div>
</div>

<?php require_once(__DIR__."/../../layout/footer.php"); ?>