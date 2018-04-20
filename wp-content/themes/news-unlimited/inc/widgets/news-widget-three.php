<?php

// Register and load the widget
function news_unlimited_load_widget() {
    register_widget( 'news_unlimited_widget' );
}
add_action( 'widgets_init', 'news_unlimited_load_widget' );
 
// Creating the widget 
class news_unlimited_widget extends WP_Widget {
 
	function __construct() {
		parent::__construct(
		 
		// Base ID of your widget
		'news_unlimited_widget', 
		 
		// Widget name will appear in UI
		esc_html__( 'News Widget Three' , 'news-unlimited'), 
		 
		// Widget description
		array( 'description' => esc_html__( 'News Layout Widget Three', 'news-unlimited' ), ) 
		);
	}
 
	// Creating widget front-end
	 
	public function widget( $args, $instance ) {

		echo wp_kses_post( $args['before_widget'] );

		$category_id = !empty( $instance['category'] ) ? $instance['category'] :'';
		$args1 = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'cat' => $category_id,
			'posts_per_page' => 3
		);

		$args1 = apply_filters( 'news_unlimited_widget_three' , $args1 );

		$top_area = new WP_Query( $args1 );
		$count = 0; ?>

        <article class="col-xs-12 col-sm-12 col-md-12 today-news bgn-third">
            <div class="title transform red">
                <h3>
                	<?php 
                	$title = !empty( $instance[ 'title' ] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) : '';
                	echo esc_html( $title ); ?></h3>
            </div>
            <?php
            if($top_area->have_posts()):
				while($top_area->have_posts()):$top_area->the_post();
					global $post;
					$banner_post = wp_get_post_terms( $post->ID, 'category' );
					$comments_count = wp_count_comments($post->ID);
					$args2 = array(
                        'status' => 'approve',
                        'number' => '5',
                    );
                    $comments = get_comments($args2);
           			if( $count == 0 ){
                		?>	
	                    <div class="wrap">
	                    	<a href="<?php the_permalink(); ?>">
	                        <?php
	                        if( has_post_thumbnail() )
	                        	the_post_thumbnail( 'news-unlimited_banner_pic' );
	                        ?>
	                        </a>
	                        <div class="post-cat purple transform"><a href="<?php echo esc_url(get_term_link( $banner_post[0]->term_id ));?>"><?php echo esc_html( $banner_post[0]->name );?></a></div>
	                    </div>
	                    <div class="content black">
	                        <h3><a href="<?php the_permalink(); ?>"><?php echo esc_html(wp_trim_words( get_the_title(), 15, '&hellip;' )); ?></a></h3>
	                        <span class="grey">
	                        	<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><i class="fa fa-user"></i><?php the_author_meta( 'user_login' , $post->post_author );?></a> | <a href="<?php echo esc_url(home_url()); ?>/<?php echo date( 'Y/m' , strtotime( get_the_date() ) ); ?>"><i class="fa fa-calendar"></i><?php echo esc_html( get_the_date() );?></a>  | <a href="<?php the_permalink(); ?>/#respond"><i class="fa fa-comments"></i><?php echo esc_html($comments_count->total_comments); ?></a></span>
	                        <p>
	                        <?php 
	                        $words = !empty( $instance[ 'num_of_words' ] ) ? $instance[ 'num_of_words' ] : 10;
	                        echo esc_html(wp_trim_words( get_the_content(), $words, '&hellip;' ));
	                        ?>
	                        </p>
	                    </div>
                		<?php
            		}else{                	
	                	if( $count == 1 ){ ?>
		                    <div class="row">
	                    	<?php
	                    } ?>
		                        <article class="col-xs-12 col-sm-6 poli grid-view-wrap">
		                            <div class="wrap">
		                            	<a href="<?php the_permalink(); ?>">
			                            	<?php
			                            	if( has_post_thumbnail() )
			                            		the_post_thumbnail( 'news-unlimited_lower_banner_pic' );
			                            	?>
		                            	</a>
		                                <div class="content">
		                                    <h4>
		                                    	<a href="<?php the_permalink(); ?>"><?php echo esc_html(wp_trim_words( get_the_title(), 8, '&hellip;' ));?></a>
		                                    </h4>
		                                    <span>
		                                    	<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><i class="fa fa-user"></i><?php the_author_meta( 'user_login', $post->post_author );?></a>  |  <a href="#"><i class="fa fa-calendar"></i><?php echo esc_html(get_the_date());?></a>  | <a href="<?php the_permalink(); ?>/#respond"><i class="fa fa-comments"></i><?php echo esc_html($comments_count->total_comments); ?></a>
		                                    </span>
		                                    <p class="para">
		                                	<?php
		                                		$num_of_words = !empty( $instance[ 'num_of_words' ] ) ? $instance[ 'num_of_words' ] : 10;
		                                		echo esc_html(wp_trim_words( get_the_content(), $num_of_words, '&hellip;' )); //post content
		                                	?>
		                                    </p>
		                                </div>
		                            </div>
		                        </article>
		                    	<?php 
		                 if( $top_area->found_posts == ( $count + 1 ) ){ ?>
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

		echo wp_kses_post( $args['after_widget'] );

	}    
	// Widget Backend 
	public function form( $instance ) {

		$title = !empty( $instance[ 'title' ] ) ?  $instance[ 'title' ] : ''; 
		$category = !empty( $instance[ 'category' ] ) ?  $instance[ 'category' ] : '';
		$select_num_of_words = !empty( $instance[ 'num_of_words' ] ) ? $instance[ 'num_of_words' ] : '';
		// Widget admin form
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:' , 'news-unlimited' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' , 'news-unlimited' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Category:' , 'news-unlimited' ); ?></label> 
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'category' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>">
				<option value=""><?php esc_html_e( 'Select one from below' , 'news-unlimited' ) ?></option>
				<?php
				$cat_name = news_unlimited_getAllCategories();
				foreach ($cat_name as $key => $value) { ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $category, $key ); ?> ><?php echo esc_html( $value ); ?></option>
					<?php
				}
				?>
				
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'num_of_words' ) ); ?>"><?php esc_html_e( 'Select Number Of Words In Paragragh:' , 'news-unlimited' ); ?></label> 
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'num_of_words' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'num_of_words' ) ); ?>">
				<option value=""><?php esc_html_e( 'Select one from below' , 'news-unlimited' ) ?></option>
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
		$instance[ 'num_of_words' ] = ( ! empty( $new_instance['num_of_words'] ) ) ? sanitize_text_field( $new_instance['num_of_words'] ) : '';
		return $instance;
	}
} // Class wpb_widget ends here