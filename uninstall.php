<?php
/**
 * Unistall
 *
 * Called on plugin activation
 *
 * @package    Package
 * @subpackage Package/SubPackage
 * @author     Author <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2016, Author
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since      1.0.0
 */

namespace BBPress_Live_Preview;

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) { die; }

// If uninstall is not called from WordPress, exit.
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) { exit(); }
