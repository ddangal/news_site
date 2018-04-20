<?php
/* Template Name: Contact Us */
get_header();
$location = get_theme_mod( 'location' );
$phone_num = get_theme_mod( 'phone_number' );
$email_id = get_theme_mod( 'email_address' );
$office_hour = get_theme_mod( 'office_hour' );
$latitude = get_theme_mod( 'latitude' );
$latitude = $latitude ? $latitude :  27.700769;
$longitude = get_theme_mod( 'longitude' );
$longitude = $longitude ? $longitude : 85.300140;
?>
<section id="main-cat" class="main-cat contact-st contact-1"> <!-- main-cat start -->
    <div class="container">
        <article class="col-xs-12 col-sm-12 col-md-12">
            <div class="row">
                <div class="contact-info top_cots">
                    <ul class="indv-info">
                        <li>
                            <i class="fa fa-location-arrow"></i> 
                            <?php esc_html_e( 'Location:', 'news-unlimited' ); ?>
                            <p class="location"><?php echo esc_html( $location ); ?></p>
                        </li>

                        <li>
                            <i class="fa fa-phone"></i> <?php esc_html_e( 'Phone No.:', 'news-unlimited' ); ?>
                            <p class="phone_number"><?php echo esc_html( $phone_num ); ?></p>
                        </li>

                        <li>
                        <i class="fa fa-envelope"></i> <?php esc_html_e( 'Email Address:', 'news-unlimited' ); ?>
                        <p class="email_address"><?php echo esc_html( $email_id ); ?></p>
                        </li>

                        <li>
                        <i class="fa fa-clock-o"></i> <?php esc_html_e( 'Office Hour:', 'news-unlimited' ); ?>
                        <p class="office_hour"><?php echo esc_html( $office_hour ); ?></p>
                        </li>
                    </ul>
                </div>
            </div>
        </article>
    </div>

    <div id="map" data-lat="<?php echo esc_attr( $latitude ); ?>" data-lon="<?php echo esc_attr( $longitude ); ?>" style="width: 100%; height: 350px;"></div>

    <div class="container">
        <!--  primary start -->
        <article class="contact-us">
            <div class="row">
                <article class="col-xs-12 col-xs-offset-1 col-sm-10 col-md-10">
                    <div class="entry-info">
                        <div class="title transform cats">
                            <h3>
                                <span class="title-sub">
                                    <?php esc_html_e( 'get in touch', 'news-unlimited' ); ?>
                                </span> 
                                - 
                                <?php esc_html_e( 'send message', 'news-unlimited' ); ?>
                            </h3>
                        </div>
                          <?php
                          $contact_form = get_theme_mod( 'contact_form' );
                          $contact_form =  htmlentities(str_replace("&quot;", '', $contact_form));
                          echo do_shortcode( $contact_form );
                          ?>
                      </div>
                </article>
            </div>
        </article><!-- primary end -->
    </div>
</section><!-- main-cat end -->
<?php
get_footer();
?>