<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package first-news
 */
?>
<!-- footer section open -->
<footer>
	<?php do_action('first_news_footer_widget'); ?>
</footer>
<!-- footer section close -->
<div class="clearfix"></div>

<?php wp_footer(); ?>

</body>
</html>