<?php

namespace PeasyAdmin;

defined( 'ABSPATH' ) or die( 'Tacita' );

abstract class Field {

	protected $name;

	protected $label;

	/**
	 * Constructor
	 *
	 * @param string $name Field name
	 * @param string $label Field label
	 * @param string|callable $type Field type
	 */
	public function __construct( $name, $label ) {
		$this->name = $name;
		$this->label = $label;
	}

	/**
	 * Render callback
	 */
	abstract public function display();

	/**
	 * Get name
	 */
	public function initialize( $section, $adminpage ) {
		add_settings_field( $this->name, $this->label, [ $this, 'display' ], $adminpage, $section );
	}

}
