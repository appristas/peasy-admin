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
	 *
	 * @return Fieldset Fieldset instance
	 */
	public function text( $name, $label, $type = 'text' ) {
		$this->fields[] = new Fields\TextField( $name, $label, $type );
		return $this->fieldset;
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
