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
define('PFCB_BASENAME', plugin_basename(__FILE__));

register_setting('stripe-forms-gutenberg-settings-group', 'stripe_forms_gutenberg_premium_key');

class PruebaExtension
{
    public function __construct()
    {
        $this->register_callbacks();
    }

    protected function register_callbacks()
    {
        add_action( 'showExtensionText', array( $this, 'showExtensionText' ) );
    }

    public function showExtensionText()
    {
        ?>
        <div class="wrap">
            <p><?php esc_html_e( 'Texto', 'stripe-forms-gutenberg' ); ?></p>        
        </div>
         <?php
    }
}

//$a = new PruebaExtension();
//$a->showExtensionText();
//do_action('showExtensionText');


function plugins_loaded() {
    $error = true;

    $active_plugins = (array) get_option('active_plugins', array());
    foreach ($active_plugins as $plugin) {
        if ($plugin == PFCB_REQUIRE_PLUGIN) {
            $error = false;
        }
    }

    if ($error) {
        add_action('admin_notices', 'display_error');

        return null;
    }

    function isPremium()
    {
        $key = get_option('stripe_forms_gutenberg_premium_key');
        if ($key == '1234') {
            return true;
        }

        return false;
    }

    $isPremium = isPremium();

    if (!$isPremium) {
        add_filter('plugin_action_links_'.PFCB_BASENAME, 'pfcb_custom_link_premium');
    }

    // función para añadir enlace custom en listado plugin
    function pfcb_custom_link_premium($links)
    {
        $links[] = '<a href="#" target="_blank" rel="noopener noreferrer"><strong style="color: green; display: inline;">Actualizar a Premium</strong></a>';

        return $links;
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
        <p><strong><?php esc_html_e(PFCB_NAME, 'stripe-forms-gutenberg') ?></strong></p>
        <p><?php esc_html_e('Para poder utilizar este plugin es necesario activar el plugin: ' . PFCB_REQUIRE_PLUGIN, 'stripe-forms-gutenberg') ?></p>
    </div>
    <?php
}

add_action('plugins_loaded', 'plugins_loaded');