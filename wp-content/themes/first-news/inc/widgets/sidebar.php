<aside class="side-bar col-sm-4 col-xs-12">
  <div class="recent-nws">
    <div class="pst-block">
        <div class="pst-block-head">
            <h2 class="title-4"><strong><?php echo esc_html('Recent News','first-news'); ?></strong></h2>
        </div>
        <div class="pst-block-main">
            <?php 
                $args = array( 'numberposts' => $instance['sidebar_postcount'] );
                $recent_posts = wp_get_recent_posts( $args );
            
                foreach( $recent_posts as $recent ): 
            ?>
                <article class="post post-tp-9">
                    <div class="row">
                        <figure class="col-md-5 recent-img">
                            <a href="<?php echo esc_url(get_permalink($recent["ID"])); ?>">
                                <?php                     
                                    if ( has_post_thumbnail($recent["ID"]) ) {
                                        echo  get_the_post_thumbnail($recent["ID"],'first-news-homepage-thumb');
                                    }
                                ?>
                            </a>
                        </figure>
                        <div class="col-md-7">
                            <h3 class="title-3"><a href="<?php echo esc_url(get_permalink($recent["ID"])); ?>"><?php echo esc_attr($recent["post_title"]); ?></a></h3>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
  </div>
</aside>
<div class="clearfix"></div>