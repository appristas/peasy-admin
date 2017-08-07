<?php

namespace PeasyAdmin;

class Section {

	private $id;

	private $title;

	private $adminpage;

	private $description = null;

	private $fields;

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
	 * Initialize
	 */
	public function initialize() {
		add_settings_section( $this->get_id(), $this->title, $this->callback, $this->adminpage->get_id() );
	}

	/**
	 * Default section display callback
	 */
	public function callback_default() {
		if ( $this->description ) :
		?>
			<p><?php echo esc_html( $this->description ); ?></p>
		<?php
		endif;
	}

	/**
	 * Get section ID
	 */
	private function get_id() {
		return sprintf( '%s_section_%d', $this->adminpage->get_id(), $this->num );
	}

}
