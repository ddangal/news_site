<?php

// Register and load the widget
function news_unlimited_category_list_load_widget() {
    register_widget( 'news_unlimited_category_list_news_widget' );
}
add_action( 'widgets_init', 'news_unlimited_category_list_load_widget' );
 
// Creating the widget 
class news_unlimited_category_list_news_widget extends WP_Widget {
 
    function __construct() {
        parent::__construct(
         
        // Base ID of your widget
        'news_unlimited_category_list_news_widget', 
         
        // Widget name will appear in UI
        esc_html__( '( Sidebar ) News Widget Category List' , 'news-unlimited'), 
         
        // Widget description
        array( 'description' => esc_html__( 'News Layout Widget Category List', 'news-unlimited' ), ) 
        );
    }
 
    // Creating widget front-end
     
    public function widget( $arguments, $instance ) {
        echo wp_kses_post( $arguments['before_widget'] ); ?>
        <div class="cats">
            <div class="title br-orange transform">
                <h3><?php esc_html_e( 'Categories', 'news-unlimited' ); ?></h3>
            </div>
            <ul class="cats-list">
                <?php
                $select_category_num = !empty( $instance['number_of_category_display'] ) ? $instance['number_of_category_display'] : '';
                $cat_name = news_unlimited_getAllCategories($select_category_num);
                    foreach ($cat_name as $key => $value) {
                        ?>
                        <li><a href="<?php echo esc_url( get_term_link( $key ) ); ?>"><?php echo esc_html( $value ); ?></a></li>
                    <?php
                    }
                    ?>
            </ul>
            <!-- Category-List -->
        </div>
        <div class="clear"></div>
        <?php
        echo wp_kses_post( $arguments['after_widget'] );
    }    
    // Widget Backend 
    public function form( $instance ) {

        $num_cat_selected = !empty( $instance[ 'number_of_category_display' ] ) ?  $instance[ 'number_of_category_display' ] : ''; 
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Select number of category to display:' , 'news-unlimited' ); ?></label> 
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number_of_category_display' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_of_category_display' ) ); ?>">
                <option value=""><?php esc_html_e( 'Select one from below' , 'news-unlimited' ); ?></option>
                <?php
                news_unlimited_drop_down_limit(10,$num_cat_selected);
                ?>               
            </select>
        </p>
        <?php
    }
     
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['number_of_category_display'] = ( ! empty( $new_instance['number_of_category_display'] ) ) ? sanitize_text_field( $new_instance['number_of_category_display'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here