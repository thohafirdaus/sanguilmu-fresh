<?php
/**
 * Site footer.
 *
 * @package SanguIlmuFresh
 */
?>
</main>
<footer class="si-site-footer">
	<div class="si-container">
		<div class="si-footer-grid">
			<div class="si-footer-brand">
				<h2><?php bloginfo( 'name' ); ?></h2>
				<p><?php esc_html_e( 'Bekal pengetahuan, aplikasi, dan tutorial praktis untuk belajar lebih tenang dan bekerja lebih terarah.', 'sanguilmu-fresh' ); ?></p>
			</div>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'footer',
				'menu_class'     => 'si-footer-menu',
				'container'      => false,
				'fallback_cb'    => false,
				'depth'          => 1,
			) );
			?>
		</div>
		<div class="si-footer-bottom">
			<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.</span>
			<span><?php esc_html_e( 'PT Sangu Ilmu Cendekia', 'sanguilmu-fresh' ); ?></span>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
