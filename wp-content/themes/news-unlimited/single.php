<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package news-unlimited
 */

get_header(); 
global $post;
$not_post = $post->ID;
$category = wp_get_post_terms( $post->ID, 'category' );
$category_id = !empty( $category[0]->term_id ) ? $category[0]->term_id : '';
$category_name = !empty( $category[0]->name ) ? $category[0]->name : '';
$colors = news_unlimited_cat_colors();
$data = array();
$show_sidebar = get_theme_mod( 'show_sidebar_checkbox' , true );
$post_num = 2;
if ( $show_sidebar != true) {
    $post_num += 1;
}
$comments_count = wp_count_comments($post->ID);
?>
    <section id="main-cat" class="main-cat theme_pages"> <!-- main-cat start -->

        <div class="container">
            <!--  primary start -->
            <div class="row">
                <article id="primary" class="<?php if( $show_sidebar == true ){ ?>col-sm-8 col-md-8<?php }else{ ?>col-sm-12 col-md-12<?php }?>">
                    <div class="row">
                        <article class="col-xs-12 col-sm-12 col-md-12">
                            <div class="single_page_featured_image">
                            	<?php
                            	if ( has_post_thumbnail() && $show_sidebar == true ){
                            		the_post_thumbnail( 'news-unlimited_single_page_main_image' );
                                }else{
                                    the_post_thumbnail( 'news-unlimited_single_page_main_image2' );
                                }
                            	?>
                            </div>
                            <div class="content detail-ct">
                                <h3><?php the_title(); ?></h3>
                                <span class="content_additional">
                                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><i class="fa fa-user"></i><?php the_author_meta( 'user_login' , $post->post_author ); ?></a>  |  <a href="<?php echo esc_url(home_url()); ?>/<?php echo date( 'Y/m' , strtotime( get_the_date() ) ); ?>"><i class="fa fa-calendar"></i><?php echo esc_html( get_the_date() ); ?></a>  | <a href="<?php the_permalink(); ?>/#respond"><i class="fa fa-comments"></i><?php echo esc_html($comments_count->total_comments); ?></a>
                                    
                                    <?php
                                    if( !empty( $category ) ){
                                        echo ' | <i class="fa fa-folder"></i>';
                                    }

                                    $numItems = count($category);
                                    $j = 0;
                                    foreach ($category as $key => $value) {
                                        if( !array_key_exists( $value->name , $data)){
                                            $data[ $value->name ] = $colors[0];
                                            $cat_id = $value->term_id;
                                            unset( $colors[0] );
                                            $colors = array_values( $colors ); 
                                        }?>
                                        <a href="<?php echo esc_url(get_term_link( $cat_id )); ?>" class="categories_tags"><?php echo esc_html( $value->name ); ?></a>
                                        <?php
                                        if(++$j != $numItems) {
                                            echo ', ';
                                        }
                                    }
                                    ?>

                                </span>
                                <p><?php the_content(); ?></p>

                                <?php 
                                // Check for tags
                                if( has_tag() ){ ?>
                                    <div class="post_tags tag-cloud">
                                        <?php 
                                        the_tags( 
                                            '<div class="tag-cloud-heading">' . esc_html__( 'Tags: ','news-unlimited' ) . '</div>', 
                                            ' ', 
                                            '<br />' 
                                        ); ?> 
                                    </div>
                                    <?php 
                                } ?>
                            </div> 

                        	<?php
                        	$args = array(
                        		'post_type' => 'post',
                        		'post_status' => 'publish',
                        		'tax_query' => array(
									array(
										'taxonomy' => 'category',
										'field'    => 'term_id',
										'terms'    => $category_id,
									),
								),
                        		'post__not_in' => array($not_post),
                        		'posts_per_page' => $post_num
                        	);

                            $args = apply_filters( 'news_unlimited_single_page_related_post', $args );

                        	$related_post = new WP_Query( $args );
                        	$count = 0;
                                
                        	if( $related_post->have_posts() ): 
                                ?>
                                <div class="title transform br-orange">
                                    <h3><?php esc_html_e( 'Related Posts', 'news-unlimited' ); ?></h3>
                                </div>
                                <div class="row related_post_wrapper">                                   
                                    <?php                           
                            		while( $related_post->have_posts() ): $related_post->the_post();                              
                                        $comments_count = wp_count_comments($post->ID);
                                        if( $count == 0 ){
                                        	?>  
                                            <article class="<?php echo( $show_sidebar ? "col-sm-6 poli cats grid-view-wrap" : "col-sm-4 poli cats grid-view-wrap" );?> col-xs-6">
                                                <div class="wrap d-inner-tag">
                                                    <a href="<?php the_permalink(); ?>">         
                                                        <?php
                				                    	if ( has_post_thumbnail() ){
                				                    		the_post_thumbnail( 'news-unlimited_lower_banner_pic' );
                                                            $has_no_image = '';
                                                        } else {
                                                            $has_no_image = "no_image";
                                                        }
                				                    	?>
                				                    </a>
                                                <div class="dt-tags <?php echo esc_attr( $has_no_image ); ?>">
                                                    <a href="<?php echo esc_url(get_term_link( $category_id )); ?>" class="" style="background: <?php echo esc_attr( $data[ $value->name ] ); ?>"><?php echo esc_html( $category_name ); ?></a>
                                                </div>
                                                <div class="content">
                                                    <h4><a href="<?php the_permalink(); ?>"><?php echo esc_html(wp_trim_words( get_the_title(), 6, '&hellip;' )); ?></a></h4>
                                                    <span><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><i class="fa fa-user"></i><?php the_author_meta( 'user_login' , $post->post_author ); ?></a>  |  <a href="<?php echo esc_url(home_url()); ?>/<?php echo date( 'Y/m' , strtotime( get_the_date() ) ); ?>"><i class="fa fa-calendar"></i><?php echo esc_html( get_the_date() ); ?></a>  | <a href="<?php the_permalink(); ?>/#respond"><i class="fa fa-comments"></i><?php echo esc_html($comments_count->total_comments); ?></a></span>
                                                    <p class="para"><?php
            				                        echo esc_html(wp_trim_words( get_the_content(), 30, '&hellip;' )); //post content
            				                        ?></p>
                                                </div>
                                                </div>
                                            </article>
                                            <?php
                                        } 
                                        else {
                                            ?>                                            
                                            <article class="<?php echo( $show_sidebar ? "col-sm-6 enter cats" : "col-sm-4 enter cats"); ?> col-xs-6">
            	                                <div class="wrap d-inner-tag">
            	                                    <a href="<?php the_permalink(); ?>">         
            	                                        <?php
            					                    	if ( has_post_thumbnail() ){
            					                    		the_post_thumbnail( 'news-unlimited_lower_banner_pic' );
                                                            $has_no_image1 = '';
                                                        } else {
                                                        $has_no_image1 = "no_image";
                                                        }
            					                    	?>
            					                    </a>
                                                    <div class="dt-tags <?php echo esc_attr( $has_no_image1 ); ?>">
                                                        <a href="<?php echo esc_url(get_term_link( $category_id )); ?>" class="" style="background: <?php echo esc_attr( $data[ $value->name ] ); ?>"><?php echo esc_html( $category_name ); ?></a>
                                                    </div>
                                                    <div class="content">
                                                        <h4>
                                                            <a href="<?php the_permalink(); ?>"><?php echo esc_html(wp_trim_words( get_the_title(), 6, '&hellip;' )); ?></a>
                                                        </h4>
                                                        <span>
                                                            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><i class="fa fa-user"></i><?php the_author_meta( 'user_login' , $post->post_author ); ?></a>  |  <a href="<?php echo esc_url(home_url()); ?>/<?php echo date( 'Y/m' , strtotime( get_the_date() ) ); ?>"><i class="fa fa-calendar"></i><?php echo esc_html( get_the_date() ); ?></a>  | <a href="<?php the_permalink(); ?>/#respond"><i class="fa fa-comments"></i><?php echo esc_html($comments_count->total_comments); ?></a>
                                                        </span>
                                                        <p class="para">
                                                            <?php
                					                        echo esc_html(wp_trim_words( get_the_content(), 30, '&hellip;' )); //post content
                					                        ?>               
                                                        </p>
                                                    </div>
            	                                </div>
                                            </article>
                                            <?php
                                	    }
                                        $count++;
                        			endwhile;
                            	    wp_reset_postdata();
                                echo "</div>";
                        	endif;
                            ?>
                            	         
                            
                            <?php
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                            ?> 
                        </article>

                    </div>
                </article><!-- primary end -->
                <!-- tab section end -->
                <?php
                if ( $show_sidebar == true) {
                ?>
                <article id="secondary" class="col-sm-4 col-md-4 tab listout lists_inner">
                    <?php
                    if (is_active_sidebar( 'sidebar-1' )) {
                    	dynamic_sidebar( 'sidebar-1' );
                    }
                    ?>
                </article>
                <?php
                }
                ?>
            </div>
        </div>
    </section><!-- main-cat end -->

<?php
get_footer();
