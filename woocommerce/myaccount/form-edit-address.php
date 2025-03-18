<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.3.0
 * @phpcs:disable WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
 * @phpcs:disable WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
 */

defined( 'ABSPATH' ) || exit;

$page_title = ( 'billing' === $load_address ) ? esc_html__( 'Billing address', 'conversions' ) : esc_html__( 'Shipping address', 'conversions' );

do_action( 'woocommerce_before_edit_account_address_form' ); ?>

<?php if ( ! $load_address ) : ?>
	<?php wc_get_template( 'myaccount/my-address.php' ); ?>
<?php else : ?>

	<form method="post" novalidate>

		<h2><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2><?php // @codingStandardsIgnoreLine ?>

		<div class="woocommerce-address-fields">
			<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

			<div class="woocommerce-address-fields__field-wrapper">
				<?php
				foreach ( $address as $key => $field ) {
					woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
				}
				?>
			</div>

			<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

			<p>
				<button type="submit" class="btn <?php echo esc_attr( get_theme_mod( 'conversions_wc_primary_btn', 'btn-outline-primary' ) ); ?>" name="save_address" value="<?php esc_attr_e( 'Save address', 'conversions' ); ?>"><?php esc_html_e( 'Save address', 'conversions' ); ?></button>
				<?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
				<input type="hidden" name="action" value="edit_address" />
			</p>
		</div>

	</form>

<?php endif; ?>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>
