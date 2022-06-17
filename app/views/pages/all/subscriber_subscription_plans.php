<?php

use Database\Models\SubscriberModel;

subscriber_auth();
require_once(__DIR__ . "/../../layout/navbar.php");
$subscription_plans = SubscriberModel::subscription($_SESSION["auth_user"]["id"]);

if (isset($subscription_plans["error"])) {
    redirect("404",$subscription_plans["error"]);
}

if(!isset($subscription_plans[0]["id"])){
    echo "<h1>No Active Subsciption is available</h1>";
    require_once(__DIR__ . "/../../layout/footer.php");
    die();
}

?>

<link rel="stylesheet" href="/public/css/table.css">
<div class="table-wrapper">
    <h1>Subcription Plans</h1>

    <table>
        <thead>
            <tr>
             
                <th>S.No</th>
                <th>Title</th>
                <th>price</th>
                <th>Book issue Limit</th>
                <th>Issue Days</th>
                <th>Time period</th>
                <th>Starting Date</th>
            

            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($subscription_plans as $subscription_plan) {
                    echo "<tr>";
                    echo '<td data-label="S no">' . $subscription_plan["id"] . '</td>';
                    echo '<td data-label="Title">' . $subscription_plan["title"] . '</td>';
                    echo '<td data-label="Price">' . $subscription_plan["price"] . '</td>';
                    echo '<td data-label="Book Issue Limit">' . $subscription_plan["book_issue_limit"] . '</td>';
                    echo '<td data-label="Issue Days">' . $subscription_plan["issue_days"] . '</td>';
                    echo '<td data-label="Time Period">' . $subscription_plan["time_period"] . '</td>';
                    echo '<td data-label="Starting Date">' . $subscription_plan["purchase_date"] . '</td>';

                    echo "</tr>";
                }
            
            ?>


        </tbody>
    </table>
</div>

<?php require_once(__DIR__ . "/../../layout/footer.php");?>



