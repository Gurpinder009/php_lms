<?php


use Database\Models\AuthorModel;
use Database\Models\BookModel;
use Database\Models\CategoryModel;
use Database\Models\PublisherModel;
use Database\Models\StaffModel;
use Database\Models\SubscriberModel;
require_once __DIR__ . "/../../logic/auth_redirection_user.php";


$subscriber_count = SubscriberModel::count();
$staff_count = StaffModel::count();

$author_count = AuthorModel::count();
$category_count = CategoryModel::count();
$publisher_count = PublisherModel::count();
$book_count = BookModel::count();
?>



<?php require_once(__DIR__ . "/../layout/navbar.php"); ?>
<link rel="stylesheet" href="/public/css/adminDashboard.css">
<div class="tile-container">
    <!-- <h1>Staff Dashboard</h1> -->

    <a class="tiles" href="/books">

        <div>
            <h1><?php echo $book_count; ?></h1>
            <h2>Books</h2>
        </div>
    </a>


    <a class="tiles" href="/staff_members">

        <div>
            <h1><?php echo $staff_count; ?></h1>
            <h2>Staff Members</h2>
        </div>
    </a>

    <a class="tiles" href="/subscribers">
        <div>
            <h1><?php echo $subscriber_count; ?></h1>
            <h2>Subscribers</h2>
        </div>
    </a>

    <a class="tiles" href="/authors">
        <div>
            <h1><?php echo $author_count; ?></h1>
            <h2>Authors</h2>
        </div>
    </a>


    <a class="tiles" href="/categories">
        <div>
            <h1><?php echo $category_count; ?></h1>
            <h2>Categories</h2>
        </div>
    </a>


    <a class="tiles" href="/publishers">
        <div>
            <h1><?php echo $publisher_count; ?></h1>
            <h2>Publishers</h2>
        </div>
    </a>

    

</div>
<script src="https://kit.fontawesome.com/265a92e85a.js" crossorigin="anonymous"></script>
<?php require_once(__DIR__ . "/../layout/footer.php"); ?>