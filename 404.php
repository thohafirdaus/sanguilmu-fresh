<?php
/**
 * 404 template.
 *
 * @package SanguIlmuFresh
 */

get_header();
?>
<section class="si-page-hero">
	<div class="si-container">
		<div class="si-kicker"><?php esc_html_e( 'Tidak Ditemukan', 'sanguilmu-fresh' ); ?></div>
		<h1 class="si-page-title"><?php esc_html_e( 'Halaman ini belum tersedia.', 'sanguilmu-fresh' ); ?></h1>
		<p class="si-lead"><?php esc_html_e( 'Tautan mungkin berubah atau kontennya sudah dipindahkan. Coba pencarian di bawah ini.', 'sanguilmu-fresh' ); ?></p>
	</div>
</section>
<div class="si-container si-content-layout si-no-sidebar">
	<div class="si-entry">
		<?php get_search_form(); ?>
	</div>
</div>
<?php
get_footer();
