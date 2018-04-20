<?php

// Register and load the widget
function news_unlimited_popular_five_column_load_widget() {
    register_widget( 'news_unlimited_popular_five_column_widget' );
}
add_action( 'widgets_init', 'news_unlimited_popular_five_column_load_widget' );
 
// Creating the widget 
class news_unlimited_popular_five_column_widget extends WP_Widget {
 
    function __construct() {
        parent::__construct(
         
        // Base ID of your widget
        'news_unlimited_popular_five_column_widget', 
         
        // Widget name will appear in UI
        esc_html__( 'News Widget Popular Five Column' , 'news-unlimited'), 
         
        // Widget description
        array( 'description' => esc_html__( 'News Layout Widget Popular Five Column', 'news-unlimited' ), ) 
        );
    }
 
    // Creating widget front-end
     
    public function widget( $arguments, $instance ) {
        echo wp_kses_post( $arguments['before_widget'] ); ?>
        <div class="section-title center"><!-- section title start-->
            <div class="main-title br-orange">
                <h2>
                    <?php 
                    $title = !empty( $instance[ 'title' ] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) : '';
                    echo esc_html( $title ); ?></h2>
            </div>
            <p class="sub-title black">
                <?php 
                $title_1 = !empty( $instance[ 'title-1' ] ) ? $instance[ 'title-1' ] : '';
                echo esc_html( $title_1 ); ?>        
            </p>
        </div><!-- section title end-->
        <div class="row">
            <?php
            $colors = news_unlimited_cat_colors();
            $data = array();
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 5,
                'meta_key' => 'post_views',
                'orderby' => 'meta_value_num',
                'ignore_sticky_posts' => 1
            );

            $args = apply_filters( 'news_unlimited_popular_five_news_post' , $args );
            
            $popular_column = new WP_Query( $args );
            $count = 0;
            if( $popular_column->have_posts() ):
                while( $popular_column->have_posts() ): $popular_column->the_post(); 
                    global $post;
                    $comments_count = wp_count_comments($post->ID);
                    $popular_column_terms = wp_get_post_terms( $post->ID, 'category' );
                    $cat_name2 = $popular_column_terms[0]->name;
                    if( !array_key_exists($cat_name2, $data) ){
                        $data[$cat_name2] = $colors[0];
                        unset( $colors[0] );
                        $colors = array_values($colors);
                    }
                    if ( $count == 0 ) {
                        ?>
                        <article class="col-xs-12 col-sm-8">
                            <div class="wrap">
                                <a href="<?php the_permalink(); ?>">
                                    <?php
                                    if( has_post_thumbnail() )
                                        the_post_thumbnail( 'news-unlimited_popular_news_big_image' );
                                    ?>
                                    </a>
                                <div class="post-cat transform" style="background: <?php echo esc_attr( $data[$cat_name2] ); ?>"><a href="<?php echo esc_url(get_term_link( $popular_column_terms[0]->term_id )); ?>"><?php echo esc_html( $cat_name2 ); ?></a></div>
                            </div>
                            <div class="content black">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <span class="grey">
                                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><i class="fa fa-user"></i><?php the_author_meta( 'user_login' , $post->post_author ); ?></a>  |  <a href="<?php echo esc_url(home_url()); ?>/<?php echo date( 'Y/m' , strtotime( get_the_date() ) ); ?>"><i class="fa fa-calendar"></i><?php echo esc_html( get_the_date('M d, Y') ); ?></a>  | <a href="<?php the_permalink(); ?>/#respond"><i class="fa fa-comments"></i><?php echo esc_html($comments_count->total_comments); ?></a>
                                </span>
                                <p><?php
                                $num_of_words = !empty( $instance[ 'num_of_words' ] ) ? $instance[ 'num_of_words' ] : 10;
                                echo esc_html(wp_trim_words( get_the_content(), $num_of_words, '&hellip;' )); //post content
                                ?></p>
                            </div>
                        </article>
                        <article class="col-xs-12 col-sm-4">
                        <?php
                    } 
                    else {
                        
                        if( $count == 1 ){ ?>
                            <div class="row listout">
                                <?php } ?>
                                <div class="item-list <?php echo(has_post_thumbnail() ? "" : "no_thumbnail"); ?>">
                                    <?php 
                                    if( has_post_thumbnail() ){ ?>
                                        <article class="col-xs-3 col-sm-5 col-md-5">
                                            <div class="wrap">
                                                <a href="<?php the_permalink(); ?>">
                                                <?php
                                                    the_post_thumbnail( 'news-unlimited_popular_news_small_image'  );
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
                                    <article class="<?php echo($no_image ? "col-xs-12 col-sm-12 col-md-12" : "col-xs-9 col-sm-7 col-md-7"); ?>">
                                        <h4 style ="background: <?php echo esc_attr( $data[ $cat_name2 ] ); ?>"><a href="<?php echo esc_url(get_term_link( $popular_column_terms[0]->term_id )); ?>" >
                                                <?php echo esc_html( $cat_name2 ); ?></a>
                                        </h4>
                                        <h5>
                                            <a href="<?php the_permalink(); ?>"><?php echo esc_html(wp_trim_words( get_the_title(), 6, '&hellip;' )); ?></a>
                                        </h5>
                                        <span class="grey">
                                            <a href="<?php echo esc_url(home_url()); ?>/<?php echo date( 'Y/m' , strtotime( get_the_date() ) ); ?>"><i class="fa fa-calendar"></i><?php echo esc_html( get_the_date( 'M d, Y' ) ); ?></a>  | <a href="<?php the_permalink(); ?>/#respond"><i class="fa fa-comments"></i> <?php echo esc_html($comments_count->total_comments); ?></a>
                                        </span>
                                    </article>
                                </div>
                                <?php 
                                if( $popular_column->found_posts == ( $count + 1 ) ){ ?>
                            </div>
                            <?php
                        }
                    }
                    $count++;
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
            </article>
        </div>
        <div class="clear"></div>
        <?php
        echo wp_kses_post( $arguments['after_widget'] );
    }    

    // Widget Backend 
    public function form( $instance ) {

        $title = !empty( $instance[ 'title' ] ) ?  $instance[ 'title' ] : '';
        $title1 = !empty( $instance[ 'title-1' ] ) ?  $instance[ 'title-1' ] : '';
        $select_num_of_words = !empty( $instance[ 'num_of_words' ] ) ? $instance[ 'num_of_words' ] : '';
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:' , 'news-unlimited' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' , 'news-unlimited' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title-1' ) ); ?>"><?php esc_html_e( 'Sub Title:' , 'news-unlimited' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title-1' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'title-1' , 'news-unlimited' )); ?>" type="text" value="<?php echo esc_attr( $title1 ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'num_of_words' ) ); ?>"><?php esc_html_e( 'Select Number Of Words In Paragragh:' , 'news-unlimited' ); ?></label> 
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'num_of_words' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'num_of_words' ) ); ?>">
                <option value=""><?php esc_html_e( 'Select one from below' , 'news-unlimited' ); ?></option>
                <?php
                news_unlimited_drop_down_paragraph_limit( 10, $select_num_of_words);
                ?>              
            </select>
        </p>
        <?php 
    }
     
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['title-1'] = ( !empty( $new_instance['title-1'] ) ) ? sanitize_text_field( $new_instance['title-1'] ) : '';
        $instance[ 'num_of_words' ] = ( !empty( $new_instance['num_of_words'] ) ) ? sanitize_text_field( $new_instance['num_of_words'] ) : '';

        return $instance;
    }
} // Class wpb_widget ends here