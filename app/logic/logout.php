<?php
use Database\Models\SubscriberModel;
subscriber_staff_auth();
if (SubscriberModel::logout()) {
    redirect("home");
}


