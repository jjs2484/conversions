<?php

namespace conversions;

class Homepage_Sorting_Customizer_Control extends \WP_Customize_Control
{
	/**
		@brief		Enqueue jquery.
		@since		2019-12-16 21:47:17
	**/
	public function enqueue()
	{
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-sortable' );
	}

	public function render_content()
	{
		echo '<script>' . file_get_contents( __DIR__ . '/homepage_sorting.js' ) . '</script>';
		echo '<style>' . file_get_contents( __DIR__ . '/homepage_sorting.css' ) . '</style>';
		?>
			<span class="customize-control-title"><?php _e( 'Sorting', 'conversions' ) ?></span>
			<ul class="conversions_homepage_sorting">
		<?php
		$sections = Homepage::get_sorted_sections();
		$value = implode( ',', array_keys( $sections ) );
		foreach( $sections as $section => $data )
		{
			$data = (object) $data;		// Accesing objects is much nicer.
			$class = '';
			if ( isset( $data->disabled ) )
				$class .= 'disabled';
			?>
			<label>
				<li id="<?php echo esc_attr( $section ); ?>" class="<?php echo $class; ?>"><span class="visibility"></span><?php echo esc_attr( $data->title ); ?></li>
			</label>
		<?php
		}
		?>
			</ul>
			<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $value ); ?>"/>
			</label>
		<?php
	}
}
