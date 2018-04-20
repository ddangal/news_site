<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package first-news
 */
?>
<div class="section">
	<div class="row">
		<div class="content">
		    <div class="pst-block">
		    	<div class="pst-block-head no-btm">
					<?php 
						$layout = esc_attr( get_theme_mod( 'first_news_single_layout' ) ); 
						if( $layout != "banner" ){ 
							the_title( '<h3 class="title-6">', '</h3><hr/>', true );
						}
					?>
	        	</div>

		        <div class="pst-block-main page-top">
					<?php 
						if ( has_post_thumbnail() ){
							if($layout!="banner"){ 
						?>
				        	<figure>
				        		<div class="<?php echo esc_attr($layout=='two_column' ? 'col-lg-9 col-md-9 col-sm-12 col-xs-12' : 'col-md-12 col-sm-12 col-xs-12') ?>">
						            <a href="<?php the_permalink(); ?>">
						                <?php the_post_thumbnail('', array('class' => 'img-center')); ?>
						            </a>
						        </div>
					        </figure>
						<?php } } ?>
		            <div class="post-content">
		            	<?php the_content();  ?>
					</div>
					
					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>
		        </div>
		    </div>
		</div>
	</div>
</div>