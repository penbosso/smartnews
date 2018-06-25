<?php
require './lib/Page.php';
require './lib/Pagescraper.php';

$pageScraper = new Pagescraper;

  // if(isset($_GET["q"])){
  //   $_GET["targetUrl"] = $_GET["q"];
  // }
// die($_GET["targetUrl"]);
  $article = $pageScraper->getArticle($_GET["targetUrl"] );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles/main.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    echo "<title>".$article->getTitle()."</title>";
     ?>
</head>

<body>

<div id="document">
<?php

  if ( $article->getTitle() !== null ) {
    echo "<h1>".str_replace('MyJoyOnline.com','SmartNews.com',$article->getTitle())."</h1>";
    echo "<hr>";
  }
  if ( $article->getAuthor() !== null ) {
    echo "<h2>by ".$article->getAuthor()."</h2>";
    echo "<hr>";
  }
  if($article->getImage() !==null){
    echo '<img style="width:auto; max-height:400px !important;overflow:hidden" src="' .$article->getImage(). '">';
  }
  if(count($article->getErrors()) > 0 ) {
    echo "<div class='error'>
            <h1>Error</h1>";
    foreach ($article->getErrors() as $error) {
      echo "<p>$error</p>";
    }
    echo  "</div>";
  } else {
    echo $article->getContent();
  }
?>
</div>

</body>
</html>
