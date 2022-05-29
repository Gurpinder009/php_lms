<?php

use Database\Models\StaffModel;

staff_auth();

$staff_members = StaffModel::all();
if (isset($staff_members['error'])) {
    redirect("404");
}
require_once __DIR__ . "/../../layout/navbar.php";
?>

<link rel="stylesheet" href="/public/css/table.css">
<div class="table-wrapper">
    <h1>Staff Members</h1>
  
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
<?php require_once(__DIR__ . "/../../../views/layout/footer.php") ?>