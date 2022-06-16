<?php

use Database\Models\PersonModel;
subscriber_staff_auth();
PersonModel::logout();
redirect("home");



