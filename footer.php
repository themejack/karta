<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Karta
 */

?>
		</div><!-- #content -->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-footer-widgets">
			<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</div>
			</div>
			<?php endif; ?>
		</div>

		<div class="site-info">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-xs-12">
						<p class="site-info__copyright"><?php echo esc_html( get_theme_mod( 'karta_sitecopyright', esc_html__( 'Copyright', 'karta' ) . ' &copy; ' . get_bloginfo( 'name' ) ) ); ?></p>
					</div>
					<div class="col-sm-6 col-xs-12">
						<div class="site-info__designed-by">
							<span><?php esc_html_e( 'Designed by', 'karta' ); ?></span>
							<a href="http://agilo.co/" title="<?php esc_attr_e( 'Agilo. Beautifully Crafted Digital Experiences.', 'karta' ); ?>" target="_blank"><?php esc_html_e( 'Agilo. Beautifully Crafted Digital Experiences.', 'karta' ); ?><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 76 15"><path fill="#FFF" d="M29.5 11.3c-.4-4.6-.6-7.6-.8-8.9h-.1l-4.4 8.7-1.8 3.2c-.3.5-.5.7-.9.7-.2 0-.5-.1-.8-.2-.7-.3-.7-.7-.4-1.1l7-12.8c.3-.7.7-.9 1.3-.9h1c.3 0 .9.1 1 .9l1.6 12.8v.4c0 .7-.3.9-1.4.9-.5 0-.7-.2-.8-.8l-.5-2.9zm24.2 3.5c-.8 0-1-.5-.8-1.1L55.6 1c.1-.7.3-1 .7-1h.9c.8 0 .8.4.7.9l-2.5 11.8h6.4c.5 0 .6.3.6.9 0 .9-.5 1.2-1.1 1.2h-7.6zM65.3 4.2c.6-3.1 1.8-4.2 4.6-4.2h2.7c3.8 0 3.6 3.2 3.3 4.7l-1.2 5.6c-.6 3.1-1.7 4.5-4.5 4.5h-2.9c-3.8 0-3.6-3.2-3.2-4.7l1.2-5.9zm8.2.7v-.2c.3-1.9 0-2.6-1.4-2.6h-2.2c-1.6 0-2 .8-2.4 2.7L66.4 10c-.4 2-.2 2.7 1.4 2.7H70c1.9 0 2.1-.8 2.4-2.6l1.1-5.2zM50 .9c.1-.6.3-.9.7-.9h.9c.9 0 .9.4.8.9L49.6 14c-.1.6-.3.9-.7.9H48c-.9 0-.9-.4-.8-.9L50 .9zM24.8 9.2h4.8l.2 2.1h-6l1-2.1zm18.3-1.6c.1-.6.3-.9.7-.9h.8c.9 0 .9.4.8.9l-1.2 5.8c-.2 1-.8 1.3-1.6 1.3h-4.9c-2.5 0-3.8-1.4-3.3-3.8l1.4-6.6C36.4.7 38 0 40.5 0h4.7c.5 0 .6.3.6.9 0 .9-.5 1.2-1.1 1.2h-4.2c-1.7 0-2.2.9-2.5 2.5l-1.3 5.6c-.4 1.8.1 2.4 1.8 2.4h3.6l1-5z"/><path fill="#FFF" class="red" d="M14.6 14.3c-.3.5-.5.7-.9.7-.2 0-1.2-.1-1.5-.2-.7-.3-.7-.7-.4-1.1L17.6 3c.3-.5.6-.7 1-.7.2 0 1.1.1 1.3.2.7.3.7.7.4 1.1l-5.7 10.7z"/><path fill="#FFF" class="yellow" d="M8.8 14.3c-.3.5-.5.7-.9.7-.2 0-1.2-.1-1.5-.2-.7-.3-.7-.7-.4-1.1L10.7 5c.3-.5.5-.7.9-.7.2 0 1.2.1 1.5.2.7.3.7.7.4 1.1l-4.7 8.7z"/><path fill="#FFF" class="blue" d="M3 14.3c-.3.5-.5.7-.9.7-.2 0-1.2-.1-1.5-.2-.7-.3-.7-.7-.4-1.1l3.5-6.6c.3-.5.5-.7.9-.7.2 0 1.2.1 1.5.2.7.3.7.7.4 1.1L3 14.3z"/></svg>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
