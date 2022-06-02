<?php
use Database\Models\SubscriberModel;
subscriber_staff_auth();
SubscriberModel::logout();
redirect("home");



