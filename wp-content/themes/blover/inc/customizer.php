<?php
/**
 * Blover Theme Customizer.
 *
 * @package blover
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blover_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_setting(
		'link_hover_color',
		array(
			'type' => 'theme_mod',
			'default' => '#a0946b',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_hover_color',
			array(
				'label' => esc_html__( 'Link hover color', 'blover' ),
				'section' => 'colors',
				'priority' => 105,
			)
		)
	);

	$wp_customize->add_setting(
		'sidebar_bg_color_1',
		array(
			'type' => 'theme_mod',
			'default' => '#f8f8f8',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'sidebar_bg_color_1',
			array(
				'label' => esc_html__( 'Sidebar Background Color 1', 'blover' ),
				'section' => 'colors',
				'priority' => 110,
			)
		)
	);

	$wp_customize->add_setting(
		'sidebar_bg_color_2',
		array(
			'type' => 'theme_mod',
			'default' => '#f8f8f8',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'sidebar_bg_color_2',
			array(
				'label' => esc_html__( 'Sidebar Background Color 2', 'blover' ),
				'section' => 'colors',
				'priority' => 120,
			)
		)
	);

	$wp_customize->add_setting(
		'sidebar_bg_color_3',
		array(
			'type' => 'theme_mod',
			'default' => '#f8f8f8',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'sidebar_bg_color_3',
			array(
				'label' => esc_html__( 'Sidebar Background Color 3', 'blover' ),
				'section' => 'colors',
				'priority' => 130,
			)
		)
	);

	$wp_customize->add_setting(
		'footer_bg_color',
		array(
			'type' => 'theme_mod',
			'default' => '#f8f8f8',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_bg_color',
			array(
				'label' => esc_html__( 'Footer Widget Area Background Color', 'blover' ),
				'section' => 'colors',
				'priority' => 130,
			)
		)
	);

	// Section Blog Home Page.
	$wp_customize->add_section(
		'home_page',
		array(
			'title' => esc_html__( 'Homepage (Blover)', 'blover' ),
			'priority' => 1000,
			'description' => esc_html__( 'Blog Home Page Settings', 'blover' ),
		)
	);

	$wp_customize->add_setting(
		'home_page_layout',
		array(
			'default' => 'classic',
			'sanitize_callback' => 'blover_sanitize_select_home_page_layout',
		)
	);

	$wp_customize->add_control(
		'home_page_layout',
		array(
			'label' => esc_html__( 'Blog Home Page Layout', 'blover' ),
			'section' => 'home_page',
			'type' => 'select',
			'choices' => array(
				'masonry' => esc_html__( 'Masonry + Sidebar', 'blover' ),
				'list' => esc_html__( 'List + Sidebar', 'blover' ),
				'' => esc_html__( 'Masonry (No Sidebar)', 'blover' ),
				'classic' => esc_html__( 'Classic (One Column)', 'blover' ),
			),
		)
	);

	$wp_customize->add_setting(
		'home_page_slider_height',
		array(
			'default' => 740,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'home_page_slider_height',
		array(
			'label' => esc_html__( 'Height of Home Page Slider', 'blover' ),
			'section' => 'home_page',
			'description' => esc_html__( '(in pixels)', 'blover' ),
			'type' => 'number',
			'input_attrs' => array(
				'min' => 100,
				'max' => 1000,
				'step' => 1,
			),
		)
	);

	$wp_customize->add_setting(
		'home_page_slider_img_size',
		array(
			'default' => 'full',
			'sanitize_callback' => 'blover_sanitize_select_img_size',
		)
	);

	$wp_customize->add_control(
		'home_page_slider_img_size',
		array(
			'label' => esc_html__( 'Slider Image Size', 'blover' ),
			'section' => 'home_page',
			'description' => esc_html__( 'From >Settings>Media', 'blover' ),
			'type' => 'select',
			'choices' => array(
				'thumbnail' => esc_html__( 'Thumbnail', 'blover' ),
				'medium' => esc_html__( 'Medium', 'blover' ),
				'large' => esc_html__( 'Large', 'blover' ),
				'full' => esc_html__( 'Full', 'blover' ),
			),
		)
	);

	$wp_customize->add_setting(
		'home_page_slider_play_speed',
		array(
			'default' => 4000,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'home_page_slider_play_speed',
		array(
			'label' => esc_html__( 'Sliding speed of Home Page Slider (in ms)', 'blover' ),
			'section' => 'home_page',
			'description' => esc_html__( '0 to disable autoplay', 'blover' ),
			'type' => 'number',
			'input_attrs' => array(
				'min' => 0,
				'max' => 10000,
				'step' => 100,
			),
		)
	);

	$wp_customize->add_setting(
		'home_page_latest_posts_text',
		array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'home_page_latest_posts_text',
		array(
			'label' => esc_html__( 'Enable Latest Posts Text', 'blover' ),
			'section' => 'home_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'home_page_display_content',
		array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'home_page_display_content',
		array(
			'label' => esc_html__( 'Display Content (or Excerpt) on Home and Archive Pages.', 'blover' ),
			'section' => 'home_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'home_page_show_featured_images',
		array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'home_page_show_featured_images',
		array(
			'label' => esc_html__( 'Show Featured Images on Homepage', 'blover' ),
			'section' => 'home_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'hide_title_on_home_archive',
		array(
			'default' => 0,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'hide_title_on_home_archive',
		array(
			'label' => esc_html__( 'Hide Titles On Home Page/Archive Pages', 'blover' ),
			'section' => 'home_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'hide_meta_on_home_archive',
		array(
			'default' => 0,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'hide_meta_on_home_archive',
		array(
			'label' => esc_html__( 'Hide Meta On Home Page/Archive Pages', 'blover' ),
			'section' => 'home_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'pagination',
		array(
			'default' => 'ajax',
			'sanitize_callback' => 'blover_sanitize_pagination',
		)
	);

	$wp_customize->add_control(
		'pagination',
		array(
			'label' => esc_html__( 'Pagination Style', 'blover' ),
			'section' => 'home_page',
			'type' => 'select',
			'choices' => array(
				'ajax' => esc_html__( 'Load More Button', 'blover' ),
				'infinite' => esc_html__( 'Infinite Scrolling', 'blover' ),
				'' => esc_html__( 'Page Numbers', 'blover' ),
			),
		)
	);

	$wp_customize->add_setting(
		'wpp_img_size',
		array(
			'default' => 'medium',
			'sanitize_callback' => 'blover_sanitize_select_img_size',
		)
	);

	$wp_customize->add_control(
		'wpp_img_size',
		array(
			'label' => esc_html__( 'Popular Posts Image Size', 'blover' ),
			'section' => 'home_page',
			'description' => esc_html__( 'From >Settings>Media', 'blover' ),
			'type' => 'select',
			'choices' => array(
				'thumbnail' => esc_html__( 'Thumbnail', 'blover' ),
				'medium' => esc_html__( 'Medium', 'blover' ),
				'large' => esc_html__( 'Large', 'blover' ),
				'full' => esc_html__( 'Full', 'blover' ),
			),
		)
	);

	$wp_customize->add_setting(
		'home_page_show_sticky',
		array(
			'default' => 0,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'home_page_show_sticky',
		array(
			'label' => esc_html__( 'Show Sticky Posts Below Slider', 'blover' ),
			'section' => 'home_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'show_content_or_excerpt',
		array(
			'default' => 'content',
			'sanitize_callback' => 'blover_sanitize_select_show_content_or_excerpt',
		)
	);

	$wp_customize->add_control(
		'show_content_or_excerpt',
		array(
			'label' => esc_html__( 'What To Show On Home and Archive Pages:', 'blover' ),
			'section' => 'home_page',
			'type' => 'select',
			'choices' => array(
				'excerpt' => esc_html__( 'Excerpt', 'blover' ),
				'content' => esc_html__( 'Content', 'blover' ),
			),
		)
	);

	$wp_customize->add_setting(
		'excerpt_length',
		array(
			'default' => 55,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'excerpt_length',
		array(
			'label' => esc_html__( 'Excerpt Length', 'blover' ),
			'section' => 'home_page',
			'description' => esc_html__( '(in words)', 'blover' ),
			'type' => 'number',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
		)
	);

	// Section Single Page.
	$wp_customize->add_section(
		'single_page',
		array(
			'title' => esc_html__( 'Single Post', 'blover' ),
			'priority' => 1010,
			'description' => esc_html__( 'Single Post Settings', 'blover' ),
		)
	);

	$wp_customize->add_setting(
		'single_post_sidebar',
		array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'single_post_sidebar',
		array(
			'label' => esc_html__( 'Show Sidebar', 'blover' ),
			'section' => 'single_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'single_post_show_featured_image',
		array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'single_post_show_featured_image',
		array(
			'label' => esc_html__( 'Show Featured Images In Standard Posts', 'blover' ),
			'section' => 'single_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'single_page_related_posts_show',
		array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'single_page_related_posts_show',
		array(
			'label' => esc_html__( 'Show Related Posts.', 'blover' ),
			'section' => 'single_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'single_page_related_posts_title',
		array(
			'default' => esc_html__( 'You May Also Like', 'blover' ),
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_control(
		'single_page_related_posts_title',
		array(
			'label' => esc_html__( 'Related Posts Header Text', 'blover' ),
			'section' => 'single_page',
			'type' => 'text',
		)
	);

	$wp_customize->add_setting(
		'single_post_navigation',
		array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'single_post_navigation',
		array(
			'label' => esc_html__( 'Enable Single Post Navigation', 'blover' ),
			'section' => 'single_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'single_page_related_posts_by_tag_or_cat',
		array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'single_page_related_posts_by_tag_or_cat',
		array(
			'label' => esc_html__( 'Show Related Posts By Categories (Else by Tags).', 'blover' ),
			'section' => 'single_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'single_post_navigation_next_label',
		array(
			'default' => esc_html__( 'Next Article', 'blover' ),
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_control(
		'single_post_navigation_next_label',
		array(
			'label' => esc_html__( 'Single Post Navigation Next Post Label', 'blover' ),
			'section' => 'single_page',
			'type' => 'text',
		)
	);

	$wp_customize->add_setting(
		'single_post_navigation_previous_label',
		array(
			'default' => esc_html__( 'Previous Article', 'blover' ),
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_control(
		'single_post_navigation_previous_label',
		array(
			'label' => esc_html__( 'Single Post Navigation Previous Post Label', 'blover' ),
			'section' => 'single_page',
			'type' => 'text',
		)
	);

	$wp_customize->add_setting(
		'single_post_navigation_only_category',
		array(
			'default' => 0,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'single_post_navigation_only_category',
		array(
			'label' => esc_html__( 'Navigate Only In The Same Category', 'blover' ),
			'section' => 'single_page',
			'type' => 'checkbox',
		)
	);

	// Section Custom Header.
	$wp_customize->add_setting(
		'show_full_width_image_in_header',
		array(
			'default' => 0,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'show_full_width_image_in_header',
		array(
			'label' => esc_html__( 'Show Full Width Image', 'blover' ),
			'section' => 'header_image',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'enable_padding_for_image_in_header',
		array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'enable_padding_for_image_in_header',
		array(
			'label' => esc_html__( 'Enable Padding for Header Image', 'blover' ),
			'section' => 'header_image',
			'type' => 'checkbox',
		)
	);

	// Section - "WooCommerce settings".
	$wp_customize->add_section(
		'woocommerce_settings',
		array(
			'title' => esc_html__( 'WooCommerce (Blover)', 'blover' ),
			'priority' => 1040,
			'description' => esc_html__( 'WooCommerce Settings', 'blover' ),
		)
	);

	$wp_customize->add_setting(
		'woocommerce_sidebar',
		array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'woocommerce_sidebar',
		array(
			'label' => esc_html__( 'Enable Sidebar on Shop Page', 'blover' ),
			'section' => 'woocommerce_settings',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'woocommerce_show_page_title',
		array(
			'default' => 0,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'woocommerce_show_page_title',
		array(
			'label' => esc_html__( 'Enable Page Title on Shop Page', 'blover' ),
			'section' => 'woocommerce_settings',
			'type' => 'checkbox',
		)
	);

	// Section - "other settings".
	$wp_customize->add_section(
		'other_settings',
		array(
			'title' => esc_html__( 'Advanced', 'blover' ),
			'priority' => 1050,
			'description' => esc_html__( 'Advanced Settings', 'blover' ),
		)
	);

	$wp_customize->add_setting(
		'show_top_menu_width',
		array(
			'default' => 978,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'show_top_menu_width',
		array(
			'label' => esc_html__( 'When to Hide/Show Top Menu (in px)', 'blover' ),
			'section' => 'other_settings',
			'type' => 'number',
			'input_attrs' => array(
				'min' => 1,
				'max' => 1200,
				'step' => 1,
			),
		)
	);

	$wp_customize->add_setting(
		'sticky_sidebar',
		array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'sticky_sidebar',
		array(
			'label' => esc_html__( 'Enable Sticky Sidebar', 'blover' ),
			'section' => 'other_settings',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'wpp_styling',
		array(
			'default' => 0,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'wpp_styling',
		array(
			'label' => esc_html__( 'Enable WordPress Popular Posts Original Output (needs page refresh)', 'blover' ),
			'section' => 'other_settings',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'load_google_fonts_from_google',
		array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'load_google_fonts_from_google',
		array(
			'label' => esc_html__( 'Load fonts from Google servers', 'blover' ),
			'section' => 'other_settings',
			'type' => 'checkbox',
		)
	);
}

add_action( 'customize_register', 'blover_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blover_customize_preview_js() {
	wp_enqueue_script( 'blover_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}

add_action( 'customize_preview_init', 'blover_customize_preview_js' );

/**
 * Sanitize select home_page_layout
 *
 * @param type $value user input.
 * @return type
 */
function blover_sanitize_select_home_page_layout( $value ) {
	if ( in_array( $value, array( '', 'list', 'masonry', 'classic' ), true ) ) {
		return $value;
	}
}

/**
 * Sanitize select pagination
 *
 * @param type $value user input.
 * @return type
 */
function blover_sanitize_pagination( $value ) {
	if ( in_array( $value, array( 'ajax', 'infinite', '' ), true ) ) {
		return $value;
	}
}

/**
 * Sanitize select.
 *
 * @param type $value user input.
 * @return type
 */
function blover_sanitize_select_img_size( $value ) {
	if ( in_array( $value, array( 'thumbnail', 'medium', 'large', 'full' ), true ) ) {
		return $value;
	}
	return 'full';
}

/**
 * Sanitize select.
 *
 * @param type $value user input.
 * @return type
 */
function blover_sanitize_select_show_content_or_excerpt( $value ) {
	if ( in_array( $value, array( 'content', 'excerpt' ), true ) ) {
		return $value;
	} else {
		return 'content';
	}
}
