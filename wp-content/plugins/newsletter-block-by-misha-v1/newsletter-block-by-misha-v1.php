<?php
/*
 * Plugin name: Newsletter block for Gutenberg
 * Plugin URI: https://rudrastyh.com/gutenberg/create-a-block.html
 * Version: 1.0
 * Author: Misha Rudrastyh
 * Author URI: https://rudrastyh.com
 */

add_action( 'enqueue_block_editor_assets', 'misha_block_assets' );

function misha_block_assets(){

	wp_enqueue_script(
 		'misha-newsletter',
		plugin_dir_url( __FILE__ ) . 'assets/block-newsletter.js',
		array( 'wp-blocks', 'wp-element' ),
		filemtime( dirname( __FILE__ ) . '/assets/block-newsletter.js' )
	);

	wp_enqueue_style(
		'misha-newsletter-css',
		plugin_dir_url( __FILE__ ) . 'assets/block-newsletter.css',
		array( 'wp-edit-blocks' ),
		filemtime( dirname( __FILE__ ) . '/assets/block-newsletter.css' )
	);

}


add_action( 'wp_enqueue_scripts', 'misha_block_front_end_assets' );

function misha_block_front_end_assets(){

	wp_enqueue_style(
		'wp-block-misha-newsletter-css',
		plugin_dir_url( __FILE__ ) . 'assets/newsletter.css',
		array(),
		filemtime( dirname( __FILE__ ) . '/assets/newsletter.css' )
	);

}
