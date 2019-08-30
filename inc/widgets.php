<?php

namespace conversions;

/**
	@brief		Widget functions.
	@since		2019-08-15 23:01:47
**/
class Widgets
{
	/**
		@brief		Constructor.
		@since		2019-08-15 23:01:47
	**/
	public function __construct()
	{
		add_action( 'widgets_init', [ $this, 'widgets_init' ] );
		add_filter( 'dynamic_sidebar_params', [ $this, 'dynamic_sidebar_params' ] );
	}

	/**
	 * Count number of visible widgets in a sidebar and add classes to widgets accordingly,
	 * so widgets can be displayed one, two, three or four per row.
	 *
	 * @global array $sidebars_widgets
	 *
	 * @param array $params {
	 *     @type array $args  {
	 *         An array of widget display arguments.
	 *
	 *         @type string $name          Name of the sidebar the widget is assigned to.
	 *         @type string $id            ID of the sidebar the widget is assigned to.
	 *         @type string $description   The sidebar description.
	 *         @type string $class         CSS class applied to the sidebar container.
	 *         @type string $before_widget HTML markup to prepend to each widget in the sidebar.
	 *         @type string $after_widget  HTML markup to append to each widget in the sidebar.
	 *         @type string $before_title  HTML markup to prepend to the widget title when displayed.
	 *         @type string $after_title   HTML markup to append to the widget title when displayed.
	 *         @type string $widget_id     ID of the widget.
	 *         @type string $widget_name   Name of the widget.
	 *     }
	 *     @type array $widget_args {
	 *         An array of multi-widget arguments.
	 *
	 *         @type int $number Number increment used for multiples of the same widget.
	 *     }
	 * }
	 * @return array $params
	 */
	public function dynamic_sidebar_params( $params )
	{
		global $sidebars_widgets;

		/*
		 * When the corresponding filter is evaluated on the front end
		 * this takes into account that there might have been made other changes.
		 */
		$sidebars_widgets_count = apply_filters( 'sidebars_widgets', $sidebars_widgets );

		// Only apply changes if sidebar ID is set and the widget's classes depend on the number of widgets in the sidebar.
		if ( isset( $params[0]['id'] ) && strpos( $params[0]['before_widget'], 'dynamic-classes' ) ) {
			$sidebar_id   = $params[0]['id'];
			$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );

			$widget_classes = 'widget-count-' . $widget_count;
			if ( 0 === $widget_count % 4 || $widget_count > 4 ) {
				// Four widgets per row if there are four or more.
				$widget_classes .= ' col-md-3';
			} elseif ( $widget_count >= 3 ) {
				// Three widgets per row if there are three or more.
				$widget_classes .= ' col-md-4';
			} elseif ( 2 === $widget_count ) {
				// Two widgets per row if there are only two.
				$widget_classes .= ' col-md-6';
			} elseif ( 1 === $widget_count ) {
				// One widgets per row if only one widget is active.
				$widget_classes .= ' col-md-12';
			}

			// Replace the placeholder class 'dynamic-classes' with the classes stored in $widget_classes.
			$params[0]['before_widget'] = str_replace( 'dynamic-classes', $widget_classes, $params[0]['before_widget'] );
		}

		return $params;
	}

	/**
		@brief		widgets_init
		@since		2019-08-18 20:09:38
	**/
	public function widgets_init()
	{
		register_sidebar(
			array(
				'name'          => __( 'Right Sidebar', 'conversions' ),
				'id'            => 'sidebar-1',
				'description'   => __( 'Right sidebar widget area', 'conversions' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Left Sidebar', 'conversions' ),
				'id'            => 'sidebar-2',
				'description'   => __( 'Left sidebar widget area', 'conversions' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer Full', 'conversions' ),
				'id'            => 'sidebar-3',
				'description'   => __( 'Full sized footer widget with dynamic grid', 'conversions' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s dynamic-classes">',
				'after_widget'  => '</div><!-- .footer-widget -->',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}
}
conversions()->widgets = new Widgets();
