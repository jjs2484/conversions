<div class="edd_download_buy_button">
	<?php if ( edd_has_variable_prices( get_the_ID() ) ) { ?>
		<div class="edd_purchase_submit_wrapper">
			<a href="<?php esc_url( the_permalink() ); ?>" class="edd-add-to-cart button btn btn-lg btn-block btn-primary">
				<?php esc_html_e( 'Select options', 'conversions' ); ?>
			</a>
		</div>
	<?php } else {
		echo edd_get_purchase_link( array( 'class' => 'btn btn-lg btn-block btn-primary', 'price' => false, 'download_id' => get_the_ID() ) );
	} ?>
</div>
