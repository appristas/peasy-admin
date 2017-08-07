<?php

namespace PeasyAdmin\Fields;

use PeasyAdmin\Field;

defined( 'ABSPATH' ) or die( 'Tacita' );

class RadioField extends Field {

	private $items;

	public function __construct( $name, $label, $options_id, $options, $items ) {
		parent::__construct( $name, $label, $options_id, $options );

		$this->items = $items;
	}

	public function display() {
		foreach ( $this->items as $radio_value => $radio_label ) {
			$checked = $radio_value == $this->get_value() ? 'checked' : '';
			?>
			<label>
				<input
					type="radio"
					name="<?php echo esc_html( $this->get_name() ); ?>"
					value="<?php echo esc_html( $radio_value ); ?>"
					<?php echo esc_html( $checked ); ?>
				>
				<?php echo esc_html( $radio_label ); ?>
			</label>
			<br />
			<?php
		}
	}

}
