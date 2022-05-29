<?php

staff_auth();
$title = "Add Publisher";
 require_once(__DIR__."/../../layout/navbar.php"); ?>
<link rel="stylesheet" href="../../../../public/css/forms.css">

<div class="registration-form-container">
  <div class="wrapper">
    <hr />
    <form class="registration-form" id="small-form" action="/publisher/store" onsubmit="return validatePublisherForm(this)" method="POST" autocomplete="off" novalidate>
      <h1 class="form-heading">Add Publisher</h1>
      <div class="field-container" id="small-form-field-container">
        <div class="form-field">
          <input class="input-field" name="name" onblur="validateTitle(this)" placeholder="Name" />
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
<?php

?>
<?php require_once(__DIR__."/../../layout/footer.php"); ?>