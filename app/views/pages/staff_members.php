<?php

use Database\Models\StaffModel;
require_once __DIR__ . "/../../logic/auth_redirection_staff.php";


$staff_members = StaffModel::all();
if (isset($staff_members['error'])) {
    header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/404");
    die();
}
require_once __DIR__ . "/../layout/navbar.php";
?>

<link rel="stylesheet" href="/public/css/table.css">
<div class="table-wrapper">
    <h1>Staff Members</h1>
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
                <th>Salary</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($staff_members as $staff_member) {
                echo "<tr>";
                echo '<td data-label="Id:">' . $staff_member["id"] . '</td>';
                echo '<td data-label="Name:">' . $staff_member["name"] . '</td>';
                echo '<td data-label="Email Address:">' . $staff_member["email"] . '</td>';
                echo '<td data-label="Phone Number:">' . $staff_member["phone_num"] . '</td>';
                echo '<td data-label="Date of Birth:">' . $staff_member["dob"] . '</td>';
                echo '<td data-label="Date of Birth:">' . $staff_member["salary"] . '</td>';
                echo '<td data-label="Address:" type="address">'.$staff_member['city'].", ".$staff_member["state"].", ".$staff_member["country"].", ".$staff_member['pin_code'] . '</td>';
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
        </div>

</div>
<?php require_once(__DIR__ . "/../../views/layout/footer.php") ?>