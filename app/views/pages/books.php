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
<div class="table-wrapper" >
    <h1>Books</h1>
    <form class="book-search">
        <input type="text" onkeyup="searchBooks(this)" placeholder="Search">
        <button class="search-button" type="submit">
            Search
        </button>
    </form>
    <div>
        <table >
            <thead>
                <tr>
                    <th>Access_no </th>
                    <th>Title</th>
                    <th>Publisher</th>
                    <th>Language</th>
                    <th>Page Count</th>
                    <th>year of publication</th>
                    <th>Condition</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Edit</th>

                </tr>
            </thead>
            <tbody id="element">
            
            </tbody>
        </table>
    </div>
</div>
<?php require_once(__DIR__ . "/../../views/layout/footer.php") ?>
<script>
    window.addEventListener("load",()=>searchBooks({value:""})); 
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>