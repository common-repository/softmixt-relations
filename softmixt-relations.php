<?php
/**
 * Plugin Name:       Softmixt Relations
 * Plugin URI:        https://wordpress.org/plugins/softmixt-relations/
 * Description:       Simple way for adding related posts .
 * Version:           2.0.0
 * Author:            Softmixt
 * Author URI:        http://softmixt.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       softmixt-relations
 * Domain Path:       /languages
 *
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Get plugin text domain all over the plugin
define( 'SFT_REL_TEXT_DOMAIN', 'softmixt-relations' );


// Include Default Widget
require_once( dirname( __FILE__ ) . '/widgets/default/SFT_DefaultWidget.php' );


// Load the plugin ...
add_action( 'plugins_loaded',
	function () {

		// Load languages
		load_plugin_textdomain( SFT_REL_TEXT_DOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

		// General functions, functions from this file are available for public and admin
		require_once( dirname( __FILE__ ) . '/includes/functions.php' );

		if ( is_admin() ) {
			// Initialize Admin hooks
			require_once( dirname( __FILE__ ) . '/admin/admin.php' );
			new SFT_Relations_Admin();
		} else {
			// Initialize Public hooks
			require_once( dirname( __FILE__ ) . '/public/public.php' );
			new SFT_Relations_Public();
		}

	} );

// HAPPY CODDING !!
