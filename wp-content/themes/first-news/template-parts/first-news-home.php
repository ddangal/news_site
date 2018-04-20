<?php 
/* Template Name: Home page */
get_header(); 
/**
 * Home Page Slider
 */
do_action('first_news_home_slider'); 
$home_sidebar_options = get_theme_mod('home-sidebar','full-width');
$home_page_layout = get_theme_mod('first_news_homepage_layout');

$home_page_layout_class = 'container-fluid';
if($home_page_layout == 'full-width'){
    $home_page_layout_class = 'container-fluid';
}else{
    $home_page_layout_class = 'container';
}
?>
<div class="<?php echo esc_attr($home_page_layout_class); ?>">
  <div class="content-margin">
        <div class="row">
          <?php if($home_sidebar_options == 'left-sidebar' ): ?>
            <div class="col-lg-3">
              <?php get_sidebar(); ?>
            </div>
          <?php endif; 
          
          if($home_sidebar_options == 'full-width'){
              $home_sidebar_layout = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
          }else{
            $home_sidebar_layout = "col-lg-9 col-md-9 col-sm-12 col-xs-12";
          }
          ?>
          <div class="<?php echo esc_attr($home_sidebar_layout); ?>">
            <?php dynamic_sidebar('news-section'); ?>
          </div>
          
          <?php if($home_sidebar_options == 'right-sidebar' ): ?>
            <div class="col-lg-3">
              <?php get_sidebar('right'); ?>
            </div>
          <?php endif;  ?>
      </div>
  </div>
</div>
<?php get_footer(); ?>
