<?php
function first_news_inline_css(){
	$first_news_custom_css = "";
    
        /**
		 * Add The Slider Arrow
		 */
		$first_news_custom_css = "
            .flex-direction-nav li a {width:45px; height:42px; margin:0; display: block; position: absolute;right: 11px; cursor: pointer; text-indent: -9999px;}
            .flex-direction-nav li a.next {background:url(". esc_url(get_template_directory_uri())."/assets/images/next.png) no-repeat center; bottom:184px;}
            .flex-direction-nav li a.prev {background:url( ". esc_url( get_template_directory_uri())."/assets/images/prev.png) no-repeat center;bottom:141px;}
            .flex-direction-nav li a.next:hover {background:url(". esc_url( get_template_directory_uri() )."/assets/images/next_a.png) no-repeat center;}
            .flex-direction-nav li a.prev:hover {background:url( ". esc_url(get_template_directory_uri())."/assets/images/prev_a.png) no-repeat center;}
            .flex-direction-nav li a.disabled {opacity: .3; filter:alpha(opacity=30); cursor: default;}
            .flexslider {width: 100%; margin: 0; padding: 0 0 0px 0;background:url(". esc_url(get_template_directory_uri())."/assets/images/shadow_bottom.png) no-repeat center bottom;}
        ";

    wp_add_inline_style( 'admin-bar', $first_news_custom_css );
}
add_action( 'wp_enqueue_scripts', 'first_news_inline_css' );
