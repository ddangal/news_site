<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package news-unlimited
 */

do_action( 'news_unlimited_top_footer');
?>
    <footer>  
        <div class="fdown">
            <div class="container">
                <div class="row">
                    <article class="col-sm-3">
                        <?php
                        if( is_active_sidebar( 'footer_1' ) ){
                            dynamic_sidebar( 'footer_1' );
                        } else {
                            // Show this message to admin only
                            if( current_user_can( 'edit_theme_options' ) ){
                                printf(
                                    __( '<a href="%s">Click here</a> to add widget.', 'news-unlimited' ),
                                    esc_url( admin_url( '/customize.php?autofocus[section]=sidebar-widgets-footer_1' ) )
                                );    
                            }                            
                        }
                        ?>
                    </article>
                    <article class="col-sm-3 cats">
                        <?php
                        if ( is_active_sidebar( 'footer_2' ) ) {
                            dynamic_sidebar( 'footer_2' );
                        } else {
                            // Show this message to admin only
                            if( current_user_can( 'edit_theme_options' ) ){
                                printf(
                                    __( '<a href="%s">Click here</a> to add widget.', 'news-unlimited' ),
                                    esc_url( admin_url( '/customize.php?autofocus[section]=sidebar-widgets-footer_2' ) )
                                );    
                            } 
                        }
                        ?>
                    </article>
                    <article class="col-sm-3 cats">
                        <?php
                        if ( is_active_sidebar( 'footer_3' ) ) {
                            dynamic_sidebar( 'footer_3' );
                        } else {
                            // Show this message to admin only
                            if( current_user_can( 'edit_theme_options' ) ){
                                printf(
                                    __( '<a href="%s">Click here</a> to add widget.', 'news-unlimited' ),
                                    esc_url( admin_url( '/customize.php?autofocus[section]=sidebar-widgets-footer_3' ) )
                                );    
                            } 
                        }
                        ?>
                    </article>
                    <article class="col-sm-3 cats">
                        <?php
                        if ( is_active_sidebar( 'footer_4' )) {
                            dynamic_sidebar( 'footer_4' );
                        } else {
                            // Show this message to admin only
                            if( current_user_can( 'edit_theme_options' ) ){
                                printf(
                                    __( '<a href="%s">Click here</a> to add widget.', 'news-unlimited' ),
                                    esc_url( admin_url( '/customize.php?autofocus[section]=sidebar-widgets-footer_4' ) )
                                );    
                            }
                        }
                        ?>
                    </article>
                    <article class="col-sm-12 copyright">
                        <?php news_unlimited_get_copyright_section(); ?>
                    </article>
                </div>
            </div>
        </div>
    </footer>

    <div id="back-to-top">
        <a href="javascript:void(0)">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
