<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package first-news
 */
get_header(); 

$home_page_layout = get_theme_mod('first_news_homepage_layout','container-fluid');
$single_page_sidebar_layout = get_theme_mod('sidebar-single','right-sidebar');

if($home_page_layout == 'full-width'){
    $home_page_layout_class = 'container-fluid';
}else{
    $home_page_layout_class = 'container';
}
			while ( have_posts() ) : the_post();
				$layout = esc_attr(get_theme_mod('first_news_single_layout'));
    		?>
    		
    		<div class="main-content <?php if($layout == "banner") echo esc_attr('no-top-pad','first-news');?>">
    		<?php if($layout=="banner"): ?>
                <div class="image-container">
				    <figure>
		        		<div class="">
				            <a href="<?php the_permalink(); ?>">
				                <?php the_post_thumbnail(); ?>
				            </a>
				        </div>
			        </figure>
				    <div class="after <?php if(!has_post_thumbnail()) echo esc_attr('no-banner','first-news');?>">
				    	<div class="table">
	                        <div class="cell">
	                            <h3 class="title-6 title-22"><?php the_title(); ?>
	                        </div>
	                    </div>
	                </div>
				    </div>
				</div>
		    <?php endif;  		
			endwhile; // End of the loop.
		?>
		<div class="<?php echo esc_attr($home_page_layout_class); ?>">
			<div class="row">
				<?php if($single_page_sidebar_layout == 'left-sidebar' ): ?>
					<div class="col-lg-3  col-md-3 col-sm-12 col-xs-12">
						<?php get_sidebar(); ?>
					</div>
				<?php endif;
				if ( is_active_sidebar( 'sidebar-right' ) OR is_active_sidebar( 'sidebar-left' ) ){
					$first_news_col_class="col-md-9";
				}else{
					$first_news_col_class="col-md-12";
				}
				?>
				<div class=<?php echo esc_attr($first_news_col_class); ?>>
					<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/contents-page', get_post_type() );

							
							
						endwhile; // End of the loop.
					?>
				</div>
				<?php if($single_page_sidebar_layout == 'right-sidebar' ): ?>
					<div class="col-lg-3  col-md-3 col-sm-12 col-xs-12">
						<?php get_sidebar('right'); ?>
					</div>
				<?php endif; ?>
			</div>
			
		</div>
	</div>
<?php
get_footer();