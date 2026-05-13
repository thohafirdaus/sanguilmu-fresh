<?php
/**
 * Main template.
 *
 * @package SanguIlmuFresh
 */

get_header();
?>
<section class="si-page-hero">
	<div class="si-container">
		<div class="si-kicker"><?php esc_html_e( 'Blog', 'sanguilmu-fresh' ); ?></div>
		<h1 class="si-page-title"><?php single_post_title(); ?></h1>
	</div>
</section>
<div class="si-container si-content-layout">
	<div class="si-archive-list">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/archive', 'item' );
			endwhile;
			the_posts_pagination();
		else :
			?>
			<div class="si-empty"><?php esc_html_e( 'Belum ada konten untuk ditampilkan.', 'sanguilmu-fresh' ); ?></div>
			<?php
		endif;
		?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
