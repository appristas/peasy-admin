<?php

namespace PeasyAdmin;

defined( 'ABSPATH' ) or die( 'Tacita' );

class Section {

	private $id;

	private $title;

	private $adminpage;

	private $description = null;

	private $fieldset;

	private $callback;

	/**
	 * Constructor
	 *
	 * @param string $title Title
	 * @param int $num Num (Used for ID)
	 * @param AdminPage $adminpage Admin Page instance
	 */
	public function __construct( $title, $num, $adminpage ) {
		$this->num = $num;
		$this->fieldset = new Fieldset( $adminpage->get_id(), $adminpage->get_options() );
		$this->callback = [ $this, 'callback_default' ];
		$this->title = $title;
		$this->adminpage = $adminpage;
	}

	/**
	 * Set description
	 *
	 * @param string $description Description
	 *
	 * @return Section Section instance
	 */
	public function description( $description ) {
		$this->description = $description;
		return $this;
	}

	/**
	 * Set callback
	 *
	 * @param callback $callback Callback
	 *
	 * @return Section Section instance
	 */
	public function callback( $callback ) {
		$this->callback = $callback;
		return $this;
	}

	/**
	 * Get fieldset object
	 *
	 * @return Fieldset Fieldset object
	 */
	public function fields() {
		return $this->fieldset;
	}

	/**
	 * Initialize
	 */
	public function initialize() {
		add_settings_section( $this->get_id(), $this->title, [ $this, 'display_content' ], $this->adminpage->get_id() );

		foreach ( $this->fieldset->items() as $field ) {
			$field->initialize( $this->get_id(), $this->adminpage->get_id() );
		}
	}

	/**
	 * Callback default
	 */
	public function callback_default() {
		if ( $this->description ) {
			?>
			<p><?php echo esc_html( $this->description ); ?></p>
			<?php
		}
	}

	/**
	 * Default section display callback
	 */
	public function display_content() {
		if ( $this->callback ) {
			call_user_func( $this->callback, $this->description );
		}
	}

	/**
	 * Get section ID
	 */
	private function get_id() {
		return sprintf( '%s_section_%d', $this->adminpage->get_id(), $this->num );
	}

}
