<?php

use Database\Models\BookModel;
require_once __DIR__ . "/../../logic/auth_redirection_staff.php";


$books = BookModel::all();
if (isset($books['error'])) {
    header("Location: http://localhost:8000/404");
    die();
}
// print_r($books);

require_once __DIR__ . "/../layout/navbar.php";
?>

<link rel="stylesheet" href="/public/css/table.css">
<div class="table-wrapper">
    <h1>Books</h1>
    <form class="book-search">
        <input type="text" >
        <button class="search-button" type="submit">
            Search
        </button>
</form>
    <table>
        <thead>
            <tr>
                <th>Access_no </th>
                <th onclick="console.log('workign')">Title</th>
                <th>Publisher</th>
                <th>Language</th>
                <th>Page Count</th>
                <th>year of publication</th>
                <th>Condition</th>
                <th>Author</th>
                <th>Category</th>
                <th >Edit</th>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($books as $book) {
                echo "<tr>";
                echo '<td data-label="Accession Number">' . $book["accession_no"] . '</td>';
                echo '<td data-label="Title">' . $book["title"] . '</td>';
                echo '<td data-label="Accession Number">' . $book["publisher_name"] . '</td>';

                echo '<td data-label="language">' . $book["language"] . '</td>';
                echo '<td data-label="page_count">' . $book["page_count"] . '</td>';
                echo '<td data-label="year_of_publication">' . $book["year_of_publication"] . '</td>';

                echo '<td data-label="condition">' . $book["condition"] . '</td>';
                echo '<td data-label="author">' . $book["author_name"] . '</td>';
                echo '<td data-label="categories">' . $book["category_name"] . '</td>';
                echo '<td data-label="Update"><a href="/edit/book/'.$book["accession_no"].'">Edit</a></td>';

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php require_once(__DIR__ . "/../../views/layout/footer.php") ?>