<?php
/**
 * components functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package simpleasy
 */

if ( ! function_exists( 'simpleasy_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the aftercomponentsetup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */



function simpleasy_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on components, use a find and replace
	 * to change 'simpleasy' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'simpleasy', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'simpleasy-featured-image', 800, 9999 );
	add_image_size( 'simpleasy-portfolio-featured-image', 800, 9999 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'simpleasy' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
                'gallery',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'simpleasy_custom_background_args', array(
		'default-color' => 'fff',
		'default-image' => '',
	) ) );
        
        
}
endif;
add_action( 'after_setup_theme', 'simpleasy_setup' );


function simpleasy_logo() {
    add_theme_support('custom-logo', array(
        'size' => 'simpleasy-logo',
        'flex-height'            => true,
        'flex-width'            => true,
        ));
}

add_action('after_setup_theme', 'simpleasy_logo');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function simpleasy_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'simpleasy_content_width', 640 );
}
add_action( 'after_setup_theme', 'simpleasy_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function simpleasy_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'simpleasy' ),
                'description'   => esc_html__( 'Widgets in this sidebar will appear throughout the site. It is the default sidebar if no others are in use.', 'simpleasy' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s ">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
         

    register_sidebar( array(
        'name'          => esc_html__( 'Top Widget 1', 'simpleasy' ),
        'description'   => esc_html__( 'This widget will appear under the header', 'simpleasy' ),
        'id'            => 'topwidget-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s ">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Top Widget 2', 'simpleasy' ),
        'description'   => esc_html__( 'This widget will appear under the header', 'simpleasy' ),
        'id'            => 'topwidget-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s ">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Top Widget 3', 'simpleasy' ),
        'description'   => esc_html__( 'This widget will appear under the header', 'simpleasy' ),
        'id'            => 'topwidget-3',
        'before_widget' => '<div id="%1$s" class="widget %2$s ">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Top Widget 4', 'simpleasy' ),
        'description'   => esc_html__( 'This widget will appear under the header', 'simpleasy' ),
        'id'            => 'topwidget-4',
        'before_widget' => '<div id="%1$s" class="widget %2$s ">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
            'name'          => esc_html__( 'Footer Widgets', 'simpleasy' ),
            'description'   => esc_html__( 'Widgets appearing above the footer of the site.', 'simpleasy' ),
            'id'            => 'sidebar-footer',
            'before_widget' => '<div id="%1$s" class="widget small-6 medium-4 large-3 columns %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'simpleasy_widgets_init' );

/**
 * Enqueue Foundation scripts and styles.
 * 
 * @link: http://wordpress.tv/2014/06/11/steve-zehngut-build-a-wordpress-theme-with-foundation-and-underscores/
 * @link: http://wordpress.tv/2014/03/31/steve-zehngut-theme-development-with-foundation-framework/
 * @link: http://www.justinfriebel.com/wordpress-underscores-with-the-foundation-framework-09-23-2014/
 * 
 */
function simpleasy_foundation_enqueue() {
    
        /* Add Foundation 6.2 CSS */
        wp_enqueue_style( 'foundation', get_stylesheet_directory_uri() . '/assets/foundation/css/foundation.min.css' );    // This is the Foundation CSS
        
        /* Add Foundation JS */
        wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/assets/foundation/js/foundation.min.js', array( 'jquery' ), true );
        //wp_enqueue_script( 'foundation-what-input', get_template_directory_uri() . '/assets/foundation/js/what-input.js', array( 'jquery' ), true );
        
        /* Foundation Init JS */
        wp_enqueue_script( 'simpleasy-foundation-init', get_template_directory_uri() . '/foundation.js', array( 'jquery' ), true );   // Small (author) customized JS script to start the Foundation library, sitting freely in the Theme folder
        
        wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/fonts/font-awesome.css' );  
        
}
add_action( 'wp_enqueue_scripts', 'simpleasy_foundation_enqueue' );




/**
 * -----------------------------------------------------------------------------
 * Fonts fresh from Google
 * -----------------------------------------------------------------------------
 */
function simpleasy_google_fonts() {
    $query_args = array(

        'family' => 'Roboto:300,400,500,700,900'
        );
    wp_register_style( 'simpleasygooglefonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
    wp_enqueue_style( 'simpleasygooglefonts');
}
/**
 * Enqueue scripts and styles.
 */
function simpleasy_scripts() {
	wp_enqueue_style( 'simpleasy-style', get_stylesheet_uri() );
        
        /* Include Dashicons for the front-end too */
        wp_enqueue_style( 'dashicons' );

	/* Conditional stylesheet only for Front Page Template */
        if ( is_page_template( 'page-templates/frontpage-portfolio.php' ) ) {
            wp_enqueue_script( 'simpleasy-front-scripts', get_stylesheet_directory_uri() . '/assets/js/frontpage-functions.js', array( 'jquery' ), '20160515', true ); 

            /* Slick Carousel */
            wp_enqueue_script( 'slick_carousel', get_stylesheet_directory_uri() . '/assets/js/slick/slick.min.js', array( 'jquery' ), '20160515', true ); 
            wp_enqueue_style( 'slick_style', get_stylesheet_directory_uri() . '/assets/js/slick/slick.css' );
            wp_enqueue_style( 'slick_theme_style', get_stylesheet_directory_uri() . '/assets/js/slick/slick-theme.css' );
        }

        /* Custom navigation script */
	wp_enqueue_script( 'simpleasy-navigation', get_template_directory_uri() . '/assets/js/navigation-custom.js', array(), '20120206', true );
        
        /* Toggle Main Search script */
        wp_enqueue_script( 'simpleasy-toggle-search', get_template_directory_uri() . '/assets/js/toggle-search.js', array( 'jquery' ), '20150925', true );

        /* Masonry for Footer widgets */
        wp_enqueue_script( 'simpleasy-masonry', get_template_directory_uri() . '/assets/js/masonry-settings.js', array( 'masonry' ), '20150925', true );
        
        /* Add dynamic back to top button */
        wp_enqueue_script( 'simpleasy-topbutton', get_template_directory_uri(). '/assets/js/topbutton.js', array( 'jquery' ), '20150926', true );

	wp_enqueue_script( 'simpleasy-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'simpleasy_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customize The Archive Title output
 */ 
function simpleasy_modify_archive_title( $title ) {
    if( is_page_template( 'archive-jetpack-portfolio.php' ) || is_page_template( 'archive-jetpack-testimonial.php' ) ) {
        return esc_html__( 'All ', 'simpleasy' ) . $title;
    } else {
        return $title;
    }
}
add_filter( 'get_the_archive_title', 'simpleasy_modify_archive_title', 10, 1 );

/*
 * Add Excerpts to Pages
 */
function simpleasy_add_excerpt_to_pages() {
    add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'simpleasy_add_excerpt_to_pages' );

/**
 * Modify Underscores nav menus to work with Foundation
 */
function simpleasy_nav_menu( $menu ) {
    
    $menu = str_replace( 'menu-item-has-children', 'menu-item-has-children has-dropdown', $menu );
    $menu = str_replace( 'sub-menu', 'sub-menu dropdown', $menu );
    return $menu;
    
}
add_filter( 'wp_nav_menu', 'simpleasy_nav_menu' );

/**
 * Walker Menu for Front Page nav
 */
class simpleasy_front_page_walker extends Walker_Nav_Menu {
  
    // add classes to ul sub-menus
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // depth dependent classes
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
                'sub-menu',
                ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
                ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
                'menu-depth-' . $display_depth
            );
        $class_names = implode( ' ', $classes );

        // build html
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }

    // add main/sub classes to li's and links
     function start_el(  &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

        // depth dependent classes
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

        // passed classes
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $li_class_names = esc_attr( implode( ' ', apply_filters( '', array_filter( $classes ), $item ) ) );
        $fa_class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // build html
        /*
         * Card Front
         */
        $foundationTouch = 'ontouchstart="this.classList.toggle(\'hover\');"';
        $output .= $indent . '<li ' . $foundationTouch . ' id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . /* $class_names . */ '">';
        $output .= '<div class="large button card-front">';

        // link attributes
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after . '<i class="fa ' . $li_class_names . ' card-icon"></i>',
            $args->after
        );

        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        $output .= '</div>';

        /** 
         * Card Back
         */
        $output .= '<div class="panel card-back">';
        $output .= '<i class="fa ' . $fa_class_names . ' card-icon"></i>';
        $output .= '<div class="hub-info">';
        
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->attr_title, $item->ID ),
            $args->link_after,
            $args->after
        );
        
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        
        $output .= '<p>';
        $output .= isset( $item->description ) ? $item->description : '';
        $output .= '</p></div><!-- .hub-info -->';
        $output .= '<small class="clear">';
        $output .= isset( $item->xfn ) ? $item->xfn : ''; 
        $output .= '</small>';
        $output .= '</div><!-- .card-back -->';
    }
}



if ( ! function_exists( 'simpleasy_posts_pagination' ) ) :
function simpleasy_posts_pagination() {
        the_posts_pagination( array(               
            'mid_size'      => 3,
            'prev_text' => __( 'Previous', 'simpleasy' ),
            'next_text' => __( 'Next', 'simpleasy' ),
            'type'      => 'list',
        ));
}
endif;


/**
 * Simpleasy Related Theme Subpage
 */

add_action( 'admin_menu', 'simpleasy_helpandinformation_sp' );
function simpleasy_helpandinformation_sp() {
    add_theme_page( __('Simpleasy Support', 'simpleasy'), __('Simpleasy Support', 'simpleasy'), 'edit_theme_options', 'simpleasy-helpandinformation.php', 'simpleasy_helpandinformation_text');
}

function simpleasy_helpandinformation_text(){ ?>

<div class="information-cards">
<h1><?php echo __('Simpleasy Information and Links', 'simpleasy') ?></h1>
<div class="information-card">
    <div class="information-card-box information-card-left">
        <a href="http://themeastronaut.com/contact-us/" target="_blank">
         <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/support.png"> 
        </a>
        <h2><?php echo __('Help and Information', 'simpleasy') ?></h2>
        <p><?php echo __('Need Help setting up Simpleasy? We have an awesome customer support who stand ready to assist you with your questions related to the theme.', 'simpleasy') ?></p>
        <a class="information-button" href="http://themeastronaut.com/contact-us/" target="_blank"><?php echo __('Theme Support', 'simpleasy') ?></a>
    </div>
</div>
<div class="information-card">
    <div class="information-card-box information-card-top">
        <a href="http://themeastronaut.com/" target="_blank">
         <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/features.png"> 
        </a>
        <h2><?php echo __('Get more features', 'simpleasy') ?></h2>
        <p><?php echo __('If you are getting serious about using Simpleasy, consider upgrading to the premium version for $35 to unlock lots of great new features!', 'simpleasy') ?></p>
        <a class="information-button" href="http://themeastronaut.com/" target="_blank"><?php echo __('Read More', 'simpleasy') ?></a>
    </div>
</div>
<div class="information-card">
    <div class="information-card-box information-card-right">
        <a href="https://wordpress.org/support/theme/simpleasy/reviews/?filter=5" target="_blank">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/review.png"> 
        </a>
        <h2><?php echo __('Review Simpleasy', 'simpleasy') ?></h2>
        <p><?php echo __('Enjoy using Simpleasy? Leave thoughtful feedback for us, that makes everyone very happy, let us know what you think!', 'simpleasy') ?></p>
        <a class="information-button" href="https://wordpress.org/support/theme/simpleasy/reviews/?filter=5" target="_blank"><?php echo __('Review Simpleasy', 'simpleasy') ?></a>
    </div>
</div>
</div>
<?php }

/**
 * Simpleasy Related Theme Subpage CSS
 */

function simpleasy_helpandinformation( $hook ) {
    if ( 'appearance_page_simpleasy-helpandinformation' !== $hook ) {
        return;
    }
    wp_enqueue_style( 'simpleasy-helpandinformation-css', get_template_directory_uri() . '/assets/styles/helpandinformation.css');
}
add_action( 'admin_enqueue_scripts', 'simpleasy_helpandinformation' );
