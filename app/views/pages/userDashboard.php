<?php

use Database\Models\BookModel;
use Database\Models\BorrowBooksModel;
use Database\Models\SubscriberModel;

require_once __DIR__ . "/../../logic/auth_redirection_user.php";
require_once(__DIR__ . "/../layout/navbar.php");

$book_count = BookModel::count();
$issue_book_count = BorrowBooksModel::count($_SESSION["auth_user"]["id"]);
if (isset($issue_book_count["error"])) {
    redirect("404",$issue_book_count["error"]);
}
$fine = BorrowBooksModel::calculate_fine($_SESSION["auth_user"]["id"]);
if (isset($fine["error"])) {
    // redirect("404",$fine["error"]);
}
$subscription_count  = SubscriberModel::subscription_count($_SESSION["auth_user"]["id"]);

if (isset($subscription_count["error"])) {
    redirect("404",$subscription_count["error"]);
}
?>

<link rel="stylesheet" href="/public/css/adminDashboard.css">
<div class="tile-container">

    <a class="tiles" href="/subscriber/books">

        <div>
            <h1><?php echo $book_count; ?></h1>
            <h2>Books</h2>
        </div>
    </a>



    <a class="tiles" href="/subscriber/issued_books">
        <div>
            <h1><?php echo $issue_book_count; ?></h1>
            <h2>Issued Books</h2>
        </div>
    </a>

    <a class="tiles" href="/subscriber/subscription_plan">
        <div>
            <h1><?php echo $subscription_count; ?></h1>
            <h2>Subscription Plans</h2>
        </div>
    </a>
    <a class="tiles">
        <div>
            <h1><?php echo $fine; ?></h1>
            <h2>Total Fine </h2>
        </div>
    </a>






</div>
<script src="https://kit.fontawesome.com/265a92e85a.js" crossorigin="anonymous"></script>
<?php require_once(__DIR__ . "/../layout/footer.php"); ?>