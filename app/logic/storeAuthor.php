<?php

use Database\Models\AuthorModel;

    if(isset($_POST['name'])){
        echo AuthorModel::insert($_POST);
        print_r(AuthorModel::all());
    }