<?php
/**
 * Form Preview Controller
 *
 * @package     BBPress_Live_Preview
 * @subpackage  BBPress_Live_Preview/Includes/Controller
 * @author      Jason Witt <contact@jawittdesigns.com>
 * @copyright   Copyright (c) 2016, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

namespace BBPress_Live_Preview\Includes\Controller;

use BBPress_Live_Preview\Includes\Model as Model;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

if ( ! class_exists( 'FormPreviewController' ) ) {
	/**
	 * Form Preview Controller
	 *
	 * @since 1.0.0
	 */
	class FormPreviewController {

		/**
		 * Initialize the class
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			new Model\RenderPreviewModel();
			new Model\InitPreviewModel();
		} // end __construct

	}
} // end FormPreviewController
