<?php
/*
 * Plugin Name: Payment Forms CustomBlock
 * Description: Bloque de formularios de Stripe con Gutenberg
 * Author: Alberto González
 * Version: 1.0.0
 * Author URI: https://albertogcatalan.com
 * Text Domain: stripe-forms-gutenberg
 * Domain Path: /languages
 */

if (!defined('ABSPATH'))
exit;

// constantes
define('STRIPEFG_NAME', 'Stripe Forms Gutenberg');
define('STRIPEFG_PATH', plugin_dir_path(__FILE__));
define('STRIPEFG_ADMIN_PATH', plugin_dir_path(__FILE__).'/admin/');

// función para añadir el menu
function stripe_forms_gutenberg_menu()
{
    add_menu_page(STRIPEFG_NAME, STRIPEFG_NAME, 'manage_options', STRIPEFG_ADMIN_PATH.'options.php');
}
add_action('admin_menu', 'stripe_forms_gutenberg_menu');

// función para registrar las opciones
function stripe_forms_gutenberg_settings()
{
    register_setting('stripe-forms-gutenberg-settings-group', 'stripe_forms_gutenberg_api_secret');
    register_setting('stripe-forms-gutenberg-settings-group', 'stripe_forms_gutenberg_api_public');
}
add_action('admin_init', 'stripe_forms_gutenberg_settings');

// función para registrar el bloque en gutenberg
function gutenberg_stripe_forms_register_block()
{
    wp_register_script(
        'stripe-forms',
        plugins_url('stripe-block.js', __FILE__),
        array('wp-blocks', 'wp-element', 'wp-i18n'),
        filemtime(plugin_dir_path(__FILE__).'stripe-block.js')
    );

    register_block_type('gutenberg-alberto/stripe-forms', array(
        'editor_script' => 'stripe-forms'
    ) );

    wp_localize_script(
        'stripe-forms',
        'custom_data',
        [
            'siteUrl' => get_site_url()
        ]
    );
}
add_action('init', 'gutenberg_stripe_forms_register_block');

// función para reigstrar el bloque en gutenberg
function gutenberg_stripe_forms_url()
{
    if (isset($_GET['gutenbergstripeform'])) {
        require 'stripe/index.php';
        exit;
    }
}
add_action('parse_request', 'gutenberg_stripe_forms_url');
add_action('init', 'gutenberg_stripe_forms_url');