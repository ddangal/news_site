		<div class="entry-meta">
			<?php simpleasy_posted_on(); ?> 
			<?php 
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				echo ' / <a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '"><span class="post-main-category">' . esc_html( $categories[0]->name ) . '</span></a>';
			}
			?>
		</div><!-- .entry-meta -->