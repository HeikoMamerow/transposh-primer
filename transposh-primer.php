<?php

/*
Plugin Name: Tp Primer
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: Heiko Mamerow
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2

Usage:
- Write a widget
*/

//include_once plugin_dir_path( __FILE__ ) . 'transposh-translation-filter-for-wordpress/transposh.php';

// Add meta box for page edit.
function tp_primer_add_custom_box() {
	add_meta_box(
		'tp_primer_box_id',
		'Transposh Primer',
		'tp_primer_custom_box_html',  // Content callback, must be of type callable
		'page'
	);
}

add_action( 'add_meta_boxes', 'tp_primer_add_custom_box' );

// Add content to meta box.
function tp_primer_custom_box_html() {

	$permalink = get_permalink();

	?>
	<div class="">
		<p><strong>Status:</strong> <span id="tp-primer-status">Ready.</span>
		</p>
		<button id="tp-primer-button" class="button" type="button">Start
			priming
		</button>
	</div>

	<script>
		// Get list of all Transposh variants of the origin page
		var tp_list = [
			<?php
			// List from transposh-widget
			if ( function_exists( "transposh_widget" ) ) {
				transposh_widget( array(), array( 'widget_file' => 'tp-primer-list/tpw_primer_list.php' ) );
			}
			?>
		];
	</script>

	<iframe id="tp-primer-iframe" class="tp-primer-iframe"
			src="<?php echo $permalink ?>">
		Sorry, your browser don't support iframe. ;-(
	</iframe>
	<?php
}

// Enqueue script and style.
function tp_primer_enqueue() {
	// Enqueue only for page admin.
	$screen = get_current_screen();
	if ( is_object( $screen ) ) {
		if ( in_array( $screen->post_type, [ 'page' ] ) ) {
			wp_enqueue_style( 'tp-primer-css', plugins_url( 'css/tp-primer.css', __FILE__ ) );
			wp_enqueue_script( 'tp-primer-js', plugins_url( 'js/tp-primer.js', __FILE__ ), array(), '1.0.0', true );
		}
	}
}

add_action( 'admin_enqueue_scripts', 'tp_primer_enqueue' );


// test



