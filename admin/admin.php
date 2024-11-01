<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) )
{
	die;
}

/**------------------------------------------------------------------------------
 * ADMIN
 **------------------------------------------------------------------------------
 * All plugin  admin logic goes in this file.
 **----------------------------------------------------------------------------**/
if ( ! class_exists( 'SFT_Relations_Admin' ) )
{
	class SFT_Relations_Admin {

		/**
		 * SFT_Relations_Admin constructor.
		 */
		public function __construct() {

			/**
			 * Register admin side scripts...
			 */
			add_action( 'admin_enqueue_scripts' , array ( $this , '_admin_enqueue_scripts' ) );

			/**
			 * Register "Post Relations" metabox
			 */
			add_action( 'add_meta_boxes' , array ( $this , '_register_metabox' ) );

			/**
			 * Save post hook
			 */
			add_action( 'save_post' , array ( $this , '_save_post' ) , 10 , 3 );

			/**
			 * Register tinymce button
			 */
			add_action( 'init' , array ( $this , '_set_tinyMCE_setting' ) );

		}

		/**
		 * Add plugin scripts to admin
		 *
		 * @param $hook
		 */
		public function _admin_enqueue_scripts( $hook ) {
			// Add scripts only in edit and new post
			if ( $hook == 'post-new.php' || $hook == 'post.php' )
			{
				// Styles ...
				wp_enqueue_style( "softmixt-relations-admin" , plugin_dir_url( __FILE__ ) . 'assets/css/plugin-admin.css' , array () , '1.0.0' , 'all' );

				// Scripts ..
				wp_enqueue_script( "softmixt-relations-admin-js" , plugin_dir_url( __FILE__ ) . 'assets/js/plugin-admin.js' , array ( 'jquery' ) , '1.0.0' , FALSE );

			}
		}

		/**
		 * Register Post Relations metabox
		 */
		public function _register_metabox() {

			// Get global plugin settings
			add_meta_box( 'softmixt-relations-mb-id' , esc_html__( 'Post Relations' , SFT_REL_TEXT_DOMAIN ) , array ( $this , '_render_metabox' ) , sft_get_all_post_types() , 'advanced' , 'core' );
		}

		/**
		 * Render metabox content
		 *
		 * @param $post
		 */
		public function _render_metabox( $post ) {
			// Add nonce for security and authentication.
			wp_nonce_field( 'custom_nonce_action' , 'custom_nonce' );
			$connected_relations            = get_post_meta( $post->ID , 'sftp_relations' , TRUE );
			$connected_relations_taxonomies = get_post_meta( $post->ID , 'sftp_relations_taxonomies' , TRUE );

			include_once 'views/softmixt-relations-mb-view.php';
		}

		/**
		 * When post is saved
		 *
		 * @param $post_id
		 * @param $post
		 * @param $update
		 */
		public function _save_post( $post_id , $post , $update ) {
			// Add nonce for security and authentication.
			$nonce_name   = isset( $_POST[ 'custom_nonce' ] ) ? $_POST[ 'custom_nonce' ] : '';
			$nonce_action = 'custom_nonce_action';

			// Check if nonce is set.
			if ( ! isset( $nonce_name ) )
			{
				return;
			}

			// Check if nonce is valid.
			if ( ! wp_verify_nonce( $nonce_name , $nonce_action ) )
			{
				return;
			}

			// Check if user has permissions to save data.
			if ( ! current_user_can( 'edit_post' , $post_id ) )
			{
				return;
			}

			// check if there was a multisite switch before
			if ( is_multisite() && ms_is_switched() )
			{
				return $post_id;
			}

			// Check if not an autosave.
			if ( wp_is_post_autosave( $post_id ) )
			{
				return;
			}

			// Check if not a revision.
			if ( wp_is_post_revision( $post_id ) )
			{
				return;
			}

			if ( isset( $_POST[ 'connected_post' ] ) )
			{
				update_post_meta( $post_id , 'sftp_relations' , $_POST[ 'connected_post' ] );
			} else
			{
				delete_post_meta( $post_id , 'sftp_relations' );
			}

			if ( isset( $_POST[ 'connected_post_taxonomies' ] ) )
			{
				update_post_meta( $post_id , 'sftp_relations_taxonomies' , $_POST[ 'connected_post_taxonomies' ] );
			} else
			{
				delete_post_meta( $post_id , 'sftp_relations_taxonomies' );
			}

		}

		/**
		 * Register tinymce button and plugin
		 */
		public function _set_tinyMCE_setting() {
			add_filter( 'mce_external_plugins' , array ( $this , '_add_tinyMCE_plugin' ) );
			add_filter( 'mce_buttons' , array ( $this , '_add_tinyMCE_button' ) );
		}


		public function _add_tinyMCE_plugin() {
			$plugin_array[ 'sftrelations' ] = plugin_dir_url( __FILE__ ) . '/assets/tinymce/plugins/sftrelations/plugin.min.js';

			return $plugin_array;
		}

		public function _add_tinyMCE_button( $buttons ) {
			array_push( $buttons , 'sftrelations' );

			return $buttons;
		}

	}


}