<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>
<div class="woocommerce-form-coupon-toggle">
	<?php wc_print_notice( apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon?', 'conversions' ) . ' <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'conversions' ) . '</a>' ), 'notice' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound ?>
</div>

<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">

	<p><?php esc_html_e( 'If you have a coupon code, please apply it below.', 'conversions' ); ?></p>

	<div class="input-group mb-3">
		<input type="text" name="coupon_code" class="form-control" placeholder="<?php esc_attr_e( 'Coupon code', 'conversions' ); ?>" id="coupon_code" value="" aria-label="<?php esc_attr_e( 'Coupon:', 'conversions' ); ?>" aria-describedby="c-wc__coupon">
		<button type="submit" id="c-wc__coupon" class="btn <?php echo esc_attr( get_theme_mod( 'conversions_wc_primary_btn', 'btn-outline-primary' ) ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'conversions' ); ?>"><?php esc_html_e( 'Apply coupon', 'conversions' ); ?></button>
	</div>

	<div class="clear"></div>
</form>
