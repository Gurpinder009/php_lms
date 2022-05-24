<?php

use Database\Models\BorrowBooksModel;
use Database\Models\SubscriberModel;
use Database\Models\SubscriptionPlanModel;
require_once(__DIR__."/auth_redirection_staff.php");

if (isset($_POST["access_no"]) && !BorrowBooksModel::isBorrowed($_POST["access_no"])) {
    $book_issue_limit = SubscriptionPlanModel::getSubscribedPlanInfo($_POST["subscriber_id"]);
    $book_count = SubscriberModel::books_borrowed_count($_POST["subscriber_id"]);
    if (isset($book_count["error"])) {
        redirect("404",$book_count["error"]);
    }else if(isset($book_issue_limit["error"])) {
        redirect("404",$book_issue_limit["error"]);
    } else if ($book_count > $book_issue_limit["book_issue_limit"]) {
        redirect("404","Opps! Book Issue Limit exceeded");        
    }
    $result = BorrowBooksModel::issue_book($_POST);
    if (!isset($result["error"])) {
        redirect("issued_books");
    }
} else {
   redirect("404","Opps! Book is already issued to someone");
}
