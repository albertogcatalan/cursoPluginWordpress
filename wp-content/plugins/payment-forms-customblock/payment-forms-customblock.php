<?php
/*
 * Plugin Name: Payment Forms CustomBlock
 * Description: Bloque de formularios de Stripe con Gutenberg
 * Author: Alberto González
 * Version: 1.2
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
define('PFCB_EXTENSION', 'payment-forms-customblock-dashboard/payment-forms-customblock-dashboard.php');
define('PFCB_BASENAME', plugin_basename(__FILE__));

function pfcb_init()
{
    function pfcb_check_extension()
    {
        $extension = false;

        $active_plugins = (array) get_option('active_plugins', array());
        foreach ($active_plugins as $plugin) {
            if ($plugin == PFCB_EXTENSION) {
                $extension = true;
            }
        }

        return true;
    }

    function pfcb_isPremium()
    {
        $key = get_option('stripe_forms_gutenberg_premium_key');
        if ($key == '1234') {
            return true;
        }

        return false;
    }

    $isPremium = pfcb_isPremium();

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
    $extensionEnabled = pfcb_check_extension();
    if (!$extensionEnabled) {
        add_action('admin_menu', 'pfcb_menu');
    }

    // función para registrar las opciones
    function pfcb_settings()
    {
        register_setting('stripe-forms-gutenberg-settings-group', 'stripe_forms_gutenberg_api_secret');
        register_setting('stripe-forms-gutenberg-settings-group', 'stripe_forms_gutenberg_api_public');
        register_setting('stripe-forms-gutenberg-settings-group', 'stripe_forms_gutenberg_premium_key');
        register_setting('stripe-forms-gutenberg-settings-group', 'stripe_forms_gutenberg_plan');
    }
    add_action('admin_init', 'pfcb_settings');

    // función para registrar el bloque en gutenberg
    function pfcb_register_block($isPremium)
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

        if ($isPremium) {
            wp_register_script(
                'stripe-suscription',
                plugins_url('stripe-sus.js', __FILE__),
                array('wp-blocks', 'wp-element', 'wp-i18n'),
                filemtime(plugin_dir_path(__FILE__).'stripe-sus.js')
            );
    
            register_block_type('pfcb-suscription/stripe-suscription', array(
                'editor_script' => 'stripe-suscription'
            ) );
    
            wp_localize_script(
                'stripe-suscription',
                'custom_data',
                [
                    'siteUrl' => get_site_url()
                ]
            );
        }
    }
    add_action('init', function() use ($isPremium) {
        pfcb_register_block($isPremium);
    });

    // función para registrar el js
    function pfcb_register_js()
    {
        if (!empty(get_option('stripe_forms_gutenberg_api_secret')) 
            && !empty(get_option('stripe_forms_gutenberg_api_public'))
            && (isset($_GET['gutenbergstripeform']) || isset($_GET['gutenbergstripeformsus']))) {
            wp_enqueue_script('pfcb-stripe-checkout','https://js.stripe.com/v3/', array('jquery'), 1, true);
        }

        if (!current_theme_supports('pfcb_style')) {
            wp_enqueue_style('pfcb-css', plugins_url('assets/plugin.css', __FILE__));
        } 
    }
    add_action( 'wp_enqueue_scripts', 'pfcb_register_js');

    // función para crear shortcode
    function pfcb_shortcode($params)
    {
        $url = get_site_url().'?gutenbergstripeform';
        return "<iframe src='$url' frameborder=0></iframe>";

    }
    add_shortcode('pfcb_stripe_checkout', 'pfcb_shortcode');

    // función para registrar el bloque en gutenberg
    function pfcb_url($isPremium)
    {
        if (isset($_GET['gutenbergstripeform'])) {

            require 'stripe/index.php';
            exit;
        }

        if ($isPremium) {
            if (isset($_GET['gutenbergstripeformsus'])) {

                require 'stripe/index_sus.php';
                exit;
            }
        }
    }
    add_action('parse_request', 'pfcb_url', 10, 1);
}

add_action('plugins_loaded', 'pfcb_init');