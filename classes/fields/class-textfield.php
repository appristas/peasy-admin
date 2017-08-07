<?php

namespace PeasyAdmin\Fields;

use PeasyAdmin\Field;

defined( 'ABSPATH' ) or die( 'Tacita' );

class TextField extends Field {

	private $type;

	public function __construct( $name, $label, $options_id, $options, $type = 'text' ) {
		parent::__construct( $name, $label, $options_id, $options );
		$this->type = $type;
	}

	public function display() {
		?>
		<input
			type="<?php echo esc_html( $this->type ); ?>"
			name="<?php echo esc_html( $this->get_name() ); ?>"
			value="<?php echo esc_html( $this->get_value() ); ?>"
		>
		<?php
	}

}
