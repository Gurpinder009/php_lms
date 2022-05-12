<?php

use Database\Models\CategoryModel;

$category_id = explode("/", $_SERVER["REQUEST_URI"])[2];
$category = CategoryModel::find($category_id);
if (isset($category["error"])) {
    print_r($category["error"]);
}
$title = "Update Category";
require_once(__DIR__ . "/../../layout/navbar.php");
?>
<link rel="stylesheet" href="/public/css/forms.css">
<link rel="stylesheet" href="/public/css/update-forms.css">



<div class="registration-form-container">
    <div class="wrapper">
        <hr />
        <form class="registration-form" id="small-form" action="/category/update" onsubmit="return validateCategoryForm(this)" method="POST">
            <h1 class="form-heading">Update Category</h1>
            <div class="field-container" id="small-form-field-container">
                <div class="form-field">
                    <label for="name">Name</label>
                    <input class="input-field" name="name" id="name" onblur="validateName(this)"  value="<?php echo $category["name"]  ?>"/>
                    <small class="error" id="title-error"></small>
                </div>

                <div class="form-field">
                    <label for="desc">Description</label>
                    <input class="input-field" id="desc" name="description" value="<?php echo $category["description"]  ?>" />
                    <small class="error"></small>
                </div>

                <button class="btn" type="submit">Update</button>
                <a class="btn" href="/404">Delete</a>

            </div>
        </form>
        <hr />
    </div>
</div>



<?php require_once(__DIR__ . "/../../layout/footer.php"); ?>