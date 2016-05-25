<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Karta
 */

get_header(); ?>

<div id="primary">
	<main id="main" class="site-main" role="main">
		<div class="error-404 not-found">
			<div class="container container--custom">
				<div class="row">
					<div class="col-xs-12">
						<h1 class="not-found__title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'karta' ); ?></h1>
						<div class="not-found__content">
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'karta' ); ?></p>
							<div class="not-found__search-form">
								<?php get_search_form(); ?>
							</div>
						</div><!-- .page-content -->
					</div>
				</div>
			</div>
		</div><!-- .error-404 -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
