<?php

namespace PeasyAdmin\Fields;

use PeasyAdmin\Field;

defined( 'ABSPATH' ) or die( 'Tacita' );

class DropdownField extends Field {

	private $items;

	public function __construct( $name, $label, $options_id, $options, $items ) {
		parent::__construct( $name, $label, $options_id, $options );
		$this->items = $items;
	}

	public function display() {
		?>
		<select name="<?php echo esc_html( $this->get_name() ); ?>">
			<?php foreach ( $this->items as $key => $value ) : ?>
				<?php $selected = ( $this->get_value() == $key ) ? ' selected' : ''; ?>
				<option value="<?php echo esc_html( $key ); ?>"<?php echo esc_html( $selected ); ?>><?php echo esc_html( $value ); ?></option>
			<?php endforeach; ?>
		</select>
		<?php
	}

}
