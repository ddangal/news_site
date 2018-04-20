<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package first-news
 */
$home_page_layout = get_theme_mod('first_news_homepage_layout','container-fluid');
$archive_page_sidebar_layout = get_theme_mod('sidebar-archive','right-sidebar');

if($home_page_layout == 'full-width'){
    $home_page_layout_class = 'container-fluid';
}else{
    $home_page_layout_class = 'container';
}
get_header(); ?>
	<div class="main-content">
		<div class="<?php echo esc_attr($home_page_layout_class); ?>">
			<?php 
			 if ( is_active_sidebar( 'sidebar-right' ) OR is_active_sidebar( 'sidebar-left' )   ){
				$first_news_col_class="col-lg-9  col-md-9 col-sm-12 col-xs-12";
			}else{
				$first_news_col_class="col-lg-12  col-md-12 col-sm-12 col-xs-12";
			}

			if ( have_posts() ) : ?>
				<?php if ( is_home() && ! is_front_page() ) : ?>
					<header>
						<h1 class="page-title screen-reader-text"><?php wp_title(); ?></h1>
					</header>
				<?php endif; ?>
				<div class="row">
					<?php if($archive_page_sidebar_layout == 'left-sidebar' ): ?>
						<div class="col-lg-3  col-md-3 col-sm-12 col-xs-12">
							<?php get_sidebar(); ?>
						</div>
					<?php endif; ?>
					<div class=<?php echo esc_attr($first_news_col_class); ?>>
						<?php
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/contents-archive', get_post_type() );
							endwhile; // End of the loop.
						?>
						<div class="wraper-pagination">
			                <?php the_posts_pagination( array(
			                        'mid_size' => 2,
			                        'prev_text' => __( '<', 'first-news' ),
			                        'next_text' => __( '>', 'first-news' ),
			                    ) ); ?>
		                </div>
					</div>
					<?php if($archive_page_sidebar_layout == 'right-sidebar' ): ?>
						<div class="col-lg-3  col-md-3 col-sm-12 col-xs-12">
							<?php get_sidebar('right'); ?>
						</div>
					<?php endif; ?>
					
				</div>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
			
		</div>
	</div>
<?php
get_footer();