<form action="<?php echo esc_url(home_url());?>">
	<input name="s" value="<?php echo get_search_query(); ?>" type="text" class="search-fld" placeholder="<?php esc_attr_e( 'Search Keyword Here..' , 'news-unlimited' ); ?>">
	<a href=""><i class="fa fa-search"></i></a>
</form>