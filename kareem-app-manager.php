<?php
/**
 * Plugin Name: Kareem App Manager
 * Plugin URI:  https://github.com/kareemsamman/kareem-app-manager
 * Description: Custom app manager plugin with GitHub-based auto-updates.
 * Version:     2.0.0
 * Author:      Kareem Samman
 * Author URI:  https://github.com/kareemsamman
 * License:     GPL-2.0+
 * Text Domain: kareem-app-manager
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
      exit;
}

// Plugin constants.
define( 'KAM_VERSION', '2.0.0' );
define( 'KAM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'KAM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'KAM_PLUGIN_FILE', __FILE__ );

/**
 * ── GitHub Auto-Updater ─────────────────────────────────────────
   * Uses YahnisElsts/plugin-update-checker (v5).
   * Checks your GitHub repo's Releases for new tags.
   */
if ( is_admin() ) {
      $puc_autoload = KAM_PLUGIN_DIR . 'plugin-update-checker/plugin-update-checker.php';
      if ( file_exists( $puc_autoload ) ) {
                require_once $puc_autoload;

          $kam_update_checker = YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
                        'https://github.com/kareemsamman/kareem-app-manager/',
                        __FILE__,
                        'kareem-app-manager'
                    );

          // Tell the updater to look at GitHub Releases.
          $kam_update_checker->getVcsApi()->enableReleaseAssets();

          // ── If the repo is PRIVATE, uncomment the next line and add a token ──
          // $kam_update_checker->setAuthentication( 'ghp_YOUR_PERSONAL_ACCESS_TOKEN' );
      }
}

/**
 * ── Plugin Activation ───────────────────────────────────────────
   */
function kam_activate() {
      // Activation tasks (create tables, set options, etc.)
    update_option( 'kam_version', KAM_VERSION );
}
register_activation_hook( __FILE__, 'kam_activate' );

/**
 * ── Plugin Deactivation ─────────────────────────────────────────
   */
function kam_deactivate() {
      // Cleanup tasks.
}
register_deactivation_hook( __FILE__, 'kam_deactivate' );

/**
 * ── Admin Menu ──────────────────────────────────────────────────
   */
function kam_admin_menu() {
      add_menu_page(
                'Kareem App Manager',
                'App Manager',
                'manage_options',
                'kareem-app-manager',
                'kam_admin_page',
                'dashicons-admin-generic',
                80
            );
}
add_action( 'admin_menu', 'kam_admin_menu' );

/**
 * Admin page callback.
   */
function kam_admin_page() {
      ?>
      <div class="wrap">
          <h1>Kareem App Manager</h1>h1>
              <p>Version: <?php echo esc_html( KAM_VERSION ); ?></p>p>
              <p>Your plugin is active and receiving auto-updates from GitHub.</p>p>
      </div>div>
    <?php
}
</p></p></h1>
