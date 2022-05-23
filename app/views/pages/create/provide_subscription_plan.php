<?php

use Database\Models\SubscriberModel;
use Database\Models\SubscriptionPlanModel;
require_once(__DIR__."/../../../logic/auth_redirection_staff.php");

require_once(__DIR__ . "/../../layout/navbar.php");
$subscribers = SubscriberModel::all();
if (isset($subscribers["error"])) {
    print_r($subscribers["error"]);
    die();
}

$subscription_plans = SubscriptionPlanModel::Activeall();

if (isset($subscription_plans["error"])) {
    print_r($subscription_plans["error"]);
    die();
}
?>

<link rel="stylesheet" href="../../../../public/css/forms.css">

<div class="registration-form-container">
    <div class="wrapper">
        <hr />
        <form class="registration-form" id="small-form" action="/provideSubscription" method="POST" onsubmit="return validateBookForm(this)" autocomplete="off">
            <h1 class="form-heading">Provide Plan</h1>
            <div class="field-container" id="small-form-field-container">
            

                <div class="form-field">
                    <input class="input-field" name="subscriber_id" type="text" onblur="validateNumber(this)" placeholder="Subscriber Name" list="subscibers" />
                    <small class="error" id="subscriber-error"></small>
                    <datalist id="subscibers">
                    <?php
                        foreach ($subscribers as $subscriber) {
                            echo "<option value='" . $subscriber["id"] . "'>" . $subscriber["name"] . "</option>";
                        }
                        ?>
                    </datalist>
                </div>

                <div class="form-field">
                    <input class="input-field" name="subscription_plan_id" onblur="validateNumber(this)" placeholder="Subscription Plan" list="subscription_plans" />
                    <datalist id="subscription_plans">
                        <?php
                        foreach ($subscription_plans as $subscription_plan) {
                            echo "<option value='" . $subscription_plan["id"] . "'>" . $subscription_plan["title"] . "</option>";
                        }
                        ?>
                    </datalist>
                    <small class="error" id="access_no-error"></small>
                </div>

                <button class="btn" type="submit">Submit</button>
            </div>
        </form>
        <hr />
    </div>
</div>

<?php
require_once(__DIR__ . "/../../layout/footer.php");
?>