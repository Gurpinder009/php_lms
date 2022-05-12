<?php
require_once(__DIR__."/../../../logic/auth_redirection_staff.php");


use Database\Models\AuthorModel;
use Database\Models\CategoryModel;
use Database\Models\PublisherModel;

$authors = AuthorModel::all();
$categories = CategoryModel::all();
$publishers = PublisherModel::all();
$title = "Add Book";

require_once __DIR__ . "/../../layout/navbar.php";?>
<link rel="stylesheet" href="../../../../public/css/forms.css">

<div class="registration-form-container">
  <div class="wrapper">
    <hr />
    <form class="registration-form" action="/book/store" method="POST" onsubmit="return validateBookForm(this)" autocomplete="off">
      <h1 class="form-heading">Books</h1>
      <div class="field-container">
        <div class="form-field">
          <input class="input-field" name="title" onblur="validateName(this)" placeholder="Title" />
          <small class="error" id="title-error"></small>
        </div>

        <div class="form-field">

          <input class="input-field" name="author_id" placeholder="Author" list="authors" />
          <datalist id="authors">
          <?php
foreach ($authors as $author) {
    echo "<option value='" . $author['name'] . "'>" . $author['name'] . "</option>";}
?>
          </datalist>


          <small class="error" id="author_id-error"></small>
        </div>


        <input class="input-field" name="category_id" placeholder="Category" list="categories" />
          <datalist id="categories">
          <?php
foreach ($categories as $category) {
    echo "<option value='" . $category['name'] . "'>" . $category['name'] . "</option>";}
?>
          </datalist>

        <div class="form-field">
          <input class="input-field" name="no_of_copies" onblur="validateNumber(this)" placeholder="Number of copies" />
          <small class="error" id="no_of_copies-error"></small>
        </div>


        <div class="form-field">
          <input class="input-field" name="condition" onblur="validateCondtion(this)" placeholder="Condition" list="conditions" />
          <datalist id="conditions" >
            <option value="best">best</option>
            <option value="good">good</option>
            <option value="bad">bad</option>
          </datalist>
          <small class="error" id="condition-error"></small>
        </div>


        <div class="form-field">
          <input class="input-field" name="edition" onblur="validateNumber(this)" placeholder="Edition" />
          <small class="error" id="edition-error"></small>
        </div>
        <input class="input-field" name="publisher_id" placeholder="Publisher" list="Publishers" />
          <datalist id="Publishers">
          <?php
foreach ($publishers as $publisher) {
    echo "<option value='" . $publisher["name"] . "'>" . $publisher['name'] . "</option>";}
?>
          </datalist>



        <div class="form-field">
          <input class="input-field" name="language" onblur="validateName(this)"  placeholder="Language" />
          <small class="error" id="language-error"></small>
        </div>



        <button class="btn" type="submit">Submit</button>
        <button class="btn" type="reset">Reset</button>
      </div>
    </form>
    <hr />
  </div>
</div>


<?php require_once __DIR__ . "/../../layout/footer.php";
unset($publishers);
unset($categories);
unset($authors);
?>