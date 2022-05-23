<?php

//drawer routes
$admin_link = [
    ["name" => "Books", "href" => "/books"],
    ["name" => "Issue book", "href" => "/issue_book/create"],
    ["name" => "Subscribers", "href" => "/subscribers"],
    ["name" => "Staff Members", "href" => "/staff_members"],
    ["name" => "Issued Books", "href" => "/issued_books"],
    ["name" => "Authors", "href" => "/authors"],
    ["name" => "Categories", "href" => "/categories"],
    ["name" => "Publishers", "href" => "/publishers"],
    ["name" => "Subscription Plans", "href" => "/subscription_plans"],
    ["name" => "Assign Subscription Plan", "href" => "/assign_subscription_plan"],
    ["name" => "Add Books", "href" => "/book/create"],
    ["name" => "Add Staff", "href" => "/staff/create"],
    ["name" => "Add Subscriber", "href" => "/subscriber/create"],
    ["name" => "Add Author", "href" => "/author/create"],
    ["name" => "Add Category", "href" => "/category/create"],
    ["name" => "Add Publisher", "href" => "/publisher/create"],
    ["name" => "Add Subscription Plans", "href" => "/subscription_plan/create"],
    ["name" => "Loggout", "href" => "/logout"]
  ];

  
  //iterating through the routes
  foreach ($admin_link as $link) {
    $data = isActive($link["href"]);
    echo "<a href='" . $link["href"] . "' $data>" . $link["name"]  . "</a>";
  }
  