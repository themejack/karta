<?php
/**
 * Template part for displaying post format: Gallery.
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
		<?php karta_featured_image( 'karta-grid-2' ); ?>
		<figcaption class="post__figcaption">
			<?php karta_the_primary_category(); ?>
			<a href="<?php the_permalink(); ?>" class="post__intro" rel="bookmark">
			<?php if ( 'post' === get_post_type() ) { ?>
				<div class="post__date"><?php echo esc_html( get_the_date() ); ?></div>
			<?php } ?>
			</a>
		</figcaption>
	</figure>
</div>
