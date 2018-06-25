<!DOCTYPE html>
<html lang="en">
<head>
    <title>Page Scrape</title>
    <link rel="stylesheet" type="text/css" href="styles/main.css">
    <style>
      #submission_form {
          padding: 10px;
      }
    </style>
</head>

<body>

<div id="document">



<?php

$scrap_url = 'https://www.myjoyonline.com/ghana-news/world.php';
// $scrap_url = 'https://www.myjoyonline.com/ghana-news/lifestyle.php';
// $scrap_url = 'https://www.myjoyonline.com/ghana-news/entertainment.php';
// $scrap_url = 'https://www.myjoyonline.com/ghana-news/sports.php';
// $scrap_url = 'https://www.myjoyonline.com/ghana-news/news.php';

function curl_download($Url){
  
    if (!function_exists('curl_init')){
        die('cURL is not installed. Install and try again.');
    }
    
    $start_str = '<div id="wrapper" class="wide">';
    $end_str = 'We recommend';

    $curl_resourse = curl_init();
    curl_setopt($curl_resourse, CURLOPT_URL, $Url);
    curl_setopt($curl_resourse, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($curl_resourse);
    curl_close($curl_resourse);
    // $start = strpos($output, $start_str);
    // $end = strpos($output, $end_str, $start);
    // $length = $end-$start;
    // $output = substr($output, $start, $length);
  
    return $output;
}

function linkExtractor($html) {
 $linkArray = array();
 $black_list = array(
    'javascript:void(0);','videos.php',
    // 'inner.php?section=business&amp;category=business"',
    'inner.php?section=business&category=finance',
    'inner.php?section=business&category=banking'
   );

if(preg_match_all("/a[\s]+[^>]*?href[\s]?=[\s\"\']+".
"(.*?)[\"\']+.*?>"."([^<]+|.*?)?<\/a>/", $html, $matches, PREG_SET_ORDER)){
 foreach ($matches as $match) {
     if(trim($match[2]) != "" && !in_array($match[1], $black_list)){
       // array_push($linkArray, array($match[1], $match[2]));
       echo '<h2 ><a href="pagescrape.php?targetUrl='. $match[1] .'">'. $match[2] .'</a></h2><hr>';
     }
 }
}
 return $linkArray;
}

linkExtractor(curl_download($scrap_url));

?>



</div>

</body>
</html>
