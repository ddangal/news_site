<?php
/*Template Name: Homepage*/

get_header();
$slider_status = get_theme_mod( 'hide_slider_checkbox' );
?>

<?php
if ( is_active_sidebar( 'front_page_top_widget' ) ) {
    dynamic_sidebar( 'front_page_top_widget' );
}
?>
<section id="main-cat" class="main-cat"> <!-- main-cat start -->
        <div class="container">
            <!--  primary start -->
            <div class="row <?php echo ( $slider_status && is_front_page() ? '' : 'menu_post_space' ); ?>">
                <article id="primary" class="col-sm-8 col-md-8 col-xs-12 supertitle">
                    <div class="row">
                        <?php 
                        if( is_active_sidebar( 'front_page_widget_area_top' ) ){
                            dynamic_sidebar( 'front_page_widget_area_top' );
                        }
                        ?>
                    </div>
                </article>
                <article id="secondary" class="col-sm-4 col-md-4 col-xs-12 tab listout">
                    <?php
                    if ( is_active_sidebar( 'front_page_widget_area_top_sidebar' ) ) {
                        dynamic_sidebar( 'front_page_widget_area_top_sidebar' );
                    }
                    ?>
                </article>

            </div>
        </div>
 </section><!-- main-cat end -->

<section id="today-news" class="today-news t-news2"><!-- today-news start-->
    <div class="container">
        <?php
        if ( is_active_sidebar( 'front_page_widget_bottom' ) ) {
            dynamic_sidebar( 'front_page_widget_bottom' );
        }
        ?>   
        <!-- Popular-Four-Column -->
    </div>
</section><!-- today-news end-->

<?php
get_footer();
?>