<?php
require(__DIR__."/../../vendor/autoload.php");
use Database\Models\SubscriberModel;

print_r(SubscriberModel::all());
echo "hello";