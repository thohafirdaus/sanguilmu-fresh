<?php
/**
 * Archive item partial.
 *
 * @package SanguIlmuFresh
 */
?>
<a class="si-archive-item si-reveal" href="<?php the_permalink(); ?>">
	<div class="si-archive-thumb">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'medium_large' );
		}
		?>
	</div>
	<div>
		<div class="si-meta">
			<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		</div>
		<h2 class="si-entry-title"><?php the_title(); ?></h2>
		<p class="si-excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
	</div>
</a>
