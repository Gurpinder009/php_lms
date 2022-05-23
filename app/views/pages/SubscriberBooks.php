<?php

use Database\Models\BookModel;

require_once __DIR__ . "/../../logic/auth_redirection_staff_subscriber.php";


require_once __DIR__ . "/../layout/navbar.php";
?>

<link rel="stylesheet" href="/public/css/table.css">
<div class="table-wrapper" >
    <h1>Books</h1>
    <form class="book-search" onkeyup="SearchBooks(this)">
        <input type="text" name="search_box" placeholder="Search">
        <!-- <button class="search-button" type="submit">
            Search
        </button>
         -->


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

                </tr>
            </thead>
            <tbody id="element">
            
            </tbody>
        </table>
    </div>
</div>
<?php require_once(__DIR__ . "/../../views/layout/footer.php") ?>
<script>
    let array ={search_box:{value:""}};
    window.addEventListener("load",()=>SearchBooks(array)); 
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>