<?php

namespace PeasyAdmin;

defined( 'ABSPATH' ) or die( 'Tacita' );

class FieldSet {

	private $fields = [];

	private $options_id;
	private $options;

	/**
	 * Constructor
	 *
	 * @param string $options_id Options ID
	 * @param array $options Options
	 */
	public function __construct( $options_id, $options ) {
		$this->options_id = $options_id;
		$this->options = $options;
	}

	/**
	 * Create text field
	 *
	 * @param string $name Field name
	 * @param string $label Field label
	 * @param string $type Field Type
	 *
	 * @return Fieldset Fieldset instance
	 */
	public function text( $name, $label, $type = 'text' ) {
		$this->fields[] = new Fields\TextField( $name, $label, $this->options_id, $this->options, $type );
		return $this;
	}

	/**
	 * Create dropdown field
	 *
	 * @param string $name Field name
	 * @param string $label Field label
	 * @param array $items Items for dropdown
	 *
	 * @return Fieldset Fieldset instance
	 */
	public function dropdown( $name, $label, $items ) {
		$this->fields[] = new Fields\DropdownField( $name, $label, $this->options_id, $this->options, $items );
		return $this;
	}

	/**
	 * Get a list of items
	 *
	 * @return array List of items
	 */
	public function items() {
		return $this->fields;
	}

}
