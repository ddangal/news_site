<?php
/**
 * First News Admin Class.
 *
 * @author  Themerelic
 * @package First News
 * @since   
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'First_News_Admin' ) ) :

/**
 * First_News_Admin Class.
 */
class First_News_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
	}

	/**
	 * Add admin menu.
	 */
	public function admin_menu() {
		$theme = wp_get_theme( get_template() );

		$page = add_theme_page( esc_html__( 'About', 'first-news' ) . ' ' . $theme->display( 'Name' ), esc_html__( 'About', 'first-news' ) . ' ' . $theme->display( 'Name' ), 'activate_plugins', 'first-news-welcome', array( $this, 'welcome_screen' ) );
		add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function enqueue_styles() {
		$first_news_theme = wp_get_theme();
		$first_news_version = $first_news_theme->get( 'Version' );

		wp_enqueue_style( 'first-news-welcome', get_template_directory_uri() . '/inc/admin/css/admin-welcome.css', array(), $first_news_version );
	}

	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		global $first_news_version, $pagenow;

		wp_enqueue_style( 'first-news-message', get_template_directory_uri() . '/inc/admin/css/admin-welcome.css', array(), $first_news_version );

		// Let's bail on theme activation.
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'First_News_Admin_notice_welcome', 1 );

		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'First_News_Admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( isset( $_GET['first-news-hide-notice'] ) && isset( $_GET['first_news_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( $_GET['first_news_notice_nonce'], 'first_news_hide_notices_nonce' ) ) {
				wp_die( __( 'Action failed. Please refresh the page and retry.', 'first-news' ) );
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'Cheatin&#8217; huh?', 'first-news' ) );
			}

			$hide_notice = sanitize_text_field( $_GET['first-news-hide-notice'] );
			update_option( 'First_News_Admin_notice_welcome' . $hide_notice, 1 );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		?>
		<div id="message" class="updated first-news-message">
			<a class="first-news-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'first-news-hide-notice', 'welcome' ) ), 'first_news_hide_notices_nonce', 'first_news_notice_nonce' ) ); ?>"><?php esc_html_e( 'Dismiss', 'first-news' ); ?></a>
			<p><?php printf( esc_html__( 'Welcome! Thank you for choosing first news! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'first-news' ), '<a href="' . esc_url( admin_url( 'themes.php?page=first-news-welcome' ) ) . '">', '</a>' ); ?></p>
			<p class="submit">
				<a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=first-news-welcome' ) ); ?>"><?php esc_html_e( 'Get started with First News', 'first-news' ); ?></a>
			</p>
		</div>
		<?php
	}

	/**
	 * Intro text/links shown to all about pages.
	 *
	 * @access private
	 */
	private function intro() {
		global $first_news_version;
		$theme = wp_get_theme( get_template() );

		// Drop minor version if 0
		$major_version = substr( $first_news_version, 0, 3 );
		?>
		<div class="first-news-theme-info">
				<h1>
					<?php esc_html_e('About', 'first-news'); ?>
					<?php echo $theme->display( 'Name' ); ?>
					<?php printf( '%s', $major_version ); ?>
				</h1>

			<div class="welcome-description-wrap">
				<div class="about-text"><?php echo $theme->display( 'Description' ); ?></div>

				<div class="first-news-screenshot">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" />
				</div>
			</div>
		</div>

		<p class="first-news-actions">
			<!-- Theme Demo -->
			<a href="<?php echo esc_url( 'http://demo.themerelic.com/first-news/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Demo', 'first-news' ); ?></a>

			<!-- Theme Details -->
			<a href="<?php echo esc_url('https://themerelic.com/wordpress-themes/first-news-magazine-theme/'); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'Theme Details', 'first-news' ); ?></a>

			<!-- Theme Documentaion  -->
			<a href="<?php echo esc_url( 'http://docs.themerelic.com/first-news/' ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Documentation', 'first-news' ); ?></a>

			<!-- Go To Pro -->
			<a href="<?php echo esc_url( 'https://themerelic.com/wordpress-themes/first-news-magazine-theme-pro/' ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'First News Pro', 'first-news' ); ?></a>
		</p>

		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php if ( empty( $_GET['tab'] ) && $_GET['page'] == 'first-news-welcome' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'first-news-welcome' ), 'themes.php' ) ) ); ?>">
				<?php echo $theme->display( 'Name' ); ?>
			</a>
			
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'free_vs_pro' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'first-news-welcome', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Free Vs Pro', 'first-news' ); ?>
			</a>

			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'more_themes' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'first-news-welcome', 'tab' => 'more_themes' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'More Themes', 'first-news' ); ?>
			</a>

			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'first-news-welcome', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Changelog', 'first-news' ); ?>
			</a>
		</h2>
		<?php
	}

	/**
	 * Welcome screen page.
	 */
	public function welcome_screen() {
		$current_tab = empty( $_GET['tab'] ) ? 'about' : sanitize_title( $_GET['tab'] );

		// Look for a {$current_tab}_screen method.
		if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
			return $this->{ $current_tab . '_screen' }();
		}

		// Fallback to about screen.
		return $this->about_screen();
	}

	/**
	 * Output the about screen.
	 */
	public function about_screen() {
		$theme = wp_get_theme( get_template() );
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<div class="changelog point-releases">
				<div class="under-the-hood two-col">
               
					<div class="col">
						<h3><?php esc_html_e( 'Theme Customizer', 'first-news' ); ?></h3>
						<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'first-news' ) ?></p>
						<p><a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-secondary"><?php esc_html_e( 'Customize', 'first-news' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Documentation', 'first-news' ); ?></h3>
						<p><?php esc_html_e( 'Please view our documentation page to setup the theme.', 'first-news' ) ?></p>
						<p><a href="<?php echo esc_url( 'http://docs.themerelic.com/first-news/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Documentation', 'first-news' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Got theme support question?', 'first-news' ); ?></h3>
						<p><?php esc_html_e( 'Please put it in our dedicated support forum.', 'first-news' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://themerelic.com/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Support', 'first-news' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Need more features?', 'first-news' ); ?></h3>
						<p><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'first-news' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://themerelic.com/wordpress-themes/first-news-magazine-theme-pro/' ); ?>" class="button button-secondary"><?php esc_html_e( 'View PRO version', 'first-news' ); ?></a></p>
					</div>

					<div class="col">
						<h3>
							<?php
							esc_html_e( 'Translate', 'first-news' );
							echo ' ' . $theme->display( 'Name' );
							?>
						</h3>
						<p><?php esc_html_e( 'Click below to translate this theme into your own language.', 'first-news' ) ?></p>
						<p>
							<a href="<?php echo esc_url( 'https://translate.wordpress.org/projects/wp-themes/first-news' ); ?>" class="button button-secondary">
								<?php
								esc_html_e( 'Translate', 'first-news' );
								echo ' ' . $theme->display( 'Name' );
								?>
							</a>
						</p>
					</div>

				</div>
			</div>

			<div class="return-to-dashboard">
				<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
					<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
						<?php is_multisite() ? esc_html_e( 'Return to Updates', 'first-news' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'first-news' ); ?>
					</a> |
				<?php endif; ?>
				<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'first-news' ) : esc_html_e( 'Go to Dashboard', 'first-news' ); ?></a>
			</div>

		</div>
		<?php
	}

		/**
	 * Output the changelog screen.
	 */
	public function changelog_screen() {
		global $wp_filesystem;

		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'View changelog below:', 'first-news' ); ?></p>

			<?php
				$changelog_file = apply_filters( 'first_news_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = $this->parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
			?>
		</div>
		<?php
	}

	/**
	 * Parse changelog from readme file.
	 * @param  string $content
	 * @return string
	 */
	private function parse_changelog( $content ) {
		$matches   = null;
		$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
		$changelog = '';

		if ( preg_match( $regexp, $content, $matches ) ) {
			$changes = explode( '\r\n', trim( $matches[1] ) );

			$changelog .= '<pre class="changelog">';

			foreach ( $changes as $index => $line ) {
				$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
			}

			$changelog .= '</pre>';
		}

		return wp_kses_post( $changelog );
	}


	/**
	 * Output the free vs pro screen.
	 */
	public function free_vs_pro_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'first-news' ); ?></p>

			<table>
				<thead>
					<tr>
						<th class="table-feature-title"><h3><?php esc_html_e('Features', 'first-news'); ?></h3></th>
						<th><h3><?php esc_html_e('First News', 'first-news'); ?></h3></th>
						<th><h3 class="first-news-pro-header"><a href="<?php echo esc_url('https://themerelic.com/wordpress-themes/first-news-pro/'); ?>"><?php esc_html_e('First News Pro', 'first-news'); ?></a></h3></th>
					</tr>
					
					<!-- Header Section -->
					<tr>
						<td><h3><?php esc_html_e('Import Demo Data.', 'first-news'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Pre Loaders.', 'first-news'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Typography Options.', 'first-news'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Typography Options.', 'first-news'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Breadcrumbs.', 'first-news'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Header Section', 'first-news'); ?></h3></td>
						<td><?php echo esc_html_e('1','first-news') ?></td>
						<td><?php echo esc_html_e('4','first-news') ?></td>
					</tr>


					<tr>
						<td><h3><?php esc_html_e('Fonts , Fonts Size , Text Color', 'first-news'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php esc_html_e('600+', 'first-news'); ?></td>
					</tr>
					
					<tr>
						<td><h3><?php esc_html_e('3+Different Style Slider Layout.', 'first-news'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Custom Archive Page Layout', 'first-news'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php esc_html_e('7+', 'first-news'); ?></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Header Mega Menu', 'first-news'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					
					<tr>
						<td><h3><?php esc_html_e('4+ Different Layout Posts Slider Widget Sections', 'first-news'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					
					<tr>
						<td><h3><?php esc_html_e('2+ Different Type Theme Layout', 'first-news'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					
					<tr>
						<td><h3><?php esc_html_e('12+ Different Widget Layout', 'first-news'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Category Color Control In Customizer', 'first-news'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Viewer Counter  Options', 'first-news'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>Product Category Section
					
					<tr>
						<td><h3><?php esc_html_e('Edit The Footer Copyright Text', 'first-news'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td></td>
						<td></td>
						<td class="btn-wrapper">
							<a href="<?php echo esc_url( 'https://themerelic.com/wordpress-themes/first-news-magazine-theme-pro/' ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e('View Pro','first-news'); ?></a>
						</td>
					</tr>
		
				</tbody>
			</table>

		</div>
		<?php
	}

	/**
	 * Output the more themes screen
	 */
	public function more_themes_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>
			<div class="theme-browser rendered">
				<div class="themes wp-clearfix">
					<?php
						// Set the argument array with author name.
						$args = array(
							'author' => 'themerelic',
						);
						// Set the $request array.
						$request = array(
							'body' => array(
								'action'  => 'query_themes',
								'request' => serialize( (object)$args )
							)
						);
						$themes = $this->themerelic_get_themes( $request );
						$active_theme = wp_get_theme()->get( 'Name' );
						$counter = 1;

						// For currently active theme.
						foreach ( $themes->themes as $theme ) {
							if( $active_theme == $theme->name ) { ?>

								<div id="<?php echo $theme->slug; ?>" class="theme active">
									<div class="theme-screenshot">
										<img src="<?php echo $theme->screenshot_url ?>"/>
									</div>
									<h3 class="theme-name" ><strong><?php _e( 'Active', 'first-news' ); ?></strong>: <?php echo $theme->name; ?></h3>
									<div class="theme-actions">
										<a class="button button-primary customize load-customize hide-if-no-customize" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>"><?php _e( 'Customize', 'first-news' ); ?></a>
									</div>
								</div><!-- .theme active -->
							<?php
							$counter++;
							break;
							}
						}

						// For all other themes.
						foreach ( $themes->themes as $theme ) {
							if( $active_theme != $theme->name ) {
								// Set the argument array with author name.
								$args = array(
									'slug' => $theme->slug,
								);
								// Set the $request array.
								$request = array(
									'body' => array(
										'action'  => 'theme_information',
										'request' => serialize( (object)$args )
									)
								);
								$theme_details = $this->themerelic_get_themes( $request );
							?>
								<div id="<?php echo $theme->slug; ?>" class="theme">
									<div class="theme-screenshot">
										<img src="<?php echo $theme->screenshot_url ?>"/>
									</div>

									<h3 class="theme-name"><?php echo $theme->name; ?></h3>

									<div class="theme-actions">
										<?php if( wp_get_theme( $theme->slug )->exists() ) { ?>											
											<!-- Activate Button -->
											<a  class="button button-secondary activate"
												href="<?php echo wp_nonce_url( admin_url( 'themes.php?action=activate&amp;stylesheet=' . urlencode( $theme->slug ) ), 'switch-theme_' . $theme->slug );?>" ><?php _e( 'Activate', 'first-news' ) ?></a>
										<?php } else {
											// Set the install url for the theme.
											$install_url = add_query_arg( array(
													'action' => 'install-theme',
													'theme'  => $theme->slug,
												), self_admin_url( 'update.php' ) );
										?>
											<!-- Install Button -->
											<a data-toggle="tooltip" data-placement="bottom" title="<?php echo 'Downloaded ' . number_format( $theme_details->downloaded ) . ' times'; ?>" class="button button-secondary activate" href="<?php echo esc_url( wp_nonce_url( $install_url, 'install-theme_' . $theme->slug ) ); ?>" ><?php _e( 'Install Now', 'first-news' ); ?></a>
										<?php } ?>

										<a class="button button-primary load-customize hide-if-no-customize" target="_blank" href="<?php echo $theme->preview_url; ?>"><?php _e( 'Live Preview', 'first-news' ); ?></a>
									</div>
								</div><!-- .theme -->
								<?php
							}
						}


					?>
				</div>
			</div><!-- .end div -->
		</div><!-- .ena wrapper -->
		<?php
	}

	/** 
	 * Get all our themes by using API.
	 */
	private function themerelic_get_themes( $request ) {

		// Generate a cache key that would hold the response for this request:
		$key = 'first_news_' . md5( serialize( $request ) );

		// Check transient. If it's there - use that, if not re fetch the theme
		if ( false === ( $themes = get_transient( $key ) ) ) {

			// Transient expired/does not exist. Send request to the API.
			$response = wp_remote_post( 'http://api.wordpress.org/themes/info/1.0/', $request );

			// Check for the error.
			if ( !is_wp_error( $response ) ) {

				$themes = unserialize( wp_remote_retrieve_body( $response ) );

				if ( !is_object( $themes ) && !is_array( $themes ) ) {

					// Response body does not contain an object/array
					return new WP_Error( 'theme_api_error', 'An unexpected error has occurred' );
				}

				// Set transient for next time... keep it for 24 hours should be good
				set_transient( $key, $themes, 60 * 60 * 24 );
			}
			else {
				// Error object returned
				return $response;
			}
		}
		return $themes;
	}


}

endif;

return new First_News_Admin();
