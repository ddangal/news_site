<?php if( $query->have_posts() ){  ?>
    <div class="col-row">
        <?php while($query->have_posts() ): $query->the_post(); ?>
            <div class="<?php echo esc_attr($first_news_col_class); ?>">
                <article class="post post-tp-4">
                    <?php if ( has_post_thumbnail() ) { ?>
                        <figure>
                            <a href="<?php the_permalink(); ?>">
                                <?php  the_post_thumbnail('first-news-thumb'); ?>
                            </a>
                        </figure>
                    <?php }//end Figure Condition check ?>
                    <h3 class="title-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="meta-tp-2">
                        <?php first_news_dateformat(); ?>
                    </div>
                </article>
            </div>
        <?php endwhile; ?>
    </div>
<?php wp_reset_query(); } ?>