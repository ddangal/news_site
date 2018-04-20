<?php
// Register the news section
function first_news_section_register_widget() { 
  register_widget( 'first_news_section' );
}
add_action( 'widgets_init', 'first_news_section_register_widget' );

class first_news_section extends WP_Widget {
  // Set up the news section widget 
  public function __construct() {
     parent::__construct(
            'first_news_section', esc_html__('FN Home: Home Page News ', 'first-news'), array(
            'description' => esc_html__('A widget that shows news section', 'first-news')
        ));
    }

    // Create the News section widget output.
  public function widget( $args, $instance ) {
    if(empty($instance['style']))
      $instance['style'] = "grid";
    $style = $instance[ 'style' ].".php";
    echo $args['before_widget']; ?>
    <?php include($style); ?>
    <?php echo $args['after_widget'];
  }

  // Apply settings to the widget instance News Main Slider.
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
    $instance[ 'post_count' ] = intval( $new_instance[ 'post_count' ] );
    $instance[ 'category' ] = (array)( $new_instance[ 'category' ] );
    $instance[ 'category_tab' ] = strip_tags( $new_instance[ 'category_tab' ] );
    $instance[ 'style' ] = strip_tags( $new_instance[ 'style' ] );
    $instance[ 'sidebar' ] = strip_tags( $new_instance[ 'sidebar' ] );
    $instance[ 'sidebar_postcount' ] = intval( $new_instance[ 'sidebar_postcount' ] );
    $instance[ 'background-img-id' ] = intval( $new_instance[ 'background-img-id' ] );
    


    return $instance;
  }

  // Create the admin area widget settings form News Banner Promo Slider.
  public function form( $instance ) {
  $categories = get_categories();
  $cats = array();
  $i = 0;
  foreach($categories as $category){
      $cats[$category->term_id] = $category->name;
  }

  $title = isset($instance['title']) ? $instance['title'] : '';
  $post_count = ! empty( $instance['post_count'] ) ? $instance['post_count'] : '6';
  $category = isset($instance['category']) ? $instance['category'] : array();
  $category_tab = isset($instance['category_tab']) ? $instance['category_tab'] : '';
  $style = !empty($instance['style']) ? $instance['style'] : 'grid';
  $sidebar = isset($instance['sidebar']) ? $instance['sidebar'] : '';
  $sidebar_postcount = !empty($instance['sidebar_postcount']) ? $instance['sidebar_postcount'] : '2';
  $background_img_id =  isset($instance['background-img-id']) ? $instance['background-img-id'] : '';
  $background_img_src = wp_get_attachment_image_src( $background_img_id, 'first-news-homepage-thumb' ); 
  $background_img_src = $background_img_src[0]; ?>

  <table class="news_widget">
    <tr>
      <td>
      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"> <?php esc_html_e("Title:","first-news") ?></label>
      </p>
      </td>
      <td>
        <input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr( $title ); ?>" />
      </td>
    </tr>
    <tr>
      <td>
        <label for="<?php echo esc_attr($this->get_field_id( 'style' )); ?>"><?php esc_html_e("Style:","first-news") ?></label>
      </td>
      <td>
        <input type="radio" id="<?php echo esc_attr($this->get_field_id( 'style' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'style' )); ?>" value="grid" <?php if ($style=="grid"){ echo "checked"; }?>  class="news_style" /> <?php esc_html_e("Grid","first-news") ?>
        <br/>
        
        <input type="radio" id="<?php echo esc_attr($this->get_field_id( 'style' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'style' )); ?>" value="list" <?php if ($style=="list"){ echo "checked"; }?>  class="news_style" /> <?php esc_html_e("List","first-news") ?>
        <br/>
        
        <input type="radio" id="<?php echo esc_attr($this->get_field_id( 'style' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'style' )); ?>" value="two-column" <?php if ($style=="two-column"){ echo "checked"; }?>  class="news_style" /> <?php esc_html_e("Two Column","first-news") ?>
        <br/>

        <input type="radio" id="<?php echo esc_attr($this->get_field_id( 'style' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'style' )); ?>" value="single" <?php if ($style=="single"){ echo "checked"; }?>  class="news_style" /> <?php esc_html_e("Single Category","first-news") ?>
      </td>
    </tr>
    <tr>
      <td>
        <label for="<?php echo esc_attr($this->get_field_id( 'category' )); ?>"><?php esc_html_e("Category:","first-news") ?></label>
      </td>
      <?php $instance['category'] = array(); ?>
      <td>
      <p>
        <select multiple="multiple" id="<?php echo esc_attr($this->get_field_id( 'category' )); ?>" name="<?php echo esc_attr($this->get_field_name('category')) ?>[]" class="news_category" >

        <?php foreach ($cats as $id => $cat): ?>
        <option value="<?php echo esc_attr($id); ?>" <?php if(in_array($id, $category)){echo "selected";} ?> ><?php echo esc_attr($cat); ?></option>
        <?php endforeach; ?>
        </select>
      </p>
      </td>
    </tr>

    <tr>
      <td colspan="2">
        <label for="<?php echo esc_attr($this->get_field_id( 'background-img-id' )); ?>"><p><?php esc_html_e("Title Background:","first-news") ?><p></label>
        <div id="bg-img-container" class="bg-img-container"  >
            <img src="<?php echo esc_url($background_img_src); ?>" alt="" >
        </div>
        <p>
        <input type="button" id="category_background" class ="category_background" value="Upload Image" />
        </p>
        <input type="hidden" id="<?php echo esc_attr($this->get_field_id( 'background-img-id' )); ?>" class="background-img-id" name="<?php echo esc_attr($this->get_field_name( 'background-img-id' )); ?>" value="<?php echo esc_attr( $background_img_id ); ?>" />
      </td>
    </tr>

    <tr>
      <td colspan="2">
        <input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'category_tab' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'category_tab' )); ?>" value="1" <?php if ($category_tab==1){ echo "checked"; }?>  class="category_tab" /> <?php esc_html_e("&nbsp; Show Category tab","first-news") ?>
      </td>
    </tr>
    <tr>
      <td>
      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'post_count' )); ?>"><?php esc_html_e("Post Count:","first-news") ?></label>
      </p>
      </td>
      <td>
        <input type="number" min="1" id="<?php echo esc_attr($this->get_field_id( 'post_count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'post_count' )); ?>" value="<?php echo esc_attr( $post_count ); ?>" />
      </td>
    </tr>
    <tr>
      <td colspan="2">
      <p>
        <input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'sidebar' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'sidebar' )); ?>" value="1" <?php if ($sidebar==1){ echo "checked"; }?>  class="news_sidebar" /> <?php esc_html_e("&nbsp; Show Recent News","first-news") ?>
      </p>
      </td>
    </tr>
    <tr>
      <td>
      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'sidebar_postcount' )); ?>"><?php esc_html_e("Sidebar Post Count:","first-news") ?></label>
      </p>
      </td>
      <td>
        <input type="number" min="1" id="<?php echo esc_attr($this->get_field_id( 'sidebar_postcount' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'sidebar_postcount' )); ?>" value="<?php echo esc_attr( $sidebar_postcount ); ?>" class="sidebar_postcount"/>
      </td>
    </tr>

  </table>

  <?php 
  }
}