<?php
/**
 * PLugin Row Meta Controller
 *
 * @package     BBPress_Live_Preview
 * @subpackage  BBPress_Live_Preview/Admin/Controller
 * @author      Jason Witt <contact@jawittdesigns.com>
 * @copyright   Copyright (c) 2016, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

namespace BBPress_Live_Preview\Admin\Controller;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

if ( ! class_exists( 'PluginRowMetaController' ) ) {
	/**
	 * Plugin Row Meta Controller
	 *
	 * @since 1.0.0
	 */
	class PluginRowMetaController {

		/**
		 * Initialize the class
		 *
		 * @uses  add_filter()
		 * @since 1.0.0
		 */
		public function __construct() {
			add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );
		} // end __construct

		/**
		 * Settings Link
		 *
		 * @since  1.0.0
		 * @uses   plugin_basename()
		 * @param  array $links The current array of action links.
		 * @param  array $file The plugin file name.
		 * @return array $links The new array of action links
		 */
		public function plugin_row_meta( $links, $file ) {
			if ( strpos( $file, plugin_basename( BBPLP_PLUGIN_FILE ) ) !== false ) {
				$new_links = array(
					'github'    => '<a href="Github_URI" target="_blank">GitHub</a>',
					'donate' => '<a href="http://jawittdesigns.com/donations/" target="_blank">Donate</a>',
				);
				$links = array_merge( $links, $new_links );
			}
			return $links;
		} // end plugin_row_meta
	}
} // end PluginRowMetaController
