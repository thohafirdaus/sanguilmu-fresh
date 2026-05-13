<?php
/**
 * Front page template.
 *
 * @package SanguIlmuFresh
 */

get_header();

$portal_groups = sanguilmu_fresh_portal_groups();
$recent_posts  = new WP_Query( array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => 5,
	'ignore_sticky_posts' => true,
) );

$mobile_apps = sanguilmu_fresh_mobile_apps();
?>

<section class="si-hero">
	<div class="si-container si-hero-grid">
		<div class="si-reveal">
			<div class="si-kicker"><?php esc_html_e( 'Portal Sangu Ilmu', 'sanguilmu-fresh' ); ?></div>
			<h1><?php esc_html_e( 'Bekal Pengetahuan,', 'sanguilmu-fresh' ); ?><br><span><?php esc_html_e( 'Solusi Masa Depan', 'sanguilmu-fresh' ); ?></span></h1>
			<p class="si-lead"><?php esc_html_e( 'Temukan aset digital, aplikasi gratis, platform belajar, dan tutorial mendalam untuk meningkatkan keahlianmu. Semua kanal penting Sangu Ilmu tersusun rapi dalam satu pintu masuk.', 'sanguilmu-fresh' ); ?></p>
			<div class="si-hero-actions">
				<a class="si-button" href="#portal">
					<?php echo sanguilmu_fresh_svg_icon( 'grid' ); ?>
					<span><?php esc_html_e( 'Jelajahi Portal', 'sanguilmu-fresh' ); ?></span>
				</a>
				<a class="si-button si-button-secondary" href="<?php echo esc_url( home_url( '/tentang-kami/' ) ); ?>">
					<span><?php esc_html_e( 'Tentang Kami', 'sanguilmu-fresh' ); ?></span>
					<?php echo sanguilmu_fresh_svg_icon( 'arrow' ); ?>
				</a>
			</div>
		</div>

		<div class="si-hero-panel si-reveal">
			<div class="si-hero-logo">
				<?php
				$logo = sanguilmu_fresh_logo_image();
				if ( $logo ) {
					echo $logo;
				} else {
					?>
					<span class="si-brand-mark">SI</span>
					<?php
				}
				?>
			</div>
			<div class="si-mini-stats">
				<div class="si-mini-stat">
					<strong><?php echo esc_html( wp_count_posts( 'post' )->publish ); ?></strong>
					<span><?php esc_html_e( 'artikel pengetahuan', 'sanguilmu-fresh' ); ?></span>
				</div>
				<div class="si-mini-stat">
					<strong><?php echo esc_html( '10+', 'sanguilmu-fresh' ); ?></strong>
					<span><?php esc_html_e( 'produk digital', 'sanguilmu-fresh' ); ?></span>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="si-section" id="portal">
	<div class="si-container">
		<div class="si-section-head si-reveal">
			<div>
				<div class="si-kicker"><?php esc_html_e( 'Media Digital', 'sanguilmu-fresh' ); ?></div>
				<h2><?php esc_html_e( 'Cari Sangu apa hari ini?', 'sanguilmu-fresh' ); ?></h2>
			</div>
			<p><?php esc_html_e( 'Dari digital shop, aplikasi digital, platform belajar, hingga blog tutorial. Pilih kanal yang paling dekat dengan kebutuhanmu sekarang.', 'sanguilmu-fresh' ); ?></p>
		</div>

		<div class="si-portal-grid">
			<?php foreach ( $portal_groups as $group ) : ?>
				<section class="si-portal-group si-reveal">
					<div class="si-group-title"><?php echo esc_html( $group['title'] ); ?></div>
						<div class="si-card-list">
								<?php foreach ( $group['items'] as $item ) : ?>
									<?php $is_external = sanguilmu_fresh_is_external_url( $item['url'] ); ?>
									<a class="si-portal-card" href="<?php echo esc_url( $item['url'] ); ?>"<?php echo $is_external ? ' target="_blank" rel="noreferrer noopener"' : ''; ?>>
										<span class="si-card-icon"><?php echo sanguilmu_fresh_svg_icon( ! empty( $item['icon'] ) ? $item['icon'] : sanguilmu_fresh_card_icon( $item['title'] ) ); ?></span>
										<span class="si-card-copy">
										<strong><?php echo esc_html( $item['title'] ); ?></strong>
										<span><?php echo esc_html( ! empty( $item['description'] ) ? $item['description'] : sanguilmu_fresh_card_description( $item['title'] ) ); ?></span>
									</span>
									<span class="si-card-arrow"><?php echo sanguilmu_fresh_svg_icon( 'arrow' ); ?></span>
							</a>
						<?php endforeach; ?>
					</div>
				</section>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="si-section si-mobile-apps" id="aplikasi-mobile">
	<div class="si-container">
		<div class="si-section-head si-reveal">
			<div>
				<div class="si-kicker"><?php esc_html_e( 'Aplikasi Mobile', 'sanguilmu-fresh' ); ?></div>
				<h2><?php esc_html_e( 'Sangu di genggaman.', 'sanguilmu-fresh' ); ?></h2>
			</div>
			<p><?php esc_html_e( 'Aplikasi pendamping ibadah harian ada di genggaman tangan mu.', 'sanguilmu-fresh' ); ?></p>
		</div>

		<div class="si-mobile-feature si-reveal">
			<div class="si-phone-showcase" aria-hidden="true">
				<img class="si-phone-shot si-phone-shot-primary" src="<?php echo esc_url( content_url( 'uploads/2026/04/marge.png' ) ); ?>" alt="">
				<img class="si-phone-shot si-phone-shot-secondary" src="<?php echo esc_url( content_url( 'uploads/2026/04/marge-sangu-quran-2.png' ) ); ?>" alt="">
			</div>

			<div class="si-mobile-copy">
				<div class="si-kicker"><?php esc_html_e( 'Sangu Quran', 'sanguilmu-fresh' ); ?></div>
				<h3><?php esc_html_e( 'Satu aplikasi untuk ibadah harianmu.', 'sanguilmu-fresh' ); ?></h3>
				<p><?php esc_html_e( 'Dilengkapi Al-Quran, jadwal sholat akurat, kalender hijriah, dan penunjuk arah kiblat dalam satu pengalaman yang ringan.', 'sanguilmu-fresh' ); ?></p>
				<a class="si-button" href="https://play.google.com/store/apps/details?id=com.sanguilmu.quran" target="_blank" rel="noreferrer noopener">
					<?php echo sanguilmu_fresh_svg_icon( 'app' ); ?>
					<span><?php esc_html_e( 'Download di Play Store', 'sanguilmu-fresh' ); ?></span>
				</a>
			</div>
		</div>

		<div class="si-app-strip si-reveal">
			<div class="si-group-title"><?php esc_html_e( 'Aplikasi lainnya', 'sanguilmu-fresh' ); ?></div>
			<div class="si-app-list">
					<?php foreach ( $mobile_apps as $app ) : ?>
						<a class="si-app-card" href="<?php echo esc_url( $app['url'] ); ?>" target="_blank" rel="noreferrer noopener">
							<?php if ( ! empty( $app['image'] ) ) : ?>
								<img src="<?php echo esc_url( $app['image'] ); ?>" alt="<?php echo esc_attr( $app['title'] ); ?>">
							<?php else : ?>
								<span class="si-app-placeholder"><?php echo sanguilmu_fresh_svg_icon( 'app' ); ?></span>
							<?php endif; ?>
						<span>
							<strong><?php echo esc_html( $app['title'] ); ?></strong>
							<small><?php esc_html_e( 'Buka di Play Store', 'sanguilmu-fresh' ); ?></small>
						</span>
						<?php echo sanguilmu_fresh_svg_icon( 'arrow' ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<section class="si-section si-post-band">
	<div class="si-container">
		<div class="si-section-head si-reveal">
			<div>
				<div class="si-kicker"><?php esc_html_e( 'Tulisan Terbaru', 'sanguilmu-fresh' ); ?></div>
				<h2><?php esc_html_e( 'Catatan praktis dari blog.', 'sanguilmu-fresh' ); ?></h2>
			</div>
			<div class="si-section-action">
				<p><?php esc_html_e( 'Baca tulisan terbaru dari blog kami.', 'sanguilmu-fresh' ); ?></p>
				<a class="si-button si-button-secondary" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">
					<span><?php esc_html_e( 'Lihat semua tulisan', 'sanguilmu-fresh' ); ?></span>
					<?php echo sanguilmu_fresh_svg_icon( 'arrow' ); ?>
				</a>
			</div>
		</div>

		<?php if ( $recent_posts->have_posts() ) : ?>
			<div class="si-latest-list">
				<?php
				while ( $recent_posts->have_posts() ) :
					$recent_posts->the_post();
					?>
					<a class="si-latest-item si-reveal" href="<?php the_permalink(); ?>">
						<span class="si-latest-meta">
							<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
							<span><?php echo esc_html( get_the_category_list( ', ' ) ? wp_strip_all_tags( get_the_category_list( ', ' ) ) : __( 'Artikel', 'sanguilmu-fresh' ) ); ?></span>
						</span>
						<strong><?php the_title(); ?></strong>
						<span class="si-latest-arrow"><?php echo sanguilmu_fresh_svg_icon( 'arrow' ); ?></span>
					</a>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php else : ?>
			<div class="si-empty"><?php esc_html_e( 'Belum ada artikel yang diterbitkan.', 'sanguilmu-fresh' ); ?></div>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
