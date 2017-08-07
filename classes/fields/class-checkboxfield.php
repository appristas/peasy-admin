<?php

namespace PeasyAdmin\Fields;

use PeasyAdmin\Field;

defined( 'ABSPATH' ) or die( 'Tacita' );

class CheckboxField extends Field {

	private $checkbox_label;

	private $checkbox_value;

	public function __construct( $name, $label, $options_id, $options, $checkbox_label, $checkbox_value ) {
		parent::__construct( $name, $label, $options_id, $options );

		$this->checkbox_label = $checkbox_label;
		$this->checkbox_value = $checkbox_value;
	}

	public function display() {
		$checked = ( $this->checkbox_value == $this->get_value() ) ? 'checked' : '';
		?>
		<label for="<?php echo esc_html( $this->get_name() ); ?>">
			<input
				type="checkbox"
				name="<?php echo esc_html( $this->get_name() ); ?>"
				id="<?php echo esc_html( $this->get_name() ); ?>"
				value="<?php echo esc_html( $this->checkbox_value ); ?>"
				<?php echo esc_html( $checked ); ?>
			>
			<?php echo esc_html( $this->checkbox_label ); ?>
		</label>
		<?php
	}

}
