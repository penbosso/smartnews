

jQuery(function($) {

    function scrollPageToTop() {
        $("html, body").animate({ scrollTop: 0}, "slow");
    };

    function paginationControl(page){

        var MaxNumberOfControls = 3;

        // ----------  pagination  ------------------------
        if( page.totalPages > 1 ){

            var navigate='';
            if( page.hasPrev ){
                navigate+='<a class="goto-page" data-page="'+page.prevPage+'"><i class="fa fa-hand-o-left"></i> Previous</a>';
            }

            if( page.curPage >= 1 ){
                var min = page.curPage - MaxNumberOfControls;
                min = ( min < 1 ) ? 1 : min;
                for (var i = min; i < page.curPage; i++) {
                    navigate+='<a class="goto-page inactive" data-page="'+i+'">'+i+'</a>';
                }

                navigate+='<span class="current">'+page.curPage+'</span>';

                var max = page.curPage + MaxNumberOfControls;
                max = ( page.totalPages < max ) ? page.totalPages : max;
                for (var i = page.curPage+1; i <= max; i++) {
                    navigate+='<a class="goto-page inactive" data-page="'+i+'">'+i+'</a>';
                }
            } 

            if( page.hasNext ){
                navigate+='<a class="goto-page" data-page="'+page.nextPage+'">Next <i class="fa fa-hand-o-right"></i></a>';
            } 

            $(".pagination.box").html(navigate).slideDown(350);

            scrollPageToTop();
        }

        // ----------  end pagination ------------------------   
    };


    function loadfeed(tag, keyword, page){

        page = ( typeof page == 'undefined' ) ? 1 : page;
        // console.log(page);

        if (blu.notfound) {
            $("#404-div").hide('slow');
        }
        $(".columns").html("");
        $("#processing").show();
        $("#no-results").hide('slow');
        $(".pagination.box").html('').hide();

        var url = "/assets/ajax/load-feed.php";
        var formdata="category=news&tag="+tag+"&keyword="+keyword+"&page="+page;

        $.post(url, formdata, function(response){
            var info = $.parseJSON(response);

            var output='';
            $(".columns").html(output);

            if(info.draw){ 
                // console.log(info.data);
                // here is where the magic happens
                $.each(info.data, function(b, j) { // b, j ... hahahahaha
                    output +=  `<article class="post type-post status-publish format-standard has-post-thumbnail hentry category-themes">
                            <div class="entry-image" style=""> <a href="/`+j.FeedID+`.html" class="image-comment" title="`+j.Title+`" rel="bookmark"> <img  src="`+j.Enclosure+`" class="attachment-sidebar-large size-sidebar-large wp-post-image" alt="" /> </a></div>
                            <div class="entry-container box">
                                <div class="post-title author-image-on">
                                    <h1 class="entry-title"> <a href="/`+j.FeedID+`.html">`+j.Title+`</a></h1>
                                    <div class="post-meta">
                                        <ul>
                                            <li>
                                                <time class="entry-date updated" datetime="`+j.PublicationDate+`">`+j.PublicationDate+`</time>
                                            </li>
                                            <li class="divider">/</li>
                                            <li>:: <a>`+j.AgencyAvatar.AgencyName+`</a> ::</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="entry-content">
                                    <p>`+j.Description+`</p>
                                    <p> <a href="/`+j.FeedID+`.html" class="more-link">Continue reading&#8230;</a></p>
                                    <footer class="entry-meta clearfix">
                                        <ul class="post-tags clearfix">
                                            <li><a class="cat-item-link" data-href="agency-`+j.AgencyAvatar.NewsAgencyID+`" rel="tag">`+j.AgencyAvatar.AgencyName+`</a></li>`;
                                            output += `<li><a class="cat-item-link `;
                                            if(tag == "News"){
                                                output += `active`;
                                            }
                                            output += `" data-href="News" rel="tag">News</a></li>`;

                                            if ( j.NewsFeedCategory.toLowerCase() != "news") {
                                                output += `<li><a class="cat-item-link `;
                                                if(tag == j.NewsFeedCategory){
                                                    output += `active`;
                                                }
                                                output += `" data-href="`+j.NewsFeedCategory+`" rel="tag">`+j.NewsFeedCategory+`</a></li>`;
                                            }

                                    output += `</ul>
                                    </footer>
                                </div>
                            </div>
                        </article>`;
                });

                // console.log(output);
                $(output).hide().appendTo($('.columns')).slideDown(350);
                
                // console.log(info.recordsTotal);
                if( parseInt(info.recordsTotal) > 9 ){
                    // console.log(info.recordsTotal);
                    // load pagination controls
                    paginationControl(info.page);
                }else{
                    $(".pagination.box").html('').hide();
                }

            }
            else{
                $("#no-results").slideDown('slow');
            }
        })
        .done(function() {
            $("#processing").hide();
        }); // end post closure
    };

    // 
    function loadRecentFeed(){

        $("#widget_recent_list").html("Loading ...");

        var url = "/assets/ajax/load-recent.php";
        var formdata="type=recent";

        $.post(url, formdata, function(response){
            var info = $.parseJSON(response);

            var output='';
            $("#widget_recent_list").html(output);

            if(info.draw){ 
                // here is where the magic happens
                $.each(info.data, function(b, j) {
                    output += '<li><a href="/'+j.FeedID+'.html">'+j.Title+'</a></li>';
                });

                // console.log(output);
                $(output).hide().appendTo($('#widget_recent_list')).fadeIn(2000);
            }
            else{
                $("#widget_recent_list").html(output);
            }
        });// end post closure

    }; 


  
    $("#navigation-button").on('mouseover', function (event) {
        $(".menu, .menubg").show();
    });

    

    $(document).on('click', '#navigation-button', function (event) {
        $(".menu, .menubg").fadeToggle("slow", "linear");
    });

    $(".menu, #navigation-button").on('mouseleave', function (event) {
        if ($('.menu').is(':hover') || $('#navigation-button').is(':hover') ) {
        }else{
            $(".menu, .menubg").hide();
        }
    });

    $(".menubg").on('click', function(event) {
        $(".menu, .menubg").hide();
    });


    // loaders
    if (blu.feed) {
        loadfeed(tag="all", keyword="");
    }

    if (blu.recent) {
        loadRecentFeed();
    }


    function removeDisqus(){
        $("#disqus_thread").remove();
    }


    $(document).on('click', '.cat-item-link', function (event) {
        event.preventDefault();
        var tag = $.trim($(this).data('href'));
        $(".cat-item-link").removeClass('active');
        loadfeed(tag, keyword="");        
        $(this).addClass('active');
        if(blu.disqus){
            removeDisqus();
        }
        $("#capturelevel").val(tag);
    });


    $("#doSearch").on('click', function (event) {
        event.preventDefault();
        var keyword = $.trim($("#s").val());
        loadfeed(tag="all", keyword); 
        if(blu.disqus){
            removeDisqus();
        }
        $(".cat-item-link").removeClass('active');
        $("#s").val("");
    });

    $(document).on('click', '.goto-page', function (event) {
        event.preventDefault();

        var page = $.trim($(this).data('page'));
        var tag = $.trim($(".cat-item-link.active").data('href'));

        var capturelevel = $("#capturelevel").val();
        capturelevel = ( $.trim(capturelevel) == "" ) ? "all" : capturelevel;
        tag = ( $.trim(tag) == "" ) ? capturelevel : tag;

        var keyword = $.trim($("#s").val());
        if( keyword != "" ){ tag = "all"; }

        loadfeed(tag, keyword, page);
    } );


});
