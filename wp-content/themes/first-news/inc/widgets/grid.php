<div class="section">
<?php do_action( 'first_news_tab_header_hook', $instance, "grid" ); 

	if(!empty($instance['sidebar'])){
		$first_news_col_class = esc_html("col-lg-4 col-md-4 col-sm-4 col-xs-12","first-news" );
	}else{
		$first_news_col_class = esc_html( "col-lg-3 col-md-3 col-sm-3 col-xs-1","first-news" );
	}
    
    if(!empty($instance['category']) and is_array($instance['category'])){
        $query = new WP_Query(
            array(
                'category__in' => $instance['category'] ,
                'posts_per_page' => intval( $instance['post_count'] ),
            )
        );
    }

if(isset($query)):  
    include("grid-content.php"); 
else: ?>
    <h3><?php esc_html_e('Category not selected.','first-news') ?></h3>
<?php endif; ?>

<?php do_action( 'first_news_tab_footer_data', $instance ); ?>