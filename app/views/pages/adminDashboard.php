<?php
    if($_SERVER['REQUEST_URI'] == "/app/views/pages/home.php"){
        header("Location: http://localhost:8000");
        die();
    }

    ?>


<?php require_once(__DIR__."/../layout/navbar.php"); ?>
it is working alright
<?php require_once(__DIR__."/../layout/footer.php"); ?>