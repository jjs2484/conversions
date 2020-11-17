<?php
/**
 * Customize Section Button Class.
 *
 * Adds a custom "button" section to the WordPress customizer.
 *
 * @package conversions
 */

namespace conversions;

use WP_Customize_Section;

/**
 * Class Button
 */
class Button extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @access public
	 * @var    string
	 */
	public $type = 'conversions-customizer-button';

	/**
	 * Custom button text to output.
	 *
	 * @access public
	 * @var    string
	 */
	public $button_text = '';

	/**
	 * Custom button URL to output.
	 *
	 * @access public
	 * @var    string
	 */
	public $button_url = '';

	/**
	 * Custom button 2 text to output.
	 *
	 * @access public
	 * @var    string
	 */
	public $button_text_2 = '';

	/**
	 * Custom button 2 URL to output.
	 *
	 * @access public
	 * @var    string
	 */
	public $button_url_2 = '';

	/**
	 * Default priority of the section.
	 *
	 * @access public
	 * @var    string
	 */
	public $priority = 999;

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @access public
	 * @return array
	 */
	public function json() {

		$json         = parent::json();
		$theme        = wp_get_theme();
		$button_url   = $this->button_url;
		$button_url_2 = $this->button_url_2;

		// Fall back to the `Theme URI` defined in `style.css`.
		if ( ! $button_url && $theme->get( 'ThemeURI' ) ) {

			$button_url   = $theme->get( 'ThemeURI' );
			$button_url_2 = $theme->get( 'ThemeURI' );

		} elseif ( ! $button_url && $theme->get( 'AuthorURI' ) ) {

			// Fall back to the `Author URI` defined in `style.css`.
			$button_url   = $theme->get( 'AuthorURI' );
			$button_url_2 = $theme->get( 'AuthorURI' );
		}

		$json['button_text']   = $this->button_text ? $this->button_text : $theme->get( 'Name' );
		$json['button_url']    = esc_url( $button_url );
		$json['button_text_2'] = $this->button_text_2 ? $this->button_text_2 : $theme->get( 'Name' );
		$json['button_url_2']  = esc_url( $button_url_2 );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.button_text && data.button_url ) { #>
					<a href="{{ data.button_url }}" class="button button-secondary alignleft" target="_blank" rel="external nofollow noopener noreferrer">{{ data.button_text }}</a>
				<# } #>
				<# if ( data.button_text_2 && data.button_url_2 ) { #>
					<a href="{{ data.button_url_2 }}" class="button button-secondary alignright" target="_blank" rel="external nofollow noopener noreferrer">{{ data.button_text_2 }}</a>
				<# } #>
			</h3>
		</li>
		<?php
	}
}
