<?php

namespace PeasyAdmin;

class PluggableFields {

	private static $_instance = null;

	private $fields = [];

	/**
	 * Get Instance
	 *
	 * @return PluggableFields Instance
	 */
	private static function get_instance() {
		if ( self::$_instance === null ) {
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	/**
	 * Registers custom field
	 *
	 * @param string $name Field name
	 * @param string $field_class Field Class
	 */
	public static function register_field( $name, $field_class ) {
		$instance = self::get_instance();
		$instance->fields[ $name ] = $field_class;
	}

	/**
	 * Get registered field
	 *
	 * @return object|null Registered field if exists, null otherwise 
	 */
	public static function get_registered_field( $name ) {
		$instance = self::get_instance();
		if ( isset( $instance->fields[ $name ] ) ) {
			return $instance->fields[ $name ];
		}

		return null;
	}

}
