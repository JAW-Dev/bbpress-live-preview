<?php
/**
 * Autoloader
 *
 * @package    BBPress_Live_Preview
 * @subpackage BBPress_Live_Preview/Helpers
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2016, Jason Witt
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since      1.0.0
 */

namespace BBPress_Live_Preview\Helpers;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

if ( ! class_exists( 'Autoloader' ) ) {
	/**
	 * Autoloader
	 *
	 * @since      1.0.0
	 */
	class Autoloader {

		/**
		 * Paths
		 *
		 * No leading or trailing slashed required.
		 *
		 * @since 1.0.0
		 * @var string $paths The path to the classes to load
		 */
		private $paths;

		/**
		 * Initialize the class
		 *
		 * @uses  spl_autoload_register()
		 * @param array $paths The path to the classes to load.
		 * @since 1.0.0
		 */
		public function __construct( $paths ) {
			$this->paths = $paths;
			spl_autoload_register( array( $this, 'autoloader' ) );
		} // end __construct()

		/**
		 * Autoloader
		 *
		 * @since  1.0.0
		 * @return void
		 */
		private function autoloader() {
			if ( '' !== $this->paths ) {
				if ( is_array( $this->paths ) ) {
					foreach ( $this->paths as $path ) {
						foreach ( glob( BBPLP_PLUGIN_DIR . trim( $path ) . '/*.php' ) as $file_name ) {
							if ( is_file( $file_name ) && file_exists( $file_name ) ) {
								require_once $file_name;
							} else {
								trigger_error( 'Could not find classes in ' . esc_attr( $file_name ) . '!', E_USER_ERROR );
							}
						}
					}
				} else {
					foreach ( glob( BBPLP_PLUGIN_DIR . trim( $this->paths ) . '/*.php' ) as $file_name ) {
						if ( is_file( $file_name ) && file_exists( $file_name ) ) {
							require_once $file_name;
						} else {
							trigger_error( 'Could not find classes in ' . esc_attr( $file_name ) . '!', E_USER_ERROR );
						}
					}
				}
			}
		} // end autoloder()
	}
} // end Autoloader

if ( ! function_exists( 'bbplp_autoloader' ) ) {
	/**
	 * Autoloader Template Function
	 *
	 * Load classes in specified directory path
	 *
	 * examples:
	 *   yourprefix_autoloader( 'Path/To/Your/Classes/Directory' );
	 *
	 *   $array = array( 'Path/To/Your/Classes/Directory' );
	 *   yourprefix_autoloader( $array );
	 *
	 * @version 1.0.0
	 * @param   string $paths the directory pointing to the classes.
	 * @return  void
	 */
	function bbplp_autoloader( $paths ) {
		$bbplp_autoloader = new Autoloader( $paths );
	}
} // end bbplp_autoloader
