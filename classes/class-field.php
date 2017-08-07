<?php

namespace PeasyAdmin;

defined( 'ABSPATH' ) or die( 'Tacita' );

class Field {

	private $name;

	private $label;

	private $callback;

	/**
	 * Constructor
	 *
	 * @param string $name Field name
	 * @param string $label Field label
	 * @param string|callable $type Field type
	 */
	public function __construct( $name, $label, $type = 'text' ) {
		$this->name = $name;
		$this->label = $label;
		if ( is_string( $type ) ) {
			$type = [ $this, 'display_' . $type ];
		}

		if ( is_callable( $type ) ) {
			$this->callback = $type;
		}
	}

	/**
	 * Render callback
	 */
	public function display() {
		call_user_func( $this->callback, $this->name, $this->label );
	}

	/**
	 * Render Text callback
	 */
	public function display_text( $name, $label ) {
		?>
		<input type="<?php echo esc_html( $name ); ?>">
		<?php
	}

	/**
	 * Get name
	 */
	public function initialize( $section, $adminpage ) {
		add_settings_field( $this->name, $this->label, [ $this, 'display' ], $adminpage, $section );
	}

}
