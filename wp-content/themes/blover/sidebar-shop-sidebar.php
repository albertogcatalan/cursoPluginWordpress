<?php
	/**
	 * The sidebar containing the shop widget area.
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package blover
	 */

if ( ! is_active_sidebar( 'shop-sidebar-1' ) ) {
	return;
}
?>
		<div id="shop-sidebar-widget" class="widget-area col-xs-12 col-lg-4 col-lg-pull-8" role="complementary">
			<?php dynamic_sidebar( 'shop-sidebar-1' ); ?>
		</div><!-- #shop-sidebar-widget -->
