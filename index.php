<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Karta
 */

global $wp_query;

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php if ( have_posts() ) : ?>

			<?php if ( ! is_paged() ) : ?>
			<div class="latest-posts">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">

			<?php else : ?>
			<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<div class="masonry-grid">
								<div class="masonry-grid__sizer"></div>
								<div class="masonry-grid__gutter-sizer"></div>
			<?php endif; ?>

			<?php
			$post_counter = 0;
			while ( have_posts() ) : the_post();

				if ( $post_counter < 3 && ! is_paged() ) : ?>
					<?php get_template_part( 'template-parts/content-latest' ); ?>

				<?php else : ?>
					<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
					
				<?php endif; // Endif counter < 3. ?>

				<?php if ( ! is_paged() && 3 === ++$post_counter && $wp_query->post_count > 3 ) : ?>
						</div>
					</div>
				</div>
			</div>

			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="masonry-grid">
							<div class="masonry-grid__sizer"></div>
							<div class="masonry-grid__gutter-sizer"></div>
				<?php endif;
			endwhile; ?>
						</div>
					</div>
				</div>
			</div>

			<?php karta_pagination(); ?>
	<?php
	else :
		get_template_part( 'template-parts/content', 'none' );
	endif;  // If have posts.
	?>
	</main>
</div>

<?php get_footer();
