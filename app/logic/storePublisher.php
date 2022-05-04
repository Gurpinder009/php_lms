<?php

use Database\Models\PublisherModel;

    if(isset($_POST['name'])){
        echo PublisherModel::insert($_POST);
        print_r(PublisherModel::all());
    }