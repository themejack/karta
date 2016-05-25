<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Karta
 */

?>

<div class="no-results not-found">
	<div class="container container--custom">
		<div class="row">
			<div class="col-xs-12">
				<h1 class="not-found__title"><?php esc_html_e( 'Nothing Found', 'karta' ); ?></h1>
				<div class="not-found__content">
					<?php
					if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
						<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'karta' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
					<?php
					elseif ( is_search() ) : ?>
						<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'karta' ); ?></p>
						<div class="not-found__search-form">
							<?php get_search_form(); ?>
						</div>
					<?php else : ?>
						<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'karta' ); ?></p>
						<div class="not-found__search-form">
							<?php get_search_form(); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
