<?php
/**
 * Searchform template
 *
 * @package blover
 */

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
			<span class="screen-reader-text"><?php esc_html_e( 'Search for: ', 'blover' ); ?></span>
			<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Type and hit enter', 'blover' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php esc_attr_e( 'Search for:', 'blover' ); ?>" />
	</label>
	<input type="submit" class="search-submit" value="<?php esc_attr_e( 'Search', 'blover' ); ?>" />
</form>   
	
