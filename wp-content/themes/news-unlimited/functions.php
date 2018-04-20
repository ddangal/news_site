<?php
/**
 * news-unlimited functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package news-unlimited
 */

if ( ! function_exists( 'news_unlimited_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function news_unlimited_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on news-unlimited, use a find and replace
		 * to change 'news-unlimited' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'news-unlimited', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'news-unlimited' ),
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

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 268,
			'width'       => 57,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		add_image_size( 'news-unlimited_slider_image', 450, 450, true );
		add_image_size( 'news-unlimited_banner_pic', 750, 365, true );
		add_image_size( 'news-unlimited_side_ad_image', 752, 91, true );
		add_image_size( 'news-unlimited_lower_banner_pic', 360, 301, true );
		add_image_size( 'news-unlimited_popular_news_images', 99, 98, true );
		add_image_size( 'news-unlimited_latest_news_image', 360, 234, true );
		add_image_size( 'news-unlimited_right_list_small_items', 135, 85, true );
		add_image_size( 'news-unlimited_popular_news_big_image', 653, 318, true );
		add_image_size( 'news-unlimited_popular_news_small_image', 182, 114, true );
		add_image_size( 'news-unlimited_single_page_main_image', 750, 398, true );
		add_image_size( 'news-unlimited_single_page_main_image2', 1140, 400, true );
		add_image_size( 'news-unlimited_sidebar_last_object_image', 360, 264, true );
		add_image_size( 'news-unlimited_sidebar_last_small_images', 128, 80, true );
	}
endif;
add_action( 'after_setup_theme', 'news_unlimited_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function news_unlimited_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'news_unlimited_content_width', 640 );
}
add_action( 'after_setup_theme', 'news_unlimited_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function news_unlimited_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'news-unlimited' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'news-unlimited' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Widget Area Top', 'news-unlimited' ),
		'id'            => 'front_page_widget_area_top',
		'description'   => esc_html__( 'Add widgets in the homepage area.', 'news-unlimited' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Widget Area Top Sidebar', 'news-unlimited' ),
		'id'            => 'front_page_widget_area_top_sidebar',
		'description'   => esc_html__( 'Add widgets in the homepage area.', 'news-unlimited' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Bottom Widget', 'news-unlimited' ),
		'id'            => 'front_page_widget_bottom',
		'description'   => esc_html__( 'Add widgets in the bottom area.', 'news-unlimited' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'news-unlimited' ),
		'id'            => 'footer_1',
		'description'   => esc_html__( 'Add widgets in the bottom area.', 'news-unlimited' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'news-unlimited' ),
		'id'            => 'footer_2',
		'description'   => esc_html__( 'Add widgets in the bottom area.', 'news-unlimited' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'news-unlimited' ),
		'id'            => 'footer_3',
		'description'   => esc_html__( 'Add widgets in the bottom area.', 'news-unlimited' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'news-unlimited' ),
		'id'            => 'footer_4',
		'description'   => esc_html__( 'Add widgets in the bottom area.', 'news-unlimited' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'news_unlimited_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function news_unlimited_scripts() {
	
	/**
	* CSS
	*/

	wp_enqueue_style('news-unlimited-style', get_stylesheet_uri() );
	wp_enqueue_style('bootstrap', get_template_directory_uri().'/bootstrap/css/bootstrap.min.css');
	wp_enqueue_style('news-unlimited-google-font', '//fonts.googleapis.com/css?family=Open+Sans');
	wp_enqueue_style('font-awesome', get_template_directory_uri().'/icons/font-awesome/css/font-awesome.min.css');
	wp_enqueue_style('news-unlimited-main', get_template_directory_uri().'/css/main.css');
	wp_enqueue_style('news-unlimited-component', get_template_directory_uri().'/css/component.css');
	wp_enqueue_style('news-unlimited-style-2', get_template_directory_uri().'/css/style.css');
	wp_enqueue_style('news-unlimited-responsive', get_template_directory_uri().'/css/responsive.css');

	/**
	* JS
	*/

	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/bootstrap/js/bootstrap.min.js', array('jquery'), false, true);
	wp_enqueue_script('easing', get_template_directory_uri().'/js/easing.js', array('jquery'), false , true);
	wp_enqueue_script('smartmenus', get_template_directory_uri().'/js/jquery.smartmenus.js', array('jquery'), false, true);
	wp_enqueue_script('match-height' , get_template_directory_uri(). '/js/match-height.js' , array('jquery'),false, true );
	wp_enqueue_script( 'slicknav' , get_template_directory_uri() . '/js/jquery.slicknav.min.js' , array('jquery'), false, true );

	$slider_style = get_theme_mod( 'slider_style', '3' );

	$icon_image = get_theme_mod( 'map_image' );
	$icon_image = $icon_image ? $icon_image : get_template_directory_uri() . '/images/navigation_image.png';
	$map_zoom = get_theme_mod( 'map_zoom' );
	$map_zoom = $map_zoom ? $map_zoom : 15;

	wp_register_script( 'news-unlimited-custom', get_template_directory_uri() . '/js/custom.js' ,array('jquery'), false , true );

	wp_localize_script( 
		'news-unlimited-custom',
		'news_unlimited_object',
		array( 
			'zoom_map' => $map_zoom,
			'map_icon' => $icon_image,
			'slider_style' => $slider_style
		 )
	 );
	
	wp_enqueue_script( 'news-unlimited-custom' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


}
add_action( 'wp_enqueue_scripts', 'news_unlimited_scripts' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/kirki/kirki.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets/news-widget-three.php';
require get_template_directory() . '/inc/widgets/popular-recent-comment.php';
require get_template_directory() . '/inc/widgets/latest-news-widget.php';
require get_template_directory() . '/inc/widgets/middle-section.php';
require get_template_directory() . '/inc/widgets/news-below-middle-section.php';
require get_template_directory() . '/inc/widgets/list-of-categories.php';
require get_template_directory() . '/inc/widgets/sidebar-last-object.php';
require get_template_directory() . '/inc/widgets/popular-five-column.php';
require get_template_directory() . '/wp-comment-walker.php';

require get_template_directory() . '/class-tgm-plugin-activation.php';

function news_unlimited_get_logo(){
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$logo = wp_get_attachment_image_src( $custom_logo_id, 'full' );
	if ( has_custom_logo() ) {
		?>
		<a class="logo" href="<?php echo esc_url(home_url());?>"><img src="<?php echo esc_url( $logo[0]);?>" alt="logo"></a>

		<?php
	} else {
		echo '<div class = "logo_name_description">';
		echo  '<a href="'. esc_url(home_url()) .'"><h3>' . esc_html(get_bloginfo( 'name' )) . '</h3>';
		echo '<p>' .esc_html(get_bloginfo( 'description' )). '</p></a>';
		echo '</div>';
	}

}

function news_unlimited_get_adImage(){
	$adImage_url = get_theme_mod( 'news-unlimited_side_ad_image' );
	$image_id = attachment_url_to_postid($adImage_url);
	$img_src = wp_get_attachment_image_src( $image_id, 'news-unlimited_side_ad_image' );
	$ad_link = get_theme_mod( 'link_of_ad' );
	?>
	<a class="ads" href="<?php echo esc_url($ad_link);?>">
		<img src="<?php echo esc_url( $img_src[0] );?>">
	</a>
	<?php
}

function news_unlimited_getAllCategories($select=''){
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'hide_empty' => false,
		'number' => $select,
	));

	$data = array();

	foreach ($terms as $term) {
		$id = $term->term_id;
		$data[$id] = $term->name;
	}
	return $data;
}

function news_unlimited_top_headline_label(){
	return esc_html( get_theme_mod('write_top_headline') );
}

add_action( 'get_header' , 'news_unlimited_add_views' );
function news_unlimited_add_views(){

	if( is_single() ){

		global $post;
		$post_id = $post->ID;

		$views = get_post_meta( $post_id, 'post_views' , true );

		if( empty( $views ) ){
			update_post_meta( $post_id, 'post_views', 1 );
		} else {
			update_post_meta( $post_id, 'post_views', ( $views + 1 ) );
		}

	}

}

function news_unlimited_drop_down_limit( $limit=10,$select=null ){

	for ( $i=1; $i < $limit; $i++) { 
		echo '<option ';
		selected( $select, $i);
		echo ' value="' . absint($i) . '">' . absint($i)  . '</option>';
	}

}

function news_unlimited_drop_down_paragraph_limit($limit=10,$select=null){

	$j = 0;
	for ( $i=0; $i < $limit; $i++) { 
		$j += 10;
		echo '<option ';
		selected( $select, $j );
		echo ' value="' . absint($j) . '">' . absint($j)  . '</option>';
	}

}

function news_unlimited_the_title_excerpt($before = '', $after = '', $echo = true, $length = false) 
{
    $title = get_the_title();

    if ( $length && is_numeric($length) ) {
        $title = substr( $title, 0, $length );
    }

    if ( strlen($title)> 0 ) {
        $title = apply_filters('the_title_excerpt', $before . $title . $after, $before, $after);
        if ( $echo )
            echo esc_html( $title );
        else
            return esc_html( $title );
    }
}

function news_unlimited_cat_colors(){
	
	$colors = array( 
		'#f44336', 
		'#e91e63', 
		'#9C27B0', 
		'#ff5722', 
		'#c18620' , '#13acc7' , '#e48a20' , '#8c5901', '#032998' , "AliceBlue","AntiqueWhite","Aqua","Aquamarine","Azure","Beige","Bisque","Black","BlanchedAlmond","Blue","BlueViolet","Brown","BurlyWood","CadetBlue","Chartreuse","Chocolate","Coral","CornflowerBlue","Cornsilk","Crimson","Cyan","DarkBlue","DarkCyan","DarkGoldenRod","DarkGray","DarkGrey","DarkGreen","DarkKhaki","DarkMagenta","DarkOliveGreen","Darkorange","DarkOrchid","DarkRed","DarkSalmon","DarkSeaGreen","DarkSlateBlue","DarkSlateGray","DarkSlateGrey","DarkTurquoise","DarkViolet","DeepPink","DeepSkyBlue","DimGray","DimGrey","DodgerBlue","FireBrick","FloralWhite","ForestGreen","Fuchsia","Gainsboro","GhostWhite","Gold","GoldenRod","Gray","Grey","Green","GreenYellow","HoneyDew","HotPink","IndianRed","Indigo","Ivory","Khaki","Lavender","LavenderBlush","LawnGreen","LemonChiffon","LightBlue","LightCoral","LightCyan","LightGoldenRodYellow","LightGray","LightGrey","LightGreen","LightPink","LightSalmon","LightSeaGreen","LightSkyBlue","LightSlateGray","LightSlateGrey","LightSteelBlue","LightYellow","Lime","LimeGreen","Linen","Magenta","Maroon","MediumAquaMarine","MediumBlue","MediumOrchid","MediumPurple","MediumSeaGreen","MediumSlateBlue","MediumSpringGreen","MediumTurquoise","MediumVioletRed","MidnightBlue","MintCream","MistyRose","Moccasin","NavajoWhite","Navy","OldLace","Olive","OliveDrab","Orange","OrangeRed","Orchid","PaleGoldenRod","PaleGreen","PaleTurquoise","PaleVioletRed","PapayaWhip","PeachPuff","Peru","Pink","Plum","PowderBlue","Purple","Red","RosyBrown","RoyalBlue","SaddleBrown","Salmon","SandyBrown","SeaGreen","SeaShell","Sienna","Silver","SkyBlue","SlateBlue","SlateGray","SlateGrey","Snow","SpringGreen","SteelBlue","Tan","Teal","Thistle","Tomato","Turquoise","Violet","Wheat","White","WhiteSmoke","Yellow","YellowGreen"  );

	return apply_filters( 'news_unlimited_category_colors', $colors );
}

/**
* Breadcrumbs
*/

function news_unlimited_custom_breadcrumbs() {
       
    // Settings
    $separator          = '/';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = esc_html__( 'Home' , 'news-unlimited' );;
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'category';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
           
        // Home page
        echo '<li class="item-home news-unlimited-home"><a class="bread-link bread-home" href="' . esc_url( home_url() ) . '">' . esc_html( $home_title ) . '</a></li>';
        
        if ( is_single() ) {
              
            // Get post category info
            $category = get_the_category();

            if(!empty($category)) {
              
                // Get last category post is in
			    $last_category=array_slice($category,-1);
			    $last_category=array_pop($last_category);
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'. wp_kses_post( $parents ) .'</li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );

                if( !empty( $taxonomy_terms ) && is_array( $taxonomy_terms ) ){

                  $cat_id         = $taxonomy_terms[0]->term_id;
                  $cat_nicename   = $taxonomy_terms[0]->slug;
                  $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                  $cat_name       = $taxonomy_terms[0]->name;

                }
                
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {

                $allowed_html = array(
                  'li' => array(
                    'class' => array()
                  ),
                  'a' => array(
                    'href' => array()
                  )
                );

                echo wp_kses( $cat_display , $allowed_html );
                echo '<li class="item-current"><span class="bread-current active">' . esc_html( get_the_title() ) . '</span></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat"><a class="bread-cat" href="' . esc_url( $cat_link ) . '">' . esc_html( $cat_name ) . '</a></li>';

				echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_title() ) . '</span></li>';
              
            } else {
                  
                echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_title() ) . '</span></li>';
                  
            }
              
        } elseif ( is_category() ) {
               
            // Category page
            echo '<li class="item-current item-cat"><span class="active bread-current bread-cat">' . single_cat_title('', false) . '</span></li>';
               
        } elseif ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                $parents = '';
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent"><a class="bread-parent" href="' . esc_url( get_permalink($ancestor) ) . '">' . esc_html( get_the_title($ancestor) ) . '</a></li>';
                }
                   
                // Display parent pages

                echo wp_kses( 
                  $parents, 
                  array(
                    'li' => array(
                      'class' => array()
                    ),
                    'a' => array(
                      'class' => array(),
                      'href' => array(),
                      'title' => array()
                    ),
                  )
                );
                   
                // Current page
                echo '<li class="item-current"><span class="active"> ' . esc_html( get_the_title() ) . '</span></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_title() ) . '</span></li>';
                   
            }
               
        } elseif ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current"><span class="active">' . esc_html( $get_term_name ) . '</span></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year"><a class="bread-year" href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '">' . esc_html( get_the_time('Y') ) . '</a></li>';
               
            // Month link
            echo '<li class="item-month"><a class="bread-month" href="' . esc_url( get_month_link( get_the_time('Y'), get_the_time('m') ) ) . '">' . esc_html( get_the_time('M') ) . '</a></li>';
               
            // Day display
            echo '<li class="item-current"><span class="active bread-current"> ' . esc_html( get_the_time('jS') ) . ' ' . esc_html( get_the_time('M') ) . '</span></li>';
               
        } elseif ( is_month() ) {
               
            // Month Archive
               
            // Year link

			echo '<li class="item-year"><a class="bread-year" href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '">' . esc_html( get_the_time('Y') ) . '</a></li>';
               
            // Month display
            echo '<li class="item-month"><span class="active bread-month">' . esc_html( get_the_time('M') ) . '</span></li>';
               
        } elseif ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_time('Y') ) . ' </span></li>';
               
        } elseif ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );

            /* translators: %s is replaced with "string". It will display the author name */
            echo '<li class="item-current"><span class="active bread-current">' . sprintf( esc_html__( 'Author: %s', 'news-unlimited' ) , esc_html( $userdata->display_name ) ) . '</span></li>';
           
        } elseif ( is_search() ) {
           
           $search_title = explode( ',' , get_search_query() );

            /* translators: %s is replaced with "string". It will display the search title */
            echo '<li class="item-current"><span class="active bread-current">' . sprintf( esc_html__( 'Search results for: %s' , 'news-unlimited' ) , esc_html( $search_title[0] ) ) . '</span></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li class="active">' . esc_html__( 'Error 404' , 'news-unlimited' ) . '</li>';
        } elseif( is_tax() ){

          $term = get_term_by("slug", get_query_var("term"), get_query_var("taxonomy") );

          $tmpTerm = $term;
          $tmpCrumbs = array();
          while ($tmpTerm->parent > 0){
              $tmpTerm = get_term($tmpTerm->parent, get_query_var("taxonomy"));
              $crumb = '<li><a href="' . esc_url( get_term_link($tmpTerm, get_query_var('taxonomy')) ) . '">' . esc_html( $tmpTerm->name ) . '</a></li>';
              array_push($tmpCrumbs, $crumb);
          }
          echo implode('', array_reverse($tmpCrumbs));
          echo '<li class="item-current item-cat"><span class="active bread-current bread-cat">' . esc_html( $term->name ) . '</span></li>';

        }
                  
    }
       
}

function news_unlimited_breadcumbs_title(){
	// Get the query & post information
    global $post,$author;
    // Do not display on the homepage
    if ( !is_front_page() ) {
        
        if ( is_single() ) {
        	//single page
           echo esc_html($post->post_title); 

        } elseif ( is_category() ) {
         // Category page
	       	$category = wp_get_post_terms( $post->ID, 'category' );
		    echo esc_html($category[0]->name);

    	} elseif ( is_author() ){
    		$userdata = get_userdata( $author );
    		echo esc_html($userdata->display_name);

    	}elseif ( is_day() ) {
            
            // Year link
            echo esc_html( get_the_time('Y') );
               
            // Month link
            echo esc_html( get_the_time('M') );
               
            // Day display
            echo esc_html( get_the_time('jS') ) . ' - ' . esc_html( get_the_time('M') );
               
        } elseif ( is_month() ) {
               
              
            // Year link

			echo esc_html( get_the_time('Y') ) .' - ' ;
               
            // Month display
            echo esc_html( get_the_time('M') );
               
        } elseif ( is_year() ) {
               
            // Display year archive
            echo esc_html( get_the_time('Y') );
               
        } elseif ( is_404() ) {
        	echo esc_html__( 'Error 404' , 'news-unlimited' );
        } elseif ( is_page() ) {
        	echo esc_html( get_the_title() );
        } elseif ( is_search() ){
        	$search_title = get_search_query();
        	echo esc_html( $search_title );
        } elseif( is_tag() ){
        	$term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_name  = $terms[0]->name;
            echo esc_html( $get_term_name );
        }
    }     
}

function news_unlimited_contact_us_location(){
	return esc_html( get_theme_mod('location') );
}

function news_unlimited_contact_us_phone_number(){
	return esc_html( get_theme_mod('phone_number') );
}

function news_unlimited_contact_us_email_address(){
	return esc_html( get_theme_mod('email_address') );
}

function news_unlimited_contact_us_office_hour(){
	return esc_html( get_theme_mod('office_hour') );
}

function news_unlimited_archive_listing_page(){
	$gird_or_list = get_theme_mod( 'grid_and_row_view', 'blue' );
	
	if ( $gird_or_list == 'green' ) {
		get_template_part( 'template-parts/content', 'grid-display' );
	} else {
		get_template_part( 'template-parts/content' , 'row-display' );
	}
}

function news_unlimited_excerpt_length( $length ) {
	$words_limit = get_theme_mod( 'words_limit' ); 
    $words_limit = empty( $words_limit ) ? 30 : $words_limit;
    return $words_limit;
}
add_filter( 'excerpt_length', 'news_unlimited_excerpt_length', 999 );

/**
* Recommended plugins 
*/

add_action( 'tgmpa_register', 'news_unlimited_register_required_plugins' );
function news_unlimited_register_required_plugins() {

  	$plugins = array(  
    	array(
      		'name' => esc_html__( 'Contact Form 7', 'news-unlimited' ),
      		'slug' => 'contact-form-7'
    	)
  	);

  	$config = array(
    	'id'           => 'news_unlimited_tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
    	'default_path' => '',                      // Default absolute path to bundled plugins.
    	'menu'         => 'tgmpa-install-plugins', // Menu slug.
    	'parent_slug'  => 'themes.php',            // Parent menu slug.
    	'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
    	'has_notices'  => true,                    // Show admin notices or not.
    	'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
    	'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
    	'is_automatic' => false,                   // Automatically activate plugins after installation or not.
    	'message'      => '',                      // Message to output right before the plugins table.
  	);

  	tgmpa( $plugins, $config );

}

if( !function_exists( 'news_unlimited_get_copyright_section' ) ){

	function news_unlimited_get_copyright_section(){
	
	    esc_html_e( 'Copyright &copy;', 'news-unlimited' ); 
	    echo date_i18n( __( 'Y' , 'news-unlimited' ) ); ?> 
	                   
	    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
	            <?php bloginfo( 'name' ); ?>
	    </a>

	    <?php 

	    esc_html_e( '. All rights reserved. ', 'news-unlimited' ); 

	    printf( 
	        esc_html__( 'Powered %1$s by %2$s', 'news-unlimited' ), 
	        '', 
	        '<a href="https://wordpress.org/" target="_blank">WordPress</a>' 
	    ); ?>

	    <span class="sep"> &amp; </span>

	    <?php esc_html_e( 'Designed by', 'news-unlimited' ); ?> 

	    <a href="<?php echo esc_url( 'http://cyclonethemes.com/'); ?>" target="_blank">
	        <?php esc_html_e( 'Cyclone Themes', 'news-unlimited' ); ?>
	    </a>

	    <?php

	}

}
