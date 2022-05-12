<?php

use Database\Models\PublisherModel;
require_once __DIR__ . "/../../logic/auth_redirection_staff.php";


$publishers = PublisherModel::all();
if (isset($publishers['error'])) {
    header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/404");
    die();
}

require_once __DIR__ . "/../layout/navbar.php";
?>

<link rel="stylesheet" href="/public/css/table.css">
<div class="table-wrapper">
    <h1>Publishers</h1>
   
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
            foreach ($publishers as $publisher) {
                echo "<tr>";
                echo '<td data-label="Id">' . $publisher["id"] . '</td>';
                echo '<td data-label="Name">' . $publisher["name"] . '</td>';
                echo '<td data-label="Other Information">' . $publisher["contact_info"] . '</td>';
                echo '<td data-label="Update"><a href="/publisher/1">Edit</a></td>';

                echo "</tr>";
            }
            ?>
    

        </tbody>
    </table>
</div>
<?php require_once(__DIR__ . "/../../views/layout/footer.php") ?>