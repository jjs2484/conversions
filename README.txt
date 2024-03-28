=== Conversions ===
Contributors: uniquelylost
Tags: block-styles, blog, custom-colors, custom-logo, custom-menu, e-commerce, editor-style, featured-images, footer-widgets, full-width-template, one-column, right-sidebar, rtl-language-support, sticky-post, theme-options, threaded-comments, translation-ready, two-columns, wide-blocks
Requires at least: 4.7
Tested up to: 6.4
Requires PHP: 5.6
Stable tag: 2.1.0
License: GPL-2.0-or-later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Conversions is conversion-focused WordPress theme. It’s based on Bootstrap 5 and Automattic’s starter theme called _s, or underscores.

== Description ==

Conversions is conversion-focused WordPress theme. It’s based on Bootstrap 5 and Automattic’s starter theme called _s, or underscores. Conversions enables you to create almost any type of website such as: business, startup, agency, e-commerce shop, portfolio, non-profit, or blog. It is fully compatible with Gutenberg and most popular page builders (Elementor, Visual Composer, etc.). Some of the theme features include: ✓ Mobile First Design ✓ Customizer Options ✓ Search Engine Optimized ✓ Google Fonts ✓ Font Awesome ✓ Translation Ready ✓ RTL Support ✓ Highly Extendable. Conversions supports many popular WordPress plugins like: WooCommerce, Easy Digital Downloads, Contact Form 7, Ninja Forms, bbPress, Google Analytics, and much more. 

Full documentation: https://conversionswp.com/docs/documentation/

NOTE: Nav menu only supports 2 levels of sub-menus. Additionally, nav menu items with sub-menus are only used to toggle the sub-menu on or off.

== Changelog ==

= 2.1.0 =
* New: Filter conversions_hide_navbar_section
* New: Filter conversions_hide_footer_section
* New: Filter conversions_hide_cta_section
* New: Filter conversions_cta_callout_btn
* Update: Bootstrap to v5.3.3
* Update: Fontawesome to v6.5.1
* Update: WooCommerce templates.
* Update: NPM Dependencies.
* Update: Composer dependencies.
* Fix: Form range styles.

= 2.0.2 =
* Update: Bootstrap to v5.3.1
* Update: Fontawesome to v6.4.2
* Update: WooCommerce templates.
* Update: NPM Dependencies.
* Update: Composer dependencies.
* Fix: Ninja Forms - checkbox and radio styles.

= 1.9.9.7 =
* Update: Bootstrap to v5.2.3
* Update: Fontawesome to v6.4.0
* Update: WooCommerce templates to v7.0.1
* Update: WooCommerce templates to v7.4.0
* Update: NPM Dependencies.
* Update: Composer dependencies.
* Update: Preload hero images.
* Fix: Minor accessibility color changes.
* Fix: EDD download list - layout flex to grid.
* Fix: EDD download list - show button for select options.
* Fix: EDD download list - button style selector.
* Fix: EDD blocks - remove old block styles.
* Fix: Ninja forms - select appearance.
* Fix: Ninja forms - submit button style selector.
* Fix: Font Awesome - Remove preloading.


= 1.9.9 =
* Fix: Check WC mini cart block exists before unregistering

= 1.9.8 =
* Update: Bootstrap to 5.1.3
* Update: Better handling of BS5 colors in PHP
* Fix: Comment structure for BS5
* Fix: Alerts color fixes for BS5
* Fix: Add select and form label BS5 styles
* Update: Font Awesome to 6.1.1
* Fix: Font Awesome prefixes
* Update: More no-sidebar body classes check
* Update: Navbar accessibility
* Update: Homepage sections accessibility
* Update: Widget styles move to dedicated sass file
* Update: Disable the new Widgets Block Editor
* Update: NPM Dependencies.
* Update: Composer dependencies.
* New: Filter conversions_show_footer_widgets
* New: Filter conversions_fixed_navbar_margin
* New: Filter conversions_reading_time
* New: Filter conversions_related_post_image
* New: Function skiplink()
* New: Filter conversions_skiplink_anchor
* New: Add modernizr, webp test, no-js test
* New: Optional WooCommerce mini cart and single product AJAX
* Fix: WooCommerce styles for BS5
* Fix: Easy Digital Downloads table styles
* Update: bbPress better BS5 search form
* Fix: bbPress no-js class on body
* Fix: bbPress styles
* Fix: Ninja Forms styles for BS5
* Fix: Only load 3rd party integrations if active


= 1.8.3 =
* New: Action hook conversions_before_footer_widgets.
* New: Action hook conversions_after_footer_widgets.
* Update: WooCommerce grouped.php template to v4.8.0 
* Update: NPM Dependencies.

= 1.8.2 =
* New: Bootstrap Responsive Tabs script.
* New: Action hook conversions_before_cta.
* New: Action hook conversions_cta_content.
* New: Filter conversions_cta_content_filter.
* New: Action hook conversions_after_page_hero_title.
* New: Action hook conversions_after_post_hero_title.
* Update: Outdated WooCommerce templates to v5.2.0.
* Update: Move some CTA stuff to functions in inc/Cta.php
* Update: Show featured image on full width page template.
* Update: Better navbar drop shadow.
* Update: Navbar button add unique id.
* Update: Fullscreen_featured_image media query image size.
* Update: NPM Dependencies.
* Update: Composer Dependencies.
* Fix: Ninja forms submit button height.
* Fix: WooCommerce products loop display:block.

= 1.8.1 =
* Update: Font Awesome to 5.15.3
* Update: Move customizer colors back to their respective sections.
* Update: Reorder customizer sections.
* Update: add conversions-gallery image size.
* Update: NPM Dependencies.

= 1.8.0 =
* Update: Lazy load more images.
* Update: Only show fab if cart is not empty.
* Update: NPM dependencies.

= 1.7.9 =
* Update: bump WordPress tested version to 5.7.
* Update: NPM dependencies.

= 1.7.8 =
* New: hex_to_rgba function.
* New: get_hero_image function.
* Update: NPM dependencies.

= 1.7.7 =
* New: Navbar toggler animation.
* New: Vertical scrolling of the mobile Navbar when the contents are 75vh+.
* Update: Change sidebar breakpoint from 768px to 992px.
* Update: Change FAB visibility to 991.98px down.
* Update: FAB fullwidth button box-shadow.
* Update: EDD single product page use WP full size image.
* Update: Let Navbar items wrap with flexbox rather than inline blocks.
* Update: Display Navbar social icons horizontally on mobile menu.
* Update: Refactor Navbar sass.
* Update: NPM dependencies.
* Fix: conversions_fab_cart filter variable.
* Fix: conversions_fab_fullwidth filter variable.
* Fix: Add extra items to base nav regardless of which Navbar layout is chosen.

= 1.7.6 =
* New: Floating action buttons (FABs)
* New: Responsive font sizes.
* New: Image background for call to action section.
* Update: Bootstrap to v4.6.0
* Update: Bootstrap success color to #198754.
* Update: Font Awesome to v5.15.2
* Update: Reorder typography customizer panel.
* Update: Run fixed header margin calc onload in addition to on resize.
* Update: Move pricing table auto_col_calc function to extensions plugin.
* Update: Remove some small image sizes from fullscreen featured image output.
* Update: Add jquery dep to all wp_enqueue_script calls.
* Update: Switch fixed header anchor link offset to use scroll-padding-top.
* Update: NPM dependencies.
* New: Filter hooks:
- conversions_fab
- conversions_fab_cart
- conversions_fab_fullwidth
- conversions_fab_fullwidth_icon
- conversions_fab_color

= 1.7.5 =
* Update: Add more Bootstrap color options to stick post highlight in customizer.
* Update: Use .c-sticky-highlight to style stick posts rather than Bootstrap border classes ex. border-primary.
* Update: NPM dependencies.
* Fix: Only highlight sticky post at top of page not in its original position too.

= 1.7.4 =
* New: Theme Info admin page.
* Update: Add TGMPA check for theme info admin page before showing notices.
* Update: Further optimize Google Fonts: combine requests, add preconnect, and load before CSS.
* Update: Further optimize Font Awesome: add preload, and load before CSS.
* Update: Refactor and reorg functions in inc/enqueue.
* Update: Move some navbar functions cart, icons, button, etc, from inc/customizer to inc/navbar.
* Update: Refactor and reorg functions in inc/navbar.
* Update: Navbar drop shadow styling.
* Update: Refactor CTA background color output.
* Update: Add Get Started customizer intro button.
* Update: NPM dependencies.
* Update: Composer dependencies.
* Fix: Gutenberg block background colors CSS selector.
* Fix: Get related post content from get_the_excerpt. 
* Fix: Switch some customizer sanitization callbacks from wp_filter_nohtml_kses to sanitize_text_field.
* Fix: Some phpcs formatting.
* New: Filter hooks:
- conversions_related_post_content
- conversions_resource_hints
- conversions_font_family
- conversions_navbar_menu
- conversions_navbar_extras

= 1.7.3 =
* Update: Bootstrap to 4.5.3
* Update: NPM dependencies.
* Update: Composer dependencies.

= 1.7.2 =
* Update: Font Awesome to v5.15.1
* Update: Add conversions_edd_singular_price filter.
* Update: NPM dependencies.

= 1.7.1 =
* Update: Font Awesome to v5.15.0
* Update: Move Homepage Hero YouTube video modal script to Conversions Extensions plugin.

== Resources ==

* Bootstrap 5.1.3 | MIT License
* Font Awesome 5.15.4 | Icons: CC BY 4.0, Font: SIL OFL 1.1, Code: MIT License
* WP Bootstrap Navwalker | GPL-3.0+
* _s, or underscores | GPLv2 or later
* TGM Plugin Activation | GPLv2 or later
* Hamburgers v1.1.3 | MIT License
* Google Fonts

	Comfortaa
    Source: https://fonts.google.com/specimen/Comfortaa
	License: SIL Open Font License, 1.1 - scripts.sil.org/OFL

    Handlee
    Source: https://fonts.google.com/specimen/Handlee
    License: SIL Open Font License, 1.1 - scripts.sil.org/OFL

    Indie Flower
    Source: https://fonts.google.com/specimen/Indie+Flower
    License: SIL Open Font License, 1.1 - scripts.sil.org/OFL

    Lato
    Source: https://fonts.google.com/specimen/Lato
    License: SIL Open Font License, 1.1 - scripts.sil.org/OFL

    Libre Baskerville
    Source: https://fonts.google.com/specimen/Libre+Baskerville
    License: SIL Open Font License, 1.1 - scripts.sil.org/OFL

    Lora
    Source: https://fonts.google.com/specimen/Lora
    License: SIL Open Font License, 1.1 - scripts.sil.org/OFL

    Merriweather
    Source: https://fonts.google.com/specimen/Merriweather
    License: SIL Open Font License, 1.1 - scripts.sil.org/OFL

    Noto Sans
    Source: https://fonts.google.com/specimen/Noto+Sans
    License: Apache License, version 2 - apache.org/licenses/LICENSE-2.0.html

    Open Sans
	Source: https://www.google.com/fonts/specimen/Open+Sans
	License: SIL Open Font License, 1.1 - scripts.sil.org/OFL

    Oxygen
    Source: https://fonts.google.com/specimen/Oxygen
	License: SIL Open Font License, 1.1 - scripts.sil.org/OFL

    Roboto
    Source: https://fonts.google.com/specimen/Roboto
	License: Apache License, version 2 - apache.org/licenses/LICENSE-2.0.html

    Roboto Mono
    Source: https://fonts.google.com/specimen/Roboto+Mono
	License: Apache License, version 2 - apache.org/licenses/LICENSE-2.0.html

    Roboto Slab
    Source: https://fonts.google.com/specimen/Roboto+Slab
	License: Apache License, version 2 - apache.org/licenses/LICENSE-2.0.html

    Special Elite
    Source: https://fonts.google.com/specimen/Special+Elite
	License: Apache License, version 2 - apache.org/licenses/LICENSE-2.0.html

    Ubuntu
    Source: https://fonts.google.com/specimen/Ubuntu
	License: Ubuntu Font License, 1.0 - design.ubuntu.com/font/

* Screenshot - Image used:
https://www.pexels.com/photo/woman-holding-card-while-operating-silver-laptop-919436/
License: Public Domain CC0