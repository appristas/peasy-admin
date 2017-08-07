<?php

namespace PeasyAdmin;

defined( 'ABSPATH' ) or die( 'Tacita' );

class AdminPage {

	private $title;

	private $slug;

	private $sections = [];

	private $options;

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

		$this->options = get_option( $this->get_id() );
		if ( ! $this->options ) {
			$this->options = [];
		}
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
		<div class="wrap">
			<h1 class="wp-heading-inline"><?php echo esc_html( $this->title ); ?></h1>
			<hr class="wp-header-end">
			
			<form action="options.php" method="post">
				<?php
				settings_fields( $this->get_id() );
				do_settings_sections( $this->get_id() );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Initialize sections
	 */
	public function initialize_sections() {
		register_setting( $this->get_id(), $this->get_id() );
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

	/**
	 * Get options
	 */
	public function get_options() {
		return $this->options;
	}

}
