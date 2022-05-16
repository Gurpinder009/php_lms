<?php

use Database\Models\AuthorModel;

require_once __DIR__ . "/../../logic/auth_redirection_staff.php";

$authors = AuthorModel::all();
if (isset($authors['error'])) {
    header("Location: http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/404");
    die();
}

require_once __DIR__ . "/../layout/navbar.php";
?>

<link rel="stylesheet" href="/public/css/table.css">
<div class="table-wrapper">
    <h1>Authors</h1>
   
    <table>
        <thead>
            <tr>
                <th>sno</th>
                <th>Author Name</th>
                <th>Other Information</th>
                <th>Update/Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($authors as $author) {
                echo "<tr>";
                echo '<td data-label="Id">' . $author["id"] . '</td>';
                echo '<td data-label="Name">' . $author["name"] . '</td>';
                echo '<td data-label="Other Info" type="desc">' . $author["contact_info"] . '</td>';
                echo '<td data-label="Update"><a href="/edit/author/'.$author["id"].'">Edit</a></td>';
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php require_once(__DIR__ . "/../../views/layout/footer.php") ?>