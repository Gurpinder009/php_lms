<?php

use Database\Models\BookModel;

staff_auth();
require_once __DIR__ . "/../../layout/navbar.php";
$offset = (isset($_GET["offset"])?$_GET["offset"]:0);
$all_books = BookModel::allBooks($offset);
$count = BookModel::count();
?>

<link rel="stylesheet" href="/public/css/table.css">
<div class="table-wrapper" >
    <h1>Books</h1>
    <form class="book-search" onkeyup="searchBooks(this)">
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
                    <th>Edit</th>

                </tr>
            </thead>
            <tbody id="element">

            <?php 
            foreach($all_books as $book){

                echo "<tr>";
                echo '<td data-label="Accession Number">'.$book["accession_no"].'</td>';
        echo '<td data-label="Title"  >'.$book["title"].'</td>';
        echo '<td data-label="Publisher">'.$book["publisher_name"].'</td>';
        echo '<td data-label="language">'.$book["language"].'</td>';
        echo '<td data-label="page_count">'.$book["page_count"].'</td>';
        echo '<td data-label="year_of_publication">'.$book["year_of_publication"].'</td>';
        echo '<td data-label="condition">'.$book["condition"].'</td>';
        echo '<td data-label="author">'.$book["author_name"].'</td>';
        echo '<td data-label="categories">'.$book["category_name"].'</td>';
        echo '<td data-label="Edit"><a href="/edit/book/'.$book["accession_no"].'">Edit</a></td>';
        
        
        echo "</tr>";
    }
        ?>
                </tbody>
            </table>
            
    </div>
    <div class="pager">
                <a class ="btn  <?php if(($offset/10+1)<2) echo "disabled" ?>" href="/books?offset=<?php echo $offset-10 ?>"><i class="fa-solid fa-angles-left"></i> Prev</a>
                <span class="page"><?php $data = (integer)($offset/10)+1; echo $data ; ?></span>
                <a class="btn <?php if(($count<=$offset+10))echo "disabled";?>" href="/books?offset=<?php echo $offset+10 ?>">Next <i class="fa-solid fa-angles-right"></i></a>
            </div>
</div>
<?php require_once __DIR__ . "/../../../views/layout/footer.php"?>
<!-- <script>
    // let array ={search_box:{value:""}};
    // window.addEventListener("load",()=>searchBooks(array));
</script> -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>