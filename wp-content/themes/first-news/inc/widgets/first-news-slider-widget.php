<?php
/**
 * Blog Widgets Section
 */
class First_News_Slider_Products extends WP_Widget {

	/* Register The Slider widget Section */
	function __construct() {
		parent::__construct(
			'first_news_slider_post_section', 
			esc_html__( 'FN: Post Slider Widgets', 'first-news' ),
			array( 'description' => esc_html__( 'Display the Slider Post.', 'first-news' ), ) // Args
		);
	}

	/**
     * Widget Form Section
     */
	public function form( $instance ) {
		$defaults = array(
			'title'			=> esc_html__( 'Latest News', 'first-news' ),
			'first_news_post_cat'		=> 'all',
			'first_news_number_of_post'	=> 5,
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

	?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'first-news' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>
		<p>
			<label><?php esc_html_e( 'Select a post category:', 'first-news' ); ?></label>
			<?php wp_dropdown_categories( array( 'name' => esc_attr($this->get_field_name('first_news_post_cat')), 'selected' => esc_attr($instance['first_news_post_cat']), 'show_option_all' => esc_html_e('All Category','first-news'), 'class' => 'widefat' ) ); ?>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'first_news_number_of_post' ) ); ?>"><?php esc_html_e( 'Number of posts:', 'first-news' ); ?></label>
			<input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'first_news_number_of_post' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'first_news_number_of_post' ) ); ?>" value="<?php echo absint( $instance['first_news_number_of_post'] ); ?>" size="3"/> 
		</p>
					
	<?php

	}

    //First News 
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );	
		$instance[ 'first_news_post_cat' ]	= absint( $new_instance[ 'first_news_post_cat' ] );
		$instance[ 'first_news_number_of_post' ] = intval( $new_instance[ 'first_news_number_of_post' ] );
		return $instance;
	}


    /**
     * First News Widget Area 
     */
	public function widget( $args, $instance ) {
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? wp_kses_post($instance['title']) : '';	
        $first_news_slider_title = apply_filters( 'widget_title', $title , $instance, $this->id_base );
		$first_news_slider_post_cat = ( ! empty( $instance['first_news_post_cat'] ) ) ? absint( $instance['first_news_post_cat'] ) : '';
		$first_news_number_of_post = ( ! empty( $instance['first_news_number_of_post'] ) ) ? absint( $instance['first_news_number_of_post'] ) : 6; 

		echo $before_widget;
	?>
        <div  class="pst-block-main">
            <div class="col-row">
                <div id="news-slider" class="owl-carousel owl-theme">
                    <?php 
                        $args = array('post_type'=>'post','posts_per_page'=>$first_news_number_of_post,'cat'=>$first_news_slider_post_cat);
                        $query = new WP_Query( $args ); 

                    if( $query->have_posts() ){
                        
                        while($query->have_posts()): $query->the_post(); 
                    ?>  
                        <div class="">
                            <article class="post post-tp-4 news-slider-widget-article" >
                                <?php if( has_post_thumbnail() ){ ?>
                                    <figure>
                                        <div class="item"><?php the_post_thumbnail(); ?></div>
                                    </figure>
                                <?php } ?>
                                <h3 class="title-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            </article>
                        </div>
                    <?php 
                        endwhile;
                        wp_reset_query();//Query Post Reset    
                    }
                    ?>
                </div>
            </div>
        </div>
	<?php
		echo $after_widget;
	}

}
// Register The Category Posts
function first_news_slider_section_config() {
    register_widget( 'First_News_Slider_Products' );
}
add_action( 'widgets_init', 'first_news_slider_section_config' );