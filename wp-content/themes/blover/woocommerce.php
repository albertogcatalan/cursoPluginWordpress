<?php
/**
 * The template for displaying shop pages.
 *
 * @package blover
 */

get_header(); ?>
<div class="row">
		<div id="primary" class="woocommerce content-area col-xs-12<?php echo ( ! is_product() && get_theme_mod( 'woocommerce_sidebar', 1 ) && is_active_sidebar( 'shop-sidebar-1' ) ? ' col-lg-8 col-lg-push-4 has-sidebar' : ' col-lg-12' ); ?>">
		<main id="main" class="site-main" role="main">
				<?php woocommerce_content(); ?>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php
	if ( ! is_product() && get_theme_mod( 'woocommerce_sidebar', 1 ) && is_active_sidebar( 'shop-sidebar-1' ) ) {
		get_sidebar( 'shop-sidebar' ); }
	?>
</div><!-- .row -->
<?php get_footer(); ?>
