<?php

use Database\Models\SubscriptionPlanModel;
staff_auth();
$subscription_plans = SubscriptionPlanModel::all();

if (isset($subscription_plans["error"])) {
    redirect("404",$subscription_plans["error"]);
}
require_once(__DIR__ . "/../../layout/navbar.php");
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
                <th>Status</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($subscription_plans as $subscription_plan) {
                $subscription_plan["description"] = $subscription_plan["description"] ? "active":"not active";
                echo "<tr>";
                echo '<td data-label="S no">' . $subscription_plan["id"] . '</td>';
                echo '<td data-label="Title">' . $subscription_plan["title"] . '</td>';
                echo '<td data-label="Price">' . $subscription_plan["price"] . '</td>';
                echo '<td data-label="Book Issue Limit">' . $subscription_plan["book_issue_limit"] . '</td>';
                echo '<td data-label="Issue Days">' . $subscription_plan["issue_days"] . '</td>';
                echo '<td data-label="Time Period">' . $subscription_plan["time_period"] . '</td>';
                echo '<td data-label="Description">' . $subscription_plan["description"] . '</td>';
                echo "<td data-label='Edit'><a href= '/edit/subscription_plan/".$subscription_plan["id"]."'>Edit</a></td>";

                echo "</tr>";
            }

            ?>


        </tbody>
    </table>
</div>





<?php require_once(__DIR__ . "/../../layout/footer.php"); ?>