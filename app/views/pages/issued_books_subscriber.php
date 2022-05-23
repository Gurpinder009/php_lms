<?php

use Database\Models\BorrowBooksModel;
require_once(__DIR__."/../../logic/auth_redirection_user.php");

require_once(__DIR__ . "/../layout/navbar.php");
$records = BorrowBooksModel::find($_SESSION["auth_user"]["id"]);

if(isset($records["error"])){
    printf($records["error"]);
    die();
}
?>
<link rel="stylesheet" href="/public/css/table.css">

<div class="table-wrapper">
    <div>
        <h1>Issued Books</h1>

        <table>
            <thead>
                <th>ID</th>
                <th>Book Title</th>
                <th>Accession No</th>
                <th>Issue Date</th>
                <th>Expected Return Date</th>


            </thead>
            <tbody>
                <?php
                foreach ($records as $record) {
                    echo "<tr>";
                    echo '<td data-label="Accession Number">' . $record["id"] . '</td>';
                    echo '<td data-label="Book Title">' . $record["title"] . '</td>';
                    echo '<td data-label="Issue Date">' . $record["accession_no"] . '</td>';
                    echo '<td data-label="Issue Date">' . $record["issue_date"] . '</td>';
                    echo '<td data-label="Expected Return Date">' . $record["expected_return_date"] . '</td>';
                   
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>
    </div>
</div>

<?php
require_once(__DIR__ . "/../layout/footer.php");
?>