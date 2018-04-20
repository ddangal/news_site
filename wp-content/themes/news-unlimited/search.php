<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package news-unlimited
 */
get_header(); 
?>
<section id="main-cat" class="main-cat">

    <div class="container">

        <div class="row">
            <article id="primary" class="col-sm-8 col-md-8 fash-ion">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12">

                	<?php
                    $str = ( !empty($_GET['s'])) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ) : '';
                    $args = array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        's' => $str
                    );
                    $search_post = new WP_Query( $args );
                	if ( $search_post->have_posts() ){
                		while ( $search_post->have_posts() ) : $search_post->the_post();
                			news_unlimited_archive_listing_page();
			            endwhile;
			        } else { 

                        $search_name = !empty( $_GET['s'] ) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ): '';
                        ?>
                        <h2>
                            <?php 
                            printf(
                                esc_html__( 'Search Result For: %s', 'news-unlimited' ),
                                esc_html( $search_name )
                            ); 
                            ?>
                        </h2>
                        <h2><?php esc_html_e( 'Nothing Found', 'news-unlimited' ); ?></h2>

                        <div class="nothing_found">   

                            <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'news-unlimited' ); ?></p>               
                            <?php 
                            get_search_form();
                            ?>

                        </div>
                        <?php
                        
                    }
			        the_posts_navigation(
			            	array(
			            		'mid_size' => 6,
							)
			            );
                	?>

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
