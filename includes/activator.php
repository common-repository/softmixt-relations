<?php
// If this file is called directly, abort.
if ( ! defined ( 'WPINC' ) )
{
	die;
}
/**------------------------------------------------------------------------------
 * ACTIVATOR / DEACTIVATOR
 **------------------------------------------------------------------------------
 * This is where we define Plugin Activation / Deactivation hooks.
 *
 *
 **----------------------------------------------------------------------------**/


/**
 * The register_activation_hook function registers a plugin function to be run when the plugin is activated.
 * When a plugin is activated, the action 'activate_PLUGINNAME' hook is called.
 * In the name of this hook, PLUGINNAME is replaced with the name of the plugin, including the optional subdirectory.
 * For example, when the plugin is located in wp-content/plugin/sampleplugin/sample.php, then the name of this hook will become 'activate_sampleplugin/sample.php'.
 * When the plugin consists of only one file and is (as by default) located at wp-content/plugin/sample.php the name of this hook will be 'activate_sample.php'.
 * This function is a wrapper for the 'activate_PLUGINNAME' action, and is easier to use.
 *
 *
 * It's far better to use an upgrade routine fired on admin_init, and handle that per-site, basing it on a stored option.[1]
 *
 * @DOCUMENTATION : https://codex.wordpress.org/Function_Reference/register_activation_hook
 */
register_activation_hook (
	$__ROOT_FILE__ ,
	function ()
	{

		// Check if user has right permissions.
		// Function is located in functions.php
		if ( check_permissions () )
		{

		}

		// ATTENTION: This is *only* done during plugin activation hook in this example!
		// You should *NEVER EVER* do this on every page load!!
		flush_rewrite_rules ();
	}
);

/**
 * The function register_deactivation_hook (introduced in WordPress 2.0) registers a plugin function to be run when the plugin is deactivated.
 * When a plugin is deactivated, the action 'deactivate_PLUGINNAME' hook is called. In the name of this hook, PLUGINNAME is replaced with the name of the plugin, including the optional subdirectory.
 * For example, when the plugin is located in wp-content/plugin/sampleplugin/sample.php, then the name of this hook will become 'deactivate_sampleplugin/sample.php'.
 * When the plugin consists of only one file and is (as by default) located at wp-content/plugin/sample.php the name of this hook will be 'deactivate_sample.php'.
 * This function is a wrapper for the 'deactivate_PLUGINNAME' action, and is easier to use.
 *
 * @DOCUMENTATION   : https://codex.wordpress.org/Function_Reference/register_deactivation_hook
 */
register_deactivation_hook (
	$__ROOT_FILE__ ,
	function ()
	{

		// Check if user has right permissions.
		// Function is located in functions.php
		if ( check_permissions () )
		{

		}
	}
);




