jQuery(document).ready(function() {
    
    //Recnet News Control
    jQuery(window).load(function() {
        jQuery('.breaking-news-slider').show().flexslider({
            animation: "slide",
            
        });
      });
    
    //Main Slider Control
        jQuery(window).load(function() {
        jQuery('.flexslider').flexslider({
            animation: "fade"
        });
            jQuery(function() {
                jQuery('.show_menu').click(function(){
                        jQuery('.menu').fadeIn();
                        jQuery('.show_menu').fadeOut();
                        jQuery('.hide_menu').fadeIn();
                });
                jQuery('.hide_menu').click(function(){
                        jQuery('.menu').fadeOut();
                        jQuery('.show_menu').fadeIn();
                        jQuery('.hide_menu').fadeOut();
                });
            });
    });

    
    /**
     * Thumbnail Control Post
     */
    jQuery(window).load(function() {
        jQuery('.thumbnail_control').flexslider({
        animation: "slide",
        controlNav: "thumbnails"
        });
    });



});
