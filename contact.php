<?php
/**
 * Template Name: Contact page
 *
 * @package Karta
 */

get_header();

while ( have_posts() ) : the_post(); ?>
<div class="container container--custom">
	<div class="row">
		<div class="col-xs-12">
			<div class="contact-box">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div>
<?php endwhile;

get_footer();
