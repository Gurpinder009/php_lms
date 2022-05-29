<?php

use Database\Models\PublisherModel;


staff_auth();
$publishers = PublisherModel::all();
if (isset($publishers['error'])) {
    redirect("404");
}

require_once __DIR__ . "/../../layout/navbar.php";
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
                echo '<td data-label="Update"><a href="/edit/publisher/'.$publisher["id"].'">Edit</a></td>';

                echo "</tr>";
            }
            ?>
    

        </tbody>
    </table>
</div>
<?php require_once(__DIR__ . "/../../../views/layout/footer.php") ?>