<?php
/**
 * Custom template tags for this theme.
 *
 * @package Karta
 */

/**
 * Display share links
 *
 * @param int|null $post_id Post ID.
 */
function karta_the_share_links( $post_id = null ) {
	if ( null === $post_id ) {
		global $post;
		$post_id = get_the_ID();
	}

	$share_links = karta_get_share_links( $post_id );
?>
<div class="share-post">
	<div class="container container--custom">
		<div class="row">
			<div class="col-sm-3 col-xs-12">
				<p class="share-post__title"><?php esc_html_e( 'SHARE ARTICLE!', 'karta' ); ?></p>
			</div>
			<div class="col-sm-9 col-xs-12">
				<ul class="share-post__list">
					<li class="share-post__list-item"><a href=<?php echo esc_url( $share_links['facebook'] ) ?> target="_blank"><?php esc_html_e( 'Facebook', 'karta' ); ?></a></li>
					<li class="share-post__list-item"><a href=<?php echo esc_url( $share_links['twitter'] ) ?> target="_blank"><?php esc_html_e( 'Twitter', 'karta' ); ?></a></li>
					<li class="share-post__list-item"><a href=<?php echo esc_url( $share_links['googleplus'] ) ?> target="_blank"><?php esc_html_e( 'Google plus', 'karta' ); ?></a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php
}

/**
 * Display primary category
 *
 * @param int|null $post_id Post ID.
 */
function karta_the_primary_category( $post_id = null ) {
	if ( null === $post_id ) {
		global $post;
		$post_id = get_the_ID();
	}

	$primary_category = karta_get_primary_category( $post_id );
	$category_id = get_cat_id( $primary_category );
	$category_link = get_term_link( $category_id, 'category' );

	if ( ! empty( $primary_category ) ) :
?>
	<a href=<?php echo esc_url( $category_link )?> class="post__primary-category"><?php echo esc_html( $primary_category ) ?></a>
<?php
	endif;
}

/**
 * Display featured image as background image
 *
 * @param int|null $post_id Post ID.
 */
function karta_background_image_url( $post_id = null ) {
	if ( null === $post_id ) {
		global $post;
		$post_id = get_the_ID();
	}

	if ( has_post_thumbnail() ) {
		$thumb_id = get_post_thumbnail_id();
		$thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'thumbnail-size', true );
		$thumb_url = $thumb_url_array[0];
		echo esc_attr( "style=background-image:url(".esc_url($thumb_url).")" );
	}
}

/**
 * Display featured image
 *
 * @param string|null $size Size of featured image.
 * @param int|null    $post_id Post ID.
 */
function karta_featured_image( $size = null, $post_id = null ) {
	if ( null === $post_id ) {
		global $post;
		$post_id = get_the_ID();
	}

	$classes = array( 'post__link' );

	if ( has_post_thumbnail() ) {
	?>
		<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( join( ' ', $classes ) ); ?>" rel="bookmark">
			<?php the_post_thumbnail( $size ); ?>
		</a>
	<?php
	}
}

/**
 * Parse chat content
 *
 * @param string $content Post content.
 * @since 1.0
 */
function karta_parse_chat_content( $content ) {
	return preg_replace( '/\n?(.*)(\:)/mi', "\n<span class=\"username\">$1</span>", $content );
}

/**
 * Display pagination
 */
function karta_pagination() {
	global $wp_query, $post;

	if ( is_single() || is_page() ) {
		wp_link_pages( array(
			'before' => '<div class="pagination">',
			'after'  => '</div>',
		) );
		return;
	}

	// Don't print empty markup if Jetpack infinite scroll is activated.
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) : ?>
	<div id="posts"></div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="infinite-indicators">
					<div id="infinite-handle">
						<span><?php esc_html_e( 'Load more', 'karta' ); ?></span>
					</div>
					<div class="infinite-loader"></div>	
				</div>
				<div class="infinite-message"><?php esc_html_e( 'No more posts', 'karta' ); ?></div>
			</div>
		</div>
	</div>

	<?php
		return;
	endif;

	// Don't print empty markup in archives if there's only one page.
	if ( 2 > $wp_query->max_num_pages ) {
		return;
	}
	?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<p class="pagination"><?php echo paginate_links( array( // WPCS: xss ok.
					'prev_text' => __( 'Previous', 'karta' ),
					'next_text' => __( 'Next', 'karta' ),
				) ); ?></p>
			</div>
		</div>
	</div>
	<?php
}
/**
 * Display logo
 */
function karta_logo() {
	$header_text = get_theme_mod( 'header_text', 1 );

	if ( 0 === $header_text ) : ?>
		<?php the_custom_logo(); ?>
	<?php endif;

	if ( 1 === $header_text ) : ?>
		<a class="site-title" href="<?php echo esc_url( home_url() ) ?>"><?php bloginfo( 'name' ); ?></a>
		<p class="site-description"><?php bloginfo( 'description' ); ?></p>
	<?php endif;
}

/**
 * Display realted posts
 *
 * @param  int $post_id Post ID.
 */
function karta_the_related_posts( $post_id = null ) {
	if ( null === $post_id ) {
		global $post;
		$post_id = get_the_ID();
	}
?>
<div class="related-posts">
	<div class="container">
		<div class="row">
		<?php
		$counter = 0;
		$categories = array_reverse( get_the_category( $post_id ) );
		$posts_not_in = array( $post_id );

		foreach ( $categories as $key => $category ) {
			if ( $counter >= 3 ) {
				break;
			}

			$args = array(
				'category_name' => $category->name,
				'post__not_in' => $posts_not_in,
			);
			$query = new WP_Query( $args );

			if ( $query->have_posts() ) {
				while ( $query->have_posts() && $counter < 3 ) {
					$query->the_post();
					$posts_not_in[] = get_the_ID();

					get_template_part( 'template-parts/content-related', get_post_format() );

					$counter++;
				}
			}

			wp_reset_postdata();
		}
		?>
		</div>
	</div>
</div>
<?php
}

/**
 * Display all categories of the post.
 *
 * @param int|null $post_id Post ID.
 */
function karta_categories( $post_id = null ) {
	if ( null === $post_id ) {
		global $post;
		$post_id = get_the_ID();
	}

	$categories = get_the_category();
	$num_of_categories = count( $categories );
	$divider = ',';
	$i = 0;

	foreach ( $categories as $key => $category ) :
		$category_id = get_cat_id( $category->name );
		$category_link = get_term_link( $category_id, 'category' );
		$i++;

		if ( $i === $num_of_categories ) {
			$divider = '';
		}
	?>
	<a href=<?php echo esc_url( $category_link ); ?>><?php echo esc_html( $category->name . $divider ) ?> </a>
	<?php endforeach;
}

