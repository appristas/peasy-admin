<?php

namespace PeasyAdmin\Fields;

use PeasyAdmin\Field;

defined( 'ABSPATH' ) or die( 'Tacita' );

class CustomField extends Field {

	private $callback = null;

	public function __construct( $name, $label, $options_id, $options, $callback ) {
		parent::__construct( $name, $label, $options_id, $options );

		if ( is_callable( $callback ) ) {
			$this->callback = $callback;
		}
	}

	public function display() {
		if ( $this->callback ) {
			call_user_func( $this->callback, $this->get_name(), $this->get_value() );
		}
	}

}
