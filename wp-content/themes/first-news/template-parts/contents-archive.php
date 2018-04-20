<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package first-news
 */
?>
<div >
	<div class="section">
		<div class="row">
			<div class="content">
				<div class="pst-block">
					<div class="pst-block-head no-btm archive_title">
						<a href="<?php the_permalink(); ?>">
							<h3 class="title-6"><?php the_title(); ?></h3>
						</a>
					</div>
					<div class="pst-block-main">
						<?php $layout = esc_attr(get_theme_mod('first_news_archive_layout', 'full_width')) ?>
						<?php if ( has_post_thumbnail() ): ?>
							<figure>
								<?php if( $layout == "alternate" ): ?>
									<div class="col-md-6 <?php echo (( $wp_query->current_post + 1 ) % 2 === 0 ? 'pull-left' : 'pull-right') ?>">
								<?php else: ?>
									<div class="<?php echo ( $layout == 'two_column' ? 'col-md-6' : 'col-md-12'); ?>">
								<?php endif; ?>
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('home-category', array('class' => 'img-center-pad')); ?>
									</a>
								</div>
							</figure>
						<?php else: ?>
							<?php $layout = 'full_width'; ?>
						<?php endif; ?>
						<div class="post-content <?php echo ( $layout == 'full_width' ? ' col-lg-12 col-md-12 col-sm-12 col-xs-12' : 'col-lg-6 col-md-6 col-sm-12 col-xs-12') ?>">
							<div class="meta-tp-2">
								<?php first_news_dateformat(); ?>
								<div class="category">
									<i class="fa fa-tag" aria-hidden="true"></i>
									<span>
										<?php the_category( ', ' ); ?>
									</span>
								</div>
							</div>
							<?php the_excerpt(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
