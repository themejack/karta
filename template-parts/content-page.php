<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Karta
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container container--custom">
		<div class="row">
			<div class="col-xs-12">
				<div class="post-box">
					<div class="post-box__intro">
						<h1 class="post-box__title"><?php echo esc_html( get_the_title() ); ?></h1>
						<?php the_title( '<h1 class="post-box__title">', '</h1>' ); ?>
					</div>
					<?php if ( get_the_content() !== '' ) : ?>
					<div class="post-content">
						<?php
						the_content();
						karta_pagination();
						?>
					</div>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>
