<?php
/**
 * Template part for displaying posts.
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
					<?php remove_filter( 'the_content', 'wp_strip_all_tags' ); ?>
				</a>
				<?php else : ?>
				<div class="post__intro">
					<div class="post__date"><?php esc_html( get_the_date() );?></div>
					<?php the_content(); ?>
				</div>
			<?php endif; ?>
		</figcaption>
	</figure>
</div>

