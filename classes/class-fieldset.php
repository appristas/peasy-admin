<?php

namespace PeasyAdmin;

defined( 'ABSPATH' ) or die( 'Tacita' );

class FieldSet {

	private $fields = [];

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
		$this->fields[] = new Fields\TextField( $name, $label, $type );
		return $this;
	}

	/**
	 * Create dropdown field
	 *
	 * @param string $name Field name
	 * @param string $label Field label
	 * @param array $options Options for dropdown
	 *
	 * @return Fieldset Fieldset instance
	 */
	public function dropdown( $name, $label, $options ) {
		$this->fields[] = new Fields\DropdownField( $name, $label, $options );
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
