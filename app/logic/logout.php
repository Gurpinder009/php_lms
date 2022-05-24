<?php
use Database\Models\SubscriberModel;
if (SubscriberModel::logout()) {
    redirect("home");
}


