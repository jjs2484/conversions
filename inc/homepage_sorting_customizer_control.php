<?php

namespace conversions;

class Homepage_Sorting_Customizer_Control extends \WP_Customize_Control
{

	public function render_content()
	{
		?>
			<span class="customize-control-title"><?php _e( 'Sorting', 'conversions' ) ?></span>
			<ul class="conversions_homepage_sorting">
		<?php
		$sections = Homepage::get_sorted_sections();
		$value = implode( ',', array_keys( $sections ) );
		foreach( $sections as $section => $data )
		{
			$data = (object) $data;		// Accessing objects is much nicer.
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
