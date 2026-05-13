<?php
/**
 * Site header.
 *
 * @package SanguIlmuFresh
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="si-site-header">
	<div class="si-container si-header-inner">
		<a class="si-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php bloginfo( 'name' ); ?>">
			<?php
			$logo = sanguilmu_fresh_logo_image();
			if ( $logo ) {
				echo $logo;
			} else {
				?>
				<span class="si-brand-mark">SI</span>
				<span><?php bloginfo( 'name' ); ?></span>
				<?php
			}
			?>
		</a>

		<nav class="si-nav" id="site-navigation" aria-label="<?php esc_attr_e( 'Menu utama', 'sanguilmu-fresh' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_class'     => 'si-menu',
				'container'      => false,
				'fallback_cb'    => false,
				'depth'          => 2,
			) );
			?>
		</nav>

		<button class="si-search-link" type="button" aria-haspopup="dialog" aria-controls="si-search-modal" aria-expanded="false">
			<?php echo sanguilmu_fresh_svg_icon( 'search' ); ?>
			<span><?php esc_html_e( 'Cari', 'sanguilmu-fresh' ); ?></span>
		</button>

		<button class="si-menu-toggle" type="button" aria-controls="site-navigation" aria-expanded="false">
			<span class="screen-reader-text"><?php esc_html_e( 'Buka menu', 'sanguilmu-fresh' ); ?></span>
			<?php echo sanguilmu_fresh_svg_icon( 'menu' ); ?>
		</button>
	</div>
</header>

<div class="si-search-modal" id="si-search-modal" role="dialog" aria-modal="true" aria-labelledby="si-search-modal-title" aria-hidden="true">
	<div class="si-search-backdrop" data-search-close></div>
	<div class="si-search-dialog" role="document">
		<button class="si-search-close" type="button" data-search-close aria-label="<?php esc_attr_e( 'Tutup pencarian', 'sanguilmu-fresh' ); ?>">
			<span aria-hidden="true">&times;</span>
		</button>
		<div class="si-kicker"><?php esc_html_e( 'Pencarian', 'sanguilmu-fresh' ); ?></div>
		<h2 id="si-search-modal-title"><?php esc_html_e( 'Cari di Sangu Ilmu', 'sanguilmu-fresh' ); ?></h2>
		<p><?php esc_html_e( 'Masukkan kata kunci artikel, tutorial, atau layanan yang ingin ditemukan.', 'sanguilmu-fresh' ); ?></p>
		<form class="si-modal-search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="screen-reader-text" for="si-modal-search-field"><?php esc_html_e( 'Kata kunci pencarian', 'sanguilmu-fresh' ); ?></label>
			<input id="si-modal-search-field" class="si-modal-search-field" type="search" name="s" placeholder="<?php esc_attr_e( 'Contoh: OJS, Arduino, DOI', 'sanguilmu-fresh' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" autocomplete="off">
			<button class="si-button" type="submit">
				<?php echo sanguilmu_fresh_svg_icon( 'search' ); ?>
				<span><?php esc_html_e( 'Cari', 'sanguilmu-fresh' ); ?></span>
			</button>
		</form>
	</div>
</div>
<main class="si-main">
