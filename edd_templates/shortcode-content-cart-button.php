<?php
/**
 * Easy Digital Downloads shortcode cart button
 *
 * @package conversions
 */

$conversions_edd_primary_btn = get_theme_mod( 'conversions_edd_primary_btn', 'btn-primary' );
?>

<div class="edd_download_buy_button">
	<?php
	if ( edd_has_variable_prices( get_the_ID() ) ) {
		?>
		<div class="edd_purchase_submit_wrapper">
			<a href="<?php esc_url( the_permalink() ); ?>" class="edd-add-to-cart button btn btn-lg <?php echo esc_attr( $conversions_edd_primary_btn ); ?>">
				<?php esc_html_e( 'Select options', 'conversions' ); ?>
			</a>
		</div>
		<?php
	} else {
		echo edd_get_purchase_link( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped earlier
			array(
				'class'       => 'btn btn-lg ' . esc_attr( $conversions_edd_primary_btn ) . '',
				'download_id' => get_the_ID(),
			)
		);
	}
	?>
</div>
