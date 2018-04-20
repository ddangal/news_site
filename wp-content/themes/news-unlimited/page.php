<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package news-unlimited
 */

get_header(); ?>

	<section id="main-cat" class="main-cat theme_pages"> <!-- main-cat start -->

        <div class="container">
            <!--  primary start -->
            <div class="row">
                <article id="primary" class="col-sm-8 col-md-8">
                    <div class="row">
                        <article class="col-xs-12 col-sm-12 col-md-12">
                        	<a href="<?php the_permalink(); ?>">
                        	<?php
                        	if ( has_post_thumbnail() ){
                        		the_post_thumbnail( 'news-unlimited_single_page_main_image' );
                            } else{
                                the_post_thumbnail( 'news-unlimited_single_page_main_image2' );
                            }
                        	?>
                        	</a>
                            <div class="content detail-ct">
                                <h3>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <p><?php the_content(); ?></p>
                            </div>
                        </article>
                    </div>
                </article>

                <article id="secondary" class="col-sm-4 col-md-4 tab listout lists_inner">
                    <?php
                    if (is_active_sidebar( 'sidebar-1' )) {
                        dynamic_sidebar( 'sidebar-1' );
                    }
                    ?>
                </article>
            </div>
        </div>
    </section>

<?php
get_footer();
