<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package blover
 */

if ( ! function_exists( 'blover_jetpack_setup' ) ) :
	/**
	 * Add theme support for Infinite Scroll.
	 * See: https://jetpack.me/support/infinite-scroll/
	 */
	function blover_jetpack_setup() {
		add_theme_support(
			'infinite-scroll',
			array(
				'container' => 'main',
				'type' => 'scroll',
				'wrapper'        => false,
				'render'    => 'blover_infinite_scroll_render',
				'footer'    => false,
			)
		);
	} // end function blover_jetpack_setup
	add_action( 'after_setup_theme', 'blover_jetpack_setup' );
endif;

if ( ! function_exists( 'blover_infinite_scroll_render' ) ) :
	/**
	 * Custom render function for Infinite Scroll.
	 */
	function blover_infinite_scroll_render() {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content-home', get_theme_mod( 'home_page_layout', 'classic' ) );
		}
	} // end function blover_infinite_scroll_render
endif;
