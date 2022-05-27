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
    "/404[\/\?a-zA-Z0-9\[\]&=_\- %+]*" => "views/pages/_404.php",
    "/books" => "views/pages/books.php",
    "/subscriber/books" => "views/pages/SubscriberBooks.php",
    "/authors"=>"views/pages/authors.php",
    "/categories"=>"views/pages/categories.php",
    "/subscribers"=>"views/pages/subscribers.php",
    "/subscription_plans"=>"views/pages/subscriptions.php",
    "/publishers"=>"views/pages/publishers.php",
    "/staff_members"=>"views/pages/staff_members.php",  
    "/issued_books"=>"views/pages/issued_books.php", 
    
    "/issue_book"=>"logic/issue_book.php",
    "/return_book/[0-9]+"=>"logic/return_book.php",
    

    "/subscriber/issued_books"=>"views/pages/issued_books_subscriber.php", 
    "/subscriber/subscription_plan"=>"views/pages/subscriber_subscription.php", 
    
    //forms for updation
    "/edit/author/[0-9]+"=>"views/pages/update/author_update.php",
    "/edit/book/[0-9]+"=>"views/pages/update/book_update.php",
    "/edit/publisher/[0-9]+"=>"views/pages/update/publisher_update.php",
    "/edit/category/[0-9]+"=>"views/pages/update/category_update.php",
    "/edit/subscription_plan/[0-9]+"=>"views/pages/update/subscription_plan_update.php",
    
    
    
    //delete data logic
    "/delete/author/[0-9]+"=>"logic/delete/delete_author.php",
    "/delete/book/[0-9]+"=>"logic/delete/delete_book.php",
    "/delete/publisher/[0-9]+"=>"logic/delete/delete_publisher.php",
    "/delete/category/[0-9]+"=>"logic/delete/delete_category.php",
    "/delete/subscriber/[0-9]+"=>"logic/delete/delete_subscriber.php",
    "/delete/staff/[0-9]+"=>"logic/delete/delete_staff.php",
    "/delete/subscription_plans/[0-9]+"=>"logic/delete/delete_subscription_plan.php",
   
    "/edit/forget-password"=>"views/pages/forget_password.php",
    
    
    
    
    
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
    "/provideSubscription" =>"logic/provideSubscription.php",
    
    //for storing form data
    "/category/store" => "logic/storeCategory.php",
    "/author/store" => "logic/storeAuthor.php",
    "/staff/store" => "logic/storeStaffMember.php",
    "/subscriber/store" => "logic/storeSubcriber.php",
    "/book/store" => "logic/storeBook.php",
    "/publisher/store" => "logic/storePublisher.php",
    "/subscription/store"=>"logic/storeSubscriptionPlan.php",
    
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
    "/change-password[\/\?a-zA-Z0-9\[\]&=_\- %+%]*"=>"views/pages/change_password.php"
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



