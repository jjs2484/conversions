<?php
/**
 * Conversions functions
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

require_once( __DIR__ . '/vendor/autoload.php' );

new \conversions\Conversions();
conversions()->load();
