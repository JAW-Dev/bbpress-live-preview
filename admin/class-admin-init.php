<?php
/**
 * Admin Instantiate
 *
 * @package    Package
 * @subpackage Package/SubPackage
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2016, Jason Witt
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since      1.0.0
 */

namespace BBPress_Live_Preview\Admin;

use BBPress_Live_Preview\Admin\Controller as Controller;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

if ( ! class_exists( 'AdminInit' ) ) {
	/**
	 * Admin Instantiate
	 *
	 * @since 1.0.0
	 */
	class AdminInit {

		/**
		 * Initialize the class
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			new Controller\SettingsPageController();
			new Controller\ActionLinksController();
			new Controller\PluginRowMetaController();
		} // end __construct

	}
} // end AdminInit
