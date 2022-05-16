<?php

use Database\Models\CategoryModel;
require_once __DIR__ . "/../../logic/auth_redirection_staff.php";


$categories = CategoryModel::all();
if (isset($categories['error'])) {
    header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/404");
    die();
}

$title ="Categories";
require_once __DIR__ . "/../layout/navbar.php";
?>

<link rel="stylesheet" href="/public/css/table.css">
<div class="table-wrapper">
    <h1>Categories</h1>
    
    <table>
        <thead>
            <tr>
                <th>sno</th>
                <th>Title</th>
                <th>Description</th>
                <th>Update/Delete</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($categories as $category) {
                echo "<tr>";
                echo '<td data-label="Id">' . $category["id"] . '</td>';
                echo '<td data-label="Category Name">' . $category["name"] . '</td>';
                echo '<td data-label="Description" type="desc">' . $category["contact_info"] . '</td>';
                echo '<td data-label="Update"><a href="/edit/category/'.$category["id"].'">Edit</a></td>';
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php require_once(__DIR__ . "/../../views/layout/footer.php") ?>