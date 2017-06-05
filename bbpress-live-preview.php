<?php
/**
 * BBPress_Live_Preview
 *
 * @package     bbPress: Live Preview Addon
 * @author      Jason Witt <contact@jawittdesigns.com>
 * @copyright   Copyright (c) The_2016, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       bbPress: Live Preview Addon
 * Plugin URI:        https://wordpress.org/plugins/bbpress-live-preview
 * Description:       Add live preview to the bbPress plugin forums
 * Version:           1.0.0
 * Author:            Jason Witt
 * Author URI:        http://jawittdesigns.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bbplp
 * Domain Path:       /languages
 */

namespace BBPress_Live_Preview;

use BBPress_Live_Preview\Helpers as Helpers;
use BBPress_Live_Preview\Admin as Admin;
use BBPress_Live_Preview\Includes as Includes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

if ( ! class_exists( 'BBPLP' ) ) {
	/**
	 * BBPress_Live_Preview
	 *
	 * @since 1.0.0
	 */
	class BBPLP {

		/**
		 * Instance of the class
		 *
		 * @since 1.0.0
		 * @var Instance of BBPLP class
		 */
		private static $instance;

		/**
		 * Instance of the plugin
		 *
		 * @uses  add_action()
		 * @since 1.0.0
		 * @static
		 * @staticvar array
		 * @return Instance
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof BBPLP ) ) {
				self::$instance = new BBPLP;
				self::$instance->define_constants();
				add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
				self::$instance->includes();
				self::$instance->init = new Includes\IncludesInit();
				if ( is_admin() ) {
					self::$instance->admin_init = new Admin\AdminInit();
				}
			}
			return self::$instance;
		}

		/**
		 * Define the plugin constants
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function define_constants() {
			// Plugin Version.
			if ( ! defined( 'BBPLP_VERSION' ) ) {
				define( 'BBPLP_VERSION', '1.0.0' );
			}
			// BBPLP.
			if ( ! defined( 'BBPLP_PREFIX' ) ) {
				define( 'BBPLP_PREFIX', 'bbplp' );
			}
			// Settings.
			if ( ! defined( 'BBPLP_SETTINGS' ) ) {
				define( 'BBPLP_SETTINGS', 'bbplp_settings' );
			}
			// Plugin Directory.
			if ( ! defined( 'BBPLP_PLUGIN_DIR' ) ) {
				define( 'BBPLP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}
			// Plugin URL.
			if ( ! defined( 'BBPLP_PLUGIN_URL' ) ) {
				define( 'BBPLP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}
			// Plugin Root File.
			if ( ! defined( 'BBPLP_PLUGIN_FILE' ) ) {
				define( 'BBPLP_PLUGIN_FILE', __FILE__ );
			}
		}

		/**
		 * Load the required files
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function includes() {
			// Autoloader.
			if ( file_exists( BBPLP_PLUGIN_DIR . 'helpers/class-autoloader.php' ) ) {
				require_once BBPLP_PLUGIN_DIR . 'helpers/class-autoloader.php';
			}
			// Include.
			if ( file_exists( BBPLP_PLUGIN_DIR . 'helpers/class-file-include.php' ) ) {
				require_once BBPLP_PLUGIN_DIR . 'helpers/class-file-include.php';
			}
			// Load Classes.
			$class_paths = array(
				// Helpers.
					'helpers/classes',
					'helpers/vendor/classes',
				// Includes.
					'includes/controller',
					'includes/model',
					'includes/vendor/classes',
				// Admin.
					'admin/controller',
					'admin/model',
					'admin/vendor/classes',
			);
			Helpers\bbplp_autoloader( $class_paths );
			// Load Files.
			$file_paths = array(
				'helpers/template-functions',
				'includes/class-includes-init',
				'activation',
			);
			Helpers\bbplp_include( $file_paths );
			Helpers\bbplp_include( 'admin/class-admin-init.php', true );
		}

		/**
		 * Load the plugin text domain for translation.
		 *
		 * @uses   plugin_basename()
		 * @uses   load_textdomain()
		 * @uses   load_plugin_textdomain()
		 * @since  1.0.0
		 * @access public
		 */
		public function load_textdomain() {
			$bbplp_lang_dir = dirname( plugin_basename( BBPLP_PLUGIN_FILE ) ) . '/languages/';
			$bbplp_lang_dir = apply_filters( 'bbplp_lang_dir', $bbplp_lang_dir );
			$locale = apply_filters( 'plugin_locale',  get_locale(), 'textdomain' );
			$mofile = sprintf( '%1-%2.mo', 'textdomain', $locale );
			$mofile_local  = $bbplp_lang_dir . $mofile;
			if ( file_exists( $mofile_local ) ) {
				load_textdomain( 'textdomain', $mofile_local );
			} else {
				load_plugin_textdomain( 'textdomain', false, $bbplp_lang_dir );
			}
		}

		/**
		 * Throw error on object clone
		 *
		 * @uses   _doing_it_wrong()
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function __clone() {
			$messeage = __( 'Cheatin&#8217; huh?', 'textdomain' );
			_doing_it_wrong( __FUNCTION__, esc_attr( $messeage ), '1.6' );
		}

		/**
		 * Disable unserializing of the class
		 *
		 * @uses   _doing_it_wrong()
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function __wakeup() {
			$messeage = __( 'Cheatin&#8217; huh?', 'textdomain' );
			_doing_it_wrong( __FUNCTION__, esc_attr( $messeage ), '1.6' );
		}
	}
} // end BBPLP
/**
 * Return the instance
 *
 * @since 1.0.0
 * @return object The Safety Links instance
 */
function bbplp_run() {
	return BBPLP::instance();
} // end bbplp_run
bbplp_run();
