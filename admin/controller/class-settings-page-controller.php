<?php
/**
 * Settings Page Controller
 *
 * @package     BBPress_Live_Preview
 * @subpackage  BBPress_Live_Preview/Admin/Controller
 * @author      Jason Witt <contact@jawittdesigns.com>
 * @copyright   Copyright (c) 2016, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

namespace BBPress_Live_Preview\Admin\Controller;

use BBPress_Live_Preview\Admin\Model as Model;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

if ( ! class_exists( 'SettingsPageController' ) ) {
	/**
	 * Settings Page Controller
	 *
	 * @since 1.0.0
	 */
	class SettingsPageController {

		/**
		 * Initialize the class
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			new Model\SettingsPageModel();
		} // end __construct

	}
} // end SettingsPageController
