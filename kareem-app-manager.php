<?php
/**
 * Plugin Name: Kareem App Manager
 * Plugin URI: https://github.com/kareemsamman/kareem-app-manager
 * Description: Custom app manager plugin with GitHub-based auto-updates.
 * Version: 2.0.1
 * Author: Kareem Samman
 * Author URI: https://github.com/kareemsamman
 * License: GPL-2.0+
 * Text Domain: kareem-app-manager
 */


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


// Plugin constants.
define( 'KAM_VERSION', '2.0.1' );
define( 'KAM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'KAM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'KAM_PLUGIN_FILE', __FILE__ );


/**
 * GitHub Auto-Updater
 * Uses YahnisElsts/plugin-update-checker (v5).
 * Checks your GitHub repo Releases for new tags.
 */
if ( is_admin() ) {
    $puc_autoload = KAM_PLUGIN_DIR . 'plugin-update-checker/plugin-update-checker.php';
    if ( file_exists( $puc_autoload ) ) {
        require_once $puc_autoload;


        $kam_update_checker = YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
            'https://github.com/kareemsamman/kareem-app-manager/',
            __FILE__,
