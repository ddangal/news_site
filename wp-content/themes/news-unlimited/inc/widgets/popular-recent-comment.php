<?php

// Register and load the widget
function news_unlimited_popular_load_widget() {
    register_widget( 'news_unlimited_popular_news_widget' );
}
add_action( 'widgets_init', 'news_unlimited_popular_load_widget' );
 
// Creating the widget 
class news_unlimited_popular_news_widget extends WP_Widget {
 
    function __construct() {
        parent::__construct(
         
        // Base ID of your widget
        'news_unlimited_popular_news_widget', 
         
        // Widget name will appear in UI
        esc_html__( '( Sidebar ) News Widget Popular Recent Comment' , 'news-unlimited'), 
         
        // Widget description
        array( 'description' => esc_html__( 'News Layout Widget Popular Recent Comment', 'news-unlimited' ), ) 
        );
    }
 
    // Creating widget front-end
    public function widget( $arguments, $instance ) {
        echo wp_kses_post( $arguments['before_widget'] );
        ?>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php esc_html_e( 'Popular', 'news-unlimited' ); ?></a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><?php esc_html_e( 'Recent', 'news-unlimited' ); ?></a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><?php esc_html_e( 'Comments', 'news-unlimited' ); ?></a></li>
        </ul>
        <div class="tab-content listout cats">
            <div role="tabpanel" class="tab-pane active" id="home">
                <?php
                $selected_pop_post_num = !empty( $instance['number_of_popular_posts'] ) ? $instance['number_of_popular_posts'] : '';
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => $selected_pop_post_num,
                    'meta_key' => 'post_views',
                    'orderby' => 'meta_value_num'
                );

                $args = apply_filters( 'news_unlimited_sidebar_popular_news' , $args );

                $popular_posts = new WP_Query( $args );
                if( $popular_posts->have_posts() ):
                    while( $popular_posts->have_posts() ): $popular_posts->the_post();
                        global $post;
                        $comments_count = wp_count_comments($post->ID);
                        ?>
                        <div class="item-list <?php echo(has_post_thumbnail() ? "" : "no_thumbnail"); ?>">
                            <?php 
                            if( has_post_thumbnail() ){ ?>
                                <article class="col-xs-2 col-sm-4 col-md-4">
                                    <a href="<?php the_permalink(); ?>">
                                    <?php
                                        the_post_thumbnail( 'news-unlimited_popular_news_images' );
                                        $no_image = false;
                                    ?>
                                    </a>
                                </article>
                                <?php 
                            } else {
                                $no_image = true;
                            }
                            ?>
                            <article class="<?php echo ( $no_image ? "col-xs-12 col-sm-12 col-md-12" : "col-xs-10 col-sm-8 col-md-8" ); ?>">
                                <h5><a href="<?php the_permalink(); ?>"><?php echo esc_html(wp_trim_words( get_the_title(), 8, '&hellip;' )); ?></a></h5>
                                <span><a href="<?php echo esc_url(home_url()); ?>/<?php echo date( 'Y/m' , strtotime( get_the_date() ) ); ?>"><i class="fa fa-calendar"></i><?php echo esc_html( get_the_date() ); ?></a>  | <a href="<?php the_permalink(); ?>/#respond"><i class="fa fa-comments"></i><?php echo esc_html($comments_count->total_comments); ?></a></span>
                            </article>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <?php
                $selected_recent_post_num = !empty( $instance['number_of_recent_posts'] ) ? $instance['number_of_recent_posts'] : '';
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => $selected_recent_post_num,
                    'ignore_sticky_posts' => 1
                );

                $args = apply_filters( 'news_unlimited_sidebar_recent_news' , $args );
                
                $popular_posts = new WP_Query( $args );
                if( $popular_posts->have_posts() ):
                    while( $popular_posts->have_posts() ): $popular_posts->the_post();
                        $comments_count = wp_count_comments($post->ID);                   
                        ?>
                        <div class="item-list <?php echo(has_post_thumbnail() ? "" : "no_thumbnail"); ?>">
                            <?php 
                            if( has_post_thumbnail() ){?>
                                <article class="col-xs-2 col-sm-4 col-md-4">
                                    <a href="<?php the_permalink(); ?>">
                                    <?php             
                                        the_post_thumbnail( 'news-unlimited_popular_news_images' );
                                        $no_image1 = false;
                                    ?>
                                    </a>
                                </article>
                                <?php
                            } else {
                                $no_image1 = true;
                            }
                            ?>
                            <article class="<?php echo( $no_image1 ? "col-xs-12 col-sm-12 col-md-12" : "col-xs-10 col-sm-8 col-md-8"); ?>">
                                <h5>
                                    <a href="<?php the_permalink(); ?>"><?php echo esc_html(wp_trim_words( get_the_title(), 8, '&hellip;' ));?></a>
                                </h5>
                                <span>
                                    <a href="<?php echo esc_url(home_url()); ?>/<?php echo date( 'Y/m' , strtotime( get_the_date() ) ); ?>"><i class="fa fa-calendar"></i><?php echo esc_html( get_the_date() ); ?></a>  | <a href="<?php the_permalink(); ?>/#respond"><i class="fa fa-comments"></i><?php echo esc_html($comments_count->total_comments); ?></a>
                                </span>
                            </article>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
            
            <div role="tabpanel" class="tab-pane" id="messages">
                <?php
                $args = array(
                    'status' => 'approve',
                    'number' => '3',
                );
                $comments = get_comments($args);
                foreach($comments as $comment) :
                    ?>
                    <div class="item-list">
                        <article class="col-xs-12 col-sm-12 col-md-12">
                            <div class="wrap"><?php echo esc_html($comment->comment_author); ?></div>
                                <p><span class="comment_on">on</span><a href="<?php echo esc_url(get_comment_link($comment)); ?>"><?php echo esc_html(get_the_title( $comment->comment_post_ID)); ?></a></p>
                        </article>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
        </div>
        <div class="clear"></div>
        <?php
        echo wp_kses_post( $arguments['after_widget'] );
    }  
      
    // Widget Backend 
    public function form( $instance ) {

        $popular_selected = !empty( $instance['number_of_popular_posts'] ) ? $instance['number_of_popular_posts'] : '';
        $recent_selected = !empty( $instance['number_of_recent_posts'] ) ? $instance['number_of_recent_posts'] : '';
        $popular_posts = !empty( $instance[ 'number_of_popular_posts' ] ) ?  $instance[ 'number_of_popular_posts' ] : '';
        $recent_posts = !empty( $instance[ 'number_of_recent_posts' ] ) ? $instance[ 'number_of_recent_posts' ] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number_of_popular_posts' ) ); ?>"><?php esc_html_e( 'Select number of popular posts:' , 'news-unlimited' ); ?></label> 
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number_of_popular_posts' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_of_popular_posts' ) ); ?>">
                <option value=""><?php esc_html_e( 'Select one from below' , 'news-unlimited' ); ?></option>
                <?php
                news_unlimited_drop_down_limit(10,$popular_selected);
                ?>               
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number_of_recent_posts' ) ); ?>"><?php esc_html_e( 'Select number of recent posts:' , 'news-unlimited' ); ?></label> 
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number_of_recent_posts' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_of_recent_posts' ) ); ?>">
                <option value=""><?php esc_html_e( 'Select one from below' , 'news-unlimited' ); ?></option>
                <?php
                news_unlimited_drop_down_limit(10,$recent_selected);
                ?>               
            </select>
        </p>
        <?php        
    }
     
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['number_of_popular_posts'] = ( !empty( $new_instance['number_of_popular_posts'] ) ) ? sanitize_text_field( $new_instance['number_of_popular_posts'] ) : '';
        $instance['number_of_recent_posts'] = ( !empty($new_instance['number_of_recent_posts'] ) ) ? sanitize_text_field( $new_instance['number_of_recent_posts'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here