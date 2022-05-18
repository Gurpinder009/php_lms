<?php


require_once "./vendor/autoload.php";


//register you routes in $routes array
$routes = [
    "/" => "views/pages/adminDashboard.php",
    "/home" => "views/pages/adminDashboard.php",
    "/userDashboard"=>"views/pages/userDashboard.php",
    "/staff/auth" => "logic/staff_auth.php",
    "/subscriber/auth" => "logic/subscriber_auth.php",
    "/login" => "views/pages/login.php",
    "/search-books\?[title=a-zA-Z0-9\[\]_ %]+"=>"logic/bookSearch.php",
    "/login\?error=[a-zA-Z0-9\[\]_ %]+"=>"views/pages/login.php",
    "/subscriber/login"=>"views/pages/subscriber_login.php",
    "/subscriber/login\?error=[a-zA-Z0-9\[\]_ %]+"=>"views/pages/subscriber_login.php",
    "/profile"=>"views/pages/profile_page.php",
    "/loggout"=>"logic/logout.php",
    "/404" => "views/pages/_404.php",
    "/books" => "views/pages/books.php",
    "/authors"=>"views/pages/authors.php",
    "/categories"=>"views/pages/categories.php",
    "/subscribers"=>"views/pages/subscribers.php",
    "/subscription_plans"=>"views/pages/subscriptions.php",
    "/publishers"=>"views/pages/publishers.php",
    "/staff_members"=>"views/pages/staff_members.php",  
    "/issue_book"=>"views/pages/create/issue_book.php",    

    //forms for updation
    "/edit/author/[0-9]+"=>"views/pages/update/author_update.php",
    "/edit/book/[0-9]+"=>"views/pages/update/book_update.php",
    "/edit/publisher/[0-9]+"=>"views/pages/update/publisher_update.php",
    "/edit/category/[0-9]+"=>"views/pages/update/category_update.php",
    





    //forms for creation
    "/subscriber/create" => "views/pages/create/subscriber_create.php",
    "/staff/create" => "views/pages/create/staff_member_create.php",
    "/book/create" => "views/pages/create/book_create.php",
    "/author/create" => "views/pages/create/author_create.php",
    "/category/create" => "views/pages/create/category_create.php",
    "/publisher/create" => "views/pages/create/publisher_create.php",


    //for storing form data
    "/category/store" => "logic/storeCategory.php",
    "/author/store" => "logic/storeAuthor.php",
    "/staff/store" => "logic/storeStaffMember.php",
    "/subscriber/store" => "logic/storeSubcriber.php",
    "/book/store" => "logic/storeBook.php",
    "/publisher/store" => "logic/storePublisher.php",


    //updating user data 

    "/update/author/[0-9]+"=>"logic/update/update_author.php",
    "/update/category/[0-9]+"=>"logic/update/update_category.php",
    "/update/publisher/[0-9]+"=>"logic/update/update_publisher.php",
    "/update/book/[0-9]+"=>"logic/update/update_book.php"
];


$found = null;
foreach($routes as $route=>$value){
    if(preg_match("#^$route$#",$_SERVER["REQUEST_URI"])){
        require_once __DIR__ . "/app/" . $value;
        $found = true;
        break;
    };
}


if(!$found){
    header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/404");
    die();
}





