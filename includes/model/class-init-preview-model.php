<?php
/**
 * Instantiate Preview Model
 *
 * @package     BBPress_Live_Preview
 * @subpackage  BBPress_Live_Preview/Includes/Model
 * @author      Jason Witt <contact@jawittdesigns.com>
 * @copyright   Copyright (c) 2016, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

namespace BBPress_Live_Preview\Includes\Model;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

if ( ! class_exists( 'InitPreviewModel' ) ) {
	/**
	 * Instantiate Preview Model
	 *
	 * @since 1.0.0
	 */
	class InitPreviewModel {

		/**
		 * Class
		 *
		 * @since  1.0.0
		 * @var    type var description
		 */
		public $class;

		/**
		 * Initialize the class
		 *
		 * @uses  add_action();
		 * @since 1.0.0
		 */
		public function __construct() {
			if ( is_admin() ) {
				add_action( 'wp_ajax_preview_action', array( $this, 'preview_action' ) );
				add_action( 'wp_ajax_nopriv_preview_action', array( $this, 'preview_action' ) );
			}
		} // end __construct

		/**
		 * Preview Action
		 *
		 * @uses   wpautop();
		 * @uses   bbp_code_trick();
		 * @since  1.0.0
		 * @return void
		 */
		public function preview_action() {
			if ( isset( $_REQUEST ) ) {
				$content = $_REQUEST['content'];
			}
			echo wpautop( bbp_kses_data( bbp_code_trick( stripslashes( $content ) ) ) );
			die();
		} // end preview_action
	}
} // end InitPreviewModel
