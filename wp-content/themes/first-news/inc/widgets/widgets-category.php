<?php
// Register the category section
function first_news_category_register_widget() { 
  register_widget( 'first_news_category_section' );
}
add_action( 'widgets_init', 'first_news_category_register_widget' );

class first_news_category_section extends WP_Widget {
  // Set up the news section widget 
  public function __construct() {
    parent::__construct(
            'first_news_category_section', esc_html__('FN Home: Category Section ', 'first-news'), array(
            'description' => esc_html__('A widget that shows category section', 'first-news')
        ));
    }

  // Create the category section widget output.
  public function widget( $args, $instance ) {
      echo $args['before_widget'];
  ?>
        <div class="main-posts-1">
          <div class="mp-section row">
          <?php 
            foreach ($instance['category'] as $category): 
            $cat_name = get_cat_name($category);  
            $cat = get_category($category);
            $count = (int) $cat->count;
            $cat_link = get_category_link( $category );

            $thumbs = array(
              'cat' => $category,
              'posts_per_page' => 1,
              'meta_query' => array(array('key' => '_thumbnail_id')) 
            );
            $query = new WP_Query($thumbs);
          ?>
            <div class="col-sm-4">
                <article class="post post-tp-2">
                    <figure>
                        <a href="<?php echo esc_url($cat_link); ?>">
                          <?php
                            if( $query->have_posts() ){
                              while($query->have_posts() ): $query->the_post(); 
                                the_post_thumbnail('first-news-thumb'); 
                              endwhile;
                              wp_reset_query();
                            }
                          ?>
                        </a>
                    </figure>
                    <div class="ptp-1-overlay">
                        <div class="ptp-1-data">
                            <a href="<?php echo esc_url($cat_link); ?>" class="category-tp-1"><?php echo esc_attr($cat_name); ?></a>
                            <h2 class="title-29"><?php echo esc_html("Posts:","first-news").esc_attr($count); ?></h2>
                        </div>
                    </div>
                </article>
            </div>
          <?php endforeach; ?>
        </div>
      <?php echo $args['after_widget'];
  }

  // Apply settings to the widget instance News Main Slider.
  public function update( $new_instance, $old_instance ) {
    $instance[ 'category' ] =(array) $new_instance[ 'category' ];
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
  $category = isset($instance['category']) ? $instance['category'] : array();?>
  <table>
    <tr>
      <td>
        <label for="<?php echo esc_attr($this->get_field_id( 'category' )); ?>"><?php esc_html_e('Category:','first-news')?></label>
      </td>
      <?php $instance['category'] = array(); ?>
      <td>
      <p>
        <select multiple="multiple" id="<?php echo absint($this->get_field_id( 'category' )); ?>" name="<?php echo esc_attr($this->get_field_name('category')) ?>[]" >

        <?php foreach ($cats as $id => $cat): ?>
        <option value="<?php echo esc_attr($id); ?>" <?php if(in_array($id, $category)){echo esc_html('selected','first-news');} ?> ><?php echo esc_attr($cat); ?></option>
        <?php endforeach; ?>
        </select>
      </p>
      </td>
    </tr>
    
  </table>
  <?php 
  }
}