<?php
/**
 * Plugin Name: Peasy Admin
 * Plugin URI: https://github.com/appristas/peasy-admin
 * Description: An easy-pease API to build custom admin pages
 * Version: 1.0
 * Author: Appristas LLC
 * Author URI: www.appristas.io
 */

defined( 'ABSPATH' ) or die( 'Tacita' );

require_once( __DIR__ . '/classes/class-fieldset.php' );
require_once( __DIR__ . '/classes/class-adminpage.php' );
require_once( __DIR__ . '/classes/class-section.php' );
require_once( __DIR__ . '/classes/class-field.php' );

require_once( __DIR__ . '/classes/fields/class-textfield.php' );
require_once( __DIR__ . '/classes/fields/class-dropdownfield.php' );
