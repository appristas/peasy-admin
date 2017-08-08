<?php

namespace PeasyAdmin\Fields;

use PeasyAdmin\Field;

defined( 'ABSPATH' ) or die( 'Tacita' );

class TextareaField extends Field {

	public function __construct( $name, $label, $options_id, $options ) {
		parent::__construct( $name, $label, $options_id, $options );
	}

	public function display() {
		?>
		<textarea name="<?php echo esc_html( $this->get_name() ); ?>" rows="5" cols="30"><?php echo esc_html( $this->get_value() ); ?></textarea>
		<?php
	}

}
