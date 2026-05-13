<?php
/**
 * Page template.
 *
 * @package SanguIlmuFresh
 */

get_header();
?>
<?php
while ( have_posts() ) :
	the_post();
	?>
	<section class="si-page-hero">
		<div class="si-container">
			<div class="si-kicker"><?php esc_html_e( 'Halaman', 'sanguilmu-fresh' ); ?></div>
			<h1 class="si-page-title"><?php the_title(); ?></h1>
		</div>
	</section>
	<div class="si-container si-content-layout si-no-sidebar">
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'si-entry' ); ?>>
			<div class="si-entry-content">
				<?php
				the_content();
				wp_link_pages( array(
					'before' => '<div class="si-pagination">',
					'after'  => '</div>',
				) );
				?>
			</div>
		</article>
	</div>
	<?php
endwhile;
get_footer();
