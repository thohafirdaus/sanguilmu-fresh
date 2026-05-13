<?php
/**
 * Single post template.
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
			<?php sanguilmu_fresh_breadcrumbs(); ?>
			<div class="si-kicker"><?php esc_html_e( 'Artikel', 'sanguilmu-fresh' ); ?></div>
			<h1 class="si-page-title"><?php the_title(); ?></h1>
			<div class="si-meta" style="margin-top: 20px;">
				<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
				<span><?php the_author(); ?></span>
				<?php $categories = get_the_category(); ?>
				<?php if ( ! empty( $categories ) ) : ?>
					<span class="si-meta-categories" aria-label="<?php esc_attr_e( 'Kategori artikel', 'sanguilmu-fresh' ); ?>">
						<?php foreach ( $categories as $category ) : ?>
							<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
						<?php endforeach; ?>
					</span>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<div class="si-container si-content-layout">
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'si-entry' ); ?>>
			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="si-entry-featured">
					<?php the_post_thumbnail( 'large' ); ?>
				</figure>
			<?php endif; ?>
			<div class="si-entry-content">
				<?php
				the_content();
				wp_link_pages( array(
					'before' => '<div class="si-pagination">',
					'after'  => '</div>',
				) );
				?>
			</div>
			<?php sanguilmu_fresh_post_navigation(); ?>
			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>
		</article>
		<?php get_sidebar(); ?>
	</div>
	<?php
endwhile;
get_footer();
