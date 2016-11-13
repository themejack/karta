<?php
/**
 * Template part for displaying latest three posts.
 *
 * @package Karta
 */

$classes = array();
$classes[] = 'latest-posts__post';
?>

<div <?php post_class( $classes ); ?>>
	<figure class="post__figure post__figure--background" <?php karta_background_image_url(); ?>>
		<a href="<?php the_permalink(); ?>" class="post__link" rel="bookmark"></a>
		<figcaption class="post__figcaption post__figcaption--absolute">
			<?php karta_the_primary_category(); ?>
			<a href="<?php the_permalink(); ?>" class="post__intro post__intro--big" rel="bookmark">
				<div class="post__date"><?php echo esc_html( get_the_date() );?></div>
				<?php the_title( '<h3 class="post__title">', '</h3>' ); ?>
			</a>
		</figcaption>
	</figure>
</div>

