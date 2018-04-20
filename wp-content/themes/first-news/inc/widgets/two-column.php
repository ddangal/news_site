<div class="section">
<?php 
	do_action( 'first_news_tab_header_hook', $instance, "two-column" ); 
	if(!empty($instance['category']) and is_array($instance['category'])){
	  $query = new WP_Query(
			array(
				'category__in' => (array)$instance['category'],
				'posts_per_page' => intval( $instance['post_count'] ),
			)
	  );
	}

	if(isset($query)): 
		include("two-column-content.php");  
	else: 
?>
    <h3><?php esc_html_e('Category not selected.','first-news') ?></h3>
<?php endif;  
do_action( 'first_news_tab_footer_data', $instance );