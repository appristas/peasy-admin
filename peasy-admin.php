<?php
/**
 * Plugin Name: Peasy Admin
 * Plugin URI: https://github.com/appristas/peasy-admin
 * Description: An easy-pease API to build custom admin pages
 * Version: 1.2.0
 * Author: Appristas LLC
 * Author URI: www.appristas.io
 */

defined( 'ABSPATH' ) or die( 'Tacita' );

add_action( 'init', function() {
	require_once( __DIR__ . '/classes/class-fieldset.php' );
	require_once( __DIR__ . '/classes/class-adminpage.php' );
	require_once( __DIR__ . '/classes/class-section.php' );
	require_once( __DIR__ . '/classes/class-field.php' );

	require_once( __DIR__ . '/classes/fields/class-textfield.php' );
	require_once( __DIR__ . '/classes/fields/class-textareafield.php' );
	require_once( __DIR__ . '/classes/fields/class-dropdownfield.php' );
	require_once( __DIR__ . '/classes/fields/class-checkboxfield.php' );
	require_once( __DIR__ . '/classes/fields/class-customfield.php' );
	require_once( __DIR__ . '/classes/fields/class-radiofield.php' );
	require_once( __DIR__ . '/classes/fields/class-mediafield.php' );

	require_once( __DIR__ . '/classes/class-option.php' );

	require_once( __DIR__ . '/classes/class-pluggablefields.php' );

	do_action( 'peasy_register' );
	do_action( 'peasy_init' );
} );
