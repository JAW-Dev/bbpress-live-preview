<?php
/**
 * Settings Page Model
 *
 * @package     BBPress_Live_Preview
 * @subpackage  BBPress_Live_Preview/Admin/Model
 * @author      Jason Witt <contact@jawittdesigns.com>
 * @copyright   Copyright (c) 2016, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

namespace BBPress_Live_Preview\Admin\Model;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

if ( ! class_exists( 'SettingsPageModel' ) ) {
	/**
	 * Settings Page Model
	 *
	 * @since 1.0.0
	 */
	class SettingsPageModel {

		/**
		 * Prefix
		 *
		 * @since  1.0.0
		 * @var    string $prefix The plugin prefix
		 */
		protected $prefix;

		/**
		 * Settings Option
		 *
		 * @since  1.0.0
		 * @var    string $settings_option The settings main option
		 */
		private $settings_option;

		/**
		 * Setting page title
		 *
		 * @since  1.0.0
		 * @var    string $page_title The title pf the settings page.
		 */
		protected $page_title;

		/**
		 * Initialize the class
		 *
		 * @uses  add_action()
		 * @uses  get_option()
		 * @since 1.0.0
		 */
		public function __construct() {
			$this->prefix          = BBPLP_SETTINGS;
			$this->settings_option = get_option( $this->prefix );
			$this->page_title      = __( 'bbPress Live Preview Settings', 'bbplp' );
			add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
			add_action( 'admin_init', array( $this, 'settings_page_init' ) );
		} // end __construct()

		/**
		 * Add Settings Page
		 *
		 * @uses  add_options_page()
		 * @uses  add_action()
		 * @since 1.0.0
		 * @return void
		 */
		public function add_settings_page() {
			$settings_page = add_options_page(
				__( 'bbPress Live Preview', 'bbplp' ),
				__( 'bbPress Live Preview', 'bbplp' ),
				'manage_options',
				BBPLP_PREFIX,
				array( $this, 'render_settings_page' )
			);
			add_action( "admin_print_styles-{$settings_page}", array( $this, 'enqueue_styles' ) );
			add_action( "admin_print_scripts-{$settings_page}", array( $this, 'enqueue_scripts' ) );
		} // end add_settings_page()

		/**
		 * Settings Page Init
		 *
		 * @uses  register_setting()
		 * @uses  add_settings_section()
		 * @uses  add_settings_field()
		 * @since 1.0.0
		 * @return void
		 */
		public function settings_page_init() {
			register_setting(
				BBPLP_SETTINGS . '_group',
				BBPLP_SETTINGS,
				array( $this, 'sanitize' )
			);
			// Preview Type Section.
			add_settings_section(
				BBPLP_SETTINGS . '_preview_type_section',
				__( 'Preview Type', 'bbplp' ),
				array( $this, 'preview_type_section_information' ),
				BBPLP_SETTINGS
			);
			$preview_type_fields = [
				[ 'preview_type', 'Preview Type',      array( $this, 'preview_type_callback' ) ],
				[ 'use_default',  'Use Defaut Styles', array( $this, 'preview_styles_default_callback' ) ],
			];
			foreach ( $preview_type_fields as $field ) {
				add_settings_field(
					$field[0],
					$field[1],
					$field[2],
					BBPLP_SETTINGS,
					BBPLP_SETTINGS . '_preview_type_section'
				);
			}
			// Preview Styles Section.
			add_settings_section(
				BBPLP_SETTINGS . '_preview_styles_section',
				__( 'Preview Box Display', 'bbplp' ),
				array( $this, 'preview_styles_section_information' ),
				BBPLP_SETTINGS
			);
			$preview_styles_fields = [
				[ 'preview_size',     'Preview Area Size',   array( $this, 'preview_styles_preview_size_callback' ) ],
				[ 'preview_height',   'Preview Area Height', array( $this, 'preview_styles_preview_height_callback' ) ],
				[ 'preview_width',    'Preview Area Width',  array( $this, 'preview_styles_preview_width_callback' ) ],
				[ 'border_type',      'Border Type',         array( $this, 'preview_styles_border_type_callback' ) ],
				[ 'border_width',     'Border Width',        array( $this, 'preview_styles_border_width_callback' ) ],
				[ 'border_color',     'Border Color',        array( $this, 'preview_styles_border_color_callback' ) ],
				[ 'background_color', 'Background Color',    array( $this, 'preview_styles_background_color_callback' ) ],
				[ 'padding',          'Padding',             array( $this, 'preview_styles_padding_callback' ) ],
			];
			foreach ( $preview_styles_fields as $field ) {
				add_settings_field(
					$field[0],
					$field[1],
					$field[2],
					BBPLP_SETTINGS,
					BBPLP_SETTINGS . '_preview_styles_section'
				);
			}
		} // end settings_page_init

		/**
		 * Preview Type Section Information
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function preview_type_section_information() {
			echo '<p>Choose the type of preview for your forums.<br />
							<strong>Toggle</strong> creates buttons to toggle from the editor to the preview.<br />
							<strong>Inline</strong> will show the preview area next to or below the editor depending on your theme.</p>';
		} // end preview_type_section_information

		/**
		 * Preview Styles Section Information
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function preview_styles_section_information() {
			echo '<p class="bbplp-field-toggle bbplp-hide">Change the style of the preview box.';
		} // end preview_styles_section_information

		/**
		 * Render Settings Page
		 *
		 * @uses   settings_fields()
		 * @uses   do_settings_sections()
		 * @uses   submit_button()
		 * @since  1.0.0
		 * @return void
		 */
		public function render_settings_page() {
			echo '<div class="wrap"><h2>' . esc_attr( $this->page_title ) . '</h2><form method="post" action="options.php">';
			settings_fields( BBPLP_SETTINGS . '_group' );
			do_settings_sections( BBPLP_SETTINGS );
			submit_button( 'Save Settings' );
			echo '</form></div>';
		} // end render_settings_page

		/**
		 * Preview Type
		 *
		 * @uses   esc_attr()
		 * @since  1.0.0
		 * @return void
		 */
		public function preview_type_callback() {
			$option = bbplp_form_field_attributes( 'preview_type', $this->prefix );
			$radios = array(
				'preview_toggle' => array( 'toggle' => 'Toggle' ),
				'preview_inline' => array( 'inline' => 'Inline' ),
			);
			$i = 0;
			echo '<fieldset>';
			foreach ( $radios as $radio ) {
				$id = str_replace( '_', '-', $this->prefix . '-' . key( $radios ) );
				$i++;
				foreach ( $radio as $key => $value ) {
					echo '<label for="' . esc_attr( $id . '-' . $i ) . '"><input type="radio" name="' . esc_attr( $option->name ) . '" id="' . esc_attr( $id . '-' . $i ) . '" value="' . esc_attr( $key ) . '" ';
					checked( $option->setting, $key );
					echo '> ' . esc_attr( $value ) . '</label><br>';
				}
			}
			echo '</fieldset>';
		} // end preview_type_callback()

		/**
		 * Use Default CSS
		 *
		 * @uses   esc_attr()
		 * @uses   checked()
		 * @since  1.0.0
		 * @return void
		 */
		public function preview_styles_default_callback() {
			$label  = isset( $this->settings_option['use_default'] ) ? 'Enabled' : 'Disabled';
			$option = bbplp_form_field_attributes( 'use_default', $this->prefix );
			echo '<label for="checkbox_3"><input type="checkbox" name="' . esc_attr( $option->name ) . '" id="' . esc_attr( $option->id ) . '" value="1" ';
			checked( $option->setting, 1 );
			echo '><span class="bbplp-checkbox-label">' . esc_attr( $label ) . '</span></label>';
		} // end preview_styles_default_callback

		/**
		 * Preview Size
		 *
		 * @uses   esc_attr()
		 * @uses   checked()
		 * @since  1.0.0
		 * @return void
		 */
		public function preview_styles_preview_size_callback() {
			$option = bbplp_form_field_attributes( 'preview_size', $this->prefix );
			$radios = array(
				'preview_match'  => array( 'match' => 'Match Editor Size' ),
				'preview_custom' => array( 'custom' => 'Custom Size' ),
			);
			$i = 0;
			echo '<fieldset class="bbplp-preview-type">';
			foreach ( $radios as $radio ) {
				$id = str_replace( '_', '-', $this->prefix . '-' . key( $radios ) );
				$i++;
				foreach ( $radio as $key => $value ) {
					echo '<label for="' . esc_attr( $id . '-' . $i ) . '"><input type="radio" name="' . esc_attr( $option->name ) . '" id="' . esc_attr( $id . '-' . $i ) . '" value="' . esc_attr( $key ) . '" ';
					checked( $option->setting, $key );
					echo '> ' . esc_attr( $value ) . '</label><br>';
				}
			}
			echo '</fieldset>';
		} // end preview_styles_preview_size_callback()

		/**
		 * Preview Height
		 *
		 * @uses   esc_attr()
		 * @since  1.0.0
		 * @return void
		 */
		public function preview_styles_preview_height_callback() {
			$option = bbplp_form_field_attributes( 'preview_height', $this->prefix );
			echo '<input class="small-text" type="text" name="' . esc_attr( $option->name ) . '" id="' . esc_attr( $option->id ) . '" value="' . esc_attr( $option->setting ) . '">';
			echo ' <em class="bbplp-field_description">Add your height by pixles "200px" or use "auto" for auto height</em>';
		} // end preview_styles_preview_height_callback()

		/**
		 * Preview Width
		 *
		 * @uses   esc_attr()
		 * @since  1.0.0
		 * @return void
		 */
		public function preview_styles_preview_width_callback() {
			$option = bbplp_form_field_attributes( 'preview_width', $this->prefix );
			echo '<input class="small-text" type="text" name="' . esc_attr( $option->name ) . '" id="' . esc_attr( $option->id ) . '" value="' . esc_attr( $option->setting ) . '">';
			echo ' <em class="bbplp-field_description">Add your width by pixles "200px" or use "auto" for auto width</em>';
		} // end preview_styles_preview_width_callback()

		/**
		 * Border Type
		 *
		 * @uses   esc_attr()
		 * @uses   selected()
		 * @since  1.0.0
		 * @return void
		 */
		public function preview_styles_border_type_callback() {
			$option = bbplp_form_field_attributes( 'border_type', $this->prefix );
			$selects = array(
				'solid'  => 'Solid',
				'dotted' => 'Dotted',
				'dashed' => 'Dashed',
				'double' => 'Double',
				'groove' => 'Groove',
				'ridge'  => 'Ridge',
				'inset'  => 'Inset',
				'outset' => 'Outset',
				'none'   => 'None',
			);
			echo '<select name="' . esc_attr( $option->name ) . '" id="' . esc_attr( $option->id ) . '">';
			foreach ( $selects as $key => $value ) {
				echo '<option value="' . esc_attr( $key ) . '"';
				selected( $option->setting, $key );
				echo '>' . esc_attr( $value ) . '</option>';
			}
			echo '</select>';
		} // end preview_styles_border_type_callback()

		/**
		 * Border Width
		 *
		 * @uses   esc_attr()
		 * @uses   selected()
		 * @since  1.0.0
		 * @return void
		 */
		public function preview_styles_border_width_callback() {
			$option = bbplp_form_field_attributes( 'border_width', $this->prefix );
			echo '<select name="' . esc_attr( $option->name ) . '" id="' . esc_attr( $option->id ) . '">';
			$widths = 20;
			for ( $i = 1; $i <= $widths; $i++ ) {
				$selected = $i . 'px';
				echo '<option value="' . esc_attr( $selected ) . '"';
				selected( $option->setting, $selected );
				echo '>' . esc_attr( $selected ) . '</option>';
			}
			echo '</select>';
		} // end preview_styles_border_width_callback()

		/**
		 * Border Color
		 *
		 * @uses   esc_attr()
		 * @since  1.0.0
		 * @return void
		 */
		public function preview_styles_border_color_callback() {
			$option = bbplp_form_field_attributes( 'border_color', $this->prefix );
			echo '<input class="bbplp-color-picker" type="text" name="' . esc_attr( $option->name ) . '" id="' . esc_attr( $option->id ) . '" data-default-color="#DDDDDD" value="' . esc_attr( $option->setting ) . '">';
		} // end preview_styles_border_color_callback()

		/**
		 * Background Color
		 *
		 * @uses   esc_attr()
		 * @since  1.0.0
		 * @return void
		 */
		public function preview_styles_background_color_callback() {
			$option = bbplp_form_field_attributes( 'background_color', $this->prefix );
			echo '<input class="bbplp-color-picker" type="text" name="' . esc_attr( $option->name ) . '" id="' . esc_attr( $option->id ) . '" data-default-color="#FFFFFF" value="' . esc_attr( $option->setting ) . '">';
		} // end preview_styles_background_color_callback()

		/**
		 * Padding
		 *
		 * @uses   esc_attr()
		 * @uses   selected()
		 * @since 1.0.0
		 * @return void
		 */
		public function preview_styles_padding_callback() {
			$option = bbplp_form_field_attributes( 'padding', $this->prefix );
			echo '<select name="' . esc_attr( $option->name ) . '" id="' . esc_attr( $option->id ) . '">';
			$widths = 20;
			for ( $i = 0; $i <= $widths; $i++ ) {
				$selected = $i . 'px';
				echo '<option value="' . esc_attr( $selected ) . '"';
				selected( $option->setting, $selected );
				echo '>' . esc_attr( $selected ) . '</option>';
			}
			echo '</select>';
		} // end preview_styles_padding_callback()

		/**
		 * Enqueue Scripts
		 *
		 * @uses   wp_register_script()
		 * @uses   wp_enqueue_script()
		 * @uses   wp_localize_script()
		 * @since  1.0.0
		 * @return void
		 */
		public function enqueue_scripts() {
			wp_enqueue_script( 'wp-color-picker' );
			// Custom Scripts.
			wp_register_script( BBPLP_PREFIX . '_admin_js', BBPLP_PLUGIN_URL . 'admin/assets/js/scripts.min.js', array( 'wp-color-picker' ), BBPLP_VERSION, true );
			wp_enqueue_script( BBPLP_PREFIX . '_admin_js' );
			wp_localize_script(
				BBPLP_PREFIX . '_admin_js',
				'bblpSettings',
				array(
					'previewType' => isset( $this->settings_option['use_default'] ) ? $this->settings_option['use_default'] : '0',
				)
			);
		} // end admin_scripts()

		/**
		 * Enqueue Styles
		 *
		 * @uses   wp_register_style()
		 * @uses   wp_enqueue_style()
		 * @since  1.0.0
		 * @return void
		 */
		public function enqueue_styles() {
			// Color Picker.
			wp_enqueue_style( 'wp-color-picker' );
			// Custom Styles.
			wp_register_style( BBPLP_PREFIX . '_admin', BBPLP_PLUGIN_URL . 'admin/assets/css/styles.css', array(), BBPLP_VERSION, 'all' );
			wp_enqueue_style( BBPLP_PREFIX . '_admin' );
		} // end admin_styles()

		/**
		 * Sanitize
		 *
		 * @uses   sanitize_text_field()
		 * @param  mixed $input The filed input.
		 * @since  1.0.0
		 * @return array $array Array of sanitized inputs.
		 */
		public function sanitize( $input ) {
			$array = array();
			foreach ( $input as $key => $val ) {
				$array[ $key ] = sanitize_text_field( $val );
			}
			return $array;
		} // end sanitize()

	}
} // end SettingsPageModel
