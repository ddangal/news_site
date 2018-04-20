<?php
$headline_name = get_theme_mod('write_top_headline');
$headline_name = !empty( $headline_name ) ? $headline_name : esc_html__( 'TOP HEADLINES' , 'news-unlimited' );
$select_headline_cat = get_theme_mod('select_headline_category');
$args = array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'cat' => $select_headline_cat
);

$args = apply_filters( 'news_unlimited_top_heading', $args );

$top_heading = new WP_Query($args);
if($top_heading->have_posts()): ?>
	<div class="headline bg-black-h"> <!-- headline start -->
	    <div class="container"><!-- container start -->
	        <div class="row">
	            <article class="col-xs-2 col-sm-2 col-md-2">
	                <h4 class="center write_top_headline"><?php echo esc_html($headline_name);?></h4>
	            </article>
	            <article class="col-xs-7 col-sm-7 col-md-7">
	                <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
	                    <ul class="quick-news">
	                    	<?php 
	                    		while ($top_heading->have_posts()): $top_heading->the_post(); 
			                    	?>
			                        <li><a href="<?php the_permalink();?>"><?php echo esc_html($post->post_title); ?></a></li>
			                        <?php
	                        	endwhile;
	                        ?>
	                    </ul>
	                </marquee>
	            </article>
	            <article class="col-xs-3 col-sm-3 col-md-3">	            	
	            	<?php get_search_form(); ?>
	            </article>
	        </div>
	    </div><!-- container end -->
	</div><!-- headline end -->
	<?php
	wp_reset_postdata();
endif;
?>