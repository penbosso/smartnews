<?php
require_once('lib/Page.php');
require_once('lib/Pagescraper.php');
require_once('lib/functions.php');
require_once('lib/db/initialize.php');


$pageScraper = new Pagescraper;

$category = 'news.php';/* gets the variable category page */

if(!empty($_GET['search'])){
    ($category=='lifestyle')? $category ='life style' : '';
    $sql ='SELECT newslink FROM news_tb';
    $string_data = $database->query($sql);
    $string_data = $database->fetch_array($string_data);
    ($string_data)? $array = $string_data: $array = '';
    $array = getSearch($string_data,$_GET['search']);
}
else if(!empty($_GET['category'])) {
    $category = $_GET['category'];
    include('./cat/'.$category.'.php');
    ($category=='lifestyle')? $category ='life style' : '';
    $sql ='SELECT newslink, category, source FROM news_tb WHERE  LCASE(category) LIKE "' .$category.'" ORDER BY newsdate DESC';
    $string_data = $database->query($sql);
    $string_data = $database->fetch_array($string_data);
    // $scrap_url = falsse;
    ($string_data)? $array = $string_data: $array = getRecent($scrap_url);
}
else{
    $sql ='SELECT newslink, category, source FROM news_tb ORDER BY newsdate DESC';
    $string_data = $database->query($sql);
    $string_data = $database->fetch_array($string_data);$string_data='';
    ($string_data)? $array = $string_data : $array = getRecent();
}

// include('./cat/'.$category);
// var_dump($array); die('hi');
if(is_array($array)){
// pagination
$per_page = 3;
$total_pages = count($array);
$pages = ceil($total_pages / $per_page);
$current_page = isset($_GET['current_page']) ? $_GET['current_page'] : 1;
$current_page = ($total_pages > 0) ? min($pages, $current_page) : 1;
$start = $current_page * $per_page - $per_page;

$allLinks = array_slice($array, $start, $per_page);
}
else{$allLinks ='';}
?>
<!DOCTYPE html>
<html lang="en-US"><!--<![endif]--><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="files/css.css">
    <link rel="stylesheet" href="files/style.css" data-minify="1">
    <link rel="stylesheet" href="files/home.css" data-minify="1">
    <link rel="stylesheet" href="files/font-awesome.css" data-minify="1">
    <script type="text/javascript" src="files/jquery.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart News Broadcast</title>
    <link rel="apple-touch-icon" href="https://news.gh.services/assets/images/favicon.png">
    <link rel="shortcut icon" href="https://news.gh.services/assets/images/favicon.png">
    <meta name="description" content="Smart News Broadcast">
    <meta name="keywords" content="Work Smart Limited, Work Smart, Smart News, Smart News Broadcast">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com/">

    <!-- <script language="javascript">
        var myHref = ((window.location.protocol == "https:") ? "" : "https://" + window.location.host);
        if( myHref !== "" ){ window.location.href = myHref; }
    </script> -->
    <style type="text/css">
        .entry-image img { min-width: 80%; }
        /* img {max-height: 400px; max-width: 80%;} */
    </style>
</head>

<body class="home blog">
    <input id="capturelevel" value="" type="hidden">
    <input id="toriko" value="infinity" type="hidden">
    <input id="komatsukun" value="2" type="hidden">
    <div id="page" class="site">
        <div id="masthead" class="masthead-container header_background_full_width header_background_color">
            <header role="banner" class="">
                <div class="masthead-background box clearfix" style=""></div>
                <div class="masthead-group clearfix container top-bar">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span> <i class="icon-menu-1"></i> </button> 
                        <a class="navbar-brand brand-image" href="index.php" title="Smart News Broadcast" rel="home"><img src="files/snb.png" alt="Smart News Broadcast"><h1><small> Quick &amp; Easy Access to Multi-Source News </small></h1></a>
                    </div>

                    <div class="blu_search pull-right navigation-button" id="navigation-button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 486.8 486.8" width="20%" height="20%" class="bars"><g fill="#4f5458"><path d="M140.35 32c0-17.6-14.4-32-32-32h-76.3c-17.6 0-32 14.4-32 32v76.2c0 17.6 14.4 32 32 32h76.2c17.6 0 32-14.4 32-32V32h.1zm-24.5 76.3c0 4.1-3.4 7.5-7.5 7.5h-76.3c-4.1 0-7.5-3.4-7.5-7.5V32c0-4.1 3.4-7.5 7.5-7.5h76.2c4.1 0 7.5 3.4 7.5 7.5v76.3h.1zM140.35 205.3c0-17.6-14.4-32-32-32h-76.3c-17.6 0-32 14.4-32 32v76.2c0 17.6 14.4 32 32 32h76.2c17.6 0 32-14.4 32-32v-76.2h.1zm-24.5 76.2c0 4.1-3.4 7.5-7.5 7.5h-76.3c-4.1 0-7.5-3.4-7.5-7.5v-76.2c0-4.1 3.4-7.5 7.5-7.5h76.2c4.1 0 7.5 3.4 7.5 7.5v76.2h.1zM108.35 346.5h-76.3c-17.6 0-32 14.4-32 32v76.2c0 17.6 14.4 32 32 32h76.2c17.6 0 32-14.4 32-32v-76.2c.1-17.6-14.3-32-31.9-32zm7.5 108.3c0 4.1-3.4 7.5-7.5 7.5h-76.3c-4.1 0-7.5-3.4-7.5-7.5v-76.2c0-4.1 3.4-7.5 7.5-7.5h76.2c4.1 0 7.5 3.4 7.5 7.5v76.2h.1zM173.35 281.5c0 17.6 14.4 32 32 32h76.2c17.6 0 32-14.4 32-32v-76.2c0-17.6-14.4-32-32-32h-76.2c-17.6 0-32 14.4-32 32v76.2zm24.5-76.2c0-4.1 3.4-7.5 7.5-7.5h76.2c4.1 0 7.5 3.4 7.5 7.5v76.2c0 4.1-3.4 7.5-7.5 7.5h-76.2c-4.1 0-7.5-3.4-7.5-7.5v-76.2zM173.35 454.8c0 17.6 14.4 32 32 32h76.2c17.6 0 32-14.4 32-32v-76.2c0-17.6-14.4-32-32-32h-76.2c-17.6 0-32 14.4-32 32v76.2zm24.5-76.3c0-4.1 3.4-7.5 7.5-7.5h76.2c4.1 0 7.5 3.4 7.5 7.5v76.2c0 4.1-3.4 7.5-7.5 7.5h-76.2c-4.1 0-7.5-3.4-7.5-7.5v-76.2zM346.55 281.5c0 17.6 14.4 32 32 32h76.2c17.6 0 32-14.4 32-32v-76.2c0-17.6-14.4-32-32-32h-76.2c-17.6 0-32 14.4-32 32v76.2zm24.5-76.2c0-4.1 3.4-7.5 7.5-7.5h76.2c4.1 0 7.5 3.4 7.5 7.5v76.2c0 4.1-3.4 7.5-7.5 7.5h-76.2c-4.1 0-7.5-3.4-7.5-7.5v-76.2zM346.55 454.8c0 17.6 14.4 32 32 32h76.2c17.6 0 32-14.4 32-32v-76.2c0-17.6-14.4-32-32-32h-76.2c-17.6 0-32 14.4-32 32v76.2zm24.5-76.3c0-4.1 3.4-7.5 7.5-7.5h76.2c4.1 0 7.5 3.4 7.5 7.5v76.2c0 4.1-3.4 7.5-7.5 7.5h-76.2c-4.1 0-7.5-3.4-7.5-7.5v-76.2zM173.35 32v76.2c0 17.6 14.4 32 32 32h76.2c17.6 0 32-14.4 32-32V32c0-17.6-14.4-32-32-32h-76.2c-17.7 0-32 14.4-32 32zm24.5 0c0-4.1 3.4-7.5 7.5-7.5h76.2c4.1 0 7.5 3.4 7.5 7.5v76.2c0 4.1-3.4 7.5-7.5 7.5h-76.2c-4.1 0-7.5-3.4-7.5-7.5V32zM378.55 140.3h76.2c17.6 0 32-14.4 32-32V32c0-17.6-14.4-32-32-32h-76.2c-17.6 0-32 14.4-32 32v76.2c0 17.7 14.4 32.1 32 32.1zM371.05 32c0-4.1 3.4-7.5 7.5-7.5h76.2c4.1 0 7.5 3.4 7.5 7.5v76.2c0 4.1-3.4 7.5-7.5 7.5h-76.2c-4.1 0-7.5-3.4-7.5-7.5V32z"></path></g></svg>
                    </div>

                    <div class="menu logged-out m-hidden">
                        <a href="https://news.gh.services/account.html"><div class="header"><b>Sign In / Up</b></div></a>
                        <a data-href="https://portal.news.gh.services" href="#"><div class="option">All about SNB</div></a>
                    </div>

                    <div class="blu_search pull-right hidden-sm hidden-xs" style="margin-right: 25px;">
                    <form action="index.php" method="GET">
                        <input id="s" name="search" placeholder="Search.." type="text"><a id="doSearch"  href="#" onclick="$(this).closest('form').submit();"" ><i class="fa fa-search"></i></a>
                    </form>

                    </div> 
                </div>
            </header>
        </div>
        <div id="main" class="container">
            
            <div class="menubg m-hidden" id="menubg"></div>

            <div id="primary" class="row right_side">
                <div id="content" class="margin  col-xs-12 col-sm-12 col-md-8 col-lg-8" role="main">

                    <article class="post type-post status-publish format-standard has-post-thumbnail hentry category-themes" id="processing" style="display: none;">
                        <div class="entry-container box">
                            <div class="entry-content text-center">
                                <!-- <p class="rubiks text-center"><img src="files/loading.gif"></p> -->
                            </div>
                        </div>
                    </article>

                    <div class="box pad-lg-35" id="no-results" style="display: none;">
                        <h1>Nothing matched the search tag</h1>
                        <p class="lead text-muted">We could not find the page you were looking for.</p>
                    </div>