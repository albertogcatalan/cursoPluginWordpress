<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blover
 */

get_header(); ?>
	<?php if ( is_category() ) : ?>

		<?php
			$blover_catmeta = get_term_meta( $cat );
			$blover_cat_bg_color = ( ! empty( $blover_catmeta['bg_color'][0] ) ) ? '#' . $blover_catmeta['bg_color'][0] : '';
			$blover_cat_text_color = ( ! empty( $blover_catmeta['text_color'][0] ) ) ? '#' . $blover_catmeta['text_color'][0] : '';
			$blover_catimage = ( ! empty( $blover_catmeta['image'][0] ) ) ? $blover_catmeta['image'][0] : '';
			$blover_catimgsrc = wp_get_attachment_image_src( $blover_catimage, 'full' );
		?>
		<div class="row archive-blover-page-intro-row">
		<div class="blover-page-intro col-xs-12" style="<?php echo 'background:' . esc_attr( $blover_cat_bg_color ) . ' url(' . esc_url( $blover_catimgsrc[0] ) . ') no-repeat center;color:' . esc_attr( $blover_cat_text_color ) . ';'; ?>background-size:cover;">
			<h1 style="color:<?php echo esc_attr( $blover_cat_text_color ); ?>;"><?php the_archive_title(); ?></h1>
			<div class="row">
			<?php the_archive_description( '<div class="taxonomy-description col-md-8 col-md-offset-2">', '</div>' ); ?>
			</div>
		</div>
		</div>
	<?php endif; ?>
	<?php get_sidebar( 'top' ); ?>
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
			<?php if ( ! is_category() ) : ?>
				<div class="blover-page-intro">
			<h1><?php the_archive_title(); ?></h1>
				<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
		</div>
			<?php endif; ?>
		<main id="main" class="site-main row masonry-container" role="main">

		<?php
		if ( have_posts() ) :

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
