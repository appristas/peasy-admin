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
	 * @param int $id ID
	 * @param AdminPage $adminpage Admin Page instance
	 */
	public function __construct( $title, $id, $adminpage ) {
		$this->id = $id;
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
		add_settings_section( $this->get_slug(), $this->title, $this->callback, $this->adminpage->get_slug() );
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
	 * Get section slug
	 */
	private function get_slug() {
		return sprintf( '%s_section_%d', str_replace( '-', '_', $this->adminpage->get_slug() ), $this->id );
	}

}
