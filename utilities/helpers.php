<?php
    
    function redirect($address,$error = ""){
        if($error === ""){
            header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/$address");
            die();
        }else{
            header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/$address?error=$error");
            die();
        }
    }