
<?php
  $title ="Add Category";
  require_once(__DIR__."/../../layout/navbar.php"); ?>

<div class="registration-form-container">
  <div class="wrapper">
    <hr />
    <form class="registration-form" id="small-form" action="/category/store" onsubmit="return validateCategoryForm(this)" method="POST">
      <h1 class="form-heading">Add Category</h1>
      <div class="field-container" id="small-form-field-container">
        <div class="form-field">
          <input class="input-field" name="title" onblur="validateName(this)" placeholder="Title" />
          <small class="error" id="title-error"></small>
        </div>

        <div class="form-field">
          <input class="input-field" name="description" placeholder="Description" />
          <small class="error"></small>
        </div>

        <button class="btn" type="submit">Submit</button>
       
      </div>
    </form>
    <hr />
  </div>
</div>

<?php require_once(__DIR__."/../../layout/footer.php"); ?>