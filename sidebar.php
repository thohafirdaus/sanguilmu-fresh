<?php
/**
 * Sidebar template.
 *
 * @package SanguIlmuFresh
 */
?>
<aside class="si-sidebar" aria-label="<?php esc_attr_e( 'Sidebar', 'sanguilmu-fresh' ); ?>">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php else : ?>
		<section class="si-sidebar-widget">
			<h2><?php esc_html_e( 'Cari Artikel', 'sanguilmu-fresh' ); ?></h2>
			<?php get_search_form(); ?>
		</section>
		<section class="si-sidebar-widget">
			<h2><?php esc_html_e( 'Artikel Terbaru', 'sanguilmu-fresh' ); ?></h2>
			<ul>
				<?php
				wp_get_archives( array(
					'type'            => 'postbypost',
					'limit'           => 5,
					'format'          => 'html',
					'show_post_count' => false,
				) );
				?>
			</ul>
		</section>
	<?php endif; ?>
</aside>
