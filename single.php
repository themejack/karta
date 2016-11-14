<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Karta
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main single-post-page" role="main">
		<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content-single', get_post_format() );
		endwhile;
		?>

		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="post-pagination">
						<?php previous_post_link( '%link', esc_html__( 'Previous post', 'karta' ), true ); ?>
						<?php next_post_link( '%link', esc_html__( 'Next post', 'karta' ), true ); ?>
					</div>
				</div>
			</div>
		</div>

		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>
	</main>
</div>

<?php get_footer();
