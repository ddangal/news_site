<?php
/**
* First News  Social Links
*/
if ( ! function_exists( 'first_news_social_links' ) ) {
	function first_news_social_links() {
        $first_news_facebook_link = get_theme_mod('first_news_facebook_link');
        $first_news_twitter_link = get_theme_mod('first_news_twitter_link');
        $first_news_g_plus_link = get_theme_mod('first_news_g_plus_link');
        $first_news_instagram_link = get_theme_mod('first_news_instagram_link');
        $first_news_youtube_link = get_theme_mod('first_news_youtube_link');
        $first_news_rss_link = get_theme_mod('first_news_rss_link');	
        ?>
        <div class="col-md-4 col-sm-12">
            <div class="social-icon">
                <ul>
                    <?php if(!empty($first_news_facebook_link)): ?><li><a href="<?php echo esc_url($first_news_facebook_link); ?>"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
                    <?php if(!empty($first_news_twitter_link)): ?><li><a href="<?php echo esc_url($first_news_twitter_link); ?>"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
                    <?php if(!empty($first_news_g_plus_link)): ?><li><a href="<?php echo esc_url($first_news_g_plus_link); ?>"><i class="fa fa-google-plus"></i></a></li><?php endif; ?>
                    <?php if(!empty($first_news_instagram_link)): ?><li><a href="<?php echo esc_url($first_news_instagram_link); ?>"><i class="fa fa-instagram"></i></a></li><?php endif; ?>
                    <?php if(!empty($first_news_youtube_link)): ?><li><a href="<?php echo esc_url($first_news_youtube_link); ?>"><i class="fa fa-youtube"></i></a></li><?php endif; ?>
                    <?php if(!empty($first_news_rss_link)): ?><li><a href="<?php echo esc_url($first_news_rss_link); ?>"><i class="fa fa-rss"></i></a></li><?php endif; ?>
                </ul>
            </div>
        </div>
    <?php 
	}
}
add_action( 'first_news_social_links', 'first_news_social_links');

//Tranding News Section
if ( ! function_exists( 'first_news_latest_news_links' ) ) {
	function first_news_latest_news_links() {
        ?>
        <div class="pst-block-head">
            <span class="breaking-news pull-left"><?php esc_html_e('Breaking News','first-news'); ?></span>
            <div class="flexslider">
                <ul class="slides">
                    <?php
                        $args = array('post_type'=>'post','posts_per_page'=>5);
                        $query = new WP_Query( $args ); 
                        if( $query->have_posts() ){ 
                            while($query->have_posts()): $query->the_post(); 
                                ?>
                                    <li><h5 class="breaking-news-header"><strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong></h5></li>
                                <?php 
                            endwhile; 
                            wp_reset_query();
                        }
                    ?>
                </ul>
            </div>
        </div>
    <?php 
	}
}
add_action( 'latest_news_title', 'first_news_latest_news_links');


/**
 * First News  Social Links
 */
if ( ! function_exists( 'first_news_slider' ) ) {
	function first_news_slider() {
    $slider_enable_disable = get_theme_mod('first_news_check_slider',false);
    $slider_cat_id = intval( get_theme_mod('first_news_category_select') );
    $first_news_slider_post_count = intval( get_theme_mod('first_news_slider_post_count',2) );
    $select_option = esc_attr(get_theme_mod('first_news_banner_layout','full_width'));
    $select_blog_cat = intval(get_theme_mod('first_section_select'));
    
    /**
     * slider Category Args
     */
    $slider_args = array(
        'posts_per_page'=> $first_news_slider_post_count, 
        'cat'=>$slider_cat_id, 
        'meta_query' => array(array('key' => '_thumbnail_id'))
    );
    $home_slider = new WP_Query( $slider_args );
    /**
     * Post Category Args
     */
    $slider_post_args = array(
        'posts_per_page'=> 4, 
        'cat'=> $select_blog_cat, 
        'meta_query' => array(array('key' => '_thumbnail_id'))
    );
    $home_slider_post = new WP_Query( $slider_post_args );

    /**
     * Slider Layout Condtion
     */
    $layout = 'col-lg-8 col-md-8 col-sm-12 col-xs-12';
    if($select_option == 'full_width'){
        $layout = 'col-lg-12  col-md-12 col-sm-12 col-xs-12';
    }elseif($select_option == 'with_left_category'){
        $layout = 'col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right';
    }else{
        $layout = 'col-lg-8 col-md-8 col-sm-12 col-xs-12';
    }

    /**
     * Full Width 
     */
    
    $first_news_latest_news_enable = get_theme_mod('first_news_latest_news_enable',false);
    if($slider_enable_disable == true){
    ?>
    <div class="<?php echo esc_attr( first_news_theme_layout() ); ?>">
        <div class="content-margin">
            <div class="row">
                <div class="col-lg-12">
                    <?php  if($first_news_latest_news_enable == true): do_action('latest_news_title'); endif; ?>
                </div>
                <div class="<?php echo esc_attr($layout); ?>">
                    
                    <div class="slider_container">
                            <div class="flexslider">
                                <ul class="slides">
                                <?php while ( $home_slider->have_posts() ) : $home_slider->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php 
                                                if($select_option == 'full_width'){
                                                    the_post_thumbnail('first-news-home-category');
                                                }else{
                                                    the_post_thumbnail('first-news-home-slider');
                                                } 
                                            ?>
                                        </a>
                                        <div class="flex-caption">
                                            <div class="caption_title_line">
                                                <h2><?php the_title(); ?></h2>
                                                <?php the_excerpt(); ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php endwhile; wp_reset_query();?>
                                
                            </ul>
                            </div>
                        </div>

                    </div>
                    <?php if($select_option == 'with_left_category' OR $select_option == 'with_right_category'): ?>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="pst-block-main">
                                <div class="col-row">
                                    <?php while ( $home_slider_post->have_posts() ) : $home_slider_post->the_post(); ?>
                                        <div class="col-sm-6">
                                            <article class="post post-tp-4">
                                                <?php if( has_post_thumbnail() ){ ?>
                                                    <figure>
                                                        <?php the_post_thumbnail('first-news-slider'); ?>
                                                    </figure>
                                                <?php } ?>
                                                <div class="meta-data">
                                                    <h3 class="title-3"><a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a></h3>
                                                    <?php first_news_dateformat(); ?>
                                                </div>
                                            </article>
                                        </div>
                                    <?php endwhile; wp_reset_query();?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php endif; ?>
            
                </div>
            </div>
        </div>
    </div>
    <?php }
	}
}
add_action( 'first_news_home_slider', 'first_news_slider');
