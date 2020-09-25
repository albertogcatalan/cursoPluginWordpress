<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blover
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'blover' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
				<nav id="top-navigation" class="navbar-navigation" role="navigation">

					<button id="left-navbar-toggle" class="menu-toggle" aria-controls="left-sidebar" aria-expanded="false"><span class="screen-reader-text"><?php esc_html_e( 'Menu', 'blover' ); ?></span><svg><path d="M3 6h18v2.016h-18v-2.016zM3 12.984v-1.969h18v1.969h-18zM3 18v-2.016h18v2.016h-18z"></path></svg></button>
					<?php
					if ( function_exists( 'wc_get_cart_url' ) ) :
						?>
						<a class="btn blover-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'Carrito', 'blover' ); ?>"><?php esc_html_e( 'Carrito', 'blover' ); ?>(<span class="blover-cart-content-counts"><?php echo esc_html( wc()->cart->get_cart_contents_count() ); ?></span>)</a>
						<?php
						endif;
					?>
					<button id="navbar-search-toggle" class="search-toggle" aria-controls="search-panel" aria-expanded="false"><span class="screen-reader-text"><?php esc_html_e( 'Search', 'blover' ); ?></span><svg><path d="M9.516 14.016q1.875 0 3.188-1.313t1.313-3.188-1.313-3.188-3.188-1.313-3.188 1.313-1.313 3.188 1.313 3.188 3.188 1.313zM15.516 14.016l4.969 4.969-1.5 1.5-4.969-4.969v-0.797l-0.281-0.281q-1.781 1.547-4.219 1.547-2.719 0-4.617-1.875t-1.898-4.594 1.898-4.617 4.617-1.898 4.594 1.898 1.875 4.617q0 2.438-1.547 4.219l0.281 0.281h0.797z"></path></svg></button>
					<div id="search-panel" class="blover-search-panel">
						<button class="blover-search-panel-close" title="<?php esc_attr_e( 'Close', 'blover' ); ?>"><svg><path d="M18.984 6.422l-5.578 5.578 5.578 5.578-1.406 1.406-5.578-5.578-5.578 5.578-1.406-1.406 5.578-5.578-5.578-5.578 1.406-1.406 5.578 5.578 5.578-5.578z"></path></svg></button>
						<?php get_search_form(); ?>
					</div>

					<div class="menu-logo">
						<?php
						if ( has_custom_logo() ) :
							the_custom_logo();
						else :
							?>
						<p class="menu-blogname"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" ><?php bloginfo( 'name' ); ?></a></p>
						<?php endif; ?>
					</div>
						<?php
						if ( has_nav_menu( 'social' ) ) {
							wp_nav_menu(
								array(
									'theme_location' => 'social',
									'menu_id' => 'social-menu',
									'container_class' => 'social-menu-container',
									'depth'           => 1,
									'link_before'     => '<span class="screen-reader-text">',
									'link_after'      => '</span>',
								)
							);
						}
						wp_nav_menu(
							array(
								'theme_location' => 'top',
								'menu_id' => 'top-menu',
							)
						);
						?>
		</nav><!-- #site-navigation -->

		<?php if ( is_front_page() && is_home() ) : ?>
		<div class="site-branding">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php if ( get_header_image() ) : ?>
							<img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>" >
							<?php
						else :
							bloginfo( 'name' );
						endif;
						?>
						</a></h1>

			<?php
			if ( ! get_header_image() ) :
				?>
<p class="site-description"><?php bloginfo( 'description' ); ?></p><?php endif; ?>

		</div><!-- .site-branding -->
		<?php endif; ?>

	</header><!-- #masthead -->

	<?php if ( is_front_page() && is_home() ) : ?>
		<?php get_template_part( 'template-parts/content', 'home-slider' ); ?>
	<?php endif; ?>

	<div id="content" class="site-content container">
