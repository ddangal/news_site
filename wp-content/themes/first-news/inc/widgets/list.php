<div class="section">
<?php 
	do_action( 'first_news_tab_header_hook', $instance, "list" ); 

	if(!empty($instance['sidebar'])){
		$first_news_col_class="col-sm-4";
	}else{
		$first_news_col_class="col-sm-3";
	}
	if(!empty($instance['category']) and is_array($instance['category'])){
		$query = new WP_Query(
		array(
			'category__in' => $instance['category'],
			'posts_per_page' => intval( $instance['post_count'] ),
		)
		);
	}
 	if(isset($query)): 
		include("list-content.php");  
	else: 
?>
    <h3><?php esc_html_e('Category not selected.','first-news') ?></h3>
<?php endif; 
do_action( 'first_news_tab_footer_data', $instance ); ?>