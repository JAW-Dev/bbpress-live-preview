<?php
namespace BBPress_Live_Preview\Includes\Model;

/**
 * Render Preview Model
 *
 * @package     BBPress_Live_Preview
 * @subpackage  BBPress_Live_Preview/Includes/Model
 * @author      Jason Witt <contact@jawittdesigns.com>
 * @copyright   Copyright (c) 2016, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

if ( ! class_exists( 'RenderPreviewModel' ) ) {
	/**
	 * Render Preview Model
	 *
	 * @package     BBPress_Live_Preview
	 * @subpackage  BBPress_Live_Preview/Includes/Model
	 * @author      Jason Witt <contact@jawittdesigns.com>
	 * @copyright   Copyright (c) 2016, Jason Witt
	 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
	 * @since       1.0.0
	 */
	class RenderPreviewModel {

		/**
		 * Initialize the class
		 *
		 * @uses  add_action();
		 * @since 1.0.0
		 */
		public function __construct() {
			add_action( 'bbp_theme_after_topic_form_content', array( $this, 'render_field' ) );
			add_action( 'bbp_theme_after_reply_form_content', array( $this, 'render_field' ) );
			add_action( 'bbp_theme_after_topic_form_content', array( $this, 'render_buttons' ) );
			add_action( 'bbp_theme_after_reply_form_content', array( $this, 'render_buttons' ) );
			add_action( 'bbp_theme_before_reply_form',        array( $this, 'tinymce_setup' ) );
			add_action( 'bbp_theme_before_topic_form',        array( $this, 'tinymce_setup' ) );
		} // end __construct()

		/**
		 * Render
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function render_field() {
			echo $this->get_preview_container();
		} // end render_field

		/**
		 * Render Buttons
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function render_buttons() {
		  echo $this->get_preview_buttons();
		} // end render_buttons

		/**
		 * Get Preview Container
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function get_preview_container() {
			require_once BBPLP_PLUGIN_DIR . 'includes/view/preview-container-view.php';
		} // end get_preview_container

		/**
		 * Get Preview Buttons
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function get_preview_buttons() {
			require_once BBPLP_PLUGIN_DIR . 'includes/view/preview-buttons-view.php';
		} // end get_preview_buttons

		/**
		 * TinyMCE Setup
		 *
		 * @uses  add_filter();
		 * @since  1.0.0
		 * @return void
		 */
		public function tinymce_setup() {
			add_filter( 'teeny_mce_before_init', array( $this, 'tinymce_callback' ) );
			add_filter( 'tiny_mce_before_init',  array( $this, 'tinymce_callback' ) );
		} // end tinymce_setup

		/**
		 * TinyMCE Callback
		 *
		 * @since  1.0.0
		 * @return array $mce The array of tineMCE parameters
		 */
		public function tinymce_callback( $mce ) {
			$mce['handle_event_callback'] = 'bbplp.tinyMCEAjax';
			return $mce;
		} // end tinymce_callback
	}
} // end RenderPreviewModel
