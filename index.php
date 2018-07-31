<?php include("head.php"); ?>
<?php

// var_dump($allLinks);
if(!is_array($allLinks) && (!empty($_GET['search'])) ){die('<hr><h1 class="lead">Nothing matched the search tag</h1>
    <p>We could not find the page you were looking for.</p>');}
if(!is_array($allLinks)){die('<hr>No data available at the moment! Please try again later');}
// $i=0; echo("Number of articles found = ".sizeof($allLinks));
// foreach ($allLinks as $links){
//     $article = $pageScraper->getArticle($links[0],$links[1]);
    
//     if ( $article->getTitle() !== null ) {
//         $i++;
//         echo "<h5>".$i." -> ".$article->getTitle()."</h5>";
//         // echo "<hr>";
//         }
// }
//     die('**************DONE**************!');
foreach ($allLinks as $links):
    // var_dump($allLinks);
    $article = $pageScraper->getArticle($links[0],$links[1],$links[2]);
    $page_link = save_news($links[0]);

?>

    <div class="columns">

        <article class="post type-post status-publish format-standard has-post-thumbnail hentry category-themes" style="">
                <div class="entry-image" style=""> 
                    <a href="article.php?page=<?php echo $page_link; ?>" class="image-comment" title="" rel="bookmark"> 
                        <?php 
                        if($article->getImage() !==null){
                            echo '<img  src="' .$article->getImage(). '">';
                            }
                        ?>
                    </a>
                </div>
                <div class="entry-container box">
                    <div class="post-title author-image-on">
                        <h1 class="entry-title"> <a href="article.php?page=<?php echo $page_link; ?>">
                        <?php
                        if ( $article->getTitle() !== null ) {
                            echo "<h1>".$article->getTitle()."</h1>";
                            echo "<hr>";
                            }
                        ?></a></h1>
                        <div class="post-meta">
                            <ul>
                                <li>
                                    <time class="entry-date updated" datetime="<? echo ( $article->getTitle() !== null )? date("M j, Y",strtotime($article->getDate())):''; ?>"> <? echo ( $article->getTitle() !== null )? date("M j, Y",strtotime($article->getDate())):''; ?> </time>
                                </li>
                                <li class="divider">/</li>
                                <li>:: <a><?echo ($article->getSource() !==null)? $article->getSource(): ''; ?></a> ::</li>
                            </ul>
                        </div>
                    </div>
                    <div class="entry-content">
                    <?php echo substr($article->getContent(), 0, strpos($article->getContent(), "</p>"));?>
                        <p> <a href="article.php?page=<?php echo $page_link; ?>" class="more-link">Continue reading…</a></p>
                        <footer class="entry-meta clearfix">
                            <ul class="post-tags clearfix">
                                <li><a class="cat-item-link" data-href="agency-4" rel="tag"><?echo ($article->getSource() !==null)? $article->getSource(): ''; ?> </a></li><li><a class="cat-item-link " data-href="News" rel="tag">News</a></li><li><a class="cat-item-link " data-href="<? echo ( $article->getCategory() !== null )? $article->getCategory():''; ?>" rel="tag"><? echo ( $article->getCategory() !== null )? $article->getCategory():''; ?></a></li></ul>
                        </footer>
                    </div>
                </div>
            </article>

        </div>
<?php endforeach; ?>
        <div class="pagination box" style="display: block;">
            <?php if($current_page > 1){ ?>
                    <a class="goto-page"href="index.php?current_page=<?=$current_page-1?>" data-page="2">Previous <i class="fa fa-hand-o-left"></i></a>
            <?}?>
            <?php $j=$current_page; if($j>3){$j-=3;}
            for($j;$j<=$current_page+4;$j++){
                if($j>$total_pages){break;}
                if($j==$current_page){?>
                <span class="current"><?=$j?></span>
                <?}else{?>
                <a class="goto-page inactive" href="index.php?current_page=<?=$j?>" data-page="<?=$j?>"><?=$j?></a>
                <?}}?>
                <?php if($current_page < $total_pages){ ?>
                    <a class="goto-page"href="index.php?current_page=<?=$current_page+1?>" data-page="2">Next <i class="fa fa-hand-o-right"></i></a>
                <?}?>
        </div>

    </div>

<?php include("foot.php"); ?>
