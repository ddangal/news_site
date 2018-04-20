<?php
$show_slider = get_theme_mod( 'hide_slider_checkbox' );
if( $show_slider == true ){
    $slider_cat = get_theme_mod( 'select_slider_category' );
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'cat' => $slider_cat
    );

    $args = apply_filters( 'news_unlimited_slider_homepage' , $args );

    $slider_post = new WP_Query( $args );
    if($slider_post->have_posts()):
        echo '<div class="slider multiple-items banner-sl">';
            while($slider_post->have_posts()):$slider_post->the_post();
                $slider_terms = wp_get_post_terms($post->ID, 'category');
                $category_arr = array();
                foreach ( $slider_terms as $key => $value ) {
                    $category_arr[] = $value->name;
                    $category_arr[] = $value->term_id;
                    }
                ?>
                <div class="item">
                   <?php 
                    $slider_style = get_theme_mod( 'slider_style', '3' );
                    if( $slider_style == '3' ){

                        the_post_thumbnail('news-unlimited_slider_image');

                    }else{

                        the_post_thumbnail('news-unlimited_single_page_main_image');

                    } 
                    ?>
                    <div class="container">
                        <div class="sl-caption">
                            <p>
                                <?php 
                                $term_link_1 = get_term_link( $category_arr[1] );
                                ?>
                                <a href="<?php echo esc_url( $term_link_1 ); ?>">
                                    <?php echo esc_html($category_arr[0]); ?>        
                                </a>
                            </p>
                            <h2 class="center">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                        </div>
                    </div>
                    <!-- banner overlay -->
                    <div class="overlay"></div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        echo '</div>';
    endif;
}