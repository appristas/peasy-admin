<?php

namespace PeasyAdmin\Fields;

use PeasyAdmin\Field;

defined( 'ABSPATH' ) or die( 'Tacita' );

class DropdownField extends Field {

	private $options;

	public function __construct( $name, $label, $options ) {
		parent::__construct( $name, $label );
		$this->options = $options;
	}

	public function display() {
		?>
		<select name="<?php echo esc_html( $this->name ); ?>">
			<?php foreach ( $this->options as $key => $value ) : ?>
			<option value="<?php echo esc_html( $key ); ?>"><?php echo esc_html( $value ); ?></option>
			<?php endforeach; ?>
		</select>
		<?php
	}

}
