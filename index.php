<?php
require_once "./vendor/autoload.php";


//register you routes in $routes array
$routes = [
    "/[0-9]+" => "views/pages/adminDashboard.php",
    "/home" => "views/pages/adminDashboard.php",
    "/auth" => "logic/auth.php",
    "/login" => "views/pages/login.php",
    "/logout"=>"logic/logout.php",
    "/404" => "views/pages/_404.php",
    "/books" => "views/pages/books.php",



    //forms for creation
    "/user/create" => "views/pages/create/user_create.php",
    "/book/create" => "views/pages/create/book_create.php",
    "/author/create" => "views/pages/create/author_create.php",
    "/category/create" => "views/pages/create/category_create.php",
    "/publisher/create" => "views/pages/create/publisher_create.php",


    //for storing form data
    "/category/store" => "logic/storeCategory.php",
    "/author/store" => "logic/storeAuthor.php",
    "/users/store" => "logic/storeUser.php",
    "/book/store" => "logic/storeBook.php",
    "/publisher/store" => "logic/storePublisher.php",

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
    header("Location: http://localhost:8000/404");
    die();
}





