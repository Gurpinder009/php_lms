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
    function redirectWithLink($error,$redirect){
        header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/404?error=$error&redirect=$redirect");
        die();
    }

