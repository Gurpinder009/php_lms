<?php

use Database\Models\PublisherModel;

$publisher_id = explode("/", $_SERVER["REQUEST_URI"])[3];
$publisher = PublisherModel::find($publisher_id);
if (isset($publisher["error"])) {
    print_r($publisher["error"]);
}
$title = "Update Publisher";
require_once(__DIR__ . "/../../layout/navbar.php");
?>
<link rel="stylesheet" href="/public/css/forms.css">
<link rel="stylesheet" href="/public/css/update-forms.css">



<div class="registration-form-container">
    <div class="wrapper">
        <hr />
        <form class="registration-form" id="small-form" action="/update/publisher/<?php echo $publisher["id"] ?>" onsubmit="return validatePublisherForm(this)" method="POST" autocomplete="off">
            <h1 class="form-heading">Add Publisher</h1>
            <div class="field-container" id="small-form-field-container">
                <div class="form-field">
                    <label for="publisher_name">Publisher Name</label>
                    <input class="input-field" id="publisher_name" name="name" value="<?php echo $publisher["name"] ?>" onblur="validateName(this)" />
                    <small class="error" id="name-error"></small>
                </div>

                <div class="form-field">
                    <label for="contact-info">Other Information</label>
                    <input class="input-field" id="contact-info" name="contact_info" value="<?php echo $publisher["contact_info"] ?>" />
                    <small class="error"></small>
                </div>

                <button class="btn" type="submit">Update</button>
                <a class="btn" href="">Delete</a>

            </div>
        </form>
        <hr />
    </div>
</div>






<?php require_once(__DIR__ . "/../../layout/footer.php"); ?>