<?php
/**
 * Template Name: Mi API
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
			
			/*$api_response = wp_remote_post('http://cursowordpress.local/wp-json/wp/v2/users/', array(
				'headers' => array(
					'Authorization' => 'Basic ' . base64_encode('admin:admin'),
				),
				'body' => array(
					'username' => 'usuarioprueba1',
					'email' => 'usuarioprueba1@correo.com',
					'password' => '1234'
				)
			));*/

			/*$api_response = wp_remote_post('http://cursowordpress.local/wp-json/wp/v2/users/4', array(
				'headers' => array(
					'Authorization' => 'Basic ' . base64_encode('admin:admin'),
				),
				'body' => array(
					'roles' => 'administrator',
				)
			));*/

			/*$api_response = wp_remote_get('http://cursowordpress.local/wp-json/wp/v2/users/4', array(
				'headers' => array(
					'Authorization' => 'Basic ' . base64_encode('admin:admin'),
				),
			));*/

			$api_response = wp_remote_request('http://cursowordpress.local/wp-json/wp/v2/users/4?reassign=1&force=true', array(
				'headers' => array(
					'Authorization' => 'Basic ' . base64_encode('admin:admin'),
				),
				'method' => 'DELETE'
			));

			var_dump($api_response);

			$body = json_decode($api_response['body']);

			var_dump($body);

			if (wp_remote_retrieve_response_message($api_response) === 'OK') {

				if ($body->deleted === true) {
					echo "Usuario eliminado:";
					echo "<br>";
					echo "Usuario: ".$body->previous->name;
					echo "<br>";
					echo "<img src='".rest_get_avatar_urls($body->previous->id)['96']."'>";
				}
				

			}


			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();
