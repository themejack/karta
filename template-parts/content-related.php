<?php
/**
 * Template part for displaying related post content in template-parts/content-single.php.
 *
 * @package Karta
 */

$classes = array();
$classes[] = 'related-posts__post';
?>
<div class="col-sm-4">
	<div <?php post_class( $classes ); ?>>
		<figure class="post__figure post__figure--background" <?php karta_background_image_url() ?>>
			<?php if ( has_post_thumbnail() ) :?>
				<a href="<?php the_permalink(); ?>" class="post__link" rel="bookmark"></a>
			<?php endif; ?>
			<figcaption class="post__figcaption post__figcaption--sm-absolute">
				<?php karta_the_primary_category(); ?>
				<a href="<?php the_permalink(); ?>" class="post__intro" rel="bookmark">
					<div class="post__date"><?php echo esc_html( get_the_date() );?></div>
					<?php the_title( '<h4 class="post__title">', '</h4>' ); ?>
				</a>
			</figcaption>
		</figure>
	</div>
</div>
