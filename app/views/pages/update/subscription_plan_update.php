<?php

use Database\Models\SubscriptionPlanModel;
require_once(__DIR__."/../../../logic/auth_redirection_staff.php");

require_once(__DIR__ . "/../../layout/navbar.php");
$subscription_plan_id = explode("/", $_SERVER["REQUEST_URI"])[3];
$subscription_plan = SubscriptionPlanModel::find($subscription_plan_id);
if (isset($subscription_plan["error"])) {
    redirect("404",$subscription_plan["error"]);
}

$title = "Edit Subscription_plan";

?>
<link rel="stylesheet" href="/public/css/forms.css">
<link rel="stylesheet" href="/public/css/update-forms.css">

<div class="registration-form-container">
    <div class="wrapper">
        <hr />
        <form class="registration-form" action="/update/subscription_plan/<?php echo $subscription_plan_id;?>" method="POST" onsubmit="return validateBookForm(this)" autocomplete="off">
            <h1 class="form-heading">Subscription Plan</h1>
            <div class="field-container">
                <div class="form-field">
                    <label for="title" >Title</label>
                    <input class="input-field" id="title" name="title" onblur="validateName(this)" value="<?php echo $subscription_plan["title"] ?>"/>
                    <small class="error" id="title-error"></small>
                </div>

                <div class="form-field">
                <label for="price" >Price</label>

                    <input class="input-field" id="price" name="price" value="<?php echo $subscription_plan["price"] ?>" onblur="validateNumber(this)"  />
                    <small class="error" id="price-error"></small>
                </div>

                <div class="form-field">
                <label for="issue_limit" >Book Issue Limit</label>
                    <input class="input-field" id="issue_limit" name="book_issue_limit" value="<?php echo $subscription_plan["book_issue_limit"]?>" onblur="validateNumber(this)"  />
                    <small class="error" id="issue_limit-error"></small>
                </div>

                <div class="form-field">
                <label for="issue_days" >Issue Days</label>
                    <input class="input-field" name="issue_days" id ="issue_days"  onblur="validateNumber(this)" value="<?php echo $subscription_plan["issue_days"]?>" />
                    <small class="error" id="issue_days-error"></small>
                </div>

                <div class="form-field">
                <label for="time_period" >Subscription Duration</label>

                    <input class="input-field" name="time_period" id="time_period"  onblur="validateNumber(this)" value="<?php echo $subscription_plan["time_period"]?>"  />
                    <small class="error" id="time_period-error"></small>
                </div>

                <div class="form-field">
                <label for="isActive" >isActive</label>
                    <input class="input-field" id="isActive"  name="isActive" onblur="validateNumber(this)" list="is_active" value="<?php echo $subscription_plan["isActive"]?>" />
                    <datalist id="is_active">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </datalist>   
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