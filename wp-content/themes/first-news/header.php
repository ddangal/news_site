<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package first-news
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- HEADER section open -->
    <?php 
        $home_page_layout = get_theme_mod('first_news_homepage_layout');
        
        $home_page_layout_class = 'container-fluid';
        if($home_page_layout == 'full-width'){
            $home_page_layout_class = 'container-fluid';
        }else{
            $home_page_layout_class = 'container';
        }
    ?>
    <header id="masthead" class="site-header" style="background-image: url(<?php echo esc_url(get_header_image()); ?>);">
        <section class="header">
            <div class="top_bar">
                <div class="<?php echo esc_attr( $home_page_layout_class ); ?>">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="nav_menu">
                                <?php
                                    if ( has_nav_menu( 'top-menu' ) ) {
                                        wp_nav_menu( array(
                                            'theme_location' => 'top-menu',
                                            'menu_id'        => 'top-menu',
                                        ) );
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="tb-date">
                                <i class="fa fa-calendar"></i> <span><?php echo esc_attr(date(get_option('date_format'))); ?></span>
                            </div>
                        </div>
                        <?php do_action('first_news_social_links'); ?>
                    </div>
                </div>
            </div>
        </section>
        <div class="site-branding hidden-xs">
            <div class="main-header">
                <div class="mh-top">
                    <div class="<?php echo esc_attr($home_page_layout_class); ?>">
                        <div class="row flex">
                            <div class="mh-logo">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php the_custom_logo(); ?></a>

                                <?php if ( is_front_page() && is_home() ) : ?>
                                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                <?php else : ?>
                                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                                <?php
                                endif;

                                $description = get_bloginfo( 'description', 'display' );
                                if ( $description || is_customize_preview() ) : ?>
                                    <p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
                                <?php
                                endif; ?>
                            </div>
                            <?php if(is_active_sidebar( 'banner-add-section' )): ?>
                            <div class="mh-banner">
                                <?php dynamic_sidebar('banner-add-section'); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <section class="main_menu">
            <div class="<?php echo esc_attr($home_page_layout_class); ?>">
                <nav>
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="navbar-brand hidden-lg hidden-md hidden-sm"><?php the_custom_logo(); ?></div>
                    <?php else: ?>
                        <a class="navbar-brand hidden-lg hidden-md hidden-sm" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class= "nav_brand_img"><?php bloginfo( 'name' ); ?></span></a>
                    <?php endif; ?>
                    <?php
                        wp_nav_menu( array(
                            'theme_location' => 'primary-menu',
                            'container'     => 'div',
                            'container_id'  => 'cssmenu',
                            'container_class'=> 'clearfix'
                        ) );
                        
                    ?>
                </nav>
            </div>
        </section>
    </header>