<?php
/**
 * Template part for displaying page content in single.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Karta
 */

if ( 'chat' === get_post_format() ) {
	add_filter( 'the_content', 'karta_parse_chat_content', 1, 1 );
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post__background" <?php karta_background_image_url() ?>></div>
	<div class="container container--custom">
		<div class="row">
			<div class="col-xs-12">
				<div class="post-box">
					<div class="post-box__categories">
						<?php karta_categories(); ?>
					</div>
					<div class="post-box__intro">
						<p class="post-box__date"><?php echo esc_html( get_the_date() ); ?></p>
						<?php if ( 'aside' !== get_post_format() ) : ?>
							<h1 class="post-box__title"><?php esc_html( the_title() ); ?></h1>
						<?php endif; ?>
						<?php if ( has_tag() ) : ?><p class="post-box__tags"><?php esc_html( the_tags() ); ?></p><?php endif; ?>
					</div>
					<?php
					if ( get_the_content() !== '' ) : ?>
					<div class="post-box__content">
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
</article>

<?php
if ( 'chat' === get_post_format() ) {
	remove_filter( 'the_content', 'karta_parse_chat_content', 1 );
}
?>

<!--======== SHARE ARTICLE ========-->
<?php karta_the_share_links(); ?>

<!--======== RELATED POSTS ========-->
<?php karta_the_related_posts();
