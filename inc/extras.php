<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Karta
 */

/**
 * Removes whitespace after list elements.
 *
 * @param array $items Items.
 * @param array $args Arguments.
 * @return array
 */
function karta_remove_wp_nav_menu_item_whitespace( $items, $args ) {
	$search = array( "/li>\n\t", "\n\t<li", "/li>\t\n", "\t\n<li", "/li>\n", "\n<li", "/li>\t", "\t<li" );
	$replace = array( '/li>', '<li', '/li>', '<li', '/li>', '<li', '/li>', '<li' );

	return str_replace( $search, $replace, $items );
}
add_filter( 'wp_nav_menu_items', 'karta_remove_wp_nav_menu_item_whitespace', 10, 2 );

/**
 * Share links
 *
 * @param int|null $post_id Post ID.
 * @param array    $data Data.
 * @return array
 */
function karta_get_share_links( $post_id = null, $data = array() ) {
	if ( null === $post_id ) {
		global $post;
		$post_id = get_the_ID();
	}

	$post_data = array(
		'title' => '',
		'url' => '',
	);

	if ( 'post' === get_post_type( $post_id ) ) {
		$post_data['title'] = get_the_title( $post_id );
		$post_data['url'] = get_permalink( $post_id );
	} else {
		$post_id = get_option( 'page_on_front' );
		$post_data['title'] = get_option( 'blogname' ) . ' - ' . get_option( 'blogdescription' );
		$post_data['url'] = home_url( '/' );
	}

	if ( is_array( $data ) ) {
		$post_data = array_merge( $post_data, $data );
	}

	$share_links = array();
	$share_links['facebook'] = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode( $post_data['url'] );
	$share_links['twitter'] = 'https://twitter.com/intent/tweet?text=' . urlencode( $post_data['title'] ) . '&url=' . urlencode( $post_data['url'] );
	$share_links['googleplus'] = 'https://plus.google.com/share?url=' . urlencode( $post_data['url'] );
	$share_links['linkedin'] = 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode( $post_data['url'] ) . '&title=' . urlencode( $post_data['title'] );

	return $share_links;
}

/**
 * Get primary category
 *
 * @param int|null $post_id Post ID.
 * @return string|boolean
 */
function karta_get_primary_category( $post_id = null ) {
	if ( null === $post_id ) {
		global $post;
		$post_id = get_the_ID();
	}

	if ( 'post' === get_post_type( $post_id ) ) {
		$categories = wp_cache_get( $post_id, 'karta_categories' );
		if ( false === $categories ) {
			$categories = wp_get_object_terms( $post_id, 'category', array( 'orderby' => 'none' ) );
			wp_cache_set( $post_id, $categories, 'karta_categories' );
		}

		$primary_category = $categories[0]->name;
		return $primary_category;
	}

	return false;
}

/**
 * Customized markup for submenu
 */
class Karta_Walker_Nav_Menu extends Walker_Nav_Menu {
	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu().
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		if ( 0 === $depth  ) {
			$output .= "\n$indent<div class=\"modal\">\n<div class=\"modal__close\"><a href=\"#\">X</a></div>\n$indent<div class=\"modal__content\">\n$indent<ul class=\"main-submenu\">\n";
		} else {
			$output .= "\n$indent<div class=\"main-submenu__submenu depth--$depth\">\n<ul>";
		}
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu().
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		if ( 0 === $depth ) {
			$output .= "$indent</ul>\n$indent</div>\n$indent</div>\n";
		} else {
			$output .= "$indent</ul>\n$indent</div>\n";
		}
	}
}

/**
 * Customized markup for comments
 */
class Karta_Walker_Comment extends Walker_Comment {
	/**
	 * Outputs a single comment.
	 *
	 * @since 3.6.0
	 * @access protected
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function comment( $comment, $depth, $args ) {
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<<?php echo $tag; // WPCS: xss ok. ?> <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?> id="comment-<?php comment_ID(); ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-meta-avatar">
			<?php
			if ( 0 != $args['avatar_size'] ) {
				echo get_avatar( $comment, $args['avatar_size'] );
			}
			?>
		</div>
		<?php if ( '0' == $comment->comment_approved ) : ?>
		<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'karta' ); ?></em>
		<br />
		<?php endif; ?>

		<div class="comment-meta comment-metadata">
			<span class="comment-author">
				<?php printf( '<b class="fn">%s</b>', get_comment_author_link( $comment ) ); ?>
			</span><!-- .comment-author -->
			<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
			<?php
				printf( esc_html__( '%1$s at %2$s', 'karta' ), get_comment_date( '', $comment ), get_comment_time() );?>
			</a>
			<?php edit_comment_link( esc_html__( '(Edit)', 'karta' ), '&nbsp;&nbsp;', '' );
			?>
			<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				) ) );
			?>
		</div>

		<?php comment_text( get_comment_id(), array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
<?php
	}

	/**
	 * Outputs a comment in the HTML5 format.
	 *
	 * @since 3.6.0
	 * @access protected
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
		<<?php echo $tag; // WPCS: xss ok.  ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<footer class="comment-meta">
					<div class="comment-meta-avatar">
						<?php
						if ( 0 != $args['avatar_size'] ) {
							echo get_avatar( $comment, $args['avatar_size'] );
						}?>

					</div>
					<div class="comment-metadata">
						<span class="comment-author">
							<?php printf( esc_html__( '%s', 'karta' ), sprintf( '<b class="fn">%s</b>', get_comment_author_link( $comment ) ) ); ?>
						</span><!-- .comment-author -->
						<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php
									printf( esc_html__( '%1$s at %2$s', 'karta' ), get_comment_date( '', $comment ), get_comment_time() );
								?>
							</time>
						</a>
						<?php edit_comment_link( __( 'Edit', 'karta' ), '<span class="edit-link">', '</span>' ); ?>
						<?php
						comment_reply_link( array_merge( $args, array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<span class="reply">',
							'after'     => '</span>',
						) ) );
						?>
					</div><!-- .comment-metadata -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'karta' ); ?></p>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->
			</article><!-- .comment-body -->
<?php
	}
}

