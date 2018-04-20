<?php
/**
 * first-news Theme Customizer
 *
 * @package first-news
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function first_news_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'first_news_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'first_news_customize_partial_blogdescription',
		) );
	}

	/**
	* General Settings Panel
	*/
	$wp_customize->add_panel('first_news_general_settings', array(
		'priority' => 1,
		'title' => esc_html__('FN: General Settings', 'first-news')
	));

	$wp_customize->get_section('title_tagline')->panel = 'first_news_general_settings';
	$wp_customize->get_section('title_tagline' )->priority = 1;

	$wp_customize->get_section('header_image')->panel = 'first_news_general_settings';
	$wp_customize->get_section('header_image' )->priority = 2;

	$wp_customize->get_section('colors')->panel = 'first_news_general_settings';
	
	$wp_customize->get_section('background_image')->panel = 'first_news_general_settings';
	$wp_customize->get_section('header_image' )->priority = 4;

}
add_action( 'customize_register', 'first_news_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function first_news_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function first_news_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function first_news_customize_preview_js() {
	wp_enqueue_script( 'first-news-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'first_news_customize_preview_js' );

function first_news_social_customize_register($wp_customize){
	/************************************************
	 * Social Links
	 *************************************************/
	$wp_customize->add_section('social', array(
		'title' => esc_html__('Social Links', 'first-news'),
		'priority'    => 5,
		'panel'		  => 'first_news_general_settings',
	));

	$wp_customize->add_setting('first_news_facebook_link', array(
		'type'    => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control('first_news_facebook_link', array(
		'label' => esc_html__('Facebook Link', 'first-news'),
		'section' => 'social',
		'type' => 'url',
		'priority'=>1
	));

	$wp_customize->add_setting('first_news_twitter_link', array(
		'type'    => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control('first_news_twitter_link', array(
		'label' => esc_html__('Twitter Link', 'first-news'),
		'section' => 'social',
		'type' => 'url',
		'priority'=>2
	));

	$wp_customize->add_setting('first_news_g_plus_link', array(
		'type'    => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control('first_news_g_plus_link', array(
		'label' => esc_html__('GooglePlus Link', 'first-news'),
		'section' => 'social',
		'type' => 'url',
		'priority'=>3
	));

	$wp_customize->add_setting('first_news_instagram_link', array(
		'type'    => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control('first_news_instagram_link', array(
		'label' => esc_html__('Instagram Link', 'first-news'),
		'section' => 'social',
		'type' => 'url',
		'priority'=>4
	));

	$wp_customize->add_setting('first_news_youtube_link', array(
		'type'    => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control('first_news_youtube_link', array(
		'label' => esc_html__('Youtube Link', 'first-news'),
		'section' => 'social',
		'type' => 'url',
		'priority'=>5
	));

	$wp_customize->add_setting('first_news_rss_link', array(
		'type'    => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control('first_news_rss_link', array(
		'label' => esc_html__('RSS Link', 'first-news'),
		'section' => 'social',
		'type' => 'url',
		'priority'=>6
	));

	/**************************************************
	 * Home Page Slider
	 ***************************************************/
	$wp_customize->add_section('first_news_headline_slider', array(
		'title' => esc_html__('FN: Homepage Slider', 'first-news'),
		'priority'    => 1,
	));

	/**
	 * Enable The Latest News Section
	 */
	$wp_customize->add_setting('first_news_latest_news_enable', array(
		'default' => false,
		'type'    => 'theme_mod',
		'sanitize_callback' => 'first_news_checkbox_sanitize'
	));

	$wp_customize->add_control('first_news_latest_news_enable', array(
		'label' => esc_html__('Show Slider', 'first-news'),
		'description' =>esc_html__('ON/OFF Breaking News','first-news') ,
		'section' => 'first_news_headline_slider',
		'type'=>'checkbox',
		'priority'=>1
	));

	/**
	 * Enable The Slider Options
	 */
	$wp_customize->add_setting('first_news_check_slider', array(
		'default' => false,
		'type'    => 'theme_mod',
		'sanitize_callback' => 'first_news_checkbox_sanitize'
	));

	$wp_customize->add_control('first_news_check_slider', array(
		'label' => esc_html__('Enable Slider', 'first-news'),
		'description' =>esc_html__('ON/OFF slider.','first-news') ,
		'section' => 'first_news_headline_slider',
		'type'=>'checkbox',
		'priority'=> 2
	));


	$wp_customize->add_setting( 'first_news_category_select', array(
		'default'           => 0,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( new First_News_Category_Control( $wp_customize, 'first_news_category_select', array(
		'type' => 'select',
		'label'         => esc_html__( 'Slider posts category', 'first-news' ),
		'description'   => esc_html__( 'Select The Slider Category Options.', 'first-news' ),
		'section' => 'first_news_headline_slider',
		'settings' => 'first_news_category_select',
		'priority'=>3,
	) ) );

	//no of post for slider
	$wp_customize->add_setting('first_news_slider_post_count', array(
		'default' => 3,
		'type'    => 'theme_mod',
		'sanitize_callback' => 'absint'
	));

	$wp_customize->add_control('first_news_slider_post_count', array(
		'label' => esc_html__('Number of Slide', 'first-news'),
		'description' =>esc_html__('No. of post for slider.','first-news') ,
		'section' => 'first_news_headline_slider',
		'type'	  => 'number',
		'priority'=>4
	));

	//options for banner category
	$wp_customize->add_setting(
	    'first_news_banner_layout',
	    array(
	        'default' => 'full_width',
	        'type'    => 'theme_mod',
			'sanitize_callback' => 'first_news_sanitize_radio'
	    )
	);
	 
	$wp_customize->add_control(
	    'first_news_banner_layout',
	    array(
	        'type' => 'radio',
	        'label' => esc_html__('Layout', 'first-news'),
	        'priority'=> 5 ,
	        'section' => 'first_news_headline_slider',
	        'choices' => array(
	            'full_width' => esc_html__('Full Width Slider', 'first-news'),
				'with_left_category' => esc_html__('Slider with Left Posts', 'first-news'),
				'with_right_category' => esc_html__('Slider with Right Posts', 'first-news')
	        ),
	    )
	);

	$wp_customize->add_setting( 'first_section_select', array(
		'default'           => 0,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( new First_News_Category_Control( $wp_customize, 'first_section_select', array(
		'type' => 'select',
		'label'         => esc_html__( 'Slider posts category', 'first-news' ),
		'description'   => esc_html__( 'Select The Slider Category Options.', 'first-news' ),
		'section' => 'first_news_headline_slider',
		'settings' => 'first_section_select',
	) ) );

	/**********************************************************************
	 * 							Layout
	 ***********************************************************************/
	$wp_customize->add_panel('first_news_layout', array(
		'title' => esc_html__('FN: Layout', 'first-news'),
		'capability' => 'edit_theme_options',
		'priority' => 3,
	));

	//Home Page layout
	$wp_customize->add_section('first_news_home_page_layout', array(
		'title' => esc_html__('Home Page Layout', 'first-news'),
		'priority'    => 1,
		'panel'		  => 'first_news_layout'
	));

	//Homepage Layout
	$wp_customize->add_setting(
	    'first_news_homepage_layout',
	    array(
	        'default' => 'right-sidebar',
	        'type'    => 'theme_mod',
			'sanitize_callback' => 'first_news_sanitize_radio'
	    )
	);
	 
	$wp_customize->add_control(
	    'first_news_homepage_layout',
	    array(
	        'type' => 'radio',
	        'label' => esc_html__('Sidebar Archive', 'first-news'),
	        'section' => 'first_news_home_page_layout',
	        'choices' => array(
	            'full-width' => esc_html__('Homepage Full Width', 'first-news'),
		    	'homepage-box-layout' => esc_html__('Homepage Box Layout', 'first-news')
			),
			'priority'    => 1,
	    )
	);

	//Sidebar Layout
	$wp_customize->add_section('first_news_sidebar_layout', array(
		'title' 	  => esc_html__('FN: Sidebar Layout', 'first-news'),
		'priority'    => 2,
		'panel'		  => 'first_news_layout'
	));

	//Archive Sidebar Settings
	$wp_customize->add_setting(
	    'sidebar-archive',
	    array(
	        'default' => 'right-sidebar',
	        'type'    => 'theme_mod',
			'sanitize_callback' => 'first_news_sanitize_radio'
	    )
	);
	
	$wp_customize->add_control(
	    'sidebar-archive',
	    array(
	        'type' => 'radio',
	        'label' => esc_html__('Sidebar Archive', 'first-news'),
	        'section' => 'first_news_sidebar_layout',
	        'choices' => array(
	            'right-sidebar' => esc_html__('Right Sidebar', 'first-news'),
			    'left-sidebar' => esc_html__('Left Sidebar', 'first-news'),
			    'full-width' => esc_html__('Full Width', 'first-news')
			),
			'priority'    => 1,
	    )
	);

	//Single Page Sidebar
	$wp_customize->add_setting(
	    'sidebar-single',
	    array(
	        'default' => 'right-sidebar',
	        'type'    => 'theme_mod',
			'sanitize_callback' => 'first_news_sanitize_radio'
	    )
	);

	$wp_customize->add_control(
	    'sidebar-single',
	    array(
	        'type' => 'radio',
	        'label' => esc_html__('Single Page Sidebar', 'first-news'),
	        'section' => 'first_news_sidebar_layout',
	        'choices' => array(
	            'right-sidebar' => esc_html__('Right Sidebar', 'first-news'),
			    'left-sidebar' => esc_html__('Left Sidebar', 'first-news'),
			    'full-width' => esc_html__('Full Width', 'first-news')
			),
			'priority'    => 2,
	    )
	);

	//Sidebar Layout
	$wp_customize->add_section('home_first_news_sidebar_layout', array(
		'title' 	  => esc_html__('Home Sidebar Layout', 'first-news'),
		'priority'    => 3,
		'panel'		  => 'first_news_layout'
	));

	$wp_customize->add_setting(
	    'home-sidebar',
	    array(
	        'default' => 'right-sidebar',
	        'type'    => 'theme_mod',
			'sanitize_callback' => 'first_news_sanitize_radio'
	    )
	);

	$wp_customize->add_control(
	    'home-sidebar',
	    array(
	        'type' => 'radio',
	        'label' => esc_html__('Sidebar Archive', 'first-news'),
	        'section' => 'home_first_news_sidebar_layout',
	        'choices' => array(
	            'right-sidebar' => esc_html__('Right Sidebar', 'first-news'),
			    'left-sidebar' => esc_html__('Left Sidebar', 'first-news'),
			    'full-width' => esc_html__('Full Width', 'first-news')
		    ),
	    )
	);

	

	//page layout
	$wp_customize->add_section('first_news_page_layout', array(
		'title' 	=> esc_html__('Page Layout', 'first-news'),
		'priority'  => 133,
		'panel'		=> 'first_news_layout'
	));

	//Archive Page layout
	$wp_customize->add_setting(
	    'first_news_archive_layout',
	    array(
	        'default' => 'full_width',
	        'type'    => 'theme_mod',
			'sanitize_callback' => 'first_news_sanitize_radio'
	    )
	);
	$wp_customize->add_control(
	    'first_news_archive_layout',
	    array(
	        'type' => 'radio',
	        'label' => esc_html__('Archive Page Layout', 'first-news'),
	        'section' => 'first_news_page_layout',
	        'choices' => array(
	            'full_width' => esc_html__('Full Width', 'first-news'),
	            'two_column' => esc_html__('Two Column', 'first-news'),
	            'alternate' => esc_html__('Alternate', 'first-news')
	        ),
	    )
	);

	//Single Page Layout
	$wp_customize->add_setting(
	    'first_news_single_layout',
	    array(
	        'default' => 'full_width',
	        'type'    => 'theme_mod',
			'sanitize_callback' => 'first_news_sanitize_radio'
	    )
	);
	$wp_customize->add_control(
	    'first_news_single_layout',
	    array(
	        'type' => 'radio',
	        'label' => esc_html__('Single Page Layout', 'first-news'),
	        'section' => 'first_news_page_layout',
	        'choices' => array(
	            'full_width' => esc_html__('Full Width', 'first-news'),
	            'two_column' => esc_html__('Two Column', 'first-news'),
	            'banner' 	 => esc_html__('Banner', 'first-news')
	        ),
	    )
	);

	/*************************************************************************
	 * 								Date Format
	 ************************************************************************/
	$wp_customize->add_section('first_news_dateformat', array(
		'title' => esc_html__('FN: Date Format', 'first-news'),
		'priority'    => 4
	));

	$wp_customize->add_setting(
	    'first_news_dateformat',
	    array(
	        'default' => 'default',
	        'type'    => 'theme_mod',
			'sanitize_callback' => 'first_news_sanitize_radio'
	    )
	);
	
	$wp_customize->add_control(
	    'first_news_dateformat',
	    array(
	        'type' => 'radio',
	        'label' => esc_html__('Date format', 'first-news'),
	        'section' => 'first_news_dateformat',
	        'choices' => array(
	            'default' => esc_html__('Default', 'first-news'),
	            'human_readable' => esc_html__('Human Readable', 'first-news')
	        ),
	    )
	);
	
}

add_action('customize_register', 'first_news_social_customize_register');

/**
 * checkbox sanitization
*/
function first_news_checkbox_sanitize( $input ){
	return ( isset( $input ) && true == $input ? true : false );
}

//radio box sanitization function
function first_news_sanitize_radio( $input, $setting ){
	$input = sanitize_key($input);

	//get the list of possible radio box options 
	$choices = $setting->manager->get_control( $setting->id )->choices;
					
	//return input if valid or return default option
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
	
}

/**
 * select and radiobox sanitization
*/
function first_news_select_sanitize( $input, $setting ) {
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}


if (!class_exists('WP_Customize_Image_Control')) {
    return null;
}

/**Post Category */
class First_News_Category_Control extends WP_Customize_Control {

	public $type = 'dropdown-category';

	protected $dropdown_args = false;

	protected function render_content() {
		?><label><?php

		if ( ! empty( $this->label ) ) {
			?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
		}

		if ( ! empty( $this->description ) ) {
			?><span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span><?php
		}

		$dropdown_args = wp_parse_args( $this->dropdown_args, array(
			'taxonomy'          => 'category',
			'show_option_none'  => ' ',
			'selected'          => $this->value(),
			'show_option_all'   => '',
			'orderby'           => 'id',
			'order'             => 'ASC',
			'show_count'        => 1,
			'hide_empty'        => 1,
			'child_of'          => 0,
			'exclude'           => '',
			'hierarchical'      => 1,
			'depth'             => 0,
			'tab_index'         => 0,
			'hide_if_empty'     => false,
			'option_none_value' => 0,
			'value_field'       => 'term_id',
		) );

		$dropdown_args['echo'] = false;

		$dropdown = wp_dropdown_categories( $dropdown_args );
		$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
		
		echo $dropdown ;

		?></label><?php

	}
}
