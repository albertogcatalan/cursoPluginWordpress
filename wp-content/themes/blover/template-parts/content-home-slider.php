<?php
/**
 * Template part for displaying header slider.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blover
 */

$blover_sticky_posts = get_option( 'sticky_posts' );
if ( ! empty( $blover_sticky_posts ) ) :

	$blover_args = array(
		'posts_per_page'   => 10,
		'post__in'          => $blover_sticky_posts,
		'post_type'        => 'post',
	);

	$blover_the_slider = new WP_Query( $blover_args ); ?>

		<div id="slider-container">
				<div class="featured-posts">
					<div class="blover-featured-slider">
					<?php if ( $blover_the_slider->have_posts() ) : ?>
						<?php
						while ( $blover_the_slider->have_posts() ) :
							$blover_the_slider->the_post();
							?>
								<div class="blover-featured-slider-wrapper">
									<?php if ( has_post_thumbnail() ) : ?>
									 <div class="featured-image" style="background:#000 url(<?php the_post_thumbnail_url( get_theme_mod( 'home_page_slider_img_size', 'full' ) ); ?>) no-repeat center;background-size: cover;">
										<div class="blover-featured-slider-title-wrapper container">
											<div class="row">
											 <div class="blover-featured-slider-title col-sm-12 col-lg-6">
														<span class="featured-category">
														<?php the_category( __( '<span> &#124; </span>', 'blover' ) ); ?>
														</span>
														<h2 class="blover-featured-slider-header"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
											 </div>
										 </div>
										<?php echo blover_post_format_icon( $blover_the_slider->ID ); // WPCS: XSS OK. ?>
										</div>
										</div>
									<?php else : ?>
									<div class="no-featured-image">
										<div class="blover-featured-slider-title-wrapper container">
											<div class="row">
											<div class="blover-featured-slider-title col-sm-12 col-lg-6">
												<span class="featured-category">
												<?php the_category( __( '<span> &#124; </span>', 'blover' ) ); ?>
												</span>
												<h2 class="blover-featured-slider-header"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
											</div>
											</div>
											</div>
									</div>
									<?php endif; ?>
								</div>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
					</div>
				</div>
		</div>
<?php endif; ?>
