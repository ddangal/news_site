<?php 
function first_news_tab_data() {
    if ( isset($_GET) ) {
    	$get = wp_unslash($_GET);
        $data_id = intval($get['data_id']);

        $category = explode (",", $data_id);
        $style = esc_attr($get['style']);
        $count = intval($get['count']);
        $sidebar = intval($get['sidebar']);
        echo first_news_get_category_data($category, $style, $count, $sidebar);
    }
	die();
}

add_action( 'wp_ajax_first_news_tab_data', 'first_news_tab_data' );

add_action( 'wp_ajax_nopriv_first_news_tab_data', 'first_news_tab_data' );

function first_news_get_category_data($category, $style, $count, $sidebar){
	ob_start();
	
		if($sidebar==0){
	        $first_news_col_class = "col-sm-3";
		}else{
			$first_news_col_class = "col-sm-4";
		}

		$query = new WP_Query(
			array(
			'category__in' => (array) $category,
			'posts_per_page' => intval($count),
			)
		);
	
	$style = $style."-content.php"; 
	include($style);  
	
	return ob_get_clean();
} 