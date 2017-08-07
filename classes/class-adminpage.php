<?php

namespace PeasyAdmin;

class AdminPage {

	private $title;

	private $slug;

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
	 * Setup
	 */
	public function setup() {
		add_action( 'admin_menu', function() {
			add_menu_page( $this->title, $this->title, $this->capability, $this->slug, [ $this, 'render' ] );
		} );
	}

	/**
	 * Render admin page
	 */
	public function render() {
		?>
		<form action="options.php" method="post">
			<h2><?php echo esc_html( $this->title ); ?></h2>

			<?php
			settings_fields( $this->slug );
			do_settings_sections( $this->slug );
			submit_button();
			?>
		</form>
		<?php
	}

}
