<?php
/**
 * Public Instantiate
 *
 * @package    Package
 * @subpackage Package/SubPackage
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2016, Jason Witt
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since      1.0.0
 */

namespace BBPress_Live_Preview\Includes;

use BBPress_Live_Preview\Includes\Controller as Controller;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

if ( ! class_exists( 'IncludesInit' ) ) {
	/**
	 * Public Instantiate
	 *
	 * @since      1.0.0
	 */
	class IncludesInit {

		/**
		 * Initialize the class
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			new Controller\IncludesScripts();
			new Controller\IncludesStyles();
			new Controller\FormPreviewController();
		} // end __construct
	}
} // end IncludesInit

