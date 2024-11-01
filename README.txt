=== Softmixt Relations ===
Contributors: franciscopalacios,  softmixt
Tags: relations, post-relation, posts, related, posts, relation, connection
Requires at least: 4.6
Tested up to: 4.8
Stable tag: 4.8
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Simple way for adding related posts .

== Description ==

A simple way to add related posts to another post.

You can easily change the public view by using this filter : SFT_related_item_content filter.

`
<?php

add_filter (
	'SFT_related_item_content' ,
	/**
	 * $itm_container : The current view of related posts .
	 * $connected_relations : Array with all related post items ID's .
	 * $atts : Short code attributes.
	 */
	function ( $itm_container , $connected_relations , $atts )
	{

		// The current post id.
		$post_id = $atts[ 'post_id' ];

		// Parent related items container element (set on short code).
		$container               = $atts[ 'container' ];

		// Parent related items container class element (set on short code).
		$container_class         = $atts[ 'container_class' ];

		// Related item container element (set on short code).
		$item_container          = $atts[ 'item_container' ];

        // Related item container title element (set on short code).
		$item_title_container          = $atts[ 'item_title_container' ];

		// Related item container class element (set on short code).
		$item_container_class    = $atts[ 'item_container_class' ];

		// Related item show title (set on short code as string "true" or "false").
		$item_show_title         = $atts[ 'item_show_title' ];

		// Related item show date (set on short code as string "true" or "false").
		$item_show_date          = $atts[ 'item_show_date' ];

		// Related item show author (set on short code as string "true" or "false").
		$item_show_author        = $atts[ 'item_show_author' ];

		// Related item show feature image (set on short code as string "true" or "false").
		$item_show_feature_image = $atts[ 'item_show_feature_image' ];

		// Related item show excerpt image (set on short code as string "true" or "false").
		$item_show_excerpt       = $atts[ 'item_show_excerpt' ];

		// Related item show content image (set on short code as string "true" or "false").
		$item_show_content       = $atts[ 'item_show_content' ];

	    // Post related taxonomies container element (set on short code)
        $item_terms_container       = $atts['item_terms_container'];

        // Post related taxonomies container class element (set on short code).
        $item_terms_container_class = $atts['item_terms_container_class'];

        // Post related taxonomy term item container element (set on short code)
        $item_term_container        = $atts['item_term_container'];

        // Post related taxonomy term item container class element (set on short code).
        $item_term_container_class  = $atts['item_term_container_class'];

		// you can overwrite  post related item view here ...

		return $itm_container;
	} ,
	10 ,
	3
);
`

== Installation ==

This section describes how to install the plugin and get it working.
1. Upload the plugin files to the `/wp-content/plugins/softmixt-relations` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress


== Frequently Asked Questions ==

=  Can I overwrite related items public view ? =

Yes, you can overwrite you related items public view by using  'SFT_related_item_content' filter , check Description section.

= Can I show  one related posts to other post ? =

Yes, you can show other post relations by adding an optional "post_id" attribute to your shortcode.

=Can I easily sort my relations =

Yes, you can sort your posts related connection by dragging items on "Post Related" section.

=Can I select related post taxonomies as categories, terms ? =

Yes, you can toggle related post and select taxonomies you want to have in front.

== Screenshots ==

1. The relations are made from a "Post Relations" metabox by clicking on "+" icon this action will insert you connection into "Posts related"

2. If you have a lot of post items or connections you can easily filter by name or post type.

3. You can insert your connection into your post content by using the tinyMCE new button.

4. When you click on tinyMCE connections button you will bring up a new popup where you can set :  "Container element", "Custom container class", "Item container element", "Item container title element", "Custom class item", "Show post meta"

5. After tinyMCE modal submitted  , an a "shortcode" automatically is created and  is inserted  into the WP Content.

6. A basic public view of your post relations.

== Changelog ==

= 1.0.1 =
* SFT Relations widget added
* Custom container item title element added , now we can change post title element type .If none is set then there  will be no element for title.

= 1.0.0 =
* First Stable Release

== Upgrade Notice ==
Not Available

== Suggestions ==
If someone has an a idea or suggestion of a new plugin feature I'm glad to hear it and probably will be implemented in the new versions.