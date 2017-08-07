<?php

namespace PeasyAdmin;

class AdminPage {

	private $title;

	private $slug;

	private $sections = [];

	/**
	 * Constructor
	 *
	 * @param string $title Title
	 * @param string $slug Slug
	 */
	public function __construct( $title, $slug, $capability = 'manage_options' ) {
		$this->title = $title;
		$this->slug = $slug;
		$this->capability = $capability;
	}

	/**
	 * Add section
	 */
	public function section( $title ) {
		$section = new Section( $title, count( $this->sections ), $this );
		$this->sections[] = $section;
		return $section;
	}

	/**
	 * Setup
	 */
	public function setup() {
		add_action( 'admin_menu', function() {
			add_menu_page( $this->title, $this->title, $this->capability, $this->slug, [ $this, 'render' ] );
		} );

		add_action( 'admin_init', [ $this, 'initialize_sections' ] );
	}

	/**
	 * Render admin page
	 */
	public function render() {
		?>
		<form action="options.php" method="post">
			<h1><?php echo esc_html( $this->title ); ?></h1>

			<?php
			settings_fields( $this->get_id() );
			do_settings_sections( $this->get_id() );
			submit_button();
			?>
		</form>
		<?php
	}

	/**
	 * Initialize sections
	 */
	public function initialize_sections() {
		foreach ( $this->sections as $section ) {
			$section->initialize();
		}
	}

	/*
	 * Get ID (slug underscored)
	 */
	public function get_id() {
		return str_replace( '-', '_', $this->slug );
	}

}
