<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package blover
 */

get_header(); ?>
	 <div class="row">
	<div id="primary" class="content-area
	<?php
	$blover_home_page_layout = get_theme_mod( 'home_page_layout', 'classic' );
			echo ( empty( $blover_home_page_layout ) ) ? ' col-md-12' : ' col-lg-8';
	if ( ! empty( $blover_home_page_layout ) && ! is_active_sidebar( 'sidebar-1' ) ) :
		echo ' col-lg-push-2';
			endif;
	?>
			">

		<?php if ( have_posts() ) : ?>

			<div class="blover-page-intro">
						<h1>
						<?php
						// Translators: search query.
						printf( esc_html__( 'Search Results for: %s', 'blover' ), '<span>' . get_search_query() . '</span>' );
						?>
						</h1>
			</div>
		<main id="main" class="site-main row masonry-container" role="main">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content-home', $blover_home_page_layout );
				?>

			<?php endwhile; ?>

			

		<?php else : ?>
				<div class="blover-page-intro nothing-found">
						<h1><?php echo esc_html__( 'Nothing Found', 'blover' ); ?></h1>
				</div>
		<main id="main" class="site-main row" role="main">
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>

		</main><!-- #main -->	
		<?php
		if ( '' === get_theme_mod( 'pagination', 'infinite' ) ) {
			the_posts_pagination();
		} else {
			the_posts_navigation();
		}
		?>

	</div><!-- #primary -->

<?php
if ( ! empty( $blover_home_page_layout ) ) {
	get_sidebar();}
?>
	</div><!-- .row -->
<?php get_footer(); ?>
