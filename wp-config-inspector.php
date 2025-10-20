<?php
/**
 * Plugin Name: WP Config Inspector
 * Description: Inspect key WordPress constants and server environment details. Export results and use via WP‑CLI.
 * Version: 1.0.0
 * Author: Best Website
 * Author URI: https://bestwebsite.com/
 * License: GPL-2.0+
 * Text Domain: wp-config-inspector
 * Domain Path: /languages
 */
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'BWCI_VERSION', '1.0.0' );
define( 'BWCI_FILE', __FILE__ );
define( 'BWCI_DIR', plugin_dir_path( __FILE__ ) );
define( 'BWCI_URL', plugin_dir_url( __FILE__ ) );

spl_autoload_register( function( $class ) {
    $prefix = 'BestWebsite\\ConfigInspector\\';
    $base   = BWCI_DIR . 'includes/';
    $len    = strlen( $prefix );
    if ( strncmp( $prefix, $class, $len ) !== 0 ) return;
    $rel = substr( $class, $len );
    $file = $base . 'class-' . strtolower( str_replace( '\\', '-', $rel ) ) . '.php';
    if ( file_exists( $file ) ) require_once $file;
} );

add_action( 'plugins_loaded', function() {
    load_plugin_textdomain( 'wp-config-inspector', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
});

add_action( 'plugins_loaded', function() {
    ( new BestWebsite\ConfigInspector\Core() )->init();
    if ( defined( 'WP_CLI' ) && WP_CLI ) require_once BWCI_DIR . 'includes/class-bwci-cli.php';
});
