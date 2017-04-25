<?php

/**
 * Plugin Name: Transposh Primer
 * Plugin URI: https://github.com/HeikoMamerow/transposh-primer
 * Description: Priming pages with transposh translation.
 * Version: 1.1.0
 * Author: Heiko Mamerow
 * Author URI: https://heikomamerow.de
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: transposh-primer
 * Domain Path: /languages
 */


/**
 * Add meta box for page edit.
 */
function tp_primer_add_custom_box() {
	add_meta_box( 'tp_primer_box_id', 'Transposh Primer', 'tp_primer_custom_box_html',  // Content callback, must be of type callable
		'page' );
}

add_action( 'add_meta_boxes', 'tp_primer_add_custom_box' );

/**
 * Add content to meta box.
 */
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
		/**
		 * Get list of all active Transposh variants of the origin page.
		 *
		 * List example:
		 * var tpList = [
		 *   "https://example.demo/de/some_page?tpedit=1",
		 *   "https://example.demo/en/some_page?tpedit=1",
		 *   "https://example.demo/fr/some_page?tpedit=1",
		 * ];
		*/
		var tpList = [
			<?php
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

/**
 * Enqueue script and style.
 * But only for page ademin.
 */
function tp_primer_enqueue() {
	$screen = get_current_screen();
	if ( is_object( $screen ) ) {
		if ( in_array( $screen->post_type, [ 'page' ] ) ) {
			wp_enqueue_style( 'tp-primer-css', plugins_url( 'css/transposh-primer.css', __FILE__ ) );
			wp_enqueue_script( 'tp-primer-js', plugins_url( 'js/transposh-primer.js', __FILE__ ), array(), '1.0.0', true );
		}
	}
}

add_action( 'admin_enqueue_scripts', 'tp_primer_enqueue' );