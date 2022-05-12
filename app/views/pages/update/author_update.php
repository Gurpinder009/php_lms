<?php

use Database\Models\AuthorModel;

    $author_id = explode("/",$_SERVER["REQUEST_URI"])[2];
    $author = AuthorModel::find($author_id);
    if(isset($author["error"])){    
        print_r($author["error"]);
    }
    $title="Update Author";
    require_once(__DIR__."/../../layout/navbar.php");
?>
<link rel="stylesheet" href="/public/css/forms.css">
<link rel="stylesheet" href="/public/css/update-forms.css">

<div class="registration-form-container">
  <div class="wrapper">
    <hr />
    <form class="registration-form" id="small-form" action="/author/update" method="POST" autocomplete="off" onsubmit="return validateAuthorForm(this)">
      <h1 class="form-heading">Update Author</h1>
      <div class="field-container" id="small-form-field-container">
        <div class="form-field">
          <label for="author_name">Author Name</label>
          <input class="input-field" name="name" id="author_name" value=<?php echo $author["name"]; ?> onblur="validateName(this)" />
          <small class="error" id="name-error"></small>
        </div>

        <div class="form-field">
          <label for="author_other_detials">Other Information</label>
          <input class="input-field" id="author_other_detials" name="contact_info" value=<?php echo $author["contact_info"]; ?>  />
          <small class="error"></small>
        </div>

        <button class="btn" type="submit">Update</button>
        <a class="btn" onclick="confirm('You really want to delete this Author')">Delete</a>

       
      </div>
    </form>
    <hr />
  </div>
</div>




<?php 
    require_once(__DIR__."/../../layout/footer.php");
?>