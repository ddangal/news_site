<?php

// Register and load the widget
function news_unlimited_sidebar_last_object_load_widget() {
    register_widget( 'news_unlimited_sidebar_last_object_widget' );
}
add_action( 'widgets_init', 'news_unlimited_sidebar_last_object_load_widget' );
 
// Creating the widget 
class news_unlimited_sidebar_last_object_widget extends WP_Widget {
 
    function __construct() {
        parent::__construct(
         
        // Base ID of your widget
        'news_unlimited_sidebar_last_object_widget', 
         
        // Widget name will appear in UI
        esc_html__( '( Sidebar ) News Widget Sidebar' , 'news-unlimited'),
         
        // Widget description
        array( 'description' => esc_html__( 'News layout widget sidebar 4 posts', 'news-unlimited' ), ) 
        );
    }
 
    // Creating widget front-end
    public function widget( $arguments, $instance ) {
        echo wp_kses_post( $arguments['before_widget'] ); ?>
        <div class="videos">
            <div class="title br-orange transform">
                <h3>
                    <?php
                    $title = !empty( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) : '';
                    echo esc_html( $title ); ?></h3>
            </div>
            <?php
            $category_id = !empty( $instance['category'] ) ? $instance['category'] : '';
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'cat' => $category_id,
                'posts_per_page' => 4
            );

            $args = apply_filters( 'news_unlimited_sidebar_last_object' , $args );
            
            $last_sidebar = new WP_Query( $args );
            $count = 0;
            if( $last_sidebar->have_posts() ):
                while( $last_sidebar->have_posts() ): $last_sidebar->the_post();
                    global $post;
                    $comments_count = wp_count_comments($post->ID);
                    if( $count == 0 ){   
                        ?>
                        <div class="wrap">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                if(has_post_thumbnail( ))
                                            the_post_thumbnail( 'news-unlimited_sidebar_last_object_image' );
                                ?>
                            </a>
                            <div class="content">
                                <h4>
                                    <a href="<?php the_permalink(); ?>"><?php echo esc_html(wp_trim_words( get_the_title(), 6, '&hellip;' )); ?></a>
                                </h4>
                                <span>
                                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><i class="fa fa-user"></i><?php the_author_meta( 'user_login', $post->post_author ) ?></a>  |  <a href="<?php echo esc_url(home_url()); ?>/<?php echo date( 'Y/m' , strtotime( get_the_date() ) ); ?>"><i class="fa fa-calendar"></i><?php echo esc_html( get_the_date() ); ?></a>  | <a href="<?php the_permalink(); ?>/#respond"><i class="fa fa-comments"></i><?php echo esc_html($comments_count->total_comments); ?></a>
                                </span>
                                <p>
                                    <?php echo esc_html(wp_trim_words( get_the_content(), 30, '&hellip;' ));?>
                                </p>
                            </div>
                        </div>
                    <?php
                    } else {
                        if( $count == 1 ){
                            ?>
                            <div class="listout">
                            <?php
                        }
                        ?>
                            <div class="item-list <?php echo(has_post_thumbnail() ? "" : "no_thumbnail"); ?>">
                                <?php 
                                if (has_post_thumbnail()){ ?>
                                    <article class="col-sm-5 col-xs-3">
                                        <div class="wrap">
                                            <a href="<?php the_permalink(); ?>">
                                            <?php
                                                the_post_thumbnail( 'news-unlimited_sidebar_last_small_images' );
                                                $no_image = false;
                                            ?>
                                            </a>
                                        </div>    
                                    </article>
                                <?php
                                } else {
                                    $no_image = true;
                                }
                                ?>
                                <article class="<?php echo( $no_image ? "col-sm-12" : "col-sm-7"); ?> col-xs-9">
                                    <h5>
                                        <a href="<?php the_permalink(); ?>"><?php echo esc_html(wp_trim_words( get_the_title(), 6, '&hellip;' )); ?></a>
                                    </h5>
                                    <span>
                                        <a href="<?php echo esc_url(home_url()); ?>/<?php echo date( 'Y/m' , strtotime( get_the_date() ) ); ?>"><i class="fa fa-calendar"></i><?php echo esc_html(get_the_date()); ?></a>  | <a href="<?php the_permalink(); ?>/#respond"><i class="fa fa-comments"></i><?php echo esc_html($comments_count->total_comments); ?></a>
                                    </span>
                                </article>
                            </div>
                        <?php
                        if($last_sidebar->found_posts == 1 ){
                            ?>
                            </div>
                        <?php
                        }
                    }
                    $count++;
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
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
                $cat_name = news_unlimited_getAllCategories();
                foreach ($cat_name as $key => $value) { ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $category, $key ); ?> ><?php echo esc_html( $value ); ?></option>
                    <?php
                }
                ?>
                
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