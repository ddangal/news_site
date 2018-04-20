jQuery(document).ready(function($) {
    var newsIndex = []; 
    for(var i=0, len=localStorage.length; i<len; i++){
        var key = localStorage.key(i);
        if(key == null) continue;
        var value = localStorage[key];
        if(key.search('news_section') >= 0){
            newsIndex.push(key);
        }
    }
    for(var i = 0 ; i <= newsIndex.length; i ++){
        localStorage.removeItem(newsIndex[i]);
    }
    $(document).on( 'click', ".filters .category" ,function() {
        $(this).closest('.filters-list-1').find('a').removeClass('active');
        $(this).addClass('active');
        var data_id = $(this).attr("data_id");
        var style = $(this).attr("style_name");
        var count = $(this).attr("count");
        var cat_link = $(this).attr("cat_link");
        var sidebar = $(this).attr("sidebar");

        var widget =$(this).closest(".news_class");

        var id = $(widget).attr('id');

        var storage_id = id + "-" +data_id;

        var data = localStorage.getItem(storage_id);

        var that = jQuery(this);

        var data_block = that.closest(".pst-block").find(".pst-block-main");

        that.closest(".pst-block").find(".pst-block-foot a").attr("href", cat_link);

        if (data != null){
            $(data_block).html(data);
            return;
        }

        $.ajax({
            url: ajax_tab.ajax_url,
            data: {
                'action':'first_news_tab_data',
                'data_id' : data_id,
                'style' : style,
                'count' : count,
                'sidebar' : sidebar
            },
            success:function(data) {
                setTimeout(function() {
                    localStorage.setItem(storage_id, data);
                    $(data_block).html(data);

                    matchHeight();

                }, 1000);
            },
            beforeSend: function() {
                $(data_block).html('<div class="ajax-loader" style="height:320px;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div>');
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });  


    var owl = jQuery('.owl-carousel');
    owl.owlCarousel({
        items:5,
        loop:true,
        margin:10,
        autoplay:true,
        autoplayTimeout:2000,
        autoplayHoverPause:true,
        nav: true,
        navText: ["<i class='fa fa-chevron-left' aria-hidden='true'></i>","<i class='fa fa-chevron-right' aria-hidden='true'></i>"],
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:3,
                nav:false
            },
            1000:{
                items:5,
                nav:true,
            }
        }
    });
    function matchHeight(){
        $('.news_class .post-tp-4').matchHeight({byRow: true});
        $('.news_class .post-tp-5').matchHeight({byRow: true});

        $('.news_class .post-tp-6').matchHeight({byRow: true});
        $('.news_class .equal_height').matchHeight({byRow: true});

    }
    matchHeight();

});
