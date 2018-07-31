



                <aside id="side-bar" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="clearfix">
                        <div id="recent-posts-2" class="box row widget_recent_entries">
                            <h3 class="widget-head">Recent News</h3>
                            <ul id="widget_recent_list">
                            <?php
                            if(is_connected()){   
                                $sql ='SELECT newslink, category, source FROM news_tb ORDER BY newsdate DESC LIMIT 7';
                                $string_data = $database->query($sql);
                                $string_data = $database->fetch_array($string_data);
                                ($string_data)? $allLink = $string_data : $allLink =array();                        
                                $count = 0;
                                foreach ($allLink as $link){
                                    $count +=1;
                                    if($count ==7){break;}
                                    if($link[0]){
                                        $article = $pageScraper->getArticle($link[0],$link[1],$link[2] );
                                        echo '<li style=""><a href="article.php?page='.save_news($link[0]).'">'. $article->getTitle() .'</a></li>';
                                    }
                                } 
                            }
                            else{echo 'no connection';}
                             ?>
                            </ul>
                        </div>
                        <div id="categories-2" class="box row widget_categories">
                            <h3 class="widget-head">Categories</h3>
                            <ul id="widget_categories_list">
                                <li class="cat-item"><a class="cat-item-link" href="index.php?category=news">News</a> </li>
                                <li class="cat-item"><a class="cat-item-link" href="index.php?category=politics">Politics</a> </li>
                                <li class="cat-item"><a class="cat-item-link" href="index.php?category=sport">Sports</a> </li>
                                <li class="cat-item"><a class="cat-item-link" href="index.php?category=business">Business</a> </li>
                                <li class="cat-item"><a class="cat-item-link" href="index.php?category=entertainment">Entertainment</a> </li>
                                <li class="cat-item"><a class="cat-item-link" href="index.php?category=world">World News</a> </li>
                                <li class="cat-item"><a class="cat-item-link" href="index.php?category=technology">Technology</a> </li>
                                <li class="cat-item"><a class="cat-item-link" href="index.php?category=lifestyle">Life Style</a> </li>
                            </ul>
                        </div>
                        <div id="recent-comments-2" class="box row widget_recent_comments">
                            <h3 class="widget-head">Sources</h3>
                            <ul id="recentcomments">
                                <li class="recentcomments"><span class="comment-author-link"><a target="_blank" href="https://www.ghanaweb.com/"> <img src="files/ghana-web.png" alt="Ghana Web Avatar"></a></span></li>
                                <li class="recentcomments"><span class="comment-author-link"><a target="_blank" href="https://www.myjoyonline.com/"> <img class="last" src="files/my-joy-online.png" alt="My Joy Online Avatar"></a></span></li>
                                <li class="recentcomments"><span class="comment-author-link"><a target="_blank" href="https://citinewsroom.com/"> <img class="last" src="files/cnr-logo.jpg" alt="Citi News Room Avatar"></a></span></li>
                            </ul>
                        </div>
                        <div id="bl_socialbox-2" class="box row bl_socialbox">
                            <h3 class="widget-head">Social</h3>
                            <div class="widget-body">
                                <ul class="clearfix">
                                    <li><a target="_blank" data-title="Twitter" class="tips bl_icon_twitter" href="https://www.twitter.com/WorkSmartGH"><i class="fa fa-twitter"></i></a></li>
                                    <li><a target="_blank" data-title="Twitter" class="tips bl_icon_twitter" href="https://www.facebook.com/WorkSmartGH"><i class="fa fa-facebook"></i></a></li>
                                    <li><a target="_blank" data-title="Twitter" class="tips bl_icon_twitter" href="https://www.instagram.com/WorkSmartGH"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="home_sidebar_sticky" class="sticky_sidebar visible-lg visible-md"></div>
                    </div>
                </aside>


            </div>
        </div>
        <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="container-cover">
                <div class="container">
                    <div class="row-fluid" id="footer-body">
                        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                            <center><a href="https://www.worksmart.limited/" target="_blank"><img src="files/worksmart.png" alt="" class="img-responsive"></a></center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid" id="footer-bottom"> Copyright <script>document.write(new Date().getFullYear());</script>2018 · All Rights Reserved · Work Smart Limited &nbsp; · &nbsp; Mind your Business. Leave <b>I.T</b> to us</div>
        </footer>
    </div>
    <!-- <script type="text/javascript">
        var blu = {"disable_fixed_header": false, feed: true, recent: true, notfound: false, disqus: false};
    </script> -->
    <script src="files/controls.js" data-minify="1" defer="defer"></script>


</body></html>
<?php
 if (is_connected()){ getRecent();}
?>