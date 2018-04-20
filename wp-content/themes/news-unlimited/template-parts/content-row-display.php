<?php
$comments_count = wp_count_comments($post->ID);
$list_page = get_theme_mod( 'grid_and_row_view' );
?>
<div class="row">
    <?php 
    if ( has_post_thumbnail() ) { ?>
        <article class="col-sm-6 cats">
            <div class="wrap">
                <a href="<?php the_permalink(); ?>">
                <?php
                    the_post_thumbnail( 'news-unlimited_lower_banner_pic' );
                    $no_image = false;
                ?>
                </a>
            </div>
        </article>
    <?php 
    } else {
        $no_image = true;
    } 
    ?>
    <article class="<?php echo( $no_image ? "col-sm-12 enter cats" : "col-sm-6 enter cats" ); ?>">
        <div class="wrap">
            <div class="content fashion-cn <?php if($list_page == 'blue') echo "post_height"; ?>">
                <h4>
                    <a href="<?php the_permalink(); ?>"><?php echo esc_html(wp_trim_words( get_the_title(), 8, '&hellip;' )); ?></a>
                </h4>
                <span>
                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><i class="fa fa-user"></i><?php the_author_meta( 'user_login', $post->post_author ); ?></a>  |  <a href="<?php echo esc_url(home_url()); ?>/<?php echo date( 'Y/m' , strtotime( get_the_date() ) ); ?>"><i class="fa fa-calendar"></i><?php echo esc_html( get_the_date() ); ?></a>  | <a href="<?php the_permalink(); ?>/#respond"><i class="fa fa-comments"></i><?php echo esc_html($comments_count->total_comments); ?></a>
                </span>
                <p class="para">
                    <?php 
                    the_excerpt();  ?>
                </p>
            </div>
        </div>
    </article>
</div>