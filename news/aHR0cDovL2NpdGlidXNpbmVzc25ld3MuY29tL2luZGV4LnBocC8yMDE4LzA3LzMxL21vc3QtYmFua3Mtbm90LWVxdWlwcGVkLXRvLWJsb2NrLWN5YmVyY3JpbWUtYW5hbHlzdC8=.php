
                <?php 
                $pageScraper = new Pagescraper;
                $article = $pageScraper->getArticle("http://citibusinessnews.com/index.php/2018/07/31/most-banks-not-equipped-to-block-cybercrime-analyst/");  
                ?>
            <div class="columns">

                        
            <div class="view-controls">
                <a class="pull-left" href="#"><i class="fa fa-hand-o-left"></i> Previous</a>

                <a class="pull-right" href="#">Next <i class="fa fa-hand-o-right"></i></a>
                <br style="clear: both;">
            </div>
            </div>
            <article class="post type-post status-publish format-standard has-post-thumbnail hentry category-themes">
                <div class="entry-image" style=""> 
                <a class="image-comment" title="<?php echo $article->getTitle(); ?>" rel="bookmark"> 
                <img src=" <?php echo $article->getImage(); ?>" class="attachment-sidebar-large size-sidebar-large wp-post-image" alt="">
                </a>
                </div>
                <div class="entry-container box">
                    <div class="post-title author-image-on">
                        <h1 class="entry-title">
                        <a>
                        <?php echo $article->getTitle(); ?>
                        </a></h1>
                        <div class="post-meta">
                            <ul>
                                <li>
                                    <time class="entry-date updated" datetime="<? echo ( $article->getTitle() !== null )? date("M j, Y",strtotime($article->getDate())):""; ?>"> <? echo ( $article->getTitle() !== null )? date("M j, Y",strtotime($article->getDate())):""; ?></time>
                                </li>
                                <li class="divider">/</li>
                                <li>:: <a target="_blank" href="https://www.myjoyonline.com"><?echo ($article->getSource() !==null)? $article->getSource(): ""; ?></a> ::</li>
                            </ul>
                        </div>
                    </div>
                    <div class="entry-content entry-content2" lang="en">
                        <p class="snb-content"></p>
                        <?php echo $article->getContent(); ?>
                        <p></p>
                        <!-- <p> <a target="_blank" href="" class="more-link"> Open Full Story&#8230;</a></p> -->
                        <footer class="entry-meta clearfix">
                            <ul class="post-tags clearfix">
                                <li><a class="cat-item-link" data-href="agency-2" rel="tag"><?echo ($article->getSource() !==null)? $article->getSource(): ""; ?></a></li>
                                <li><a class="cat-item-link" data-href="News" rel="tag">News</a></li>
                                                                                    <li><a class="cat-item-link" data-href="Business" rel="tag">Business</a></li>
                                                                            </ul>
                        </footer>
                    </div>
                </div>
            </article>
            </div>
            