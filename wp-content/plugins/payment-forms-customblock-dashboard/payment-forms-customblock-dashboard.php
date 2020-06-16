<?php
/*
 * Plugin Name: Payment Forms CustomBlock Dashboard
 * Description: Extensión para ver el panel de cobros de Stripe
 * Author: Alberto González
 * Version: 1.0
 * Author URI: https://albertogcatalan.com
 * Text Domain: stripe-forms-gutenberg
 * Domain Path: /languages
 */

if (!defined('ABSPATH'))
exit;

// constantes
define('PFCBD_NAME', 'Stripe Forms Gutenberg Dashboard');
define('PFCBD_PATH', plugin_dir_path(__FILE__));
define('PFCBD_ADMIN_PATH', plugin_dir_path(__FILE__).'/admin/');
define('PFCBD_REQUIRE_PLUGIN', 'payment-forms-customblock/payment-forms-customblock.php');
define('PFCBD_BASENAME', plugin_basename(__FILE__));

function pfcbd_init()
{
    $error = true;

    $active_plugins = (array) get_option('active_plugins', array());
    foreach ($active_plugins as $plugin) {
        if ($plugin == PFCBD_REQUIRE_PLUGIN) {
            $error = false;
        }
    }

    if ($error) {
        add_action('admin_notices', 'pfcbd_display_error');

        return null;
    }

    function pfcbd_menu()
    {
        add_menu_page(PFCB_NAME, PFCB_NAME, 'manage_options', PFCBD_ADMIN_PATH.'dashboard.php');
        add_submenu_page(
            PFCBD_ADMIN_PATH.'dashboard.php',
            PFCBD_NAME,
            __('Dashboard', 'stripe-forms-gutenberg'),
            'manage_options',
            PFCBD_ADMIN_PATH.'dashboard.php'
        );
        add_submenu_page(
            PFCBD_ADMIN_PATH.'dashboard.php',
            __('Opciones', 'stripe-forms-gutenberg'),
            __('Opciones', 'stripe-forms-gutenberg'),
            'manage_options',
            PFCB_ADMIN_PATH.'options.php'
        );
    }
    add_action('admin_menu', 'pfcbd_menu');
}

function pfcbd_display_error() {
    ?>
    <div class="error">
        <p><strong><?php esc_html_e(PFCBD_NAME, 'stripe-forms-gutenberg') ?></strong></p>
        <p><?php esc_html_e('Para poder utilizar este plugin es necesario activar el plugin: ' . PFCBD_REQUIRE_PLUGIN, 'stripe-forms-gutenberg') ?></p>
    </div>
    <?php
}

add_action('plugins_loaded', 'pfcbd_init');