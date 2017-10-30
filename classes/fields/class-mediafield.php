<?php

namespace PeasyAdmin\Fields;

use PeasyAdmin\Field;

defined( 'ABSPATH' ) or die( 'Tacita' );

class MediaField extends Field {

	private $type;

	public function __construct( $name, $label, $options_id, $options, $button_label = 'Select file' ) {
		parent::__construct( $name, $label, $options_id, $options );
		$this->type = $type;
		$this->button_label = $button_label;
	}

	public function display() {
		$media_id = 'media_' . $this->name;
		$media_image_id = 'image_' . $this->name;
		$button_id = 'button_' . $this->name;
		$value = $this->get_value();
		if ( empty ( $value ) ) {
			$value = '#';
			$hidden = 'hidden ';
		} else {
			$hidden = '';
		}
		?>
		<button
			type="button"
			id="<?php echo esc_html( $button_id ); ?>"
			class="js-media-button button button-primary"
			data-media-frame="<?php echo esc_html( $media_id ); ?>"
			data-target-image="<?php echo esc_html( $media_image_id ); ?>"
			data-target-name="<?php echo esc_html( $this->get_name() ); ?>"
		>
			<?php echo esc_html( $this->button_label ); ?>
		</button>
		<div class="<?php echo esc_html( $hidden ); ?>thumbnail-container" id="<?php echo esc_html( $media_image_id ); ?>">
			<img alt="Selected image" src="<?php echo esc_html( $value ); ?>">
			<button
				type="button"
				class="js-media-remove-image button-remove-image"
				data-target-image="<?php echo esc_html( $media_image_id ); ?>"
				data-target-button="<?php echo esc_html( $button_id ); ?>"
				data-target-name="<?php echo esc_html( $this->get_name() ); ?>"
			>
				<i class="dashicons dashicons-dismiss"></i>
			</button>
		</div>
		
		<input type="hidden" name="<?php echo esc_html( $this->get_name() ); ?>" value="<?php echo esc_html( $value ); ?>">
		<?php
	}

}
