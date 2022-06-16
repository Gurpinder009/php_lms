<?php

if (isset($_GET["error"])) {
    print_r("<h1>".$_GET["error"]."</h1>");
} else {
    echo "<h1>Oops! Page is not avaiable</h1> ";
}
if(isset($_GET["redirect"])){
    echo "<h3>Go <a href='/".$_GET['redirect']."'>Back</a></h3>";
}else{
    echo "<p>Go to <a href='/home'>home</a></p>";
}

if(!isset($_SESSION)){
    session_start();
}

print_r($_SESSION);