
<?php
require 'lib/Page.php';
require 'lib/Pagescraper.php';
?>
<?php include("head.php"); ?>

<?php

$page = '';/* gets the variable $page */
if (!empty($_GET['page'])) {
    $page .= $_GET['page'];

    include($page);
}   /* if $page has a value, include it */
else {
    header("Location: index.php");
}
?>

<?php include("foot.php"); ?>