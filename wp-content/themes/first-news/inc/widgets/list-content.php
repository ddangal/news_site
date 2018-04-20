<div class="col-row">
    <?php 
    if( $query->have_posts() ){ 

        while( $query->have_posts() ): $query->the_post(); 
        
        // Post Count
        $count = $query->current_post; 
        if( $count == 0 ): 
    ?>
        <div class="col-sm-6">
            <article class="post post-tp-5">
                <?php if ( has_post_thumbnail() ) { ?>
                    <figure>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('first-news-thumb'); ?>
                        </a>
                    </figure>
                <?php }//End Figure condtion ?>

                <h3 class="title-5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <div class="meta-tp-2">
                    <?php first_news_dateformat(); ?>
                </div>
                <p class="p"><?php  the_excerpt(); ?></p>
            </article>
        </div>
        <div class="col-sm-6">
            <?php else: ?>
                <article class="post post-tp-6">
                    
                    <?php if ( has_post_thumbnail() ) { ?>
                        <figure>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('first-news-homepage-thumb'); ?>
                            </a>
                        </figure>
                    <?php }//End Figure condtion ?>
                    
                    <h3 class="title-5"><a href ="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php first_news_dateformat(); ?>
                </article>
            <?php endif;  endwhile;  wp_reset_query(); ?>
        </div>
    <?php } ?>
</div>