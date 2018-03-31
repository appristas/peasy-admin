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
	 * Create textarea field
	 *
	 * @param string $name Field name
	 * @param string $label Field label
	 *
	 * @return Fieldset Fieldset instance
	 */
	public function textarea( $name, $label ) {
		$this->fields[] = new Fields\TextareaField( $name, $label, $this->options_id, $this->options );
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
	 * Create checkbox field
	 *
	 * @param string $name Field name
	 * @param string $label Field label
	 * @param string $checkbox_label Checkbox label
	 * @param string $checkbox_value Checkbox value
	 *
	 * @return Fieldset Fieldset instance
	 */
	public function checkbox( $name, $label, $checkbox_label, $checkbox_value ) {
		$this->fields[] = new Fields\CheckboxField( $name, $label, $this->options_id, $this->options, $checkbox_label, $checkbox_value );
		return $this;
	}

	/**
	 * Create radio field
	 *
	 * @param string $name Field name
	 * @param string $label Field label
	 * @param string $items Radio items
	 *
	 * @return Fieldset Fieldset instance
	 */
	public function radio( $name, $label, $items ) {
		$this->fields[] = new Fields\RadioField( $name, $label, $this->options_id, $this->options, $items );
		return $this;
	}

	/**
	 * Create media field
	 *
	 * @param string $name Field name
	 * @param string $label FIeld label
	 */
	public function media( $name, $label ) {
		$this->fields[] = new Fields\MediaField( $name, $label, $this->options_id, $this->options );
		return $this;
	}

	/**
	 * Create custom field
	 *
	 * @param string $name Field name
	 * @param string $label Field label
	 * @param callable $callback Custom function
	 *
	 * @return Fieldset Fieldset instance
	 */
	public function custom( $name, $label, $callback ) {
		$this->fields[] = new Fields\CustomField( $name, $label, $this->options_id, $this->options, $callback );
		return $this;
	}

	/**
	 * Magic call function
	 *
	 * This function is used for 3rd party plugins registering their fields
	 *
	 * @param string $method Method
	 * @param array $args Arguments
	 */
	public function __call( $method, $args ) {
		$field_class = PluggableFields::get_registered_field( $method );
		if ( $field_class !== null ) {
			$reflection = new \ReflectionClass( $field_class );
			$this->fields[] = $reflection->newInstanceArgs( array_merge( $args, [ $this->options_id, $this->options ] ) );
		}
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
