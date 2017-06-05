<?php
/**
 * Template Functions
 *
 * @package    BBPress_Live_Preview
 * @subpackage BBPress_Live_Preview/Helpers
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2016, Jason Witt
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since      1.0.0
 */

use BBPress_Live_Preview\Helpers\Classes  as Helpers;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }


/**
 * Form Field Attributes
 *
 * @version    1.0.0
 * @return     void
 */
if( !function_exists( 'bbplp_form_field_attributes') ) {
  function bbplp_form_field_attributes( $id, $prefix, $option = '' ) {
  	return Helpers\FormFieldAttributes::attributes( $id, $prefix, $option );
  }
} // end bbplp_form_field_attributes