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
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	/**
	 * Enqueue scripts
	 */
	public function enqueue_scripts() {
		wp_enqueue_media();
		wp_enqueue_script( 'pa-media-js', plugins_url( 'assets/media.js', __DIR__ ), '1.2.0' );
		wp_enqueue_style( 'pa-media-css', plugins_url( 'assets/media.css', __DIR__ ), '1.2.0' );
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
	 * Sanitize fields before submission
	 */
	public function process_fields( $input ) {
		foreach ( $this->sections as $section ) {
			$fields = $section->fields();
			foreach ( $fields->items() as $field ) {
				$val = $input[ $field->get_field_name() ];
				$input[ $field->get_field_name() ] = $field->process_value( $val );
			}
		}

		return $input;
	}

	/**
	 * Initialize sections
	 */
	public function initialize_sections() {
		register_setting( $this->get_id(), $this->get_id(), [ $this, 'process_fields' ] );
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
