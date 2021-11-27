<?php
/**
 * Widget functions
 *
 * @package conversions
 */

namespace conversions;

/**
 * Class Widgets.
 *
 * @since 2019-08-15
 */
class Widgets {
	/**
	 * Class constructor.
	 *
	 * @since 2019-08-15
	 */
	public function __construct() {
		add_action( 'widgets_init', [ $this, 'widgets_init' ] );
	}

	/**
	 * Register sidebars.
	 *
	 * @since 2019-08-18
	 */
	public function widgets_init() {
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
				'name'          => __( 'Footer Column 1', 'conversions' ),
				'id'            => 'sidebar-3',
				'description'   => __( 'Widgets added here will appear in column 1 of the footer.', 'conversions' ),
				'before_widget' => '<div id="%1$s" class="%2$s footer-widget">',
				'after_widget'  => '</div><!-- .footer-widget -->',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer Column 2', 'conversions' ),
				'id'            => 'sidebar-4',
				'description'   => __( 'Widgets added here will appear in column 2 of the footer.', 'conversions' ),
				'before_widget' => '<div id="%1$s" class="%2$s footer-widget">',
				'after_widget'  => '</div><!-- .footer-widget -->',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer Column 3', 'conversions' ),
				'id'            => 'sidebar-5',
				'description'   => __( 'Widgets added here will appear in column 3 of the footer.', 'conversions' ),
				'before_widget' => '<div id="%1$s" class="%2$s footer-widget">',
				'after_widget'  => '</div><!-- .footer-widget -->',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer Column 4', 'conversions' ),
				'id'            => 'sidebar-6',
				'description'   => __( 'Widgets added here will appear in column 4 of the footer.', 'conversions' ),
				'before_widget' => '<div id="%1$s" class="%2$s footer-widget">',
				'after_widget'  => '</div><!-- .footer-widget -->',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}

	/**
	 * Show footer widget section filter.
	 *
	 * Override to show the footer widget section even if empty.
	 *
	 * @since 2021-11-24
	 */
	public function show_footer_widgets() {
		$r = false;

		if ( has_filter( 'conversions_show_footer_widgets' ) ) {
			$r = apply_filters( 'conversions_show_footer_widgets', $r );
		}

		return $r;
	}
}
