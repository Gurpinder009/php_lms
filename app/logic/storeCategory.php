<?php

use Database\Models\CategoryModel;

echo " we are here";
    if(isset($_POST['title'])){
        echo CategoryModel::insert($_POST);
        print_r(CategoryModel::all());
    }