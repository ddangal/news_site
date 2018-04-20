<?php
/**
 * Blog Widgets Section
 */
class First_News_Sidebar_List extends WP_Widget {

	/* Register The Slider widget Section */
	function __construct() {
		parent::__construct(
			'first_news_sidebar_list', // Base ID
			esc_html__( 'FN: Sidebar List Widget', 'first-news' ), //Widget Name
			array( 'description' => esc_html__( 'Display the Sidebar List.', 'first-news' ), ) // Args
		);
	}

	/**
     * Widget Form Section
     */
	public function form( $instance ) {
		$defaults = array(
			'first_news_title'			=> esc_html__( 'Sidebar List', 'first-news' ),
			'first_news_post_cat'		=> 'all',
			'first_news_number_of_post'	=> 5,
			'first_news_sidebar_layout'	=> 'Gird View'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$first_news_sidebar_layout = $instance['first_news_sidebar_layout'];   

	?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'first_news_title' ) ); ?>"><?php esc_html_e( 'Title:', 'first-news' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'first_news_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'first_news_title' ) ); ?>" value="<?php echo esc_attr($instance['first_news_title']); ?>"/>
		</p>

		<p>
			<label><?php esc_html_e( 'Select a post category:', 'first-news' ); ?></label>
			<?php wp_dropdown_categories( array( 'name' => esc_attr($this->get_field_name('first_news_post_cat')), 'selected' => esc_attr($instance['first_news_post_cat']), 'show_option_all' => esc_html_e('All Category','first-news'), 'class' => 'widefat' ) ); ?>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'first_news_number_of_post' ) ); ?>"><?php esc_html_e( 'Number of posts:', 'first-news' ); ?></label>
			<input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'first_news_number_of_post' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'first_news_number_of_post' ) ); ?>" value="<?php echo absint( $instance['first_news_number_of_post'] ); ?>" size="3"/> 
		</p>

		<!-- First News Sidebar Layout -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('first_news_sidebar_layout') ); ?>"><?php esc_html_e('First News Sidebar Layout:','first-news'); ?> 
				<select class='widefat' id="<?php echo esc_attr( $this->get_field_id('first_news_sidebar_layout') ); ?>"
						name="<?php echo esc_attr( $this->get_field_name('first_news_sidebar_layout') ); ?>" type="text">
					<option value='sidebar-list-view'<?php echo ($first_news_sidebar_layout == 'sidebar-list-view') ? 'selected':''; ?>>
						<?php esc_html_e('List View','first-news'); ?>
					</option>
					<option value='sidebar-gird-view'<?php echo ($first_news_sidebar_layout=='sidebar-gird-view')? 'selected':''; ?>>
						<?php esc_html_e('Gird View','first-news'); ?>
					</option> 
					<option value='sidebar-random-view'<?php echo ($first_news_sidebar_layout=='sidebar-random-view')?'selected':''; ?>>
						<?php esc_html_e('First Full Then List','first-news'); ?>
					</option> 
				</select>                
			</label>
		</p>
		<!-- First News Slider Layout END -->
					
	<?php

	}

    //First News 
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'first_news_title' ] = sanitize_text_field( $new_instance[ 'first_news_title' ] );	
		$instance[ 'first_news_post_cat' ]	= absint( $new_instance[ 'first_news_post_cat' ] );
		$instance[ 'first_news_number_of_post' ] = intval( $new_instance[ 'first_news_number_of_post' ] );
		
		$instance['first_news_sidebar_layout'] = sanitize_text_field( $new_instance['first_news_sidebar_layout'] );
		return $instance;
	}


    /**
     * First News Widget Area 
     */
	public function widget( $args, $instance ) {
		extract($args);

		$first_news_title = ( ! empty( $instance['first_news_title'] ) ) ? wp_kses_post($instance['first_news_title']) : '';	
        $sidebar_list_title = apply_filters( 'widget_first_news_title', $first_news_title , $instance, $this->id_base );
		$home_blog_category_id = ( ! empty( $instance['first_news_post_cat'] ) ) ? absint( $instance['first_news_post_cat'] ) : '';
		$home_blog_product_count = ( ! empty( $instance['first_news_number_of_post'] ) ) ? absint( $instance['first_news_number_of_post'] ) : 6; 
		
		$sidebar_product_layout = ( ! empty( $instance['first_news_sidebar_layout'] ) ) ?  $instance['first_news_sidebar_layout'] : '';
		// Latest Posts 

		echo $before_widget;
	?>
	<div class="pst-block">
		<div class="pst-block-head">
			<h2 class="title-4"><strong><?php echo esc_html($sidebar_list_title);  ?></strong></h2>
		</div>
		<div class="pst-block-main">
			<?php 
				$args = array('post_type'=>'post','posts_per_page'=>$home_blog_product_count,'cat'=>$home_blog_category_id);
				$query = new WP_Query( $args ); 
				$sidebar_list_count = 1;

			if( $query->have_posts() ){

				while($query->have_posts()): $query->the_post(); 
			?> 
			<article class="post post-tp-6" >
				<figure>
					<a href="<?php the_permalink(); ?>">
						<?php 
							if($sidebar_product_layout == 'sidebar-list-view'){
								the_post_thumbnail('first-news-homepage-thumb');
							}elseif($sidebar_product_layout == 'sidebar-gird-view'){
								the_post_thumbnail('large');
							}else{
								if( $sidebar_list_count == 1){
									the_post_thumbnail();
								}else{
									the_post_thumbnail('first-news-homepage-thumb');
								}
							}
						?>
					</a>
				</figure>
				<h3 class="title-5"><a href="<?php the_permalink(); ?>"><?php  the_title(); ?></a></h3>
				<?php first_news_dateformat(); ?>
			</article>
		<?php 
			$sidebar_list_count++; 
			endwhile;
			wp_reset_query();//Query Post Reset 
		}  
		?>
		</div>
	</div>
	<?php
		echo $after_widget;
	}

}
// Register The Category Posts
function first_news_sidebar_list_config() {
    register_widget( 'First_News_Sidebar_List' );
}
add_action( 'widgets_init', 'first_news_sidebar_list_config' );