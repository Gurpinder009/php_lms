<?php
if (isset($_GET["error"])) {
    print_r("<h1>".$_GET["error"]."</h1>");
} else {
    echo "<h1>Oops! Page is not avaiable</h1> ";
}
?>
<p>Go to <a href="/home">Home</a>? page</p>