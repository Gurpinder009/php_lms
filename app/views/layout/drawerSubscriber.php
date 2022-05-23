<?php
$subscriber_link = [
    ["name" => "Dashboard", "href" => "/userDashboard"],
    ["name" => "All Books", "href" => "/subscriber/books"],
    ["name" => "Subscription Plan", "href" => "/subscriber/subscription_plan"],
    ["name" => "Categories", "href" => "/subscriber/issued_books"],
    ["name" => "Logout", "href" => "/loggout"]
];

  
  
  foreach ($subscriber_link as $link) {
    $data = isActive($link["href"]);
    echo "<a href='" . $link["href"] . "' $data>" . $link["name"]  . "</a>";
  }
  