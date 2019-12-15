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
}
conversions()->widgets = new Widgets();
