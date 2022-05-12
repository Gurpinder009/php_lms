<?php
$admin_link = [


  ["name" => "Users", "href" => "/users"],
  ["name" => "Books", "href" => "/books"],
  ["name" => "Authors", "href" => "/authors"],
  ["name" => "Categories", "href" => "/categories"],
  ["name" => "Publishers", "href" => "/publishers"],


  ["name" => "Add Books", "href" => "/book/create"],
  ["name" => "Add User", "href" => "/user/create"],
  ["name" => "Add Author", "href" => "/author/create"],
  ["name" => "Add Category", "href" => "/category/create"],
  ["name" => "Add Publisher", "href" => "/publisher/create"],

  ["name" => "Loggout", "href" => "/logout"]


];

function isActive($href)
{
  if ($href == $_SERVER["REQUEST_URI"]) {
    return "class='active-link'";
  }
}
?>


<div id="drawer">
  <?php
  foreach ($admin_link as $link) {
    $data = isActive($link["href"]);
    echo "<a href='" . $link["href"] . "' $data>" . $link["name"]  . "</a>";
  }
  ?>


</div>