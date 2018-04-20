<?php
/**
 * First News  Footer Widget
 */
if ( ! function_exists( 'first_news_footer_widget' ) ) {
	function first_news_footer_widget() {
        
     if( is_active_sidebar('footer-first-section') OR is_active_sidebar('footer-second-section') OR
      is_active_sidebar('footer-third-section') OR is_active_sidebar("footer-fourth-section")){ ?>
        <div class="mainfooter">
            <div class="<?php echo esc_attr( first_news_theme_layout() ); ?>">
                <div class="row">
                    <div class="mainfooter_inner clearfix">
                        <div class="col-sm-3 col-xs-12">
							    <?php dynamic_sidebar('footer-first-section'); ?>
                        </div>
                        <div class="col-sm-3 col-xs-12">
							    <?php dynamic_sidebar('footer-second-section'); ?>
                        </div>
                        <div class="col-sm-3 col-xs-12">
							    <?php dynamic_sidebar('footer-third-section'); ?>
                        </div>
                        <div class="col-sm-3 col-xs-12">
							    <?php dynamic_sidebar('footer-fourth-section'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php  }
    
	}
}
add_action( 'first_news_footer_widget', 'first_news_footer_widget',1);

/**
 * Button Footer Widget
 */
if ( ! function_exists( 'first_news_footer_copyright' ) ) {
	function first_news_footer_copyright() {
    ?>
        <div class="clearfix"></div>
	    <div class="sub_footer">
            <div class="<?php echo esc_attr( first_news_theme_layout() ); ?>">
                <div class="clearfix">
                    <?php
                        wp_nav_menu( array(
                            'theme_location' => 'footer-menu',
                            'menu_id'        => 'footer-menu',
                            'menu_class'	=> 'footer_menu',
                            'container'		=>'div',
                            'container_class' => 'footer_menu'
                        ) );
                    ?>
                    <div class="footer_copyright">
                        <p>
                            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'first-news' ) ); ?>"><?php
                                /* translators: %s: CMS name, i.e. WordPress. */
                                printf( esc_html__( 'Proudly powered by %s', 'first-news' ), 'WordPress' );
                            ?></a>
                            <span class="sep"> | </span> <a href="<?php echo esc_url('http://themerelic.com/','first-news') ?>">
                            <?php
                                /* translators: 1: Theme name, 2: Theme author. */
                                printf( esc_html__( 'Theme: %1$s by %2$s.', 'first-news' ), 'First News', 'THEMERELIC' );
                            ?></a>
                        </p><!-- .site-info -->
                    </div>
                </div>
            </div>
        </div>
    <?php 
	}
}
add_action( 'first_news_footer_widget', 'first_news_footer_copyright',2);