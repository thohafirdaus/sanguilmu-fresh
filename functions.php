<?php
/**
 * Sangu Ilmu Fresh theme functions.
 *
 * @package SanguIlmuFresh
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sanguilmu_fresh_setup() {
	load_theme_textdomain( 'sanguilmu-fresh', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 120,
		'width'       => 360,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'sanguilmu-fresh' ),
		'footer'  => __( 'Footer Menu', 'sanguilmu-fresh' ),
	) );
}
add_action( 'after_setup_theme', 'sanguilmu_fresh_setup' );

function sanguilmu_fresh_assets() {
	wp_enqueue_style(
		'sanguilmu-fresh-fonts',
		'https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'sanguilmu-fresh-style',
		get_stylesheet_uri(),
		array( 'sanguilmu-fresh-fonts' ),
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_script(
		'sanguilmu-fresh-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'sanguilmu_fresh_assets' );

function sanguilmu_fresh_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'sanguilmu-fresh' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Widget untuk halaman artikel dan arsip.', 'sanguilmu-fresh' ),
		'before_widget' => '<section id="%1$s" class="si-sidebar-widget widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'sanguilmu_fresh_widgets_init' );

function sanguilmu_fresh_register_mobile_app_post_type() {
	register_post_type( 'si_mobile_app', array(
		'labels' => array(
			'name'               => __( 'Aplikasi Mobile', 'sanguilmu-fresh' ),
			'singular_name'      => __( 'Aplikasi Mobile', 'sanguilmu-fresh' ),
			'add_new_item'       => __( 'Tambah Aplikasi Mobile', 'sanguilmu-fresh' ),
			'edit_item'          => __( 'Edit Aplikasi Mobile', 'sanguilmu-fresh' ),
			'new_item'           => __( 'Aplikasi Mobile Baru', 'sanguilmu-fresh' ),
			'view_item'          => __( 'Lihat Aplikasi Mobile', 'sanguilmu-fresh' ),
			'search_items'       => __( 'Cari Aplikasi Mobile', 'sanguilmu-fresh' ),
			'not_found'          => __( 'Belum ada aplikasi mobile.', 'sanguilmu-fresh' ),
			'menu_name'          => __( 'Aplikasi Mobile', 'sanguilmu-fresh' ),
			'featured_image'     => __( 'Gambar Aplikasi', 'sanguilmu-fresh' ),
			'set_featured_image' => __( 'Pilih Gambar Aplikasi', 'sanguilmu-fresh' ),
		),
		'public'       => false,
		'show_ui'      => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-smartphone',
		'supports'     => array( 'title', 'thumbnail', 'page-attributes' ),
	) );
}
add_action( 'init', 'sanguilmu_fresh_register_mobile_app_post_type' );

function sanguilmu_fresh_register_portal_item_post_type() {
	register_post_type( 'si_portal_item', array(
		'labels' => array(
			'name'          => __( 'Media Digital', 'sanguilmu-fresh' ),
			'singular_name' => __( 'Media Digital', 'sanguilmu-fresh' ),
			'add_new_item'  => __( 'Tambah Item Media Digital', 'sanguilmu-fresh' ),
			'edit_item'     => __( 'Edit Item Media Digital', 'sanguilmu-fresh' ),
			'new_item'      => __( 'Item Media Digital Baru', 'sanguilmu-fresh' ),
			'search_items'  => __( 'Cari Media Digital', 'sanguilmu-fresh' ),
			'not_found'     => __( 'Belum ada item media digital.', 'sanguilmu-fresh' ),
			'menu_name'     => __( 'Media Digital', 'sanguilmu-fresh' ),
		),
		'public'       => false,
		'show_ui'      => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-screenoptions',
		'supports'     => array( 'title', 'page-attributes' ),
	) );
}
add_action( 'init', 'sanguilmu_fresh_register_portal_item_post_type' );

function sanguilmu_fresh_mobile_app_meta_box() {
	add_meta_box(
		'sanguilmu-fresh-mobile-app-url',
		__( 'Link Aplikasi', 'sanguilmu-fresh' ),
		'sanguilmu_fresh_render_mobile_app_meta_box',
		'si_mobile_app',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'sanguilmu_fresh_mobile_app_meta_box' );

function sanguilmu_fresh_portal_item_meta_box() {
	add_meta_box(
		'sanguilmu-fresh-portal-item-settings',
		__( 'Detail Media Digital', 'sanguilmu-fresh' ),
		'sanguilmu_fresh_render_portal_item_meta_box',
		'si_portal_item',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'sanguilmu_fresh_portal_item_meta_box' );

function sanguilmu_fresh_render_mobile_app_meta_box( $post ) {
	$value = get_post_meta( $post->ID, '_si_mobile_app_url', true );
	wp_nonce_field( 'sanguilmu_fresh_save_mobile_app', 'sanguilmu_fresh_mobile_app_nonce' );
	?>
	<p>
		<label for="si-mobile-app-url"><strong><?php esc_html_e( 'URL Play Store atau halaman aplikasi', 'sanguilmu-fresh' ); ?></strong></label>
	</p>
	<p>
		<input id="si-mobile-app-url" type="url" name="si_mobile_app_url" value="<?php echo esc_attr( $value ); ?>" class="widefat" placeholder="https://play.google.com/store/apps/details?id=...">
	</p>
	<p class="description"><?php esc_html_e( 'Gunakan Gambar Aplikasi di panel kanan sebagai ikon/gambar yang tampil di homepage.', 'sanguilmu-fresh' ); ?></p>
	<?php
}

function sanguilmu_fresh_render_portal_item_meta_box( $post ) {
	$url         = get_post_meta( $post->ID, '_si_portal_item_url', true );
	$description = get_post_meta( $post->ID, '_si_portal_item_description', true );
	$icon        = get_post_meta( $post->ID, '_si_portal_item_icon', true );
	$icons       = sanguilmu_fresh_icon_choices();

	wp_nonce_field( 'sanguilmu_fresh_save_portal_item', 'sanguilmu_fresh_portal_item_nonce' );
	?>
	<p>
		<label for="si-portal-item-url"><strong><?php esc_html_e( 'URL tujuan', 'sanguilmu-fresh' ); ?></strong></label>
	</p>
	<p>
		<input id="si-portal-item-url" type="url" name="si_portal_item_url" value="<?php echo esc_attr( $url ); ?>" class="widefat" placeholder="https://example.com/">
	</p>
	<p>
		<label for="si-portal-item-description"><strong><?php esc_html_e( 'Deskripsi singkat', 'sanguilmu-fresh' ); ?></strong></label>
	</p>
	<p>
		<textarea id="si-portal-item-description" name="si_portal_item_description" class="widefat" rows="3" placeholder="<?php esc_attr_e( 'Teks pendek yang tampil di card homepage.', 'sanguilmu-fresh' ); ?>"><?php echo esc_textarea( $description ); ?></textarea>
	</p>
	<p>
		<label for="si-portal-item-icon"><strong><?php esc_html_e( 'Icon', 'sanguilmu-fresh' ); ?></strong></label>
	</p>
	<p>
		<select id="si-portal-item-icon" name="si_portal_item_icon" class="widefat">
			<?php foreach ( $icons as $key => $label ) : ?>
				<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $icon, $key ); ?>><?php echo esc_html( $label ); ?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<?php
}

function sanguilmu_fresh_save_mobile_app_meta( $post_id ) {
	if ( ! isset( $_POST['sanguilmu_fresh_mobile_app_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['sanguilmu_fresh_mobile_app_nonce'] ) ), 'sanguilmu_fresh_save_mobile_app' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$url = isset( $_POST['si_mobile_app_url'] ) ? esc_url_raw( wp_unslash( $_POST['si_mobile_app_url'] ) ) : '';

	if ( $url ) {
		update_post_meta( $post_id, '_si_mobile_app_url', $url );
	} else {
		delete_post_meta( $post_id, '_si_mobile_app_url' );
	}
}
add_action( 'save_post_si_mobile_app', 'sanguilmu_fresh_save_mobile_app_meta' );

function sanguilmu_fresh_save_portal_item_meta( $post_id ) {
	if ( ! isset( $_POST['sanguilmu_fresh_portal_item_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['sanguilmu_fresh_portal_item_nonce'] ) ), 'sanguilmu_fresh_save_portal_item' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$url         = isset( $_POST['si_portal_item_url'] ) ? esc_url_raw( wp_unslash( $_POST['si_portal_item_url'] ) ) : '';
	$description = isset( $_POST['si_portal_item_description'] ) ? sanitize_textarea_field( wp_unslash( $_POST['si_portal_item_description'] ) ) : '';
	$icon        = isset( $_POST['si_portal_item_icon'] ) ? sanitize_key( wp_unslash( $_POST['si_portal_item_icon'] ) ) : 'grid';
	$icons       = sanguilmu_fresh_icon_choices();

	$url ? update_post_meta( $post_id, '_si_portal_item_url', $url ) : delete_post_meta( $post_id, '_si_portal_item_url' );
	$description ? update_post_meta( $post_id, '_si_portal_item_description', $description ) : delete_post_meta( $post_id, '_si_portal_item_description' );
	update_post_meta( $post_id, '_si_portal_item_icon', isset( $icons[ $icon ] ) ? $icon : 'grid' );
}
add_action( 'save_post_si_portal_item', 'sanguilmu_fresh_save_portal_item_meta' );

function sanguilmu_fresh_filter_primary_menu_items( $items, $args ) {
	if ( empty( $args->theme_location ) || 'primary' !== $args->theme_location ) {
		return $items;
	}

	$removed_ids = array();

	foreach ( $items as $item ) {
		if ( 'educational' === strtolower( trim( wp_strip_all_tags( $item->title ) ) ) ) {
			$removed_ids[] = (int) $item->ID;
		}
	}

	if ( empty( $removed_ids ) ) {
		return $items;
	}

	return array_values( array_filter( $items, function ( $item ) use ( &$removed_ids ) {
		$parent_id = (int) $item->menu_item_parent;

		if ( in_array( (int) $item->ID, $removed_ids, true ) || in_array( $parent_id, $removed_ids, true ) ) {
			$removed_ids[] = (int) $item->ID;
			return false;
		}

		return true;
	} ) );
}
add_filter( 'wp_nav_menu_objects', 'sanguilmu_fresh_filter_primary_menu_items', 10, 2 );

function sanguilmu_fresh_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'sanguilmu_fresh_posts', array(
		'title'       => __( 'Sangu Ilmu: Artikel', 'sanguilmu-fresh' ),
		'description' => __( 'Pengaturan tampilan untuk halaman artikel.', 'sanguilmu-fresh' ),
		'priority'    => 85,
	) );

	$wp_customize->add_setting( 'show_post_nav_thumbnails', array(
		'default'           => true,
		'sanitize_callback' => 'wp_validate_boolean',
	) );

	$wp_customize->add_control( 'show_post_nav_thumbnails', array(
		'type'        => 'checkbox',
		'section'     => 'sanguilmu_fresh_posts',
		'label'       => __( 'Tampilkan gambar unggulan di navigasi artikel', 'sanguilmu-fresh' ),
		'description' => __( 'Jika nonaktif, navigasi sebelumnya/berikutnya akan memakai ikon arah tanpa gambar.', 'sanguilmu-fresh' ),
	) );
}
add_action( 'customize_register', 'sanguilmu_fresh_customize_register' );

function sanguilmu_fresh_after_switch_theme() {
	$old_mods = get_option( 'theme_mods_generatepress' );

	if ( is_array( $old_mods ) ) {
		if ( empty( get_theme_mod( 'custom_logo' ) ) && ! empty( $old_mods['custom_logo'] ) ) {
			set_theme_mod( 'custom_logo', absint( $old_mods['custom_logo'] ) );
		}

		if ( empty( get_nav_menu_locations() ) && ! empty( $old_mods['nav_menu_locations'] ) && is_array( $old_mods['nav_menu_locations'] ) ) {
			set_theme_mod( 'nav_menu_locations', array(
				'primary' => isset( $old_mods['nav_menu_locations']['primary'] ) ? absint( $old_mods['nav_menu_locations']['primary'] ) : 0,
				'footer'  => isset( $old_mods['nav_menu_locations']['primary'] ) ? absint( $old_mods['nav_menu_locations']['primary'] ) : 0,
			) );
		}
	}
}
add_action( 'after_switch_theme', 'sanguilmu_fresh_after_switch_theme' );

function sanguilmu_fresh_logo_image() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );

	if ( $custom_logo_id ) {
		return wp_get_attachment_image(
			$custom_logo_id,
			'full',
			false,
			array(
				'class' => 'custom-logo',
				'alt'   => get_bloginfo( 'name' ),
			)
		);
	}

	$fallback_path = WP_CONTENT_DIR . '/uploads/2020/09/logo-sangu-ilmu-kecil-new.png';

	if ( file_exists( $fallback_path ) ) {
		return sprintf(
			'<img src="%s" alt="%s" class="custom-logo">',
			esc_url( content_url( 'uploads/2020/09/logo-sangu-ilmu-kecil-new.png' ) ),
			esc_attr( get_bloginfo( 'name' ) )
		);
	}

	return '';
}

function sanguilmu_fresh_excerpt_length() {
	return 24;
}
add_filter( 'excerpt_length', 'sanguilmu_fresh_excerpt_length' );

function sanguilmu_fresh_excerpt_more() {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'sanguilmu_fresh_excerpt_more' );

function sanguilmu_fresh_svg_icon( $name ) {
	$icons = array(
		'arrow' => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="none"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'grid'  => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="none"><path d="M4 4h6v6H4V4Zm10 0h6v6h-6V4ZM4 14h6v6H4v-6Zm10 0h6v6h-6v-6Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>',
		'app'   => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="none"><path d="M8 3h8a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.7"/><path d="M10 18h4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
		'book'  => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="none"><path d="M5 5.5A2.5 2.5 0 0 1 7.5 3H20v16H7.5A2.5 2.5 0 0 0 5 21.5v-16Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M5 18.5A2.5 2.5 0 0 1 7.5 16H20" stroke="currentColor" stroke-width="1.7"/></svg>',
		'bag'   => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="none"><path d="M6.5 8h11l1 12h-13l1-12Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M9 8a3 3 0 0 1 6 0" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
		'learn' => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="none"><path d="m3 8.5 9-4 9 4-9 4-9-4Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M6.5 10.2v4.6c0 1.3 2.5 3 5.5 3s5.5-1.7 5.5-3v-4.6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
		'search' => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="none"><path d="m20 20-4.2-4.2m1.2-5.3a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
		'menu' => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="none"><path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
	);

	return isset( $icons[ $name ] ) ? $icons[ $name ] : $icons['grid'];
}

function sanguilmu_fresh_icon_choices() {
	return array(
		'grid'  => __( 'Grid / Umum', 'sanguilmu-fresh' ),
		'app'   => __( 'Aplikasi', 'sanguilmu-fresh' ),
		'book'  => __( 'Buku / Publikasi', 'sanguilmu-fresh' ),
		'bag'   => __( 'Toko / Layanan', 'sanguilmu-fresh' ),
		'learn' => __( 'Edukasi', 'sanguilmu-fresh' ),
	);
}

function sanguilmu_fresh_is_external_url( $url ) {
	$url_host  = wp_parse_url( $url, PHP_URL_HOST );
	$home_host = wp_parse_url( home_url(), PHP_URL_HOST );

	if ( ! $url_host || ! $home_host ) {
		return false;
	}

	return strtolower( preg_replace( '/^www\./', '', $url_host ) ) !== strtolower( preg_replace( '/^www\./', '', $home_host ) );
}

function sanguilmu_fresh_post_navigation() {
	$previous_post = get_previous_post();
	$next_post     = get_next_post();

	if ( ! $previous_post && ! $next_post ) {
		return;
	}

	$show_thumbnails = (bool) get_theme_mod( 'show_post_nav_thumbnails', true );
	?>
	<nav class="si-post-navigation" aria-label="<?php esc_attr_e( 'Navigasi artikel', 'sanguilmu-fresh' ); ?>">
		<div class="si-post-nav-header">
			<span><?php esc_html_e( 'Lanjut membaca', 'sanguilmu-fresh' ); ?></span>
		</div>
		<div class="si-post-nav-grid">
			<?php
			if ( $previous_post ) {
				sanguilmu_fresh_post_nav_card( $previous_post, 'previous', $show_thumbnails );
			}

			if ( $next_post ) {
				sanguilmu_fresh_post_nav_card( $next_post, 'next', $show_thumbnails );
			}
			?>
		</div>
	</nav>
	<?php
}

function sanguilmu_fresh_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}

	$items = array(
		array(
			'label' => __( 'Beranda', 'sanguilmu-fresh' ),
			'url'   => home_url( '/' ),
		),
	);

	if ( is_singular( 'post' ) ) {
		$blog_page_id = (int) get_option( 'page_for_posts' );

		if ( $blog_page_id ) {
			$items[] = array(
				'label' => get_the_title( $blog_page_id ),
				'url'   => get_permalink( $blog_page_id ),
			);
		} else {
			$items[] = array(
				'label' => __( 'Blog', 'sanguilmu-fresh' ),
				'url'   => home_url( '/blog/' ),
			);
		}

		$categories = get_the_category();

		if ( ! empty( $categories ) ) {
			$primary_category = $categories[0];
			$items[] = array(
				'label' => $primary_category->name,
				'url'   => get_category_link( $primary_category ),
			);
		}
	}

	$items[] = array(
		'label' => get_the_title(),
		'url'   => '',
	);
	?>
	<nav class="si-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sanguilmu-fresh' ); ?>">
		<ol>
			<?php foreach ( $items as $index => $item ) : ?>
				<li>
					<?php if ( ! empty( $item['url'] ) && $index < count( $items ) - 1 ) : ?>
						<a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a>
					<?php else : ?>
						<span><?php echo esc_html( $item['label'] ); ?></span>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ol>
	</nav>
	<?php
}

function sanguilmu_fresh_post_nav_card( $post, $direction, $show_thumbnail ) {
	$is_previous = 'previous' === $direction;
	$label       = $is_previous ? __( 'Artikel sebelumnya', 'sanguilmu-fresh' ) : __( 'Artikel berikutnya', 'sanguilmu-fresh' );
	$classes     = 'si-post-nav-card si-post-nav-card-' . $direction;
	?>
	<a class="<?php echo esc_attr( $classes ); ?>" href="<?php echo esc_url( get_permalink( $post ) ); ?>">
		<?php if ( $show_thumbnail && has_post_thumbnail( $post ) ) : ?>
			<span class="si-post-nav-thumb">
				<?php echo get_the_post_thumbnail( $post, 'medium_large' ); ?>
			</span>
		<?php else : ?>
			<span class="si-post-nav-fallback" aria-hidden="true">
				<?php echo sanguilmu_fresh_svg_icon( 'arrow' ); ?>
			</span>
		<?php endif; ?>
		<span class="si-post-nav-copy">
			<span class="si-post-nav-label"><?php echo esc_html( $label ); ?></span>
			<strong><?php echo esc_html( get_the_title( $post ) ); ?></strong>
		</span>
	</a>
	<?php
}

function sanguilmu_fresh_portal_groups() {
	$home_media_group = array(
		'title' => 'Media Digital',
		'items' => array(
			array( 'title' => 'SanguShop', 'url' => 'https://shop.sanguilmu.com/', 'description' => sanguilmu_fresh_card_description( 'SanguShop' ), 'icon' => 'bag' ),
			array( 'title' => 'SanguApps', 'url' => 'https://apps.sanguilmu.com/', 'description' => sanguilmu_fresh_card_description( 'SanguApps' ), 'icon' => 'app' ),
			array( 'title' => 'SanguBlog', 'url' => home_url( '/blog/' ), 'description' => sanguilmu_fresh_card_description( 'SanguBlog' ), 'icon' => 'book' ),
			array( 'title' => 'Publication', 'url' => 'https://publishing.sanguilmu.com', 'description' => sanguilmu_fresh_card_description( 'Publication' ), 'icon' => 'book' ),
			array( 'title' => 'Sangu Invoice', 'url' => 'https://invoice.sanguilmu.com/', 'description' => sanguilmu_fresh_card_description( 'Sangu Invoice' ), 'icon' => 'grid' ),
		),
	);

	$query = new WP_Query( array(
		'post_type'      => 'si_portal_item',
		'post_status'    => 'publish',
		'posts_per_page' => 30,
		'orderby'        => array(
			'menu_order' => 'ASC',
			'date'       => 'DESC',
		),
	) );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();

			$url = get_post_meta( get_the_ID(), '_si_portal_item_url', true );

			if ( ! $url ) {
				continue;
			}

			$home_media_group['items'][] = array(
				'title'       => get_the_title(),
				'url'         => $url,
				'description' => get_post_meta( get_the_ID(), '_si_portal_item_description', true ),
				'icon'        => get_post_meta( get_the_ID(), '_si_portal_item_icon', true ) ?: 'grid',
			);
		}

		wp_reset_postdata();
	}

	return array( $home_media_group );
}

function sanguilmu_fresh_card_description( $title ) {
	$map = array(
		'sangushop' => 'Premium OJS themes, plugin, serta layanan kustomisasi dan instalasi Open Journal System.',
		'sanghshop' => 'Premium OJS themes, plugin, serta layanan kustomisasi dan instalasi Open Journal System.',
		'sanguapps' => 'Kumpulan aplikasi ringan untuk kebutuhan belajar dan produktivitas.',
		'sangublog' => 'Artikel tutorial, teknologi, pendidikan, dan catatan praktis.',
		'publication' => 'Kumpulan terbitan publikasi ilmiah dalam bentuk jurnal maupun prosiding.',
		'sangu invoice' => 'Kelola invoice multi organisasi dengan lebih mudah dan rapi.',
		'crew-a' => 'Ruang belajar real-world untuk riset, proyek, dan pengembangan diri.',
		'thoha.id' => 'Portofolio, catatan, dan kanal personal pengembangan digital.',
	);

	$key = strtolower( trim( $title ) );
	return isset( $map[ $key ] ) ? $map[ $key ] : 'Akses cepat menuju kanal Sangu Ilmu yang relevan.';
}

function sanguilmu_fresh_card_icon( $title ) {
	$key = strtolower( trim( $title ) );

	if ( false !== strpos( $key, 'shop' ) ) {
		return 'bag';
	}

	if ( false !== strpos( $key, 'app' ) ) {
		return 'app';
	}

	if ( false !== strpos( $key, 'blog' ) ) {
		return 'book';
	}

	if ( false !== strpos( $key, 'publication' ) ) {
		return 'book';
	}

	if ( false !== strpos( $key, 'invoice' ) ) {
		return 'grid';
	}

	if ( false !== strpos( $key, 'crew' ) || false !== strpos( $key, 'educ' ) ) {
		return 'learn';
	}

	return 'grid';
}

function sanguilmu_fresh_mobile_apps() {
	$apps = array(
		array(
			'title' => 'Dzikir Pagi & Petang',
			'image' => content_url( 'uploads/2026/04/logo-dzikir2.png' ),
			'url'   => 'https://play.google.com/store/apps/details?id=com.sanguilmu.dzikirpagipetang',
		),
		array(
			'title' => 'Jadwal Sholat',
			'image' => content_url( 'uploads/2026/04/data-jadwal-sholat-fix.jpg' ),
			'url'   => 'https://play.google.com/store/apps/details?id=com.sanguilmu.waktusholat',
		),
	);

	$query = new WP_Query( array(
		'post_type'      => 'si_mobile_app',
		'post_status'    => 'publish',
		'posts_per_page' => 20,
		'orderby'        => array(
			'menu_order' => 'ASC',
			'date'       => 'DESC',
		),
	) );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();

			$url = get_post_meta( get_the_ID(), '_si_mobile_app_url', true );

			if ( ! $url ) {
				continue;
			}

			$apps[] = array(
				'title' => get_the_title(),
				'image' => get_the_post_thumbnail_url( get_the_ID(), 'medium' ),
				'url'   => $url,
			);
		}

		wp_reset_postdata();
	}

	return $apps;
}
