<?php
/**
 * The navbar partial
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$conversions_navbar = new conversions\Navbar();

if ( $conversions_navbar->hide_navbar_section() === false ) {
	?>

	<div id="wrapper-navbar" class="<?php echo esc_attr( $conversions_navbar->conversions_wrapper_classes() ); ?>" role="banner">

		<?php
		echo $conversions_navbar->skiplink(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped earlier
		?>

		<?php
		/**
		 * Functions hooked into conversions_navbar action
		 *
		 * @hooked conversions_navbar_open          - 10
		 * @hooked conversions_navbar_branding      - 20
		 * @hooked conversions_navbar_menu          - 30
		 * @hooked conversions_navbar_close         - 40
		 */
		do_action( 'conversions_navbar' );
		?>

	</div><!-- #wrapper-navbar end -->

	<?php do_action( 'conversions_after_navbar' ); ?>

	<?php
}
