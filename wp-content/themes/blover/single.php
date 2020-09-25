<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package blover
 */

get_header(); ?>
<?php
$blover_has_sidebar = get_theme_mod( 'single_post_sidebar', 1 );
	$blover_is_active_sidebar = ( is_active_sidebar( 'sidebar-1' ) ? '' : ' col-lg-offset-2' );
get_sidebar( 'top' );
?>
<div class="row">
		<div id="primary" class="content-area<?php echo ( $blover_has_sidebar ? ' col-lg-8' . $blover_is_active_sidebar : ' col-lg-8 col-lg-offset-2' ); // WP XSS OK. ?>">
		<main id="main" class="site-main row" role="main">

		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php get_template_part( 'template-parts/content-single', get_post_format() ); ?>

			<?php blover_related_posts(); ?>

			<?php
			if ( get_theme_mod( 'single_post_navigation', 1 ) ) :

							the_post_navigation(
								array(
									'prev_text'          => '<div class="blover-previous-article">' . esc_html( get_theme_mod( 'single_post_navigation_previous_label', __( 'Previous article', 'blover' ) ) ) . '</div><div class="blover-previous-article-title">%title</div>',
									'next_text'          => '<div class="blover-next-article">' . esc_html( get_theme_mod( 'single_post_navigation_next_label', __( 'Next article', 'blover' ) ) ) . '</div><div class="blover-next-article-title">%title</div>',
									'in_same_term' => wp_validate_boolean( get_theme_mod( 'single_post_navigation_only_category', 0 ) ),
								)
							);

						endif;
			?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
if ( $blover_has_sidebar ) {
	get_sidebar(); }
?>
</div><!-- .row -->
<?php get_footer(); ?>
