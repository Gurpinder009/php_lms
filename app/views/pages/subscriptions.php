<?php

use Database\Models\SubscriptionPlanModel;

$subscription_plans = SubscriptionPlanModel::all();

if (isset($subscription_plans["error"])) {
    header("Location: http://" . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . "/_404");
    die();
}
require_once(__DIR__ . "/../layout/navbar.php");
?>

<link rel="stylesheet" href="/public/css/table.css">
<div class="table-wrapper">
    <h1>Subcription Plans</h1>
    <form class="book-search">
        <input type="text">
        <button class="search-button" type="submit">
            Search
        </button>
    </form>
    <table>
        <thead>
            <tr>
                <th>S.NO</th>
                <th>Publisher Name</th>
                <th>Other Information</th>
                <th>Update/Delete</th>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($subscription_plans as $subscription_plan) {
                echo "<tr>";
                echo '<td data-label="Id">' . $subscription_plan["id"] . '</td>';
                echo '<td data-label="Name">' . $subscription_plan["title"] . '</td>';
                echo '<td data-label="Other Information">' . $subscription_plan["price"] . '</td>';
                echo '<td data-label="Update"><a href="/subscription_plans/1">Edit</a></td>';

                echo "</tr>";
            }
            ?>


        </tbody>
    </table>
</div>





<?php require_once(__DIR__ . "/../layout/footer.php"); ?>