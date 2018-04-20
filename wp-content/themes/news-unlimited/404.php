<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package news-unlimited
 */

get_header(); 
    
?>

<div id="error404_page">
    <div class="container">
        <h1 class="error_number">
        	<?php 
        	printf(
        		esc_html__( '4%s4', 'news-unlimited' ),
        		'<span>0</span>'
        	); 
        	?>
        </h1>
        <div class="main_title text-center">
            <h2><?php esc_html_e( 'OOPS!! PAGE NOT FOUND', 'news-unlimited' ); ?></h2>
        </div>
        <div class="text-center">
            <a href="<?php echo esc_url( home_url() );?>" class="button btn_sm btn_dark"><i class="fa fa-angle-left"></i> <?php esc_html_e( 'GO BACK TO HOME PAGE', 'news-unlimited' ); ?></a>
        </div>
    </div>
</div>

<?php
get_footer();
