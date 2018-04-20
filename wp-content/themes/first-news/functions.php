<?php
/**
 * first-news functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package first-news
 */

if ( ! function_exists( 'first_news_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	*/
	function first_news_setup() {
		/*
		 * Make theme available for translation.
		*/
		load_theme_textdomain( 'first-news', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary-menu'=>esc_html__('Primary Menu', 'first-news'),
			'top-menu' => esc_html__( 'Top Menu', 'first-news' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'first-news' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( '', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'first_news_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_image_size( 'first-news-homepage-thumb', 115, 85, true );
		add_image_size( 'first-news-thumb', 520, 352, true );
		add_image_size( 'first-news-home-category', 1350, 450, true );
		add_image_size('first-news-slider',300,300,true);
		add_image_size('first-news-home-slider',900,450,true);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'first_news_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
* @global int $content_width
 */
function first_news_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'first_news_content_width', 640 );
}
add_action( 'after_setup_theme', 'first_news_content_width', 0 );


/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function first_news_custom_excerpt_length( $length ) {
	if(is_admin()){
		return $length;
	}
    return 20;
}
add_filter( 'excerpt_length', 'first_news_custom_excerpt_length', 999 );



/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function first_news_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'first-news' ),
		'id'            => 'sidebar-right',
		'description'   => esc_html__( 'Add widgets here.', 'first-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'first-news' ),
		'id'            => 'sidebar-left',
		'description'   => esc_html__( 'Add widgets here.', 'first-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'First News : Home Page', 'first-news' ),
		'id'            => 'news-section',
		'description'   => esc_html__( 'Add widgets here.', 'first-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s news_class">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'First News : Footer First Section', 'first-news' ),
		'id'            => 'footer-first-section',
		'description'   => esc_html__( 'Add widgets here.', 'first-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'First News : Footer Second Section', 'first-news' ),
		'id'            => 'footer-second-section',
		'description'   => esc_html__( 'Add widgets here.', 'first-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'First News : Footer Third Section', 'first-news' ),
		'id'            => 'footer-third-section',
		'description'   => esc_html__( 'Add widgets here.', 'first-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'First News : Footer Fourth Section', 'first-news' ),
		'id'            => 'footer-fourth-section',
		'description'   => esc_html__( 'Add widgets here.', 'first-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'First News Header Ad : Banner Ad', 'first-news' ),
		'id'            => 'banner-add-section',
		'description'   => esc_html__( 'Add advertisement here.', 'first-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s news_class">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'first_news_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function first_news_scripts() {
	$first_news = wp_get_theme();
	$theme_version = $first_news->get( 'Version' );

	//google Fonts
	$first_news_google_fonts = array('Montserrat','Poppins','Roboto');
	foreach(  $first_news_google_fonts as $google_fonts ){
		wp_enqueue_style( 'google-fonts-'.$google_fonts, 'http://fonts.googleapis.com/css?family='.$google_fonts.':300italic,400italic,700italic,400,700,300', false ); 
	}
	
	//Style
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/library/bootstrap/css/bootstrap.min.css', array(), esc_attr( $theme_version ) );
	wp_enqueue_style( 'first-news-style', get_stylesheet_uri() );
	wp_enqueue_style( 'first-news-main-menu', get_template_directory_uri() . '/assets/css/main-menu-styles.css', array(), esc_attr( $theme_version ) );
	wp_enqueue_style( 'first-news-main-style', get_template_directory_uri() . '/assets/css/style.css', array(), esc_attr( $theme_version ) );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/font-awesome.min.css', array(), esc_attr( $theme_version ) );
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/library/owl.carousel/css/owl.carousel.min.css', array(), esc_attr( $theme_version ) );
	wp_enqueue_style( 'flex-slider', get_template_directory_uri() . '/assets/library/flex-slider/css/flex-slider.css', array(), esc_attr( $theme_version ) );

	//Scripts
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/library/bootstrap/js/bootstrap.min.js', array(), esc_attr( $theme_version ), true );
	wp_enqueue_script( 'first-news-matheight-js', get_template_directory_uri() . '/assets/library/match-height/js/jquery.matchHeight.min.js', array(), esc_attr( $theme_version ), true );
	wp_enqueue_script( 'first-news-main-menu-js', get_template_directory_uri() . '/assets/js/main-menu.js', array('jquery'), esc_attr( $theme_version ), true );
	wp_enqueue_script( 'first-news-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), esc_attr( $theme_version ), true );
	wp_enqueue_script( 'owl-slider-js', get_template_directory_uri() . '/assets/library/owl.carousel/js/owl.carousel.min.js', array(), esc_attr( $theme_version ), true );
	wp_enqueue_script( 'first-news-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), esc_attr( $theme_version ), true );
	wp_enqueue_script( 'first-news-main', get_template_directory_uri() . '/assets/js/first-news-main.js', array(), esc_attr( $theme_version ), true );
	wp_enqueue_script( 'jquery-flex-js', get_template_directory_uri() . '/assets/library/flex-slider/js/jquery-flexslider-min.js', array(), esc_attr( $theme_version ), true );

	// Register the script
	wp_register_script( 'first-news-tabdata-js', get_template_directory_uri() . '/assets/js/tabdata.js' );

	// Localize the script with new data
	$translation_array = array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	);
	wp_localize_script( 'first-news-tabdata-js', 'ajax_tab', $translation_array );

	// Enqueued script with localized data.
	wp_enqueue_script( 'first-news-tabdata-js', array(), esc_attr( $theme_version ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

		
}
add_action( 'wp_enqueue_scripts', 'first_news_scripts' );


function first_news_theme_add_editor_styles() {
    add_editor_style( 'assets/css/custom-editor-style.css' );
}
add_action( 'admin_init', 'first_news_theme_add_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Metabox additions.
 */
require get_template_directory() . '/inc/init.php';

/**
 * Widgets additions.
 */
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/widgets/widgets-category.php';

/**
 * ajax additions.
 */
require get_template_directory() . '/inc/widgets/tabdata.php';


function first_news_load_scripts($hook) {
	//Admin Widget Section
	$first_news = wp_get_theme();
	$theme_version = $first_news->get( 'Version' );

	if( $hook != 'widgets.php' ) 
		return;
 
	wp_enqueue_script( 'custom-js', get_template_directory_uri(). '/assets/js/news-widget.js', array('jquery'), esc_attr($theme_version) , true);
	wp_enqueue_script( 'media-js', get_template_directory_uri() . '/assets/js/media.js', array('jquery'), esc_attr($theme_version) , true);

	$custom_css = "
		#widget-list [id*='_first_news_'] .widget-top, #widget-list [id*='_first_news_'] h3 {
			background: #0074a2;
			color: #fff;
		}    
	";
	wp_add_inline_style( 'admin-bar', $custom_css );
}
add_action('admin_enqueue_scripts', 'first_news_load_scripts');

function first_news_excerpt_more( $more ) {
	
	return ' <a class=" read-more  " href="'. esc_url( get_permalink( get_the_ID() )) . '">' . esc_html('read more', 'first-news') . '</a>';
}
add_filter( 'excerpt_more', 'first_news_excerpt_more' );


/**********************************************************************
 * 						Tab Header
 **********************************************************************/
add_action( 'first_news_tab_header_hook', 'first_news_header_data', 10, 2 );
 
function first_news_header_data( $instance, $style ) {
	
	//Sidebar Condtion
	if( !empty($instance['sidebar']) ){
	    $first_news_col_class 	= "col-lg-8 col-md-8  col-sm-8 col-xs-12";
	    $sidebar 	= 1;
	}else{
	    $first_news_col_class 	= "col-lg-12 col-md-12  col-sm-12 col-xs-12";
	    $sidebar 	= 0;
	}
	?>
	<div class="row">
	    <div class="trend-pst <?php echo esc_attr($first_news_col_class); ?>">
	        <div class="pst-block">
	        	<?php if( !empty( $instance['title'] ) or ( !empty($instance['category_tab'] ) ) ): ?>
		            <div class="pst-block-head">
		                <h2 class="title-4"><strong><?php echo esc_attr($instance['title']); ?></strong> </h2>
		                <div class="filters">
		                	<?php if(!empty($instance['category_tab'])): ?>
								<ul class="filters-list-1">
								<?php
									if(!empty($instance['category']) and is_array($instance['category'])){
										$cat_list = implode (",", $instance['category']);
									}
									else{
										$cat_list = array();
									}
									$page_option = get_option( 'page_for_posts' )
								?>
								<?php if (!empty($page_option)): ?>
									<?php $cat_link = esc_url( get_page_link(get_option( 'page_for_posts' )) ) ?>
								<?php else: ?>
									<?php $cat_link = ""; ?>
								<?php endif; ?>
								<?php if(!empty($instance['category']) and is_array($instance['category'])): ?>
									<li><a href="javascript:void(0)" data_id="<?php echo esc_attr($cat_list); ?>" cat_link="<?php echo esc_attr($cat_link); ?>" count ="<?php echo esc_attr($instance['post_count']); ?>" style_name=<?php echo esc_attr($style); ?> sidebar=<?php echo esc_attr($sidebar); ?> class="active category" ><?php esc_html_e('all','first-news') ?></a></li>
									<?php foreach ($instance['category'] as $category): ?>
										<?php $cat_name = get_cat_name($category); ?>
										<li><a href="javascript:void(0)" data_id="<?php echo esc_attr($category); ?>" cat_link="<?php echo esc_url(get_category_link( $category )); ?> " sidebar=<?php echo esc_attr($sidebar); ?> count ="<?php echo esc_attr($instance['post_count']); ?>" style_name=<?php echo esc_attr($style); ?> class="category"><?php echo esc_attr($cat_name); ?></a></li>
									<?php endforeach; ?>
								<?php endif; ?>

		                    </ul>
		                	<?php endif; ?>
		                </div>
		            </div>
		        <?php endif; ?>
	            <div class="pst-block-main">
<?php } 

/**
 * New Footer Tab
 */
if ( ! function_exists( 'first_news_tab_footer_data' ) ) {
    function first_news_tab_footer_data( $instance) {  
     
     ?>
         </div>
		    <div class="pst-block-foot">
		    	<?php $page_option = get_option( 'page_for_posts' ) ?>
		    	<?php if (!empty($page_option)): ?>
			        <?php $cat_link = esc_url( get_page_link(get_option( 'page_for_posts' )) ) ?>
			    <?php else: ?>
					<?php $cat_link = ""; ?>
			    <?php endif; ?>
			    <a href="<?php echo esc_url($cat_link);?>"><?php esc_html_e( 'View More News', 'first-news' ); ?></a>
		    </div>
		    </div>
		    </div>
		    <?php if(!empty($instance['sidebar'])): ?>
		    	<?php include("inc/widgets/sidebar.php"); ?>
		    <?php endif; ?>
		  </div>
		</div>
          
    <?php 
}
}
add_action( 'first_news_tab_footer_data', 'first_news_tab_footer_data', 10, 1);
