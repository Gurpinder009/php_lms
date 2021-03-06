<?php

use Database\Models\CategoryModel;
staff_auth();

$categories = CategoryModel::all();
if (isset($categories['error'])) {
    redirect("404");
}

$title ="Categories";
require_once __DIR__ . "/../../layout/navbar.php";
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
                echo '<td data-label="Description" type="desc">' . $category["desc"] . '</td>';
                echo '<td data-label="Update"><a href="/edit/category/'.$category["id"].'">Edit</a></td>';
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php require_once(__DIR__ . "/../../../views/layout/footer.php") ?>