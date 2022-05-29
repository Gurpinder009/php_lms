<?php

use Database\Models\AuthorModel;
use Database\Models\BookModel;
use Database\Models\CategoryModel;
use Database\Models\PublisherModel;
staff_auth();

$authors = AuthorModel::all();
$categories = CategoryModel::all();
$publishers = PublisherModel::all();

$accession_no = explode("/", $_SERVER["REQUEST_URI"])[3];
$book = BookModel::find($accession_no);
if (isset($book["error"])) {
    redirect("404",$book["error"]);
}

$title = "Update Book";
require_once __DIR__ . "/../../layout/navbar.php";
?>
<link rel="stylesheet" href="../../../../public/css/forms.css">
<link rel="stylesheet" href="../../../../public/css/update-forms.css">


<div class="registration-form-container">
    <div class="wrapper">
        <hr />
        <form class="registration-form" action="/update/book/<?php echo $book["accession_no"] ?>" method="POST" onsubmit="return validateBookForm(this)" autocomplete="off">
            <h1 class="form-heading">Update Book Data</h1>
            <div class="field-container">
                <div class="form-field">
                    <label for="accession_no">Accession Number</label>
                    <input class="input-field" id="accession_no" placeholder="Accession Number" disabled value='<?php echo $book["accession_no"]; ?>' />
                    <small class="error" id="accession-no-error"></small>
                </div>
                <div class="form-field">
                    <label for="Title">Book Title</label>

                    <input class="input-field" for="Title" name="title" value='<?php echo $book["title"]; ?>' onblur="validateName(this)" placeholder="Title" />
                    <small class="error" id="title-error"></small>
                </div>

                <div class="form-field">
                    <label for="page_count">Page Count</label>

                    <input class="input-field" id="page_count" name="page_count" onblur="validateNumber(this)" placeholder="Page Count" value='<?php echo $book["page_count"]; ?>' />
                    <small class="error" id="page_count-error"></small>
                </div>

                <div class="form-field">
                    <label for="year_of_publication">Year Of Publication</label>
                    <input class="input-field" id="year_of_publication" name="year_of_publication" onblur="(this.type='text'); validateDateOfBirth(this)" onfocus="(this.type='date')" placeholder="Year of publication" value='<?php echo $book["year_of_publication"]; ?>' />
                    <small class="error" id="year_of_publication-error"></small>
                </div>


                <div class="form-field">
                    <label for="condition">Condition</label>
                    <input class="input-field" id="condition" name="condition" onblur="validateCondtion(this)" value="<?php echo $book["condition"]; ?>" placeholder="Condition" list="conditions" />
                    <datalist id="conditions">
                        <option value="best">best</option>
                        <option value="good">good</option>
                        <option value="bad">bad</option>
                    </datalist>
                    <small class="error" id="condition-error"></small>
                </div>




                <div class="form-field">
                    <label for="edition">Book Edition</label>
                    <input class="input-field" id="edition" name="edition" onblur="validateNumber(this)" value='<?php echo $book["volume"]; ?>' placeholder="Edition" />
                    <small class="error" id="edition-error"></small>
                </div>


                <div class="form-field">
                    <label for="category">Category Name</label>

                    <input class="input-field" id="category" name="category_id" value='<?php echo $book["category_name"]; ?>' placeholder="Category" list="categories" />
                    <datalist id="categories">
                        <?php
                        foreach ($categories as $category) {
                            echo "<option value='" . $category['name'] . "'>" . $category['name'] . "</option>";
                        }
                        ?>
                    </datalist>
                </div>


                <div class="form-field">
                    <label for="author">Book Publisher</label>

                    <input class="input-field" name="publisher_id" placeholder="Publisher" value='<?php echo $book["publisher_name"]; ?>' list="Publishers" />
                    <datalist id="Publishers">
                        <?php
                        foreach ($publishers as $publisher) {
                            echo "<option value='" . $publisher["name"] . "'>" . $publisher['name'] . "</option>";
                        }
                        ?>
                    </datalist>
                </div>


                <div class="form-field">
                    <label for="author">Author Name</label>
                    <input class="input-field" id="author" name="author_id" value='<?php echo $book["author_name"]; ?>' placeholder="Author" list="authors" />
                    <datalist id="authors">
                        <?php
                        foreach ($authors as $author) {
                            echo "<option value='" . $author['name'] . "'>" . $author['name'] . "</option>";
                        }
                        ?>
                    </datalist>
                    <small class="error" id="author_id-error"></small>
                </div>




                <div class="form-field">
                    <label for="author">Language</label>

                    <input class="input-field" name="language" onblur="validateName(this)" value='<?php echo $book["language"]; ?>' placeholder="Language" />
                    <small class="error" id="language-error"></small>
                </div>
                <button class="btn" type="submit">Update</button>
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