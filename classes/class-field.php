<?php

namespace PeasyAdmin;

defined( 'ABSPATH' ) or die( 'Tacita' );

abstract class Field {

	protected $name;

	protected $label;

	protected $options_id;

	protected $options;

	/**
	 * Constructor
	 *
	 * @param string $name Field name
	 * @param string $label Field label
	 * @param string $options_id Options ID
	 * @param array $options_id Options
	 */
	public function __construct( $name, $label, $options_id, $options ) {
		$this->name = $name;
		$this->label = $label;
		$this->options_id = $options_id;
		$this->options = $options;
	}

	/**
	 * Render callback
	 */
	abstract public function display();

	/**
	 * Initialize field
	 *
	 * @param string $section Section ID
	 * @param string $adminpage AdminPage ID
	 */
	public function initialize( $section, $adminpage ) {
		add_settings_field( $this->name, $this->label, [ $this, 'display' ], $adminpage, $section );
	}

	/**
	 * Get option name
	 *
	 * @return string Option name
	 */
	protected function get_name() {
		return sprintf( '%s[%s]', $this->options_id, $this->name );
	}

	/**
	 * Get option value
	 *
	 * @return string Option value
	 */
	protected function get_value() {
		return isset( $this->options[ $this->name ] ) ? $this->options[ $this->name ] : null;
	}

	/**
	 * Get field name
	 *
	 * @return string Field name
	 */
	public function get_field_name() {
		return $this->name;
	}

	/**
	 * Process value
	 *
	 * @return string Processed value
	 */
	public function process_value( $value ) {
		return $value;
	}

}
