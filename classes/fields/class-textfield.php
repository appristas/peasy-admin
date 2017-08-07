<?php

namespace PeasyAdmin\Fields;

use PeasyAdmin\Field;

defined( 'ABSPATH' ) or die( 'Tacita' );

class TextField extends Field {

	private $type;

	public function __construct( $name, $label, $type = 'text' ) {
		parent::__construct( $name, $label );
		$this->type = $type;
	}

	public function display() {
		?>
		<input type="<?php echo esc_html( $this->type ); ?>" name="<?php echo esc_html( $this->name ); ?>">
		<?php
	}

}
