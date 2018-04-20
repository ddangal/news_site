<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package first-news
 */

$layout = esc_attr( get_theme_mod('first_news_single_layout') );

?>
<div class="section">
	<div class="row">
		<div class="content">
		    <div class="pst-block">
			    <?php if($layout!="banner"): ?>
			    	<div class="pst-block-head no-btm">
						<h3 class="title-6"><?php the_title(); ?></h3> <hr/>
						<div class="meta-tp-2">
			                <?php first_news_dateformat(); ?>
			                <div class="category">
			                	<i class="fa fa-tag" aria-hidden="true"></i>
			                	<span><?php the_category( ', ' ); ?></span>
			                </div>
			            </div>
	        		</div>
	        	<?php endif; ?>

		        <div class="pst-block-main">
		        	<?php if ( has_post_thumbnail() ): ?>
		        		<?php if($layout!="banner"): ?>
				        	<figure>
				        		<div class="<?php echo ($layout=='two_column' ? ' col-lg-9 col-md-9 col-sm-12 col-xs-12' : 'col-md-12 col-sm-12 col-xs-12') ?>">
						            <a href="<?php the_permalink(); ?>">
						                <?php the_post_thumbnail('', array('class' => 'img-center')); ?>
						            </a>
						        </div>
					        </figure>
					    <?php endif; ?>
			    	<?php endif; ?>
			    	<?php if($layout == "full_width"): ?>
			    		<div class="clearfix"> </div>
			    	<?php endif; ?>

		            <div class="post-content <?php if($layout=="full_width") echo esc_attr('content-top','first-news')  ;?>">
		            	<?php the_content();  wp_link_pages(); ?>
		            </div>
					<div class="clearfix"></div>					
	            	<div class="single-nav">
				    	<?php the_post_navigation(); ?>
				    </div>
					<div class="clearfix"></div>
						<?php
							$orig_post = $post;
							$tags = wp_get_post_tags($post->ID);

							//Individual Tag
							if ( $tags ) {
								$tag_ids = array();
								foreach($tags as $individual_tag){
									$tag_ids[] = $individual_tag->term_id;
								}

								//Query Args
								$args = array(
									'tag__in' => $tag_ids,
									'post__not_in' => array( $post->ID ),
									'posts_per_page'=>6, // Number of related posts to display.
								);
								$my_query = new wp_query( $args );
								
								if($my_query->have_posts()){ ?>
									<h2 class="recent_title"><?php esc_html_e("Related posts","first-news"); ?></h2>
								<?php } ?>
								<div class="relatedposts owl-carousel">
									<?php
										while( $my_query->have_posts() ) {
										$my_query->the_post();
									?>
									<div class="relatedthumb">
										<a rel="external" href="<?php the_permalink() ?>"><?php the_post_thumbnail('thumbnail'); ?><br />
											<?php the_title(); ?>
										</a>
									</div>
								<?php } ?>
							</div>

						<?php }
							$post = $orig_post;
							wp_reset_query();
						
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