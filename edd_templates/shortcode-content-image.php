<?php
/**
 * Easy Digital Downloads shortcode image
 *
 * @package conversions
 */

if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( get_the_ID() ) ) : ?>
	<div class="edd_download_image">
		<a href="<?php esc_url( the_permalink() ); ?>">
			<?php echo get_the_post_thumbnail( get_the_ID(), 'medium_large' ); ?>
		</a>
	</div>
<?php endif; ?>
