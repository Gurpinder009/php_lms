<?php

use Database\Models\SubscriberModel;
require_once __DIR__ . "/../../logic/auth_redirection_staff.php";


$users = SubscriberModel::all();
if (isset($users['error'])) {
    header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/404");
    die();
}
require_once __DIR__ . "/../layout/navbar.php";
?>

<link rel="stylesheet" href="/public/css/table.css">
<div class="table-wrapper">
    <h1>Subscribers</h1>
    <form class="book-search">
        <input type="text" >
        <button class="search-button" type="submit">
            Search
        </button>
</form>
    <div>
    <table>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th>Date of Birth</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($users as $user) {
                echo "<tr>";
                echo '<td data-label="Id:">' . $user["id"] . '</td>';
                echo '<td data-label="Name:">' . $user["name"] . '</td>';
                echo '<td data-label="Email Address:">' . $user["email"] . '</td>';
                echo '<td data-label="Phone Number:">' . $user["phone_num"] . '</td>';
                echo '<td data-label="Date of Birth:">' . $user["dob"] . '</td>';
                echo '<td data-label="Address:" type="address">'.$user['city'].", ".$user["state"].", ".$user["country"].", ".$user['pin_code'] . '</td>';
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
        </div>

</div>
<?php require_once(__DIR__ . "/../../views/layout/footer.php") ?>