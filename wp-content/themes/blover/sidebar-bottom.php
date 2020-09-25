<?php
/**
 * The sidebar containing the bottom widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blover
 */

if ( ! is_active_sidebar( 'bottom-1' ) ) {
	return;
}
?>
	<div id="bottom-widget" class="widget-area container" role="complementary">
		<?php dynamic_sidebar( 'bottom-1' ); ?>
	</div><!-- #bottom-widget -->
