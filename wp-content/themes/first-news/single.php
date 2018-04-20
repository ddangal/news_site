<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package first-news
 */

get_header(); 
	/**Home Page Layout */
	$single_page_sidebar_layout = get_theme_mod('sidebar-single','right-sidebar');

	while ( have_posts() ) : the_post();
		$layout = get_post_meta( get_the_ID(),'layout',true);
		
	?>
    	<div class="main-content <?php if($layout=="banner") echo 'no-top-pad';?>">
    		<?php if($layout=="banner"): ?>
                <div class="image-container">
				    <figure>
		        		<div class="single-post-thumbnail-img" >
				            <a href="<?php the_permalink(); ?>">
				                <?php the_post_thumbnail(); 	?>
				            </a>
				        </div>
			        </figure>
				    <div class="after <?php if(!has_post_thumbnail()) echo 'no-banner';?>">
				    	<div class="table">
	                        <div class="cell">
								<?php 
									$categories = get_the_category();
									if ( ! empty( $categories ) ) {
										foreach ($categories as $cat) {
											echo '<a class="category-tp-3" href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>';
										}
									}
								?>
	                            <h3 class="title-6 title-22"><?php the_title(); ?></h3>
	                            <div class="meta-tp-4">
	                                <div class="author-tp-2">
	                                    <i class="fa fa-user" aria-hidden="true"></i><?php the_author(); ?>
	                                </div>
	                                <?php first_news_dateformat(); ?>
	                                <div class="ptp-1-comments">
	                                    <a href="<?php echo esc_url( get_comments_link()); ?>"><i class="fa fa-comments" aria-hidden="true"></i><span><?php comments_number( '0', '1', '%' ); ?></span></a>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
				    </div>
				</div>
		    <?php endif; ?>
		<?php endwhile; // End of the loop. ?>
		<div class="<?php echo esc_attr( first_news_theme_layout() ); ?>">
			<div class="row">
				<?php if($single_page_sidebar_layout == 'left-sidebar' ): ?>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<?php get_sidebar(); ?>
					</div>
				<?php endif;
					if( $single_page_sidebar_layout != 'full-width') {
						if ( is_active_sidebar( 'sidebar-right' ) OR is_active_sidebar( 'sidebar-left' ) ){
							$first_news_col_class = "col-lg-9 col-md-9 col-sm-12 col-xs-12";
						}
					}
						else{
							$first_news_col_class = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
						}
				?>
				<div class="<?php echo esc_attr( $first_news_col_class ); ?>">
					<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/contents-single', get_post_type() );
						endwhile; // End of the loop.
					?>
				</div>
				<?php if($single_page_sidebar_layout == 'right-sidebar' ){ ?>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<?php get_sidebar('right'); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php
get_footer();
