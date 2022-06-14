<?php
/**
 * WooCommerce functions
 *
 * @package conversions
 */

namespace conversions;

/**
 * Class WooCommerce.
 *
 * @since 2019-08-06
 */
class WooCommerce {
	/**
	 * Class constructor.
	 *
	 * @since 2019-08-06
	 */
	public function __construct() {

		// First unhook the WooCommerce wrappers.
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );

		add_action( 'after_setup_theme', [ $this, 'after_setup_theme' ] );
		add_action( 'woocommerce_before_main_content', [ $this, 'woocommerce_before_main_content' ] );
		add_action( 'woocommerce_after_main_content', [ $this, 'woocommerce_after_main_content' ] );

		add_filter( 'woocommerce_add_to_cart_fragments', [ $this, 'woocommerce_add_to_cart_fragments' ] );

		$this->review_ratings();

		if ( get_theme_mod( 'conversions_wc_minicart', true ) === true ) {
			add_action( 'wp_footer', [ $this, 'woocommerce_mini_cart' ] );
			add_action( 'woocommerce_widget_shopping_cart_buttons', [ $this, 'woocommerce_mini_cart_keep_shopping' ], 1 );
			add_action( 'wp_footer', [ $this, 'woocommerce_single_ajax_add_to_cart' ] );
			add_action( 'wc_ajax_c_add_to_cart', [ $this, 'ajax_add_to_cart_handling' ] );
			add_action( 'wc_ajax_nopriv_c_add_to_cart', [ $this, 'ajax_add_to_cart_handling' ] );

			// Remove WC Core add to cart handler to prevent double-add.
			remove_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );

			add_filter( 'woocommerce_add_to_cart_fragments', [ $this, 'ajax_add_to_cart_add_fragments' ] );
			add_action( 'wp_loaded', [ $this, 'disable_minicart_block' ], 99 );
		}
	}

	/**
	 * Declares WooCommerce theme support.
	 *
	 * @since 2019-08-06
	 */
	public function after_setup_theme() {
		// Is WooCommerce active?
		if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
			return;

		// Add theme support.
		add_theme_support( 'woocommerce' );

		// Add New Woocommerce 3.0.0 Product Gallery support.
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Hook in and customizer form fields.
		add_filter( 'woocommerce_form_field_args', [ $this, 'woocommerce_form_field_args' ], 10, 3 );

		// Remove the default woo sidebar since we call our own.
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}

	/**
	 * WooCommerce cart for navbar.
	 *
	 * @since 2020-03-12
	 */
	public static function get_cart_nav_html() {
		// get WC cart totals and if = 0 only show icon with no text.
		$cart_totals = WC()->cart->get_cart_contents_count();
		if ( $cart_totals > 0 ) {
			$cart_totals = sprintf(
				'<span>%d<span class="visually-hidden">' . __( 'items in your shopping cart', 'conversions' ) . '</span></span>',
				esc_html( WC()->cart->get_cart_contents_count() )
			);
		} else {
			$cart_totals = '<span class="visually-hidden">' . __( 'View your shopping cart', 'conversions' ) . '</span>';
		}

		$cart_icon = '<i aria-hidden="true" class="fa-solid fa-shopping-cart"></i>';

		if ( get_theme_mod( 'conversions_wc_minicart', true ) === true ) {

			$cart_html = sprintf(
				'<a class="cart-customlocation nav-link" title="%s" data-bs-toggle="offcanvas" href="#offcanvasWcMiniCart" role="button" aria-controls="offcanvasWcMiniCart">%s%s</a>',
				esc_attr__( 'View your shopping cart', 'conversions' ), // title.
				$cart_icon,
				$cart_totals
			);
		} else {
			$cart_html = sprintf(
				'<a class="cart-customlocation nav-link" title="%s" href="%s">%s%s</a>',
				esc_attr__( 'View your shopping cart', 'conversions' ), // title.
				esc_url( wc_get_cart_url() ),                           // href.
				$cart_icon,
				$cart_totals
			);
		}
		return $cart_html;
	}

	/**
	 * Enable review ratings support.
	 *
	 * @since 2019-08-06
	 */
	public function review_ratings() {
		if ( is_admin() )
			return;
		if ( function_exists( 'wc_review_ratings_enabled' ) )
			return;

		/**
		 * Check if reviews are enabled.
		 *
		 * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
		 *
		 * @return bool
		 */
		function wc_reviews_enabled() {
			return 'yes' === get_option( 'woocommerce_enable_reviews' );
		}

		/**
		 * Check if reviews ratings are enabled.
		 *
		 * - Function introduced in WooCommerce 3.6.0.
		 * - Included for backwards compatibility.
		 *
		 * @return bool
		 */
		function wc_review_ratings_enabled() {
			return wc_reviews_enabled() && 'yes' === get_option( 'woocommerce_enable_review_rating' );
		}
	}

	/**
	 * Ajaxify navbar cart totals so it updates when an item is added.
	 *
	 * @since 2019-08-15
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 */
	public function woocommerce_add_to_cart_fragments( $fragments ) {
		$fragments['a.cart-customlocation'] = static::get_cart_nav_html();
		return $fragments;
	}

	/**
	 * Filter function to add Bootstrap form classes to WooCommerce
	 *
	 * @since 2019-08-06
	 *
	 * @param string $args Form attributes.
	 * @param string $key Not in use.
	 * @param null   $value Not in use.
	 *
	 * @return mixed
	 */
	public function woocommerce_form_field_args( $args, $key, $value = null ) {
		// Start field type switch case.
		switch ( $args['type'] ) {
			/* Targets all select input type elements, except the country and state select input types */
			case 'select':
				// Add a class to the field's html element wrapper - woocommerce
				// input types (fields) are often wrapped within a <p></p> tag.
				$args['class'][] = 'mb-3';
				// Add a class to the form input itself.
				$args['input_class']       = array( 'form-control', 'input-lg' );
				$args['label_class']       = array( 'control-label' );
				$args['custom_attributes'] = array(
					'data-plugin'      => 'select2',
					'data-allow-clear' => 'true',
					'aria-hidden'      => 'true',
					// Add custom data attributes to the form input itself.
				);
				break;
			// By default WooCommerce will populate a select with the country names - $args
			// defined for this specific input type targets only the country select element.
			case 'country':
				$args['class'][]     = 'mb-3 single-country';
				$args['label_class'] = array( 'control-label' );
				break;
			// By default WooCommerce will populate a select with state names - $args defined
			// for this specific input type targets only the country select element.
			case 'state':
				// Add class to the field's html element wrapper.
				$args['class'][] = 'mb-3';
				// add class to the form input itself.
				$args['input_class']       = array( '', 'input-lg' );
				$args['label_class']       = array( 'control-label' );
				$args['custom_attributes'] = array(
					'data-plugin'      => 'select2',
					'data-allow-clear' => 'true',
					'aria-hidden'      => 'true',
				);
				break;
			case 'password':
			case 'text':
			case 'email':
			case 'tel':
			case 'number':
				$args['class'][]     = 'mb-3';
				$args['input_class'] = array( 'form-control', 'input-lg' );
				$args['label_class'] = array( 'control-label' );
				break;
			case 'textarea':
				$args['input_class'] = array( 'form-control', 'input-lg' );
				$args['label_class'] = array( 'control-label' );
				break;
			case 'checkbox':
				$args['label_class'] = array( 'custom-control custom-checkbox' );
				$args['input_class'] = array( 'custom-control-input', 'input-lg' );
				break;
			case 'radio':
				$args['label_class'] = array( 'custom-control custom-radio' );
				$args['input_class'] = array( 'custom-control-input', 'input-lg' );
				break;
			default:
				$args['class'][]     = 'mb-3';
				$args['input_class'] = array( 'form-control', 'input-lg' );
				$args['label_class'] = array( 'control-label' );
				break;
		} // end switch.
		return $args;
	}

	/**
	 * Output wrappers before WooCommerce content.
	 *
	 * @since 2019-08-06
	 */
	public function woocommerce_before_main_content() {
		echo '<div class="wrapper content-wrapper" id="woocommerce-wrapper">';
		echo '<div class="container-fluid" id="content">';
		echo '<div class="row">';
		get_template_part( 'partials/left-sidebar-check' );
		echo '<main class="site-main" id="main">';
	}

	/**
	 * Output wrappers after WooCommerce content.
	 *
	 * @since 2019-08-06
	 */
	public function woocommerce_after_main_content() {
		echo '</main><!-- #main -->';
		get_template_part( 'partials/right-sidebar-check' );
		echo '</div><!-- .row -->';
		echo '</div><!-- Container end -->';
		echo '</div><!-- Wrapper end -->';
	}

	/**
	 * Mini cart offcanvas.
	 *
	 * @since 2022-05-27
	 */
	public function woocommerce_mini_cart() {
		?>
		<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasWcMiniCart" aria-labelledby="offcanvasWcMiniCartLabel">
			<div class="offcanvas-header">
				<h2 id="offcanvasWcMiniCartLabel"><?php esc_html_e( 'Your Cart', 'conversions' ); ?></h2>
				<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">
				<div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>
			</div>
		</div>
		<?php
	}

	/**
	 * Mini cart keep shopping button.
	 */
	public function woocommerce_mini_cart_keep_shopping() {
		echo sprintf(
			'<button type="button" class="btn c-wc__keep-shopping" data-bs-dismiss="offcanvas">%s</button>',
			esc_html__( 'Keep shopping', 'conversions' )
		);
	}

	/**
	 * JS for AJAX Add to Cart handling.
	 *
	 * @since 2022-05-29
	 */
	public function woocommerce_single_ajax_add_to_cart() {
		?>
		<script type="text/javascript" charset="UTF-8">
		jQuery(function($) {

			$('form.cart').on('submit', function(e) {
				e.preventDefault();

				var form = $(this);
				form.block({ message: null, overlayCSS: { background: '#fff', opacity: 0.6 } });

				var formData = new FormData(form[0]);
				formData.append('add-to-cart', form.find('[name=add-to-cart]').val() );

				// Ajax action.
				$.ajax({
					url: wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'c_add_to_cart' ),
					data: formData,
					type: 'POST',
					processData: false,
					contentType: false,
					complete: function( response ) {
						response = response.responseJSON;

						if ( ! response ) {
							return;
						}

						if ( response.error && response.product_url ) {
							window.location = response.product_url;
							return;
						}

						// Redirect to cart option
						if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
							window.location = wc_add_to_cart_params.cart_url;
							return;
						}

						var $thisbutton = form.find('.single_add_to_cart_button'); //
						// var $thisbutton = null; // uncomment this if you don't want the 'View cart' button

						// Trigger event so themes can refresh other areas.
						$( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, $thisbutton ] );

						// Remove existing notices
						$( '.woocommerce-error, .woocommerce-message, .woocommerce-info' ).remove();

						// Add new notices
						form.closest('.product').before(response.fragments.notices_html)

						form.unblock();
					}
				});
			});
		});

		jQuery(document).ready(function($){
			$('body').on( 'added_to_cart', function(){
				var myOffcanvas = document.getElementById('offcanvasWcMiniCart');
				var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);
				bsOffcanvas.show();
			});
		});

		jQuery(document).ready(function($){
			var myOffcanvas = document.getElementById('offcanvasWcMiniCart');
			myOffcanvas.addEventListener('show.bs.offcanvas', function () {
				$( '.c-fab__cart-wrapper' ).addClass( 'd-none' );
			});
			myOffcanvas.addEventListener('hidden.bs.offcanvas', function () {
				$( '.c-fab__cart-wrapper' ).removeClass( 'd-none' );
			});
		});
		</script>
		<?php
	}

	/**
	 * AJAX Add to Cart handling.
	 *
	 * @since 2022-05-29
	 */
	public function ajax_add_to_cart_handling() {
		\WC_Form_Handler::add_to_cart_action();
		\WC_AJAX::get_refreshed_fragments();
	}

	/**
	 * Add fragments for notices.
	 *
	 * @since 2022-05-30
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 */
	public function ajax_add_to_cart_add_fragments( $fragments ) {
		$all_notices  = WC()->session->get( 'wc_notices', array() );
		$notice_types = apply_filters( 'woocommerce_notice_types', array( 'error', 'success', 'notice' ) ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound

		ob_start();
		foreach ( $notice_types as $notice_type ) {
			if ( wc_notice_count( $notice_type ) > 0 ) {
				wc_get_template(
					"notices/{$notice_type}.php",
					array(
						'notices' => array_filter( $all_notices[ $notice_type ] ),
					)
				);
			}
		}
		$fragments['notices_html'] = ob_get_clean();

		wc_clear_notices();

		return $fragments;
	}

	/**
	 * Disable minicart block if conversions mini cart is enabled.
	 *
	 * This is due to a conflict in both mini carts appearing.
	 *
	 * @since 2022-05-30
	 */
	public function disable_minicart_block() {

		$registry = \WP_Block_Type_Registry::get_instance();

		if ( $registry->get_registered( 'woocommerce/mini-cart' ) ) {
			$registry->unregister( 'woocommerce/mini-cart' );
		}
	}
}
