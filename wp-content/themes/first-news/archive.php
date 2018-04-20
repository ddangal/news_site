<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package first-news
 */
$home_page_layout = get_theme_mod('first_news_homepage_layout');

$home_page_layout_class = 'container-fluid';
if($home_page_layout == 'full-width'){
    $home_page_layout_class = 'container-fluid';
}else{
    $home_page_layout_class = 'container';
}

$archive_page_sidebar_layout = get_theme_mod('sidebar-archive', 'right-sidebar');
get_header(); 
?>
	<div class="main-content">
		<div class="<?php echo esc_attr($home_page_layout_class); ?>">
		<?php 
			if ( is_active_sidebar( 'sidebar-right' ) ){
				$first_news_col_class="col-lg-9 col-md-9 col-sm-12 col-xs-12";
			}else{
				$first_news_col_class="col-lg-12 col-md-12 col-sm-12 col-xs-12";
			}
			
			if ( have_posts() ) :
				
				$post_list = array();
				while ( have_posts() ) : the_post();
					$post_list[] = $post;
				endwhile; // End of the loop.
				$first_post[] = array_shift($post_list);
				
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				echo '<div class="clearfix"></div>';
			?>
				<?php
					foreach ( $first_post as $post ) : setup_postdata( $post );
					?>
						<div class="list-item">
							<?php
							$has_fiture = '';
							if(has_post_thumbnail(  )): $has_fiture = "has-figure"; ?>
								<div class="figure">
									<a href="<?php the_permalink(  ); ?>"><?php the_post_thumbnail('first-news-home-category'); ?>  </a>
								</div>
							<?php endif; ?>
							<div class="article <?php echo esc_attr($has_fiture); ?>">
								<a href="<?php the_permalink(); ?>">
									<h3 class="title-6"><?php the_title(); ?></h3>
								</a>
								<?php the_excerpt(); ?>
								<div class="category">
									<i class="fa fa-tag" aria-hidden="true"></i>
									<span>
										<?php the_category( ', ' ); ?>
									</span>
								</div>
							</div>
						</div>
				<?php endforeach; // End of the loop.?>
				</ul>
				<div class="row">
				<?php if($archive_page_sidebar_layout == 'left-sidebar' ){ ?>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<?php get_sidebar(); ?>
					</div>
				<?php }//End Sidebar ?>
					<div class=<?php echo esc_attr($first_news_col_class); ?>>
						<?php
							foreach($post_list as $post): setup_postdata($post);
								get_template_part( 'template-parts/contents-archive', get_post_type() );
							endforeach; // End of the loop.
						?>
						<div class="wraper-pagination">
			                <?php the_posts_pagination( array(
			                        'mid_size' => 2,
			                        'prev_text' => __( '<', 'first-news' ),
			                        'next_text' => __( '>', 'first-news' ),
			                    ) ); ?>
		                </div>
					</div>
					<?php if($archive_page_sidebar_layout == 'right-sidebar' ){ ?>
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<?php get_sidebar('right'); ?>
						</div>
					<?php } ?>
				</div>
			<?php else : 
				get_template_part( 'template-parts/content', 'none' ); 
			endif; ?>
			
		</div>
	</div>
<?php
get_footer();