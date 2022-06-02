<?php


require_once "./vendor/autoload.php";


//register you routes in $routes array
$routes = [
    "/" => "views/pages/staff_dashboard.php",
    "/home" => "views/pages/staff_dashboard.php",
    "/subscriber_dashboard"=>"views/pages/subscriber_dashboard.php",
    "/staff/auth" => "logic/login/staff_login.php",
    "/subscriber/auth" => "logic/login/subscriber_login.php",
    "/search-books\?[title=a-zA-Z0-9\[\]_ %]+"=>"logic/book_search.php",
    "/logout"=>"logic/logout.php",
    "/404[\/\?a-zA-Z0-9\[\]&=_\- %+]*" => "views/pages/_404.php",
    "/books" => "views/pages/all/books.php",
    "/subscriber/books" => "views/pages/all/subscriber_books.php",
    "/authors"=>"views/pages/all/authors.php",
    "/categories"=>"views/pages/all/categories.php",
    "/subscribers"=>"views/pages/all/subscribers.php",
    "/subscription_plans"=>"views/pages/all/subscription_plans.php",
    "/publishers"=>"views/pages/all/publishers.php",
    "/staff_members"=>"views/pages/all/staff_members.php",  
    "/issued_books"=>"views/pages/all/issued_books.php", 
    "/issue_book"=>"logic/issue_return/issue_book.php",
    "/return_book/[0-9]+"=>"logic/issue_return/return_book.php",
    

    //login forms
    "/login[?=a-zA-Z0-9\[\]_ %]*"=>"views/pages/login.php",
    "/subscriber/login[?=a-zA-Z0-9\[\]_ %]*"=>"views/pages/subscriber_login.php",
    

    "/subscriber/issued_books"=>"views/pages/all/issued_books_subscriber.php", 
    "/subscriber/subscription_plan"=>"views/pages/all/subscriber_subscription_plans.php", 
    
    //forms for updation
    "/edit/author/[0-9]+"=>"views/pages/edit/author_edit.php",
    "/edit/book/[0-9]+"=>"views/pages/edit/book_edit.php",
    "/edit/publisher/[0-9]+"=>"views/pages/edit/publisher_edit.php",
    "/edit/category/[0-9]+"=>"views/pages/edit/category_edit.php",
    "/edit/subscription_plan/[0-9]+"=>"views/pages/edit/subscription_plan_edit.php",
    "/edit/forget-password"=>"views/pages/password/forget_password.php",
    
    
    
    //delete data logic
    "/delete/author/[0-9]+"=>"logic/delete/delete_author.php",
    "/delete/book/[0-9]+"=>"logic/delete/delete_book.php",
    "/delete/publisher/[0-9]+"=>"logic/delete/delete_publisher.php",
    "/delete/category/[0-9]+"=>"logic/delete/delete_category.php",
    "/delete/subscriber/[0-9]+"=>"logic/delete/delete_subscriber.php",
    "/delete/staff/[0-9]+"=>"logic/delete/delete_staff.php",
    "/delete/subscription_plans/[0-9]+"=>"logic/delete/delete_subscription_plan.php",

    
    
    
    
    
    //forms for creation
    "/issue_book/create"=>"views/pages/create/issue_book.php",    
    "/subscriber/create" => "views/pages/create/subscriber_create.php",
    "/staff/create" => "views/pages/create/staff_member_create.php",
    "/book/create" => "views/pages/create/book_create.php",
    "/author/create" => "views/pages/create/author_create.php",
    "/category/create" => "views/pages/create/category_create.php",
    "/publisher/create" => "views/pages/create/publisher_create.php",
    "/subscription_plan/create" => "views/pages/create/subscription_plan_create.php",
    "/assign_subscription_plan" =>"views/pages/create/provide_subscription_plan.php",
    "/provide_subscription" =>"logic/provide_subscription.php",
    
    //for storing form data
    "/category/store" => "logic/store/store_category.php",
    "/author/store" => "logic/store/store_author.php",
    "/staff/store" => "logic/store/store_staff_member.php",
    "/subscriber/store" => "logic/store/store_subcriber.php",
    "/book/store" => "logic/store/store_book.php",
    "/publisher/store" => "logic/store/store_publisher.php",
    "/subscription/store"=>"logic/store/store_subscription_plan.php",
    
    //updating user data 
    "/update/author/[0-9]+"=>"logic/update/update_author.php",
    "/update/category/[0-9]+"=>"logic/update/update_category.php",
    "/update/publisher/[0-9]+"=>"logic/update/update_publisher.php",
    "/update/book/[0-9]+"=>"logic/update/update_book.php",
    "/update/subscription_plan/[0-9]+"=>"logic/update/update_subscription_plan.php",
    "/update/staff/password" =>"logic/update/update_staff_password.php",
    "/update/password/[0-9]+" =>"logic/update/update_password.php",
    
  
    "/verify-otp[\/a\?-zA-Z0-9\[\]&=_\- %+]*"=>"logic/verification/otp_verification.php",
    "/verify-email" => "logic/verification/email_verification.php",
    "/change-password[\/\?a-zA-Z0-9\[\]&=_\- %+%]*"=>"views/pages/password/change_password.php"
];


$found = null;
//iterating through the routes 
foreach($routes as $route=>$value){
    if(preg_match("#^$route$#",$_SERVER["REQUEST_URI"])){
        require_once __DIR__ . "/app/" . $value;
        $found = true;
        break;
    };
}

//If required route is not available
if(!$found){
    redirect("404");
}



