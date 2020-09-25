<?php
/*
Plugin Name: Striperks
Plugin URI: 
Description: 
Version: 
Author: 
Author URI: 
License: 
License URI: 
*/

function striperks_init()
{
    // Comprobamos si eres usuario de pago en RCP
    

    // Cargamos url
    function striperks_load_url()
    {
        function my_the_content_filter(){
            if(is_page('webapp')) {
                include '/path/to/myscript.php';
            }
        }
        add_filter( 'the_content', 'my_the_content_filter' );
    }
    
    add_action( 'init', 'wpse9870_init_internal' );
    function wpse9870_init_internal()
    {
        add_rewrite_rule( 'stripe-command/public/index.php$', 'index.php?webapp=1', 'top' );
    }

    add_filter( 'query_vars', 'wpse9870_query_vars' );
    function wpse9870_query_vars( $query_vars )
    {
        $query_vars[] = 'webapp';
        return $query_vars;
    }

    add_action( 'parse_request', 'wpse9870_parse_request' );
    function wpse9870_parse_request( &$wp )
    {
        if ( array_key_exists( 'webapp', $wp->query_vars ) ) {
            include 'stripe-command/bootstrap.php';
            exit();
        }
        return;
    } 

}
add_action('plugins_loaded', 'striperks_init');