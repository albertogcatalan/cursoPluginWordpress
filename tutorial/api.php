<?php
/**
 * Template Name: API
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			
			$api_response = wp_remote_post('http://cursowordpress.local/wp-json/wp/v2/tags', array(
				'headers' => array(
					'Authorization' => 'Basic ' . base64_encode( 'admin:admin' )
				),
			   'body' => array(
					'name'   => 'prueba3',
					'slug'  => 'prueba3',
			   	)
			));

			var_dump($api_response);
			
		   $body = json_decode( $api_response['body'] );
			
		   // you can always print_r to look what is inside
		   var_dump( $body ); // or print_r( $api_response );
			
			if (wp_remote_retrieve_response_message( $api_response ) === 'Created' ) {
				echo 'The post ' . $body->name . ' has been created successfully';
			}


			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();
