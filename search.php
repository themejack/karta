<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Karta
 */

get_header(); ?>

<div id="primary">
	<main id="main" class="site-main" role="main">
		<div class="archive-intro">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<h5 class="archive-intro__title"><?php printf( esc_html__( 'Search Results for: %s', 'karta' ), '<span>' . get_search_query() . '</span>' ); ?></h5>
					</div>
				</div>
			</div>
		</div>

		<?php if ( have_posts() ) : ?>

		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="masonry-grid">
						<div class="masonry-grid__sizer"></div>
						<div class="masonry-grid__gutter-sizer"></div>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</div>

		<?php karta_pagination() ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
	</main>
</div>

<?php get_footer();
