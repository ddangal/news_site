<?php
/**
 * Hooks Cantorl
 */
require get_template_directory() . '/inc/hooks/header-hooks.php';
require get_template_directory() . '/inc/hooks/footer-hooks.php';

/**
 * Widget Area
 */
require get_template_directory() . '/inc/widgets/first-news-slider-widget.php';
require get_template_directory() . '/inc/widgets/first-news-sidebar-list.php';


/***
 *  Functions Area
 */
require get_template_directory() . '/inc/first-news-functions.php';


/***
 *  inline css
 */
require get_template_directory() . '/inc/settings/inline-css.php';


/**
 * First News Theme About page
 */
require get_template_directory() . '/inc/admin/class-first-news-admin.php';
