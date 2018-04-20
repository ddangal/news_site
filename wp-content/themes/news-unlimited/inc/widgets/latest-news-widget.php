<?php

// Register and load the widget
function news_unlimited_latest_load_widget() {
    register_widget( 'news_unlimited_latest_news_widget' );
}
add_action( 'widgets_init', 'news_unlimited_latest_load_widget' );
 
// Creating the widget 
class news_unlimited_latest_news_widget extends WP_Widget {
 
    function __construct() {
        parent::__construct(
         
        // Base ID of your widget
        'news_unlimited_latest_news_widget', 
         
        // Widget name will appear in UI
        esc_html__( '( Sidebar ) News Widget Carousel' , 'news-unlimited'), 
         
        // Widget description
        array( 'description' => esc_html__( 'News Layout Widget Carousel', 'news-unlimited' ), ) 
        );
    }
 
    // Creating widget front-end
     
    public function widget( $arguments, $instance ) {

        echo wp_kses_post( $arguments['before_widget'] ); ?>
        <div class="title br-orange transform">

        <h3>
            <?php 
            $title = !empty( $instance[ 'title' ] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base )  : '';
            echo esc_html( $title );?></h3>
        
        </div>
        <div class="row latest-page3">
            <div dir="rtl" class="slider single-item-rtl">
                <?php
                $colors = news_unlimited_cat_colors();
                $data = array();
                $category_id = !empty( $instance['category'] ) ? $instance['category'] : '';
                global $post;
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => 3,
                    'cat' => $category_id
                );

                $args = apply_filters( 'news_unlimited_latest_news' , $args );
                
                $latest_news = new WP_Query( $args );
                if( $latest_news->have_posts() ):
                    while( $latest_news->have_posts() ): $latest_news->the_post();
                        $comments_count = wp_count_comments($post->ID);
                        $banner_slider_terms = wp_get_post_terms( $post->ID, 'category' );
                        $cat_name = $banner_slider_terms[0]->name;
                        if( !array_key_exists($cat_name, $data) ){
                            $data[$cat_name] = $colors[0];
                            unset( $colors[0] );
                            $colors = array_values($colors);
                        }
                        ?>
                        <div class="sidebar-latest">
                            <article class="col-xs-6 col-sm-12 col-md-12"><!-- post item 1-->
                                <div class="post-sec <?php echo ( has_post_thumbnail() ? '' : 'no_image' );?>">
                                    <a href="<?php the_permalink(); ?>">
                                    <?php
                                    if(has_post_thumbnail())
                                        the_post_thumbnail( 'news-unlimited_latest_news_image' );
                                    ?>
                                    </a>
                                    <div class="post-detail">

                                        <div class="post-cat transform" style="background: <?php echo esc_attr($data[$cat_name]);?>">
                                            <a href="<?php echo esc_url(get_term_link( $banner_slider_terms[0]->term_id )); ?>"><?php echo esc_html( $cat_name );?></a>
                                        </div>

                                        <p>
                                            <a href="<?php echo esc_url(home_url()); ?>/<?php echo date( 'Y/m' , strtotime( get_the_date() ) ); ?>"><i class="fa fa-calendar"></i><?php echo esc_html( get_the_date() ); ?></a> <span class="slider-span"><a href="<?php the_permalink(); ?>/#respond"><i class="fa fa-comment"></i><?php echo esc_html($comments_count->total_comments); ?></a></span>
                                        </p>
                                        <p>
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </p>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
        <div class="clear"></div>
        <?php
        echo wp_kses_post( $arguments['after_widget'] );
    }    
    // Widget Backend 
    public function form( $instance ) {

        $title = !empty( $instance[ 'title' ] ) ?  $instance[ 'title' ] : ''; 
        $category = !empty( $instance[ 'category' ] ) ?  $instance[ 'category' ] : ''; 
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:' , 'news-unlimited' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' , 'news-unlimited' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Category:' , 'news-unlimited' ); ?></label> 
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'category' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>">
                <option value=""><?php esc_html_e( 'Select one from below' , 'news-unlimited' ); ?></option>
                <?php
                $selected_cat = !empty( $instance['category'] ) ? $instance['category'] : '';
                $cat_name = news_unlimited_getAllCategories();
                foreach ($cat_name as $key => $value) { ?>
                    <option value="<?php echo esc_attr( $key ); ?>"<?php selected($selected_cat, $key);?> ><?php echo esc_html( $value ); ?></option>
                    <?php
                } ?>
                
            </select>
        </p>
        <?php
    }
     
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['category'] = ( ! empty( $new_instance['category'] ) ) ? sanitize_text_field( $new_instance['category'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here