=== Conversions ===
Contributors: uniquelylost
Tags: block-styles, blog, custom-colors, custom-logo, custom-menu, e-commerce, editor-style, featured-images, footer-widgets, full-width-template, one-column, right-sidebar, rtl-language-support, sticky-post, theme-options, threaded-comments, translation-ready, two-columns, wide-blocks
Requires at least: 4.7
Tested up to: 5.5.1
Requires PHP: 5.6
Stable tag: 1.7.3
License: GPL-2.0-or-later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Conversions is conversion-focused WordPress theme. It’s based on Bootstrap 4 and Automattic’s starter theme called _s, or underscores.

== Description ==

Conversions is conversion-focused WordPress theme. It’s based on Bootstrap 4 and Automattic’s starter theme called _s, or underscores. Conversions enables you to create almost any type of website such as: business, startup, agency, e-commerce shop, portfolio, non-profit, or blog. It is fully compatible with Gutenberg and most popular page builders (Elementor, Visual Composer, etc.). Some of the theme features include: ✓ Mobile First Design ✓ Customizer Options ✓ Search Engine Optimized ✓ Google Fonts ✓ Font Awesome ✓ Translation Ready ✓ RTL Support ✓ Highly Extendable. Conversions supports many popular WordPress plugins like: WooCommerce, Easy Digital Downloads, Contact Form 7, Ninja Forms, bbPress, Google Analytics, and much more. 

Full documentation: https://conversionswp.com/docs/documentation/

NOTE: Nav menu only supports 2 levels of sub-menus. Additionally, nav menu items with sub-menus are only used to toggle the sub-menu on or off.

== Changelog ==

= 1.0 =
* Initial release

= 1.1 =
* New: add additional action hook.
* Update: screenshot.
* Update: default styles.
* Fix: customizer checkbox options returning to defaults.
* Fix: code compatibility with PHP 5.6.

= 1.2 =
* Update: Add display=swap parameter to Google Fonts.
* Update: default styles.
* Fix: ob_get_clean() conflict with WP Super Cache.
* Fix: navbar accessibility and styles.

= 1.3 =
* New: Easy Digital Downloads integration.
* New: add new action hooks.
* New: add content-wrapper class for generalized targeting.
* Update: optimized browser prefix support.
* Fix: adjust fixed navbar margin calcs.

= 1.4 =
* New: add conversions_navbar action hook.
* New: add navbar border on light colors.
* Update: refactor navbar.
* Update: add WooCommerce store notice styles.
* Fix: add has_menu check before displaying mobile menu toggle.

= 1.4.1 =
* Fix: add no-sidebar class to full width page wrappers.
* Fix: WooCommerce blocks onsale tag style.
* Fix: Add margin to Gutenberg editor wrapper to prevent overflow.

= 1.5 =
* New: add composer.json
* New: add phpcs.xml
* New: add .editorconfig
* New: add .eslintrc.json
* Update: stricter WPCS compliance.
* Update: prefix class file names with "class-"
* Update: Font Awesome to v5.12.1
* Update: better versioning on enqueued CSS and JavaScript files.
* Update: JavaScript formatting.
* Update: Sass formatting.
* Update: segment customizer sections into files in /inc/customizer/*
* Update: add styles for block group.
* Fix: remove no-sidebar class from wrapper of singular download posts.
* Fix: add page title to blog index if not front page.
* Fix: center posts pagination.
* Fix: add some extra checks for homepage sections visibility.
* Fix: only show comment count in post meta if 1+ exists.
* Fix: add missing ob_start to beginning of news_content

= 1.5.1 =
* New: add bottom padding to Gutenberg editor.
* Update: add License info for Bootstrap WP nav and comment walkers.
* Update: refactor comments.php
* Update: refactor inc/class-template.php
* Update: more escaping inc/class-wp-bootstrap-comment-walker.php

= 1.5.2 =
* Update: refactor comment walker.
* Update: refactor comment styles.
* Update: exclude WooCommerce files from WPCS.

= 1.5.3 =
* Update: use get_parent_theme_file_path to add class and customizer files for child theme filtering.
* Update: use get_theme_file_uri to enqueue scripts and styles for child theme overriding.
* Update: Gutenberg editor styles for markup changes in WordPress 5.4
* Update: screenshot
* Update: add fallback navbar menu if none are assigned.
* Fix: add Bootstrap colors to button placeholder text in Gutenberg editor.

= 1.5.4 =
* Update: use jQuery for anchor link click events and offset.
* Fix: CSS margin for blog featured images.

= 1.5.5 =
* Update: remove Fancybox, use Bootstrap modal for video instead.

= 1.5.6 =
* Update: WooCommerce templates to 4.0. 
* Update: refactor navbar CSS.
* Update: cart icon.
* Update: nav walker improvements.
* Update: screenshot.
* Update: add starter-content for fresh installs.
* Update: add additional resource licences.
* Fix: jQuery anchor link offset - ignore elements with data-toggle attribute.
* Fix: CSS bottom border on navbar.

= 1.5.7 =
* Fix: only show related posts on default post type.
* Fix: add .wp-block-buttons selector for Gutenberg buttons in WP v5.4
* Fix: keyboard focus highlighting.
* Fix: prefix edd_primary_btn variable in shortcode-content-cart-button.php
* Fix: prefix variables in shortcode-content-price.php
* Fix: prefix variables in shortcode-download.php
* Fix: prefix repeater_input_labels_filter hook in class-conversions-repeater.php

= 1.5.8 =
* Fix: add page template checks to sidebar display.
* Fix: add phpcs comments in inc/class-wp-bootstrap-navwalker.php
* Fix: prefix variables in:
- partials/content.php
- partials/download-grid.php
- partials/footer-cta.php
- partials/left-sidebar-check.php
- partials/navbar-right.php
- partials/right-sidebar-check.php
- partials/sidebar-left.php
- partials/sidebar-right.php
- taxonomy-download_category.php
- taxonomy-download_tag.php 
- archive-download.php

= 1.6.0 =
* New: Add TGM plugin activation class.
* Update: Moved homepage sections and footer social icons to <a href="https://wordpress.org/plugins/conversions-extensions/">Conversions Extensions plugin.</a> 
* Update: add notice on homepage template if Conversions Extensions plugin is not activated
* Update: Font Awesome to v5.13.
* Update: NPM Dependencies.
* Update: Further optimize CSS prefixes.
* Update: Footer credit to - Powered by Conversions Theme.
* Update: Prefix add_image_size images. Requires image sizes to be regenerated.
* Update: Remove starter content.
* Update: Screenshot.
* Update: Improve skip link focus.
* Fix: Exclude skip link hashes from anchor link offset script.
* Fix: rename pagination function to the_posts_pagination
* Fix: Better escaping for the comments fields.
* Fix: Mobile menu focus trapping.
* Fix: WPCS annotations.

= 1.6.1 =
* Update: Remove offcanvas menu.
* Update: NPM dependencies.
* Update: Composer dependencies.
* Update: Reorder navbar customizer options.
* New: Add fixed_navbar_height_calc function in class-customizer.php
* New: Add navbar filters:
- conversions_nav_open_wrapper
- conversions_nav_close_wrapper
- conversions_nav_branding_output

= 1.6.2 =
* Update: WooCommerce form-login.php template for v4.1.0.
* Update: NPM dependencies.

= 1.6.3 =
* Update: Bootstrap to v4.5.0
* Update: NPM dependencies.

= 1.6.4 =
* New: Add skip link styles to match default WordPress styles.
* New: Add conversions-team image size.
* Update: Add resource list to style.css
* Update: Add new required header fields for style.css
* Update: NPM dependencies.
* Fix: Namespace path for conversions-extensions homepage class.

= 1.6.5 =
* Update: Remove some unused styles.
* Update: Remove CSS map files for WP theme directory.
* Fix: Minor escaping changes based on Theme Check findings.

= 1.6.6 =
* Update: Font Awesome to v5.13.1
* Update: NPM dependencies.
* Fix: Only show entry-footer when content exists.

= 1.6.7 =
* New: bbPress integration.
* New: Add background color customizer control.
* New: Add content container card customizer control.
* Update: Move basic color controls to "Colors" customizer panel.
* Update: Reorder customizer panels.
* Update: Font Awesome to v5.14.0
* Update: Screenshot.
* Update: NPM dependencies.
* Update: Convert more CSS colors to Bootstrap variables when possible.
* Fix: Add dl to footer conversions_footer_text_color style.
* Fix: Remove role attributes from the navbar menu.
* Fix: Adjust post_nav HTML output.
* Fix: Correct Contact form 7 alert CSS selectors.
* Fix: Base block button styles preventing some WooCommerce specific overrides.

= 1.6.8 =
* New: Add composer class autoloader.
* New: Add conversions_footer_credits filter.
* Update: Bootstrap to v4.5.2
* Fix: .single-post CSS selector to .single for meta/navs/related spacing styles.
* Fix: Change logo CSS selector from a.navbar-brand to .navbar-brand for WP 5.5 compatibility.

= 1.6.9 =
* New: Ninja Forms integration.
* Update: NPM dependencies.
* Update: Composer dependencies.
* Fix: Remove GB in editor wrapper padding hack, its no longer necessary as of WP 5.5.

= 1.7.0 =
* New: Customizer links to documentation and premium extensions.
* Update: WooCommerce cart.php template to 4.4.0.
* Update: Reverse display order of cart and account nav icons for WooCommerce.
* Update: Reverse display order of cart and account nav icons for Easy Digital Downloads.
* Update: NPM dependencies.
* Fix: Preformatted block width in Gutenberg editor.
* Fix: Add Easy Digital Downloads checkout button styles - discount, license key.

= 1.7.1 =
* Update: Font Awesome to v5.15.0
* Update: Move Homepage Hero YouTube video modal script to Conversions Extensions plugin.

= 1.7.2 =
* Update: Font Awesome to v5.15.1
* Update: Add conversions_edd_singular_price filter.
* Update: NPM dependencies.

= 1.7.3 =
* Update: Bootstrap to 4.5.3
* Update: NPM dependencies.
* Update: Composer dependencies.

== Resources ==

* Bootstrap 4.5.3 | MIT License
* Font Awesome v5.15.1 | Icons: CC BY 4.0, Font: SIL OFL 1.1, Code: MIT License
* WP Bootstrap Navwalker | GPL-3.0+
* _s, or underscores | GPLv2 or later
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