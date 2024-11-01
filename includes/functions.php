<?php
// If this file is called directly, abort.
if ( ! defined ( 'WPINC' ) )
{
	die;
}
/**------------------------------------------------------------------------------
 * PLUGIN FUNCTIONS
 **------------------------------------------------------------------------------
 * Here where we store entire plugin function  , the recommended functions can be
 * helper functions , database functions  mostly functions that will be used in
 * your public , admin classes .
 **----------------------------------------------------------------------------**/

// Check  for your user permissions
// This function is used in activator.php file
if ( ! function_exists ( 'check_permissions' ) )
{

	/**
	 * Small check permissions function helper
	 *
	 * @return bool
	 */
	function check_permissions ()
	{
		return current_user_can ( 'activate_plugins' );
	}

}

if ( ! function_exists ( 'sft_get_all_post_types' ) )
{
	/**
	 * Will Return all available custom post types + post, page (builtin post types)
	 *
	 * @return array
	 */
	function sft_get_all_post_types ()
	{

		$post_types   = get_post_types ( [ 'public' => TRUE , '_builtin' => FALSE , ] , 'names' , 'and' );
		$post_types[] = 'all';
		$post_types[] = 'post';
		$post_types[] = 'page';
		asort ( $post_types );

		return $post_types;
	}
}

if ( ! function_exists ( 'sft_get_all_post_types_posts' ) )
{
	/**
	 * Get all post items for all post types
	 *
	 * @return array
	 */
	function sft_get_all_post_types_posts ()
	{
		$all_pt_items = [];
		foreach ( sft_get_all_post_types () as $pt )
		{
			$args = array ( 'numberposts' => - 1 , 'post_type' => $pt );
			foreach ( get_posts ( $args ) as $p_item )
			{
				$all_pt_items[] = [
					'id'         => $p_item->ID ,
					'post_type'  => $p_item->post_type ,
					'post_name'  => $p_item->post_name ,
					'post_title' => $p_item->post_title ,
				];
			}
		}

		return $all_pt_items;
	}

}

if ( ! function_exists ( 'sft_get_the_excerpt' ) )
{
	/**
	 * Get post excerpt
	 *
	 * @param $post_id
	 *
	 * @return string
	 */
	function sft_get_the_excerpt ( $post_id )
	{

		global $post;
		$save_post = $post;
		$post      = get_post ( $post_id );
		setup_postdata ( $post ); // hello
		$output = get_the_excerpt ();
		$post   = $save_post;

		return $output;
	}
}
