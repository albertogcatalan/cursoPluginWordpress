<?php
/**
 * The sidebar containing the footer widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blover
 */

if ( ! is_active_sidebar( 'footer-1' ) ) {
	return;
}
?>
	<div id="footer-widget" class="widget-area" role="complementary">
		<div class="container">
			<div class="row">
			<?php dynamic_sidebar( 'footer-1' ); ?>
			</div>
		</div>
	</div><!-- #footer-widget -->
