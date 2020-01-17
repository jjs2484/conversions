<?php if ( ! edd_has_variable_prices( get_the_ID() ) ) : ?>
	<div>
		<div itemprop="price" class="edd_price">
			<?php
				if ( edd_is_free_download( get_the_ID() ) ) {
					$price = 'Free';
				} else {
					$price = edd_price( get_the_ID() );
				}
				echo $price;
			?>
		</div>
	</div>
<?php endif; ?>
