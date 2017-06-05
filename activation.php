<?php
/**
 * Activation
 *
 * Called on plugin activation
 *
 * @package    Package
 * @subpackage Package/SubPackage
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2016, Jason Witt
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since      1.0.0
 */

namespace BBPress_Live_Preview;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

if ( ! class_exists( 'BBPLP_Activation' ) ) {
	/**
	 * Activation
	 *
	 * @since      1.0.0
	 */
	class BBPLP_Activation {

		/**
		 * Initialize the class
		 *
		 * @uses  flush_rewrite_rules()
		 * @since 1.0.0
		 */
		public function init() {
			$this->settings_options();
			flush_rewrite_rules();
		} // end init

		/**
		 * Add Default Settings Options
		 *
		 * @uses  add_option()
		 * @uses  get_option()
		 * @uses  update_option()
		 * @since  1.0.0
		 * @return void
		 */
		public function settings_options() {
			$option     = BBPLP_SETTINGS;
			$get_option = get_option( $option, array() );
			$settings   = array(
				'preview_type'     => 'toggle',
				'use_default'      => 1,
				'preview_size'     => 'match',
				'border_type'      => 'solid',
				'border_width'     => '1px',
				'border_color'     => '#DDDDDD',
				'background_color' => '#FFFFFF',
				'padding'          => '10px',
			);
			if ( ! $get_option ) {
				add_option( $option, $settings );
			} else {
				foreach ( $settings as $key => $value  ) {
					if ( ! array_key_exists( $key, $get_option ) ) {
						update_option( $option, $settings );
					}
				}
			}
		} // end settings_options

	}
} // end BBPLP_Activation
$activation = new BBPLP_Activation();
register_activation_hook( BBPLP_PLUGIN_FILE, array( $activation, 'init' ) );
