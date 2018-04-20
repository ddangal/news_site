<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package first-news
 */
if ( ! is_active_sidebar( 'sidebar-right' ) ) {
	return;
}
$sidebar_id = 'secondary';
if(is_front_page()){
	$sidebar_id = '';
}else{
	$sidebar_id = 'secondary';
}
?>
<aside id="<?php echo esc_attr( $sidebar_id ); ?>"  class="widget-area">
	<?php dynamic_sidebar( 'sidebar-right' ); ?>
</aside><!-- #secondary -->