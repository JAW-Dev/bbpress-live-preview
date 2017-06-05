<?php
/**
 * Action Links Controller
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

if ( ! class_exists( 'ActionLinksController' ) ) {
	/**
	 * Action Links Controller
	 *
	 * @since 1.0.0
	 */
	class ActionLinksController {

		/**
		 * Admin URL
		 *
		 * @since  1.0.0
		 * @var    string $admin_url The URL tot the settings page.
		 */
		protected $admin_url;

		/**
		 * Initialize the class
		 *
		 * @uses  add_filter()
		 * @since 1.0.0
		 */
		public function __construct() {
			$this->admin_url = admin_url( 'options-general.php?page=' . BBPLP_PREFIX );
			add_filter( 'plugin_action_links_' . plugin_basename( BBPLP_PLUGIN_FILE ), array( $this, 'settings_link' ) );
		} // end __construct

		/**
		 * Settings Link
		 *
		 * @since  1.0.0
		 * @param  array $links The current array of action links.
		 * @return array $links The new array of action links.
		 */
		public function settings_link( $links ) {
			$links[] = '<a href="' . $this->admin_url . '">Settings</a>';
			return $links;
		} // end settings_link
	}
} // end ActionLinksController