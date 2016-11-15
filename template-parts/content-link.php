<?php
/**
 * Template part for displaying post format: Link.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Karta
 */

$classes = array();
$classes[] = 'masonry-grid__item';
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<figure class="post__figure">
		<?php karta_featured_image(); ?>
		<figcaption class="post__figcaption">
			<?php karta_the_primary_category(); ?>
			<?php
			$link = get_url_in_content( get_the_content() );
			if ( '' !== $link ) :
			?>
				<a href="<?php echo esc_url( $link ); ?>" class="post__intro">
					<?php add_filter( 'the_content', 'wp_strip_all_tags', 1, 1 ); ?>
					<?php the_content(); ?>
					<?php remove_filter( 'the_content', 'wp_strip_all_tags', 1 ); ?>
					<div class="post__icon">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 99.7"><path d="M57.5 11.8v5.7"/><path d="M98.6 4.8c0-.1 0-.2-.1-.3 0-.1-.1-.2-.1-.3 0-.1 0-.1-.1-.2v-.1c0-.1-.1-.2-.2-.3-.1-.2-.1-.3-.2-.4-.1-.1-.1-.2-.2-.3-.1-.1-.1-.2-.2-.2l-.3-.3-.2-.2c0-.1-.1-.1-.2-.2s-.2-.1-.2-.2c-.1-.1-.2-.1-.3-.2-.1 0-.2-.1-.3-.1 0 0-.1 0-.1-.1-.1 0-.2 0-.2-.1-.1 0-.2-.1-.3-.1-.1 0-.2-.1-.4-.1H94.1l-30.3.2c-2.5 0-4.6 2.1-4.6 4.6 0 2.5 2.1 4.6 4.6 4.5l19.3-.1-29.8 30.2c-1.1 1.1-1.5 2.7-1.2 4.1.2.9.6 1.7 1.3 2.4.9.9 2.1 1.3 3.2 1.3 1.2 0 2.3-.5 3.2-1.4l29.8-30.2.1 19.3c0 2.5 2.1 4.6 4.6 4.5 1.3 0 2.4-.5 3.2-1.4.8-.8 1.3-2 1.3-3.2l-.1-30.2v-.2-.4c-.1-.1-.1-.2-.1-.3z"/><path d="M6.5 83.3c0 5.7 4.6 10.4 10.4 10.4l55.6.1c5.7 0 10.4-4.6 10.4-10.4l-.1-40.8h6.1v40.8c0 9-7.3 16.3-16.3 16.3l-56.4-.1C7.6 99.6.6 92.6.6 84V27.8c0-9 7.3-16.3 16.3-16.3l41.1-.1v6.1H16.9c-5.7 0-10.4 4.6-10.4 10.4v55.4z"/></svg>
					</div>
				</a>

				<?php else : ?>
				<div class="post__intro">
					<div class="post__date"><?php echo esc_html( get_the_date() );?></div>
					<?php the_content(); ?>
				</div>
			<?php endif; ?>
		</figcaption>
	</figure>
</div>

