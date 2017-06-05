<?php
/**
 * Includes Scripts
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

if ( ! class_exists( 'IncludesScripts' ) ) {
	/**
	 * Includes Scripts
	 *
	 * @since 1.0.0
	 */
	class IncludesScripts {

		/**
		 * Initialize the class
		 *
		 * @uses  is_admin();
		 * @uses  add_action();
		 * @since 1.0.0
		 */
		public function __construct() {
			if ( ! is_admin() ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'public_scripts' ) );
			}
		} // end __construct

		/**
		 * Enqueue Scripts
		 *
		 * @uses   wp_register_script()
		 * @uses   wp_enqueue_script()
		 * @uses   wp_localize_script()
		 * @uses   get_option()
		 * @since  1.0.0
		 * @return void
		 */
		public function public_scripts() {
			$option = get_option( BBPLP_SETTINGS );
			wp_register_script(
				BBPLP_PREFIX . '-public-js',
				BBPLP_PLUGIN_URL . 'includes/assets/js/scripts.min.js',
				array( 'bbpress-editor' ),
				BBPLP_VERSION, true
			);
			wp_enqueue_script( BBPLP_PREFIX . '-public-js' );
			wp_localize_script(
				BBPLP_PREFIX . '-public-js',
				'bblpSettings',
				array(
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'type'    => $option['preview_type'],
					'size'    => $option['preview_size'],
				)
			);
		} // end public_scripts
	}
} // end IncludesScripts
