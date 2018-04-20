<form class="navbar-form" method="get" role="search" action="<?php echo esc_url(home_url( '/' )); ?>">
	<div class="input-group add-on">
	  <input  type="text" class="form-control" placeholder="<?php esc_attr_e( 'Search', 'first-news' ) ?>" value="<?php echo get_search_query(); ?>" name="s">
	  <div class="input-group-btn">
	    <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
	  </div>
	</div>
</form>