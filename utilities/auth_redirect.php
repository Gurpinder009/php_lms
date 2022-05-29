<?php
if (!isset($_SESSION)) {
    session_start();
}

function staff_auth()
{
    if (!isset($_SESSION['auth']) || $_SESSION["isStaff"] !== true) {
        redirect("login");
    }
}

function subscriber_auth()
{
    if (!isset($_SESSION['auth']) || $_SESSION['isStaff'] !== false) {
        redirect("subscriber/login");
    }
}

function subscriber_staff_auth()
{
    if(!isset($_SESSION['auth']) ){
        redirect("login");
     }
}
