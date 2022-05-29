<?php

use Database\Models\BookModel;
use Database\Models\SubscriberModel;
staff_auth();
$title ="Issue Book";
$subscribers = SubscriberModel::all();
if (isset($subscribers["error"])) {
    redirect("404",$subscribers["error"]);
}
$books = BookModel::allAvailableBooks();


if (isset($books["error"])) {
    redirect("404",$books["error"]);
}
require_once(__DIR__ . "/../../layout/navbar.php");
?>

<link rel="stylesheet" href="../../../../public/css/forms.css">

<div class="registration-form-container">
    <div class="wrapper">
        <hr />
        <form class="registration-form" id="small-form" action="/issue_book" method="POST" onsubmit="return validateBookForm(this)" autocomplete="off">
            <h1 class="form-heading">Issue Book</h1>
            <div class="field-container" id="small-form-field-container">
                <div class="form-field">
                    <input class="input-field" name="access_no" onblur="validateNumber(this)" placeholder="Accession Number" list="accession_no" />

                    <datalist id="accession_no">

                        <?php
                        foreach ($books as $book) {
                            echo "<option value='" . $book["accession_no"] . "'>" . $book["title"] . "</option>";
                        }
                        ?>


                    </datalist>
                    <small class="error" id="access_no-error"></small>
                </div>

                <div class="form-field">
                    <input class="input-field" name="subscriber_id" type="text" onblur="validateNumber(this)" placeholder="Subscriber Name" list="subscibers" />
                    <small class="error" id="subscriber_id-error"></small>
                    <datalist id="subscibers">
                    <?php
                        foreach ($subscribers as $subscriber) {
                            echo "<option value='" . $subscriber["id"] . "'>" . $subscriber["name"] . "</option>";
                        }
                        ?>
                    </datalist>
                </div>



                <div class="form-field">
                    <input class="input-field" name="issue_date" onblur="(this.type='text'); validateDateOfBirth(this)" onfocus="(this.type='date')" placeholder="Issue Date (Default today)" />
                    <small class="error" id="issue_date-error"></small>
                </div>



                <button class="btn" type="submit">Issue Book</button>
            </div>
        </form>
        <hr />
    </div>
</div>

<?php
require_once(__DIR__ . "/../../layout/footer.php");
?>