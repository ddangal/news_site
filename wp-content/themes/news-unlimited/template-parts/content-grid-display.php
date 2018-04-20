<?php
$comments_count = wp_count_comments($post->ID);
?>
<article class="col-sm-6 cats grid-view-wrap">
    <div class="wrap"> 
        <a href="<?php the_permalink(); ?>">         
        <?php
        if (has_post_thumbnail()) {
            the_post_thumbnail( 'news-unlimited_lower_banner_pic' );
        }
        ?>
        </a>
        <div class="content">
            <h4>
                <a href="<?php the_permalink(); ?>"><?php echo esc_html(wp_trim_words( get_the_title(), 6, '&hellip;' )); ?></a>
            </h4>
            <span>
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><i class="fa fa-user"></i><?php the_author_meta( 'user_login' , $post->post_author );?></a>  |  <a href="<?php echo esc_url(home_url()); ?>/<?php echo date( 'Y/m' , strtotime( get_the_date() ) ); ?>"><i class="fa fa-calendar"></i><?php echo esc_html( get_the_date() ); ?></a>  | <a href="<?php the_permalink(); ?>/#respond"><i class="fa fa-comments"></i><?php echo esc_html($comments_count->total_comments); ?></a>
            </span>
            <p class="para">
                <?php
                the_excerpt(); 
                ?>        
            </p>
        </div>
    </div>
</article>
