<?php
/**
 * The navbar partial
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$conversions_navbar = new conversions\Navbar();
?>

	<div id="wrapper-navbar" class="<?php echo esc_attr( $conversions_navbar->conversions_wrapper_classes() ); ?>">

		<?php if ( is_page_template( 'page-templates/homepage.php' ) ) : ?>

			<a class="skip-link" href="#homepage-wrapper">
				<?php esc_html_e( 'Skip to content', 'conversions' ); ?>
			</a>

		<?php else : ?>

			<a class="skip-link" href="#content">
				<?php esc_html_e( 'Skip to content', 'conversions' ); ?>
			</a>

		<?php endif; ?>

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
