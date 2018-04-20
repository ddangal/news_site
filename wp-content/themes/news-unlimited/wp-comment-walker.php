<?php
class news_unlimited_comment_walker extends Walker_Comment {

	var $tree_type = 'comment';
	var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

	// constructor wrapper for the comments list
	function __construct() { ?>

		<ul class="comment-item comment-holder">

	<?php }

	// start_lvl wrapper for child comments list
	function start_lvl( &$output, $depth = 0, $args = array() ) { ?>
		
		<ul class="child-comments comment-item">

	<?php }

	// end_lvl closing wrapper for child comments list
	function end_lvl( &$output, $depth = 0, $args = array() ) { ?>

		</ul>

	<?php }

	// start_el HTML for comment template
	function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {

		$depth++;		
		$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); 

		if ( 'article' == $args['style'] ) {
			$tag = 'article';
			$add_below = 'comment';
		} else {
			$tag = 'article';
			$add_below = 'comment';
		} ?>

		<li <?php comment_class(empty( $args['has_children'] ) ? '' :'parent') ?> id="comment-<?php echo absint( $comment->comment_ID ); ?>">

			<?php 
			$avatar = get_avatar( $comment, 65, '', esc_attr__( 'Author gravatar' , 'news-unlimited' ) ); 

			if( !empty( $avatar ) ){ 
				$margin = ''; ?>
				<div class="comment-avatar">
					<?php 
					echo wp_kses(
						$avatar,
						array( 
							'img' => array( 
								'class' => array(),
								'alt' => array(),
								'src' => array(),
								'width' => array(),
								'height' => array(),
							) 
						) 
					); 
					?>
				</div>
				<?php 
			} else {
				$margin = 'margin-left: 0;';
			} 

			$date_format = get_option( 'date_format' );
			$time_format = get_option( 'time_format' ); ?>

			<div class="comment-header" style="<?php echo esc_attr( $margin ); ?>">

				<?php 
				$author_url = !empty( $comment->user_id ) ? get_author_posts_url( $comment->user_id ) : '#';
				?>
				<a href="<?php echo esc_url( $author_url ); ?>" class="font600 font16">
					<?php echo esc_html( $comment->comment_author ); ?>		
				</a>
				<span class="comment-time">
					<a href="#comment-<?php echo absint( $comment->comment_ID ); ?>">
						<?php comment_date( $date_format . ', ' . $time_format , $comment->comment_ID ); ?>		
					</a>
				</span>
			</div>

			<div class="comment-content">
				<?php comment_text( $comment->comment_ID ) ?>

				<div class="edit_repy_links">

					<a class="comment-edit-link btn btn-primary btn-sm" href="<?php echo esc_url( get_edit_comment_link( $comment->comment_ID ) ); ?>"><span class="comment-meta-item"><?php esc_html_e( 'Edit this comment', 'news-unlimited' ); ?></span></a>

					<?php 					

					$myclass = 'comment-reply';
					echo preg_replace( 
						'/comment-reply-link/', 'comment-reply-link ' . $myclass,
						get_comment_reply_link( 
							array_merge( 
								$args, 
								array(
									'add_below' => $add_below, 
									'depth' => $depth, 
									'max_depth' => $args['max_depth']
								)
							),
							$comment
						), 
						1 
					);
					?>
				</div>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p class="comment-meta-item comment_awating"><?php esc_html_e( 'Your comment is awaiting moderation.' , 'news-unlimited' ); ?></p>
				<?php endif; ?>

			</div>

		<?php 

	}

	// end_el closing HTML for comment template
	function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
		</li>
	<?php }

	// destructor closing wrapper for the comments list
	function __destruct() { ?>
		</ul>
	<?php }

}