<?php
/**
 * Search template.
 *
 * @package SanguIlmuFresh
 */

get_header();
?>
<section class="si-page-hero">
	<div class="si-container">
		<div class="si-kicker"><?php esc_html_e( 'Pencarian', 'sanguilmu-fresh' ); ?></div>
		<h1 class="si-page-title"><?php printf( esc_html__( 'Hasil untuk %s', 'sanguilmu-fresh' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
		<p class="si-lead"><?php esc_html_e( 'Gunakan kata kunci yang lebih spesifik jika hasilnya terlalu luas.', 'sanguilmu-fresh' ); ?></p>
	</div>
</section>
<div class="si-container si-content-layout">
	<div>
		<div class="si-entry" style="margin-bottom: 18px;"><?php get_search_form(); ?></div>
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
				<div class="si-empty"><?php esc_html_e( 'Tidak ada hasil. Coba kata kunci lain.', 'sanguilmu-fresh' ); ?></div>
				<?php
			endif;
			?>
		</div>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
