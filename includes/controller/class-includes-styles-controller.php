<?php
/**
 * Includes Styles
 *
 * @package     BBPress_Live_Preview
 * @subpackage  BBPress_Live_Preview/Includes/Controller
 * @author      Jason Witt <contact@jawittdesigns.com>
 * @copyright   Copyright (c) 2016, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

namespace BBPress_Live_Preview\Includes\Controller;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

if ( ! class_exists( 'IncludesStyles' ) ) {
	/**
	 * Includes Styles
	 *
	 * @since 1.0.0
	 */
	class IncludesStyles {

		/**
		 * Settings Option
		 *
		 * @since  1.0.0
		 * @var    string $settings_option The settings main option
		 */
		private $settings_option;

		/**
		 * Initialize the class
		 *
		 * @uses  is_admin()
		 * @uses  get_option()
		 * @uses  add_action()
		 * @since 1.0.0
		 */
		public function __construct() {
			$this->settings_option = get_option( BBPLP_SETTINGS );
			if ( ! is_admin() ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );
			}
		} // end __construct

		/**
		 * Public Styles
		 *
		 * @uses   wp_register_style()
		 * @uses   wp_enqueue_style()
		 * @since  1.0.0
		 * @return void
		 */
		public function styles() {
			wp_register_style(
				BBPLP_PREFIX . '-styles',
				BBPLP_PLUGIN_URL . 'includes/assets/css/styles.css',
				array(),
				BBPLP_VERSION,
				'all'
			);
			wp_enqueue_style( BBPLP_PREFIX . '-styles' );
		} // end styles

	}
} // end IncludesStyles
