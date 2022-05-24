<?php

use Database\Models\SubscriberModel;
require_once __DIR__ . "/../../logic/auth_redirection_staff.php";


$subscribers = SubscriberModel::all();
if (isset($subscribers['error'])) {
    redirect("404",$subscribers["error"]);
}
require_once __DIR__ . "/../layout/navbar.php";
?>

<link rel="stylesheet" href="/public/css/table.css">
<div class="table-wrapper">
    <h1>Subscribers</h1>

    <div>
    <table>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Subscription</th>

                <th>Email Address</th>
                <th>Phone Number</th>
                <th>Date of Birth</th>
                
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($subscribers as $subscriber) {
                if($subscriber["title"] == null){
                    $subscriber["title"] = "Not Subscribed";
                }
                echo "<tr>";
                echo '<td data-label="Id:">' . $subscriber["id"] . '</td>';
                echo '<td data-label="Name:">' . $subscriber["name"] . '</td>';
                echo '<td data-label="Subscription:">' . $subscriber["title"] . '</td>';
                echo '<td data-label="Email Address:">' . $subscriber["email"] . '</td>';
                echo '<td data-label="Phone Number:">' . $subscriber["phone_num"] . '</td>';
                echo '<td data-label="Date of Birth:">' . $subscriber["dob"] . '</td>';
                echo '<td data-label="Address:" type="address">'.$subscriber['city'].", ".$user["state"].", ".$user["country"].", ".$user['pin_code'] . '</td>';
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
        </div>

</div>
<?php require_once(__DIR__ . "/../../views/layout/footer.php") ?>