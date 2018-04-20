<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package news-unlimited
 */

$sidebar_alignment = get_theme_mod( 'left_or_right_sidebar' );
$slider_view = get_theme_mod( 'full_or_box_slider' );
$breadcrumb = get_theme_mod( 'breadcrumb_image' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body class="homepage-2 <?php if($sidebar_alignment == 'left'){ echo "left-sidebar"; }?>" <?php body_class(); ?> >

<header id="header" class=""><!-- header section start -->
    <?php get_template_part( 'template-parts/content', 'top-heading' ); ?>
    <div class="mid-level page3-head"><!-- mid-level start -->
        <div class="container">
            <?php news_unlimited_get_logo(); ?>
            <?php news_unlimited_get_adImage();?>
        </div>
    </div><!-- mid-level end -->
    <nav class="navbar navbar-default top_menu_wrapper">
        <div class="container">
            <div id="navbar" class="navbar-nav-wrapper navbar-arrow"> 
            <div class="nav-home"><a href="<?php echo esc_url( home_url() ); ?>"><i class="fa fa-home"></i></a></li></div>       
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-1',
                    'container' => 'ul',
                    'menu_class' => 'nav navbar-nav',
                    'menu_id' => 'responsive-menu'
                ) );

                $social_links = get_theme_mod( 'add_social_media_buttons' );
                if( !empty( $social_links ) && is_array( $social_links ) ){ ?>
                    <ul class="bar-social bg-black-c">
                        <?php                    
                        foreach ($social_links as $social) { ?>  
                            <li>
                                <a target="_blank" href="<?php echo esc_url($social['link_url']);?>">
                                    <i class="fa <?php echo esc_attr($social['link_text']);?>"></i>
                                </a>
                            </li>
                            <?php
                        } ?>
                    </ul>
                    <?php 
                } ?>
            </div>
        </div>
        <div id="slicknav-mobile"></div>
    </nav>

	<div id="banner" class="banner bg-page3"> <!-- banner section start -->
        <?php 
        if ( is_front_page() ) {

            get_template_part( 'template-parts/homepage', 'full_slider' );

        }
        else{
            if( is_404() ){
                // Do notheing
            } else { ?>
                <div class="br-banner" style=" <?php echo ( !empty( $breadcrumb ) ? 'background-image: url('. esc_url( $breadcrumb ) .')' : '' ); ?> ">
                    <div class="container">
                        <div class="page-title">
                            <h3>
                                <?php
                                news_unlimited_breadcumbs_title();
                                ?>
                            </h3>
                        </div>
                        <ul class="breadcrumb">
                          <?php news_unlimited_custom_breadcrumbs();?>
                        </ul>
                    </div>
                    <div class="overlay"></div>
                </div>
    	       <?php
            }
        }
        ?>
    </div>
</header>
<div id="content" class="site-content">