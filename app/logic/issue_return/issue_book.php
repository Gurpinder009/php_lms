<?php

use Database\Models\BorrowBooksModel;
use Database\Models\SubscriberModel;
use Database\Models\SubscriptionPlanModel;
staff_auth();

if (isset($_POST["access_no"])) {
    if (!BorrowBooksModel::isBorrowed($_POST["access_no"])) {
        if (SubscriberModel::isExists($_POST["subscriber_id"])) {
            $book_issue_limit = SubscriptionPlanModel::getSubscribedPlanInfo($_POST["subscriber_id"]);
            $book_count = SubscriberModel::books_borrowed_count($_POST["subscriber_id"]);
            if (isset($book_count["error"])) {
                redirect("404", $book_count["error"]);
            } else if (isset($book_issue_limit["error"])) {
                redirect("404", $book_issue_limit["error"]);
            } else if ($book_count > $book_issue_limit["book_issue_limit"]) {
                redirect("404", "Opps! Book Issue Limit exceeded");
            }
            $result = BorrowBooksModel::issue_book($_POST);
            if (isset($result["error"])) {
                redirect("404",$result["error"]);
            }
            redirect("issued_books");
        } else {
            redirect("404", "Opps! Subscriber not found");
        }
    } else {
        redirect("404", "Opps! Book is already issued to someone");
    }
} else {
    redirect("404", "Provided data is not sufficient");
}
