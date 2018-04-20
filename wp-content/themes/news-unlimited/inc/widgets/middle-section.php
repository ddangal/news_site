<?php

// Register and load the widget
function news_unlimited_middle_section_load_widget() {
    register_widget( 'news_unlimited_middle_section_widget' );
}
add_action( 'widgets_init', 'news_unlimited_middle_section_load_widget' );
 
// Creating the widget 
class news_unlimited_middle_section_widget extends WP_Widget {
 
    function __construct() {
        parent::__construct(
         
        // Base ID of your widget
        'news_unlimited_middle_section_widget', 
         
        // Widget name will appear in UI
        esc_html__( 'News Widget Middle Section News' , 'news-unlimited'), 
         
        // Widget description
        array( 'description' => esc_html__( 'News Layout Widget Middle Section News', 'news-unlimited' ), ) 
        );
    }
 
    // Creating widget front-end
    public function widget( $arguments, $instance ) {

        echo wp_kses_post( $arguments['before_widget'] );

        $title = !empty( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) : '';
        $num_of_words = !empty( $instance[ 'num_of_words' ] ) ? $instance[ 'num_of_words' ] : 10; ?>

        <article class="col-xs-6 col-sm-6 poli">
            <div class="title transform">
                <h3><?php echo esc_html( $title ); ?></h3>
            </div>
            <?php
            $category_id = !empty( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'cat' => $category_id,
                'posts_per_page' => 4
            );

            $args = apply_filters( 'news_unlimited_middle_section_first' , $args );

            $left_news_list = new WP_Query( $args );
            $count1 = 0;
            if ( $left_news_list->have_posts() ):
                while( $left_news_list->have_posts() ) : $left_news_list->the_post();
                    global $post;
                    $comments_count = wp_count_comments($post->ID);
                    if($count1 == 0):
                        ?>
                        <div class="wrap middle-section-view-wrap">
                            <a href="<?php the_permalink()?>">
                            <?php
                            if( has_post_thumbnail() )
                                the_post_thumbnail( 'news-unlimited_lower_banner_pic' );
                            ?></a>
                            <div class="content">
                                <h4><a href="<?php the_permalink()?>"><?php echo esc_html(wp_trim_words( get_the_title(), 6, '&hellip;' )); ?></a></h4>
                                <span><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><i class="fa fa-user"></i><?php the_author_meta( 'user_login', $post->post_author ); ?></a>  |  <a href="<?php echo esc_url(home_url()); ?>/<?php echo date( 'Y/m' , strtotime( get_the_date() ) ); ?>"><i class="fa fa-calendar"></i><?php echo esc_html(get_the_date()); ?></a>  | <a href="<?php the_permalink(); ?>/#respond"><i class="fa fa-comments"></i><?php echo esc_html($comments_count->total_comments); ?></a></span>
                                <p class="para">
                                    <?php
                                    echo esc_html(wp_trim_words( get_the_content(), $num_of_words, '&hellip;' )); //post content
                                    ?></p>
                            </div>
                        </div>
                        <?php
                    else:
                        if($count1 == 1):
                            ?>
                            <div class="listout">
                            <?php 
                        endif; ?>
                        <div class="item-list <?php echo(has_post_thumbnail() ? "" : "no_thumbnail"); ?> ">
                            <?php if(has_post_thumbnail()){ ?>
                                <article class="col-sm-5 col-xs-5">
                                    <div class="wrap">
                                        <a href="<?php the_permalink()?>">
                                        <?php
                                            the_post_thumbnail( 'news-unlimited_right_list_small_items' );
                                            $no_image = false;
                                        ?></a>
                                    </div>    
                                </article>
                                <?php
                            } else {
                                $no_image = true;
                            }
                            ?>
                            <article class="<?php echo( $no_image ? "col-sm-12" : "col-sm-7" );?> col-xs-7">
                                <h5><a href="<?php the_permalink();?>"><?php echo esc_html(wp_trim_words( get_the_title(), 6, '&hellip;' )); ?></a></h5>
                                <span><a href="<?php echo esc_url(home_url()); ?>/<?php echo date( 'Y/m' , strtotime( get_the_date() ) ); ?>"><i class="fa fa-calendar"></i><?php echo esc_html(get_the_date()); ?></a>  | <a href="<?php the_permalink(); ?>/#respond"><i class="fa fa-comments"></i><?php echo esc_html($comments_count->total_comments); ?></a></span>
                            </article>
                            
                        </div>
                        <?php 
                        if($left_news_list->found_posts == ($count1 + 1) ): ?>
                            </div>
                            <?php
                        endif;
                    endif;
                    $count1++;
                endwhile;
            wp_reset_postdata();
            endif;
            ?>
        </article>
        <article class="col-xs-6 col-sm-6 enter">
            <div class="title transform">
                <h3>
                    <?php 
                    $title_1 = !empty( $instance['title-1'] ) ? $instance['title-1'] : '';
                    echo esc_html( $title_1 ); ?>        
                </h3>
            </div>
            <?php
            $category_id1 = !empty( $instance['category-1'] ) ? $instance['category-1'] : '';
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'cat' => $category_id1,
                'posts_per_page' => 4
            );

            $args = apply_filters( 'news_unlimited_middle_section_second' , $args );

            $left_news_list = new WP_Query( $args );
            $count = 0;
            if ( $left_news_list->have_posts() ):
                while( $left_news_list->have_posts() ) : $left_news_list->the_post();
                    global $post;
                    $comments_count = wp_count_comments($post->ID);
                    if( $count == 0 ){
                        ?>
                        <div class="wrap middle-section-view-wrap">
                            <a href="<?php the_permalink(); ?>">
                            <?php
                            if(has_post_thumbnail())
                                the_post_thumbnail( 'news-unlimited_lower_banner_pic' );
                            ?></a>
                            <div class="content">
                                <h4><a href="<?php the_permalink(); ?>"><?php echo esc_html(wp_trim_words( get_the_title(), 6, '&hellip;' ));?></a></h4>
                                <span><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><i class="fa fa-user"></i><?php the_author_meta( 'user_login', $post->post_author ); ?></a>  |  <a href="<?php echo esc_url(home_url()); ?>/<?php echo date( 'Y/m' , strtotime( get_the_date() ) ); ?>"><i class="fa fa-calendar"></i><?php echo esc_html( get_the_date() ); ?></a>  | <a href="<?php the_permalink(); ?>/#respond"><i class="fa fa-comments"></i><?php echo esc_html($comments_count->total_comments); ?></a></span>
                                <p class="para">
                                <?php
                                $num_of_words = !empty( $instance[ 'num_of_words' ] ) ? $instance[ 'num_of_words' ] : '';
                                echo esc_html(wp_trim_words( get_the_content(), $num_of_words, '&hellip;' )); //post content
                                ?></p>
                            </div>
                        </div>
                        <?php
                    }else{
                        if( $count == 1 ){
                        ?>
                        <div class="listout">
                            <?php } ?>
                            <div class="item-list <?php echo(has_post_thumbnail() ? "" : "no_thumbnail"); ?>">
                                <?php if(has_post_thumbnail()){ ?>
                                <article class="col-sm-5 col-xs-5">
                                    <div class="wrap">
                                    <a href="<?php the_permalink(); ?>">
                                    <?php
                                        the_post_thumbnail( 'news-unlimited_right_list_small_items' );
                                        $no_image1 = false;
                                    ?></a>
                                    </div>    
                                </article>
                                <?php
                                }else {
                                    $no_image1 = true;
                                }
                                ?>
                                <article class="<?php echo( $no_image1 ? "col-sm-12" : "col-sm-7"); ?> col-xs-7">
                                    <h5>
                                        <a href="<?php the_permalink(); ?>"><?php echo esc_html(wp_trim_words( get_the_title(), 6, '&hellip;' )); ?></a>
                                    </h5>
                                    <span>
                                        <a href="<?php echo esc_url(home_url()); ?>/<?php echo date( 'Y/m' , strtotime( get_the_date() ) ); ?>"><i class="fa fa-calendar"></i><?php echo esc_html( get_the_date() ); ?></a>  | <a href="<?php the_permalink(); ?>/#respond"><i class="fa fa-comments"></i><?php echo esc_html($comments_count->total_comments); ?></a>
                                    </span>
                                </article>
                            </div>
                            <?php if( $left_news_list->found_posts == ($count + 1 )){ ?>
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
        <div class="clear"></div>
        
        <?php
        echo wp_kses_post( $arguments['after_widget'] );

    }  

    // Widget Backend 
    public function form( $instance ) {

        $title = !empty( $instance[ 'title' ] ) ?  $instance[ 'title' ] : ''; 
        $category = !empty( $instance[ 'category' ] ) ?  $instance[ 'category' ] : ''; 
        $title1 = !empty( $instance[ 'title-1' ] ) ?  $instance[ 'title-1' ] : ''; 
        $category1 = !empty( $instance[ 'category-1' ] ) ?  $instance[ 'category-1' ] : '';
        $select_num_of_words = !empty( $instance[ 'num_of_words' ] ) ? $instance[ 'num_of_words' ] : '';
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Left Title:' , 'news-unlimited' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' , 'news-unlimited' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Category:' , 'news-unlimited' ); ?></label> 
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'category' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>">
                <option value=""><?php esc_html_e( 'Select one from below' , 'news-unlimited' ); ?></option>
                <?php
                $cat_name = news_unlimited_getAllCategories();
                foreach ($cat_name as $key => $value) { ?>
                    <option value="<?php echo esc_attr( $key ); ?>"<?php selected($category, $key);?> ><?php echo esc_html( $value ); ?></option>
                    <?php
                }
                ?>
                
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title-1' ) ); ?>"><?php esc_html_e( 'Right Title:' , 'news-unlimited' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title-1' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'title-1' , 'news-unlimited' )); ?>" type="text" value="<?php echo esc_attr( $title1 ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'category-1' ) ); ?>"><?php esc_html_e( 'Category:' , 'news-unlimited' ); ?></label> 
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'category-1' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category-1' ) ); ?>">
                <option value=""><?php esc_html_e( 'Select one from below' , 'news-unlimited' ); ?></option>
                <?php
                $cat_name = news_unlimited_getAllCategories();
                foreach ($cat_name as $key => $value) { ?>
                    <option value="<?php echo esc_attr( $key ); ?>"<?php selected($category1, $key);?> ><?php echo esc_html( $value ); ?></option>
                    <?php
                }
                ?>
                
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'num_of_words' ) ); ?>"><?php esc_html_e( 'Select Number Of Words In Paragragh:' , 'news-unlimited' ); ?></label> 
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'num_of_words' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'num_of_words' ) ); ?>">
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
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['category'] = ( ! empty( $new_instance['category'] ) ) ? sanitize_text_field( $new_instance['category'] ) : '';
        $instance['title-1'] = ( ! empty( $new_instance['title-1'] ) ) ? sanitize_text_field( $new_instance['title-1'] ) : '';
        $instance['category-1'] = ( ! empty( $new_instance['category-1'] ) ) ? sanitize_text_field( $new_instance['category-1'] ) : '';
        $instance[ 'num_of_words' ] = ( ! empty( $new_instance['num_of_words'] ) ) ? sanitize_text_field( $new_instance['num_of_words'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here