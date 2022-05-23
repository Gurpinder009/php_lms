<?php

use Database\Models\BorrowBooksModel;
use Database\Models\SubscriberModel;
use Database\Models\SubscriptionPlanModel;
require_once(__DIR__."/auth_redirection_staff.php");

if (isset($_POST["access_no"]) && !BorrowBooksModel::isBorrowed($_POST["access_no"])) {
    $book_issue_limit = SubscriptionPlanModel::getSubscribedPlanInfo($_POST["subscriber_id"]);
    $book_count = SubscriberModel::books_borrowed_count($_POST["subscriber_id"]);
    if (isset($book_count["error"])) {
        print_r($book_count["error"]);
        die();
    }else if(isset($book_issue_limit["error"])) {
        print_r($book_issue_limit["error"]);
        die();
    } else if ($book_count > $book_issue_limit["book_issue_limit"]) {
        echo "<h1>Opps! Book Issue Limit exceeded</h1>";
        echo "<a href='/issued_books'>Back</a>";
        die();
    }
    $result = BorrowBooksModel::issue_book($_POST);
    if (!isset($result["error"])) {
        header("Location: http://" . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . "/issued_books");
        die();
    }
} else {
    echo "<h1>Opps! Book is already issued to someone</h1>";
    echo "<a href='/issued_books'>Back</a>";
    die();
}
