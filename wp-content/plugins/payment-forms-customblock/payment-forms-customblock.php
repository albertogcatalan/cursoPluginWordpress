<?php
/*
 * Plugin Name: Payment Forms CustomBlock
 * Description: Bloque de formularios de Stripe con Gutenberg
 * Author: Alberto González
 * Version: 1.1
 * Author URI: https://albertogcatalan.com
 * Text Domain: stripe-forms-gutenberg
 * Domain Path: /languages
 */

if (!defined('ABSPATH'))
exit;

// constantes
define('PFCB_NAME', 'Stripe Forms Gutenberg');
define('PFCB_PATH', plugin_dir_path(__FILE__));
define('PFCB_ADMIN_PATH', plugin_dir_path(__FILE__).'/admin/');
define('PFCB_REQUIRE_PLUGIN', 'hello.php');

// carga inicial de plugin
function plugins_loaded() {
    $error = true;

    // comprobamos si tenemos el plugin hello dolly
    $active_plugins = (array) get_option('active_plugins', array());
    foreach ($active_plugins as $plugin) {
        if ($plugin == PFCB_REQUIRE_PLUGIN) {
            $error = false;
        }
    }

    // comprobamos si hay errores para mostrar mensaje o activar plugin
    if ($error) {
        add_action( 'admin_notices', 'display_error');

        return null;
    }

    // función para añadir el menu
    function pfcb_menu()
    {
        add_menu_page(PFCB_NAME, PFCB_NAME, 'manage_options', PFCB_ADMIN_PATH.'options.php');
    }
    add_action('admin_menu', 'pfcb_menu');

    // función para registrar las opciones
    function pfcb_settings()
    {
        register_setting('stripe-forms-gutenberg-settings-group', 'stripe_forms_gutenberg_api_secret');
        register_setting('stripe-forms-gutenberg-settings-group', 'stripe_forms_gutenberg_api_public');
    }
    add_action('admin_init', 'pfcb_settings');

    // función para registrar el bloque en gutenberg
    function pfcb_register_block()
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
    add_action('init', 'pfcb_register_block');

    // función para registrar el js
    function pfcb_register_js()
    {
        if (!empty(get_option('stripe_forms_gutenberg_api_secret')) 
            && !empty(get_option('stripe_forms_gutenberg_api_public'))
            && isset($_GET['gutenbergstripeform'])) {
            wp_enqueue_script('pfcb-stripe-checkout','https://js.stripe.com/v3/', array('jquery'), 1, true);
        }
    }
    add_action( 'wp_enqueue_scripts', 'pfcb_register_js');

    // función para registrar el bloque en gutenberg
    function pfcb_url()
    {
        if (isset($_GET['gutenbergstripeform'])) {

            require 'stripe/index.php';
            exit;
        }
    }
    add_action('parse_request', 'pfcb_url');
    add_action('init', 'pfcb_url');
}

function display_error() {
    ?>
    <div class="error">
        <p><strong><?php esc_html_e( PFCB_NAME, 'stripe-forms-gutenberg' ); ?></strong></p>

        <p><?php esc_html_e( 'Para poder utilizar este plugin es necesario activar el plugin: ' . PFCB_REQUIRE_PLUGIN, 'stripe-forms-gutenberg' ); ?></p>
        
    </div>
    <?php
}

add_action('plugins_loaded', 'plugins_loaded');


