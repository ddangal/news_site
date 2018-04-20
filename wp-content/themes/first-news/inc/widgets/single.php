<div class="clearfix"></div>
  <div class="section">
    <section class="header">
      <?php 
        $bg_id = intval($instance['background-img-id']);
        $bg_src = wp_get_attachment_image_src( $bg_id, 'header_image' );
        $bg_src = $bg_src[0];

        //header title
        $first_news_single_header_title = $instance['title'];
        $first_news_single_header_links = get_category_link( $instance['category'][0] )
      ?>
      <div class="row">
        <div class="header_image">
            <figure>
                <img src="<?php echo esc_url($bg_src); ?>" alt="header image">
            </div>
            <div class="header_desc">
                <h1>
                  <a href="<?php echo esc_url( $first_news_single_header_links ); ?>">
                    <?php echo wp_kses_post($first_news_single_header_title); ?>
                  </a>
                </h1>
            </div>
        </div>
      </div>
    </section>
    <section class="service">
        <div class="row single-block-section">
          <?php
            //Single Page Query
            $query = new WP_Query(
              array(
                'category__in' => (array) $instance['category'],
                'posts_per_page' => intval( $instance['post_count'] ),
                )
            );
            
            //Query Check
            if( $query->have_posts() ){

              while( $query->have_posts() ): $query->the_post(); 
                ?>
                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="equal_height clearfix">
                        <?php if ( has_post_thumbnail() ) { ?>
                          <div class="service_inner_img">
                              <figure>
                                  <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('first-news-thumb'); ?>
                                  </a>
                              </figure>
                          </div>
                        <?php } ?>
                        <div class="service_inner_text">
                            <h3 class="title-5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="meta-tp-2">
                              <?php first_news_dateformat(); ?>
                              <div class="category">
                                  <i class="fa fa-pencil" aria-hidden="true"></i><span><?php the_author(); ?></span></a>
                              </div>
                            </div>
                            <p class="p"><?php echo wp_kses_post( get_the_excerpt() )." <a href='".esc_url(get_the_permalink())."'>".esc_html('read more','first-news')." </a>"; ?></p>
                        </div>
                    </div>
                  </div>
                <?php 
              endwhile; wp_reset_query();
            }
          ?>
        </div>
    </section>
  </div>
