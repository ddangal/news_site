<?php
/**
 * Theme Layout Functions
 */
if ( ! function_exists( 'first_news_theme_layout' ) ) {
	function first_news_theme_layout() {	
        //Theme Layout customizer Vaue
		$home_page_layout = get_theme_mod('first_news_homepage_layout','container-fluid');
        
        //Condtion Statement
        if($home_page_layout == 'full-width'){
            $home_page_layout_class = 'container-fluid';
        }else{
            $home_page_layout_class = 'container';
        }

        return $home_page_layout_class;
        
	}
}

/**
 * Post Date Display
 */
if ( ! function_exists( 'first_news_dateformat' ) ) {
	function first_news_dateformat() {	
    ?>
    <div class="date">
        <i class="fa fa-clock-o" aria-hidden="true"></i>
        <span>
            <?php 
                if ( get_theme_mod( 'first_news_dateformat','default' ) == "default" ) {
                    echo esc_attr(get_the_date(get_option( 'date_format' )));  
                }else{
                    echo esc_attr(human_time_diff( get_the_time('U'), current_time('timestamp') )) . esc_html(' ago', 'first-news'); 
                }
            ?>
        </span>
    </div>
    <?php    
	}
}