<?php if ( ! edd_has_variable_prices( get_the_ID() ) ) : ?>
	<?php $item_props = edd_add_schema_microdata() ? ' itemprop="offers" itemscope itemtype="http://schema.org/Offer"' : ''; ?>
	<div<?php echo $item_props; ?>>
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
