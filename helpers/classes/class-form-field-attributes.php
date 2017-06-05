<?php
/**
 * Form Field Attributes
 *
 * @package     BBPress_Live_Preview
 * @subpackage  BBPress_Live_Preview/Helpers/Classes
 * @author      Jason Witt <contact@jawittdesigns.com>
 * @copyright   Copyright (c) 2016, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

namespace BBPress_Live_Preview\Helpers\Classes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

if ( ! class_exists( 'FormFieldAttributes' ) ) {
	/**
	 * Form Field Attributes
	 *
	 * @since 1.0.0
	 */
	class FormFieldAttributes {

		/**
		 * Attributes
		 *
		 * @since  1.0.0
		 * @param  string $id The option ID.
		 * @param  string $prefix The Perfix,
		 * @param  string $option The option to use.
		 * @return array $attributes The field attributes
		 */
		public static function attributes( $id, $prefix, $option = '' ) {
			$option = ( $option == '' ) ? get_option( $prefix ) : get_option( $option );
			$items  = array(
				'setting' => isset( $option[ $id ] ) ? $option[ $id ] : '',
				'name'    => $prefix . '[' . $id . ']',
				'id'      => $prefix . '-' . $id,
			);
			$attributes = (object) $items;
			return $attributes;
		} // end attributes
	}
} // end FormFieldAttributes
