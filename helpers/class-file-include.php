<?php
namespace BBPress_Live_Preview\Helpers;

/**
 * FileInclude
 *
 * @package    BBPress_Live_Preview
 * @subpackage BBPress_Live_Preview/Helpers
 * @author     Author_Name <Author_Email>
 * @copyright  Copyright (c) The_Year, Author_Name
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since      1.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

if ( ! class_exists( 'FileInclude' ) ) {
	/**
	 * FileInclude
	 *
	 * @since 1.0.0
	 */
	class FileInclude {

		/**
		 * Paths
		 *
		 * No leading or trailing slashed required.
		 *
		 * @since 1.0.0
		 * @var   @var string $paths The path to the files to load
		 */
		private $paths;

		/**
		 * Is Admin
		 *
		 * If you only want to load file if in the admin dashboard
		 *
		 * @since 1.0.0
		 * @var   @var boolean $is_admin
		 */
		private $is_admin;

		/**
		 * Initialize the class
		 *
		 * @since 1.0.0
		 * @param array   $paths The path to the files to load.
		 * @param boolean $is_admin The path to the files to load.
		 */
		public function __construct( $paths, $is_admin = false ) {
			$this->paths    = $paths;
			$this->is_admin = $is_admin;
			$this->include_files();
		} // end __construct

		/**
		 * FileInclude
		 *
		 * @since      1.0.0
		 * @return     void
		 */
		private function include_files() {
			$pattern = '/(?<=\.[a-zA-Z0-9])/';
			if ( '' !== $this->paths ) {
				if ( is_array( $this->paths ) ) {
					foreach ( $this->paths as $path ) {
						$path = trim( $path );
						$full_path = BBPLP_PLUGIN_DIR . $path;
						$file_name = ( preg_match( $pattern, $path ) ) ? $full_path : $full_path . '.php';
						$this->includes( $file_name );
					}
				} else {
					$this->paths = trim( $this->paths );
					$full_path = BBPLP_PLUGIN_DIR . $this->paths;
					$file_name = ( preg_match( $pattern, $this->paths ) ) ? $full_path : $full_path . '.php';
					$this->includes( $file_name );
				}
			}
		} // end include_files()

		/**
		 * Include
		 *
		 * @since  1.0.0
		 * @param  string $file_name The file path.
		 * @return void
		 */
		private function includes( $file_name ) {
			if ( is_file( $file_name ) && file_exists( $file_name ) ) {
				if ( true === $this->is_admin ) {
					if ( is_admin() ) {
						include $file_name;
					}
				} else {
					include $file_name;
				}
			}
		} // end include
	}
} // end FileInclude

if ( ! function_exists( 'bbplp_include' ) ) {
	/**
	 * FileInclude Template Function
	 *
	 * File extentions is optional, defaults to ".php".
	 *
	 * examples:
	 *   bbplp_include( 'Path/To/Your/File' );
	 *
	 *   $array = array( 'Path/To/Your/File' );
	 *   bbplp_include( $array );
	 *
	 * @version    1.0.0
	 * @param      string $paths The path to the files to load.
	 * @return     void
	 */
	function bbplp_include( $paths ) {
		$bbplp_include = new FileInclude( $paths );
	}
} // end bbplp_include
