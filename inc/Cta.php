<?php
/**
 * CTA functions
 *
 * @package conversions
 */

namespace conversions;

/**
 * Cta class.
 *
 * Contains Fab functions.
 *
 * @since 2021-04-02
 */
class Cta {
	/**
	 * Class constructor.
	 *
	 * @since 2021-04-02
	 */
	public function __construct() {
		add_action( 'conversions_cta_content', [ $this, 'conversions_cta_content' ], 10 );
		add_action( 'conversions_cta_content', [ $this, 'conversions_cta_shortcode' ], 20 );
	}

	/**
	 * CTA content.
	 *
	 * @since 2021-04-02
	 */
	public function conversions_cta_content() {
		ob_start();
		?>

		<div class="c-cta__items">
			<?php
			if ( ! empty( get_theme_mod( 'conversions_hcta_title' ) ) ) {
				// Title.
				echo '<h2 class="h3">' . esc_html( get_theme_mod( 'conversions_hcta_title' ) ) . '</h2>';
			}

			if ( ! empty( get_theme_mod( 'conversions_hcta_desc' ) ) ) {
				// Description.
				echo '<p class="subtitle">' . wp_kses_post( get_theme_mod( 'conversions_hcta_desc' ) ) . '</p>';
			}

			if ( get_theme_mod( 'conversions_hcta_btn', 'no' ) !== 'no' ) {
				// Button.
				$conversions_cta_btn_text = get_theme_mod( 'conversions_hcta_btn_text' );
				if ( empty( $conversions_cta_btn_text ) ) {
					$conversions_cta_btn_text = '';
				}
				$conversions_cta_btn_url = get_theme_mod( 'conversions_cta_btn_url' );
				if ( empty( $conversions_cta_btn_url ) ) {
					$conversions_cta_btn_url = '';
				}
				$cta_callout_btn = sprintf(
					'<a href="%s" class="btn %s btn-lg">%s</a>',
					esc_url( $conversions_cta_btn_url ),
					esc_attr( get_theme_mod( 'conversions_hcta_btn', 'btn-light' ) ),
					esc_html( $conversions_cta_btn_text )
				);

				// Apply filter if exists.
				if ( has_filter( 'conversions_cta_callout_btn' ) ) {
					$cta_callout_btn = apply_filters( 'conversions_cta_callout_btn', $cta_callout_btn );
				}

				echo $cta_callout_btn;
			}
			?>
		</div>

		<?php
		$content = ob_get_contents();
		ob_clean();

		// Apply filter if exists.
		if ( has_filter( 'conversions_cta_content_filter' ) ) {
			$content = apply_filters( 'conversions_cta_content_filter', $content );
		}

		echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * CTA shortcode.
	 *
	 * @since 2021-04-02
	 */
	public function conversions_cta_shortcode() {

		if ( ! empty( get_theme_mod( 'conversions_hcta_shortcode' ) ) ) {
			// Shortcode.
			echo do_shortcode( wp_kses_post( get_theme_mod( 'conversions_hcta_shortcode' ) ) );
		}
	}
}
