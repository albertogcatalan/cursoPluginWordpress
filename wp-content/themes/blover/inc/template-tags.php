<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package blover
 */

if ( ! function_exists( 'blover_posted_on' ) ) :

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function blover_posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( is_single() ) {

			$time_string = sprintf(
				$time_string,
				esc_attr( get_the_date( 'c' ) ),
				human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) )
			);

			$posted_on = sprintf(
				// Translators: post date in "ago" format.
				esc_html_x( '%s ago', 'post date', 'blover' ),
				'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			);

			$byline = '<span class="author vcard">' . get_avatar( get_the_author_meta( 'ID' ) ) . '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

			echo '<span class="byline"> ' . $byline . '</span><div class="blover-posted-on-sharing-wrapper"><span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
			blover_jetpack_sharing();
			echo '</div>';
		} else {

			$time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_attr( get_the_date() ) );

			$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

			echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
		}
	}

endif;

if ( ! function_exists( 'blover_entry_footer' ) ) :

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function blover_entry_footer() {

		blover_jetpack_sharing();
		// Hide category and tag text for pages.
		if ( is_single() && 'post' === get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'blover' ) );
			if ( $tags_list ) {
				// Translators: tag list.
				printf( '<span class="tags-links">' . esc_html__( 'Tagged: %1$s', 'blover' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( '<span><svg width="18" height="18"><path d="M14.143 7.714q0 1.396-0.944 2.581t-2.576 1.873-3.551 0.688q-0.864 0-1.768-0.161-1.246 0.884-2.792 1.286-0.362 0.090-0.864 0.161h-0.030q-0.11 0-0.206-0.080t-0.116-0.211q-0.010-0.030-0.010-0.065t0.005-0.065 0.020-0.060l0.025-0.050t0.035-0.055 0.040-0.050 0.045-0.050 0.040-0.045q0.050-0.060 0.231-0.251t0.261-0.296 0.226-0.291 0.251-0.387 0.206-0.442q-1.246-0.723-1.959-1.778t-0.713-2.25q0-1.396 0.944-2.581t2.576-1.873 3.551-0.688 3.551 0.688 2.576 1.873 0.944 2.581zM18 10.286q0 1.205-0.713 2.255t-1.959 1.773q0.1 0.241 0.206 0.442t0.251 0.387 0.226 0.291 0.261 0.296 0.231 0.251q0.010 0.010 0.040 0.045t0.045 0.050 0.040 0.050 0.035 0.055l0.025 0.050t0.020 0.060 0.005 0.065-0.010 0.065q-0.030 0.141-0.131 0.221t-0.221 0.070q-0.502-0.070-0.864-0.161-1.547-0.402-2.792-1.286-0.904 0.161-1.768 0.161-2.722 0-4.741-1.326 0.583 0.040 0.884 0.040 1.617 0 3.104-0.452t2.652-1.296q1.256-0.924 1.929-2.129t0.673-2.551q0-0.773-0.231-1.527 1.296 0.713 2.049 1.788t0.753 2.31z"></path></svg></span>', '<span><svg width="18" height="18"><path d="M14.143 7.714q0 1.396-0.944 2.581t-2.576 1.873-3.551 0.688q-0.864 0-1.768-0.161-1.246 0.884-2.792 1.286-0.362 0.090-0.864 0.161h-0.030q-0.11 0-0.206-0.080t-0.116-0.211q-0.010-0.030-0.010-0.065t0.005-0.065 0.020-0.060l0.025-0.050t0.035-0.055 0.040-0.050 0.045-0.050 0.040-0.045q0.050-0.060 0.231-0.251t0.261-0.296 0.226-0.291 0.251-0.387 0.206-0.442q-1.246-0.723-1.959-1.778t-0.713-2.25q0-1.396 0.944-2.581t2.576-1.873 3.551-0.688 3.551 0.688 2.576 1.873 0.944 2.581zM18 10.286q0 1.205-0.713 2.255t-1.959 1.773q0.1 0.241 0.206 0.442t0.251 0.387 0.226 0.291 0.261 0.296 0.231 0.251q0.010 0.010 0.040 0.045t0.045 0.050 0.040 0.050 0.035 0.055l0.025 0.050t0.020 0.060 0.005 0.065-0.010 0.065q-0.030 0.141-0.131 0.221t-0.221 0.070q-0.502-0.070-0.864-0.161-1.547-0.402-2.792-1.286-0.904 0.161-1.768 0.161-2.722 0-4.741-1.326 0.583 0.040 0.884 0.040 1.617 0 3.104-0.452t2.652-1.296q1.256-0.924 1.929-2.129t0.673-2.551q0-0.773-0.231-1.527 1.296 0.713 2.049 1.788t0.753 2.31z"></path></svg></span><span class="comments-number"> 1</span>', '<span><svg width="18" height="18"><path d="M14.143 7.714q0 1.396-0.944 2.581t-2.576 1.873-3.551 0.688q-0.864 0-1.768-0.161-1.246 0.884-2.792 1.286-0.362 0.090-0.864 0.161h-0.030q-0.11 0-0.206-0.080t-0.116-0.211q-0.010-0.030-0.010-0.065t0.005-0.065 0.020-0.060l0.025-0.050t0.035-0.055 0.040-0.050 0.045-0.050 0.040-0.045q0.050-0.060 0.231-0.251t0.261-0.296 0.226-0.291 0.251-0.387 0.206-0.442q-1.246-0.723-1.959-1.778t-0.713-2.25q0-1.396 0.944-2.581t2.576-1.873 3.551-0.688 3.551 0.688 2.576 1.873 0.944 2.581zM18 10.286q0 1.205-0.713 2.255t-1.959 1.773q0.1 0.241 0.206 0.442t0.251 0.387 0.226 0.291 0.261 0.296 0.231 0.251q0.010 0.010 0.040 0.045t0.045 0.050 0.040 0.050 0.035 0.055l0.025 0.050t0.020 0.060 0.005 0.065-0.010 0.065q-0.030 0.141-0.131 0.221t-0.221 0.070q-0.502-0.070-0.864-0.161-1.547-0.402-2.792-1.286-0.904 0.161-1.768 0.161-2.722 0-4.741-1.326 0.583 0.040 0.884 0.040 1.617 0 3.104-0.452t2.652-1.296q1.256-0.924 1.929-2.129t0.673-2.551q0-0.773-0.231-1.527 1.296 0.713 2.049 1.788t0.753 2.31z"></path></svg></span><span class="comments-number"> %</span>' );
			echo '</span>';
		}

		edit_post_link( esc_html__( 'Edit', 'blover' ), '<span class="edit-link">', '</span>' );
	}

endif;

if ( ! function_exists( 'blover_categorized_blog' ) ) :

	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @return bool
	 */
	function blover_categorized_blog() {
		$all_the_cool_cats = get_transient( 'blover_categories' );
		if ( false === ( $all_the_cool_cats ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
				array(
					'fields' => 'ids',
					'hide_empty' => 1,
					// We only need to know if there is more than one category.
					'number' => 2,
				)
			);

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'blover_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so blover_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so blover_categorized_blog should return false.
			return false;
		}
	}

endif;

/**
 * Flush out the transients used in blover_categorized_blog.
 */
function blover_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'blover_categories' );
}

add_action( 'edit_category', 'blover_category_transient_flusher' );
add_action( 'save_post', 'blover_category_transient_flusher' );

if ( ! function_exists( 'blover_comment' ) ) :

	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since blover 1.0
	 * @param type $comment comment.
	 * @param type $args comment args.
	 * @param type $depth comments depth.
	 */
	function blover_comment( $comment, $args, $depth ) {
		// $GLOBALS['comment'] = $comment;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
				<?php $avatar = get_avatar( $comment, $args['avatar_size'] ); ?>
				<?php if ( ! empty( $avatar ) ) : ?>
					<div class="comments-avatar">
						<?php echo wp_kses_post( $avatar ); ?>
					</div>
				<?php endif; ?>
				<div class="comment-meta commentmetadata">
					<?php printf( sprintf( '<cite class="fn"><b>%s</b></cite>', get_comment_author_link() ) ); ?>
					<br />
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>">
						<?php
						/* translators: 1: date, 2: time */
						printf( esc_html__( '%s ago', 'blover' ), esc_html( human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ) );
						?>
					</time></a>
					<span class="reply">
					<?php
					comment_reply_link(
						array_merge(
							$args,
							array(
								'depth' => $depth,
								'max_depth' => $args['max_depth'],
								'reply_text' => 'REPLY',
								'before' => ' &#8901; ',
							)
						)
					);
					?>
					</span><!-- .reply -->
					<?php edit_comment_link( __( 'Edit', 'blover' ), ' &#8901; ' ); ?>
				</div><!-- .comment-meta .commentmetadata -->
				</div><!-- .comment-author .vcard -->
				<?php if ( '0' === $comment->comment_approved ) : ?>
					<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'blover' ); ?></em>
					<br />
				<?php endif; ?>
			</footer>
			<div class="comment-content"><?php comment_text(); ?></div>
			</article><!-- #comment-## -->
			<?php
	}

	endif; // Ends check for blover_comment().

if ( ! function_exists( 'blover_comments_fields' ) ) :

	/**
	 * Customized comment form
	 *
	 * @param array $fields comment form fields.
	 * @return string
	 */
	function blover_comments_fields( $fields ) {

		$commenter = wp_get_current_commenter();
		// $user = wp_get_current_user();
		// $user_identity = $user->exists() ? $user->display_name : '';
		if ( ! isset( $args['format'] ) ) {
			$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
		}

		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? ' aria-required="true"' : '' );
		$html_req = ( $req ? ' required="required"' : '' );
		$html5 = 'html5' === $args['format'];

		$fields = array(
			'author' => '<div class="comment-fields"><p class="comment-form-author"><label for="author">' . esc_attr__( 'Name', 'blover' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>
		            <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . $html_req . ' placeholder="' . esc_html__( 'Name', 'blover' ) . '" /></p>',
			'email' => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'blover' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>
		            <input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '"' . $aria_req . $html_req . ' placeholder="' . esc_attr__( 'Email', 'blover' ) . '" /></p>',
			'url' => '<p class="comment-form-ur"><label for="url">' . esc_html__( 'Website', 'blover' ) . '</label>
			<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_attr__( 'Website', 'blover' ) . '" /></p></div>',
		);

		return $fields;
	}

	add_filter( 'comment_form_default_fields', 'blover_comments_fields' );
	endif;

if ( ! function_exists( 'blover_get_excerpt_by_id' ) ) :

	/**
	 * Gets the excerpt using the post ID outside the loop.
	 *
	 * @author      Withers David
	 * @link        http://uplifted.net/programming/wordpress-get-the-excerpt-automatically-using-the-post-id-outside-of-the-loop/
	 * @param       int $post_id WP post ID.
	 * @param       int $excerpt_length excerpt length.
	 * @return      string
	 */
	function blover_get_excerpt_by_id( $post_id, $excerpt_length = 15 ) {
		$the_post = get_post( $post_id ); // Gets post ID.
		$the_excerpt = $the_post->post_content; // Gets post_content to be used as a basis for the excerpt.
		$the_excerpt = strip_tags( strip_shortcodes( $the_excerpt ) ); // Strips tags and images.
		$words = explode( ' ', $the_excerpt, $excerpt_length + 1 );

		if ( count( $words ) > $excerpt_length ) :
			array_pop( $words );
			$the_excerpt = implode( ' ', $words );
			endif;

		$the_excerpt = '<p>' . $the_excerpt . '</p>';
		return $the_excerpt;
	}

	endif;

if ( ! function_exists( 'blover_custom_popular_posts_html_list' ) ) :

	/**
	 * Builds custom HTML
	 *
	 * With this function, I can alter WPP's HTML output from my theme's functions.php.
	 * This way, the modification is permanent even if the plugin gets updated.
	 *
	 * @param   array $mostpopular WPP mostpopular.
	 * @param   array $instance WPP instance.
	 * @return  string
	 */
	function blover_custom_popular_posts_html_list( $mostpopular, $instance ) {
		$output = '<ol class="wpp-list">';

		// loop the array of popular posts objects.
		foreach ( $mostpopular as $popular ) {

			$stats = array(); // placeholder for the stats tag.
			// Comment count option active, display comments.
			if ( $instance['stats_tag']['comment_count'] ) {
				// display text in singular or plural, according to comments count.
				$stats[] = '<span class="wpp-comments">' . sprintf(
					// Translators: comment count.
					_n( '%s comment', '%s comments', absint( $popular->comment_count ), 'blover' ),
					number_format_i18n( $popular->comment_count )
				) . '</span>';
			}

			// Pageviews option checked, display views.
			if ( $instance['stats_tag']['views'] ) {

				// If sorting posts by average views.
				if ( 'avg' === $instance['order_by'] ) {
					// display text in singular or plural, according to views count.
					$stats[] = '<span class="wpp-views">' . sprintf(
						// Translators: pageviews.
						_n( '%s view per day', '%s views per day', absint( $popular->pageviews ), 'blover' ),
						number_format_i18n( $popular->pageviews, 2 )
					) . '</span>';
				} else { // Sorting posts by views
					// display text in singular or plural, according to views count.
					$stats[] = '<span class="wpp-views">' . sprintf(
						// Translators: pageviews.
						_n( '%s view', '%s views', absint( $popular->pageviews ), 'blover' ),
						number_format_i18n( $popular->pageviews )
					) . '</span>';
				}
			}

			// Author option checked.
			if ( $instance['stats_tag']['author'] ) {
				$author = get_the_author_meta( 'display_name', $popular->uid );
				$display_name = '<a href="' . esc_url( get_author_posts_url( $popular->uid ) ) . '">' . esc_html( $author ) . '</a>';
				// Translators: author name.
				$stats[] = '<span class="wpp-author">' . sprintf( esc_html__( 'by %s', 'blover' ), $display_name ) . '</span>';
			}

			// Date option checked.
			if ( $instance['stats_tag']['date']['active'] ) {
				$date = date_i18n( $instance['stats_tag']['date']['format'], strtotime( $popular->date ) );
				$stats[] = '<span class="wpp-date">' . esc_html( $date ) . '</span>';
			}

			// Category option checked.
			if ( $instance['stats_tag']['category'] ) {
				$post_cat = get_the_category( $popular->id );
				$post_cat = ( isset( $post_cat[0] ) ) ? '<a href="' . esc_url( get_category_link( $post_cat[0]->term_id ) ) . '">' . esc_html( $post_cat[0]->cat_name ) . '</a>' : '';

				if ( '' !== $post_cat ) {
					$stats[] = '<span class="wpp-category">' . $post_cat . '</span>';
				}
			}

			// Build stats tag.
			if ( ! empty( $stats ) ) {
				$stats = '<div class="post-stats">' . join( ' / ', $stats ) . '</div>';
			}

			$excerpt = ''; // Excerpt placeholder.
			// Excerpt option checked, build excerpt tag.
			if ( $instance['post-excerpt']['active'] ) {

				$excerpt = blover_get_excerpt_by_id( $popular->id, $instance['post-excerpt']['length'] );
				if ( ! empty( $excerpt ) ) {
					$excerpt = '<div class="wpp-excerpt">' . wp_kses_post( $excerpt ) . '</div>';
				}
			}

			if ( has_post_thumbnail( $popular->id ) ) {
				$thumb_url = get_the_post_thumbnail_url( $popular->id, get_theme_mod( 'wpp_img_size', 'medium' ) );
				$background = ' style="background:url(' . esc_url( $thumb_url ) . ') no-repeat center;background-size: cover;"';
			}

			$output .= '<li>';
			$output .= ( ! empty( $thumb_url ) ) ? '<a class="wpp-image" href="' . esc_url( get_the_permalink( $popular->id ) ) . '" title="' . esc_attr( $popular->title ) . '"' . $background . '></a>' : '';
			$output .= '<div class="wpp-content"><h2 class="wpp-post-title"><a href="' . esc_url( get_the_permalink( $popular->id ) ) . '" title="' . esc_attr( $popular->title ) . '">' . esc_html( $popular->title ) . '</a></h2>';
			$output .= $excerpt;
			$output .= $stats;
			$output .= '</div></li>';
		}// End foreach().

		$output .= '</ol>';

		return $output;
	}

	if ( ! get_theme_mod( 'wpp_styling', 0 ) ) {
		add_filter( 'wpp_custom_html', 'blover_custom_popular_posts_html_list', 10, 2 );
	}
	endif;

if ( ! function_exists( 'blover_content' ) ) :

	/**
	 * Template for displaying content in different post formats.
	 *
	 * @since blover 1.0
	 */
	function blover_content() {

		$format = get_post_format();

		if ( 'audio' === $format ) {
			return blover_media_content();
		} elseif ( 'video' === $format ) {
			return blover_media_content();
		} elseif ( 'gallery' === $format ) {
			return blover_gallery_content();
		} elseif ( 'excerpt' === get_theme_mod( 'show_content_or_excerpt', 'content' ) ) {
			the_excerpt();
		} else {
			// Translators: page/post title.
			the_content( sprintf( '<span>' . esc_html__( 'Read more %s', 'blover' ) . '</span>', the_title( '<span class="screen-reader-text">"', '"</span>', false ) ) );
		}
	}

	endif;

if ( ! function_exists( 'blover_gallery_content' ) ) :

	/**
	 * Template for cutting images from gallery post format.
	 *
	 * @since blover 1.0
	 */
	function blover_gallery_content() {

		// Translators: page/post title.
		$content = get_the_content( sprintf( '<span>' . esc_html__( 'Read more %s', 'blover' ) . '</span>', the_title( '<span class="screen-reader-text">"', '"</span>', false ) ) );
		$pattern = '#\[gallery[^\]]*\]#';
		$replacement = '';

		$newcontent = preg_replace( $pattern, $replacement, $content, 1 );
		$newcontent = apply_filters( 'the_content', $newcontent ); // WPCS: prefix ok.
		$newcontent = str_replace( ']]>', ']]&gt;', $newcontent );
		echo $newcontent; // WPCS: XSS OK.
	}

	endif;

if ( ! function_exists( 'blover_media_content' ) ) :

	/**
	 * Template for cutting media from audio/video post formats.
	 *
	 * @since blover 1.0
	 */
	function blover_media_content() {

		// Translators: page/post title.
		$content = get_the_content( sprintf( '<span>' . esc_html__( 'Read more %s', 'blover' ) . '</span>', the_title( '<span class="screen-reader-text">"', '"</span>', false ) ) );
		$content = apply_filters( 'the_content', $content ); // WPCS: prefix ok.
		$content = str_replace( ']]>', ']]&gt;', $content );

		$tags = 'audio|video|object|embed|iframe';

		$replacement = '';

		$newcontent = preg_replace( '#<(?P<tag>' . $tags . ')[^<]*?(?:>[\s\S]*?<\/(?P=tag)>|\s*\/>)#', $replacement, $content, 1 );

		echo $newcontent; // WPCS: XSS OK.
	}

	endif;

if ( ! function_exists( 'blover_post_format_icon' ) ) :

	/**
	 * Function for getting post format icon.
	 *
	 * @param type $post_id WP post ID.
	 * @return string
	 */
	function blover_post_format_icon( $post_id ) {

		if ( empty( $post_id ) ) {
			return;
		}

		$format = get_post_format( $post_id );

		if ( ! $format ) {

			return;
		} else {

			if ( 'audio' === $format ) {
				return '<div class="blover-post-format-icon"><svg viewBox="0 0 24 24"><path d="M17.297 11.016h1.688q0 2.531-1.758 4.43t-4.242 2.273v3.281h-1.969v-3.281q-2.484-0.375-4.242-2.273t-1.758-4.43h1.688q0 2.203 1.57 3.633t3.727 1.43 3.727-1.43 1.57-3.633zM10.781 4.922v6.188q0 0.469 0.352 0.82t0.867 0.352q0.469 0 0.82-0.328t0.352-0.844l0.047-6.188q0-0.516-0.375-0.867t-0.844-0.352-0.844 0.352-0.375 0.867zM12 14.016q-1.219 0-2.109-0.891t-0.891-2.109v-6q0-1.219 0.891-2.109t2.109-0.891 2.109 0.891 0.891 2.109v6q0 1.219-0.891 2.109t-2.109 0.891z"></path></svg></div>';
			} elseif ( 'video' === $format ) {
				return '<div class="blover-post-format-icon"><svg viewBox="0 0 24 24"><path d="M9 9.984l6.984 4.031-6.984 3.984v-8.016zM21 20.016v-12h-18v12h18zM21 6q0.797 0 1.406 0.586t0.609 1.43v12q0 0.797-0.609 1.383t-1.406 0.586h-18q-0.797 0-1.406-0.586t-0.609-1.383v-12q0-0.844 0.609-1.43t1.406-0.586h7.594l-3.281-3.281 0.703-0.703 3.984 3.984 3.984-3.984 0.703 0.703-3.281 3.281h7.594z"></path></svg></div>';
			} elseif ( 'gallery' === $format ) {
				return '<div class="blover-post-format-icon"><svg viewBox="0 0 24 24"><path d="M3.984 12.984v7.031h7.031v1.969h-7.031q-0.797 0-1.383-0.586t-0.586-1.383v-7.031h1.969zM20.016 20.016v-7.031h1.969v7.031q0 0.797-0.586 1.383t-1.383 0.586h-7.031v-1.969h7.031zM20.016 2.016q0.797 0 1.383 0.586t0.586 1.383v7.031h-1.969v-7.031h-7.031v-1.969h7.031zM17.016 8.484q0 0.609-0.445 1.055t-1.055 0.445-1.055-0.445-0.445-1.055 0.445-1.055 1.055-0.445 1.055 0.445 0.445 1.055zM9.984 12.984l3 3.703 2.016-2.672 3 3.984h-12zM3.984 3.984v7.031h-1.969v-7.031q0-0.797 0.586-1.383t1.383-0.586h7.031v1.969h-7.031z"></path></svg></div>';
			}
		}
	}

	endif;

	/*
	 * CSS output from customizer settings
	 */
if ( ! function_exists( 'blover_customize_css' ) ) :

	/**
	 * Custom css header output
	 */
	function blover_customize_css() {
		$hide_title_on_home_archive = get_theme_mod( 'hide_title_on_home_archive', 0 );
		$hide_meta_on_home_archive = get_theme_mod( 'hide_meta_on_home_archive', 0 );
		$show_title_on_shop_page = get_theme_mod( 'woocommerce_show_page_title', 0 );

		$custom_css = '';
		if ( ! display_header_text() ) {
			$custom_css .= '.site-title, .site-description {display:none;}
		.site-branding {padding:0;}';
		}
		$custom_css .= '.blover-featured-slider, .blover-featured-slider .featured-image, .blover-featured-slider .no-featured-image {height:' . ( absint( get_theme_mod( 'home_page_slider_height', 500 ) ) * 0.6 ) . 'px;}';
		$custom_css .= '#secondary .widget:nth-of-type(3n+1), #secondary .widget:nth-of-type(3n+1) .widget-title span {background-color:' . esc_attr( get_theme_mod( 'sidebar_bg_color_1', '#f8f8f8' ) ) . ';}';
		$custom_css .= '#secondary .widget:nth-of-type(3n+2), #secondary .widget:nth-of-type(3n+2) .widget-title span {background-color:' . esc_attr( get_theme_mod( 'sidebar_bg_color_2', '#f8f8f8' ) ) . ';}';
		$custom_css .= '#secondary .widget:nth-of-type(3n+3), #secondary .widget:nth-of-type(3n+3) .widget-title span {background-color:' . esc_attr( get_theme_mod( 'sidebar_bg_color_3', '#f8f8f8' ) ) . ';}';
		$custom_css .= '#footer-widget, #footer-widget .widget-title span {background-color:' . esc_attr( get_theme_mod( 'footer_bg_color', '#f8f8f8' ) ) . ';}';
		$custom_css .= 'a:hover, a:focus, a:active, .main-navigation .current_page_item > a, .main-navigation .current-menu-item > a, .main-navigation .current_page_ancestor > a, .main-navigation .current-menu-ancestor > a, .navbar-navigation .current_page_item > a, .navbar-navigation .current-menu-item > a, .navbar-navigation .current_page_ancestor > a, .navbar-navigation .current-menu-ancestor > a {color:' . esc_attr( get_theme_mod( 'link_hover_color', '#a0946b' ) ) . ';}';
		if ( $hide_title_on_home_archive ) {
			$custom_css .= '.blog .content-area .entry-title, .archive .content-area .entry-title, .search .content-area .entry-title {display:none;}';
		}
		if ( $hide_meta_on_home_archive ) {
			$custom_css .= '.blog .content-area .entry-meta, .archive .content-area .entry-meta, .search .content-area .entry-meta {display:none;}';
		}
		if ( ! $show_title_on_shop_page ) {
			$custom_css .= '.woocommerce .page-title {display:none;}';
		}
		if ( get_theme_mod( 'show_full_width_image_in_header', 0 ) ) {
			$custom_css .= '.site-branding .site-title img {width: 100%;}';
		}
		if ( ! get_theme_mod( 'enable_padding_for_image_in_header', 1 ) ) {
			$custom_css .= '.site-branding {padding:0;}';
		}
		$custom_css .= '@media screen and (min-width:' . absint( get_theme_mod( 'show_top_menu_width', 978 ) ) . 'px )  {
		.menu-logo {float:left;}
		.navbar-navigation ul, .nav-social {display:block;}
		.blover-featured-slider, .blover-featured-slider .featured-image, .blover-featured-slider .no-featured-image {height:' . absint( get_theme_mod( 'home_page_slider_height', 500 ) ) . 'px;}
		}';
		wp_add_inline_style( 'blover-style', $custom_css );
	}

	add_action( 'wp_enqueue_scripts', 'blover_customize_css' );

	endif;

if ( ! function_exists( 'blover_months' ) ) :

	/**
	 * Months with translations for js.
	 *
	 * @return type
	 */
	function blover_months() {

		$months = array();

		$jan = esc_html__( 'January', 'blover' );
		$feb = esc_html__( 'February', 'blover' );
		$mar = esc_html__( 'March', 'blover' );
		$apr = esc_html__( 'April', 'blover' );
		$may = esc_html__( 'May', 'blover' );
		$jun = esc_html__( 'June', 'blover' );
		$jul = esc_html__( 'July', 'blover' );
		$aug = esc_html__( 'August', 'blover' );
		$sep = esc_html__( 'September', 'blover' );
		$oct = esc_html__( 'October', 'blover' );
		$nov = esc_html__( 'November', 'blover' );
		$dec = esc_html__( 'December', 'blover' );

		$months = array( $jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec );

		return $months;
	}

	endif;

if ( ! function_exists( 'blover_days' ) ) :

	/**
	 * Days with translations for js.
	 *
	 * @return type
	 */
	function blover_days() {

		$days = array();

		$sun = esc_html__( 'Sunday', 'blover' );
		$mon = esc_html__( 'Monday', 'blover' );
		$tue = esc_html__( 'Tuesday', 'blover' );
		$wed = esc_html__( 'Wednesday', 'blover' );
		$thu = esc_html__( 'Thursday', 'blover' );
		$fri = esc_html__( 'Friday', 'blover' );
		$sat = esc_html__( 'Saturday', 'blover' );

		$days = array( $sun, $mon, $tue, $wed, $thu, $fri, $sat );

		return $days;
	}

	endif;

if ( ! function_exists( 'blover_submenu_span' ) ) :

	/**
	 * Function add span to menu elements which has children.
	 *
	 * @param string $item_output html output.
	 * @param type   $item menu element object.
	 * @param type   $depth menu depth level.
	 * @param type   $args nwv walker args.
	 * @return string
	 */
	function blover_submenu_span( $item_output, $item, $depth, $args ) {

		$needle1 = 'menu-item-has-children';
		$needle2 = 'page_item_has_children';
		$haystack = $item->classes;
		if ( in_array( $needle1, $haystack, true ) || in_array( $needle2, $haystack, true ) ) {
			$item_output = $item_output . '<span class="expand-submenu" title="' . esc_attr__( 'Expand', 'blover' ) . '">&#43;</span>';
		}

		return $item_output;
	}

	add_filter( 'walker_nav_menu_start_el', 'blover_submenu_span', 10, 4 );

	endif;

if ( ! function_exists( 'blover_related_posts' ) ) :

	/**
	 * Function for displaying related posts on single page.
	 */
	function blover_related_posts() {
		$show_related = get_theme_mod( 'single_page_related_posts_show', 1 );

		if ( $show_related ) {

			$by_cat = get_theme_mod( 'single_page_related_posts_by_tag_or_cat', 1 );
			$taxonomy = ( $by_cat ? 'category' : 'post_tag' );

			if ( $by_cat ) {
				$terms = wp_get_post_categories( get_the_ID() );
			} else {
				$terms = wp_get_post_tags(
					get_the_ID(),
					array(
						'fields' => 'ids',
					)
				);
			}

			$args = array(
				'posts_per_page' => 3,
				'post__not_in' => array( get_the_ID() ),
				'post_type' => 'post',
				'tax_query' => array(
					'relation' => 'OR',
					array(
						'taxonomy' => $taxonomy,
						'terms' => $terms,
					),
				),
			);
			$the_query = new WP_Query( $args );

			if ( $the_query->have_posts() ) :
				?>
			<div class="blover-related-posts col-xs-12">
			<h3><span><?php echo esc_html( get_theme_mod( 'single_page_related_posts_title', __( 'You May Also Like', 'blover' ) ) ); ?></span></h3>
					<div class="row">
				<?php
				while ( $the_query->have_posts() ) :
					$the_query->the_post();
					?>
					<div class="col-xs-12 col-md-4">
					<?php if ( has_post_thumbnail() ) : ?>
								<a class="related-posts-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" style="background: url( <?php the_post_thumbnail_url( 'medium' ); ?> ) center no-repeat;background-size: cover;"></a>
						<?php endif; ?>
							<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
							</div>
						<?php
					endwhile;
				wp_reset_postdata();
				?>
			</div>
			</div>
				<?php
			endif;
		}// End if().
	}

	endif;

if ( ! function_exists( 'blover_woocommerce_comment_fields' ) ) :

	/**
	 * Customized WooCommerce review form.
	 * */
	function blover_woocommerce_comment_fields() {

		$commenter = wp_get_current_commenter();

		$comment_form = array(
			// Translators: woocommerce product.
			'title_reply' => have_comments() ? '<span>' . esc_html__( 'Add a review', 'blover' ) . '</span>' : sprintf( '<span>' . esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'blover' ) . '</span>', get_the_title() ),
			// Translators: comment title.
			'title_reply_to' => esc_html__( 'Leave a Reply to %s', 'blover' ),
			'comment_notes_after' => '',
			'fields' => array(
				'author' => '<p class="comment-form-author"><label for="author">' . esc_html__( 'Name', 'blover' ) . ' <span class="required">*</span></label>
				    <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" required /></p>',
				'email' => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'blover' ) . ' <span class="required">*</span></label>
						<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" required /></p>',
			),
			'label_submit' => esc_html__( 'Submit', 'blover' ),
			'logged_in_as' => '',
			'comment_field' => '',
		);

		$account_page_url = wc_get_page_permalink( 'myaccount' );
		if ( $account_page_url ) {
			// Translators: url to "my account" page.
			$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %s to post a review.', 'blover' ), '<a href="' . esc_url( $account_page_url ) . '">' . esc_html__( 'logged in', 'blover' ) . '</a>' ) . '</p>';
		}

		if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
			$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . esc_html__( 'Your Rating', 'blover' ) . '</label><select name="rating" id="rating" aria-required="true" required>
			<option value="">' . esc_html__( 'Rate&hellip;', 'blover' ) . '</option>
			<option value="5">' . esc_html__( 'Perfect', 'blover' ) . '</option>
			<option value="4">' . esc_html__( 'Good', 'blover' ) . '</option>
			<option value="3">' . esc_html__( 'Average', 'blover' ) . '</option>
			<option value="2">' . esc_html__( 'Not that bad', 'blover' ) . '</option>
			<option value="1">' . esc_html__( 'Very Poor', 'blover' ) . '</option>
		</select></p>';
		}

		$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your Review', 'blover' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required></textarea></p>';

		return $comment_form;
	}

	endif;

	add_filter( 'woocommerce_product_review_comment_form_args', 'blover_woocommerce_comment_fields' );


	add_filter( 'add_to_cart_fragments', 'blover_woocommerce_header_add_to_cart_fragment' );

	/**
	 * Adding ajax calls when cart is updated.
	 *
	 * @param string $fragments todo.
	 */
function blover_woocommerce_header_add_to_cart_fragment( $fragments ) {

	ob_start();
	?>
	<a class="btn blover-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'Carrito', 'blover' ); ?>"><?php esc_html_e( 'Carrito', 'blover' ); ?>(<span class="blover-cart-content-counts"><?php echo esc_html( wc()->cart->get_cart_contents_count() ); ?></span>)</a>
	<?php
	$fragments['a.blover-cart'] = ob_get_clean();

	return $fragments;
}

	/**
	 * Displays Jetpack sharing buttons.
	 */
function blover_jetpack_sharing() {
	if ( function_exists( 'sharing_display' ) ) {
		$options = get_option( 'sharing-options' );
		$display_options = $options['global']['show'];

		if ( ! is_feed() ) {
			if ( is_singular() && in_array( get_post_type(), $display_options, true ) ) {
				echo '<div class="blover-jp-sharing">' . sharing_display( '', false ) . '</div>'; // WPCS: XSS OK.
			} elseif ( in_array( 'index', $display_options, true ) && ( is_home() || is_front_page() || is_archive() || is_search() || in_array( get_post_type(), $display_options, true ) ) ) {
				echo '<button class="blover-jp-sharing-toggle"><span><svg width="12" height="14"><path d="M9.5 8q1.039 0 1.77 0.73t0.73 1.77-0.73 1.77-1.77 0.73-1.77-0.73-0.73-1.77q0-0.094 0.016-0.266l-2.812-1.406q-0.719 0.672-1.703 0.672-1.039 0-1.77-0.73t-0.73-1.77 0.73-1.77 1.77-0.73q0.984 0 1.703 0.672l2.812-1.406q-0.016-0.172-0.016-0.266 0-1.039 0.73-1.77t1.77-0.73 1.77 0.73 0.73 1.77-0.73 1.77-1.77 0.73q-0.984 0-1.703-0.672l-2.812 1.406q0.016 0.172 0.016 0.266t-0.016 0.266l2.812 1.406q0.719-0.672 1.703-0.672z"></path></svg></span></button><div class="blover-jp-sharing">' . sharing_display( '', false ) . '</div><button class="blover-jp-sharing-close"><span><svg width="14" height="14"><svg><line stroke-miterlimit="10" x1="0.354" y1="0.354" x2="14.354" y2="14.354"/><line stroke-miterlimit="10" x1="14.354" y1="0.354" x2="0.354" y2="14.354"/></svg></svg></span></button>'; // WPCS: XSS OK.
			}
		}
	}
}

	/**
	 * Remove Jetpack sharing filters.
	 */
function blover_jetpack_sharing_remove_filters() {
	if ( function_exists( 'sharing_display' ) ) {
		remove_filter( 'the_content', 'sharing_display', 19 );
		remove_filter( 'the_excerpt', 'sharing_display', 19 );
	}
}

	add_action( 'init', 'blover_jetpack_sharing_remove_filters' );

	/**
	 * Custom number of related products in woocommerce.
	 *
	 * @param array $args woocommerce related products arguments.
	 */
function blover_woocommerce_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 3 related products
	// $args['columns'] = 2; // arranged in 2 columns
	return $args;
}

	add_filter( 'woocommerce_output_related_products_args', 'blover_woocommerce_related_products_args' );

if ( ! function_exists( 'blover_show_sticky' ) ) :

	/**
	 * Show sticky posts below slider depends on option
	 *
	 * @return bool
	 */
	function blover_show_sticky() {
		if ( is_sticky() && ! get_theme_mod( 'home_page_show_sticky', 0 ) ) {
			return false;
		}
		return true;
	}

	endif;


	add_filter( 'get_the_archive_title', 'blover_the_archive_title' );

	/**
	 * Modify the_archive_title
	 *
	 * @param string $title title of archive pages.
	 * @return string $title
	 */
function blover_the_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	}
	return $title;
}

if ( ! function_exists( 'blover_excerpt_length' ) ) :

	add_filter( 'excerpt_length', 'blover_excerpt_length', 100 );
	/**
	 * Custom excerpt length
	 *
	 * @return int
	 */
	function blover_excerpt_length() {
		return get_theme_mod( 'excerpt_length', 55 );
	}
	endif;

