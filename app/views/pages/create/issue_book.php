<?php

use Database\Models\BorrowBooksModel;

require_once(__DIR__ . "/../../layout/navbar.php");
$records = BorrowBooksModel::all();
?>
<link rel="stylesheet" href="/public/css/table.css">

<div class="table-wrapper">
    <div>
        <h1>Issued Books</h1>

        <table>
            <thead>
                <th>ID</th>
                <th>
            </thead>
            <tbody>
                <?php
                foreach ($records as $record) {
                    echo "<tr>";
                    echo '<td data-label="Accession Number">' . $record["id"] . '</td>';

                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>
    </div>
</div>

<?php
require_once(__DIR__ . "/../../layout/footer.php");
?>