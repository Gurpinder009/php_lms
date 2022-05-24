<?php
require_once(__DIR__."/../../../logic/auth_redirection_staff.php");
$title = "Add Subscription Plan";
require_once(__DIR__ . "/../../layout/navbar.php");

?>
<link rel="stylesheet" href="../../../../public/css/forms.css">

<div class="registration-form-container">
    <div class="wrapper">
        <hr />
        <form class="registration-form"  action="/subscription/store" method="POST" onsubmit="return validateBookForm(this)" autocomplete="off">
            <h1 class="form-heading">Subscription Plan</h1>
            <div class="field-container">
                <div class="form-field">
                    <input class="input-field" name="title" onblur="validateName(this)" placeholder="Title"  />
                    <small class="error" id="title-error"></small>
                </div>

                <div class="form-field">
                    <input class="input-field" name="price"  onblur="validateNumber(this)" placeholder="price"/>
                    <small class="error" id="price-error"></small>
                </div>

                <div class="form-field">
                    <input class="input-field" name="issue_limit" onblur="validateNumber(this)"  placeholder="Book Issue Limit"/>
                    <small class="error" id="issue_limit-error"></small>
                </div>

                <div class="form-field">
                    <input class="input-field" name="issue_days" placeholder="Issue Days" onblur="validateNumber(this)" />
                    <small class="error" id="issue_days-error"></small>
                </div>

                <div class="form-field">
                    <input class="input-field" name="time_period" placeholder="Duration" onblur="validateNumber(this)" />
                    <small class="error" id="time_period-error"></small>
                </div>

                <div class="form-field">
                    <input class="input-field" name="desc" placeholder="Description" />
                    <small class="error" id="desc-error"></small>
                </div>

                <button class="btn" type="submit">Submit</button>
                <button class="btn" type="reset">Reset</button>

            </div>
        </form>
        <hr />
    </div>
</div>

<?php
require_once(__DIR__ . "/../../layout/footer.php");
?>