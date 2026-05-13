<?php
/**
 * Post card partial.
 *
 * @package SanguIlmuFresh
 */
?>
<a class="si-post-card si-reveal" href="<?php the_permalink(); ?>">
	<div class="si-post-thumb">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'large' );
		}
		?>
	</div>
	<div class="si-post-body">
		<div class="si-meta">
			<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
			<span><?php echo esc_html( get_the_category_list( ', ' ) ? wp_strip_all_tags( get_the_category_list( ', ' ) ) : __( 'Artikel', 'sanguilmu-fresh' ) ); ?></span>
		</div>
		<h3><?php the_title(); ?></h3>
		<p><?php echo esc_html( get_the_excerpt() ); ?></p>
	</div>
</a>
