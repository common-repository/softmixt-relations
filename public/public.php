<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'SFT_Relations_Public' ) ) {
	class SFT_Relations_Public {

		public function __construct() {
			add_shortcode( 'sftrelations', array( $this, '_sft_show_related_posts' ) );
		}

		/**
		 * public short code for post relations
		 * short code : [sftrelations container="" container_class="" item_container="" container_item_class=""]
		 *
		 * @param $atts
		 *
		 * @return string
		 */
		public function _sft_show_related_posts( $atts ) {
			global $post;

			$post_id = isset( $post->ID ) ? $post->ID : '';
			$atts    = shortcode_atts(
				array(
					'post_id'                    => $post_id,
					'container'                  => 'div',
					'container_class'            => 'sft-rlp-container',
					'item_container'             => 'div',
					'item_title_container'       => 'none',
					'item_container_class'       => 'sft-rlp-itm-container',
					'item_show_title'            => 'true',
					'item_show_date'             => 'true',
					'item_show_author'           => 'false',
					'item_show_feature_image'    => 'false',
					'item_show_excerpt'          => 'false',
					'item_show_content'          => 'false',
					'item_terms_container'       => 'none',
					'item_terms_container_class' => 'sft-rlp-itm-terms-container',
					'item_term_container'        => 'span',
					'item_term_container_class'  => 'sft-rlp-itm-term-container',
				),
				$atts,
				'sftrelations'
			);

			$container                  = $atts['container'];
			$container_class            = $atts['container_class'];
			$item_container             = $atts['item_container'];
			$item_title_container       = $atts['item_title_container'];
			$item_container_class       = $atts['item_container_class'];
			$item_show_title            = $atts['item_show_title'];
			$item_show_date             = $atts['item_show_date'];
			$item_show_author           = $atts['item_show_author'];
			$item_show_feature_image    = $atts['item_show_feature_image'];
			$item_show_excerpt          = $atts['item_show_excerpt'];
			$item_show_content          = $atts['item_show_content'];

			$item_terms_container       = $atts['item_terms_container'];
			$item_terms_container_class = $atts['item_terms_container_class'];
			$item_term_container        = $atts['item_term_container'];
			$item_term_container_class  = $atts['item_term_container_class'];
			$connected_relations        = get_post_meta( $atts['post_id'], 'sftp_relations', true );

			if ( is_array( $connected_relations ) && ! empty( $connected_relations ) ) {

				$itm_container = "<$container class=\"$container_class\" >";
				foreach ( $connected_relations as $post_related_id ) {

					$post_tmp = get_post( $post_related_id );

					// Get taxonomies relations ...
					$itm_container .= "<$item_container class=\"$item_container_class\" >";

					if ( $item_show_title === 'true' ) {
						$title = get_the_title( $post_related_id );
						$url   = get_permalink( $post_related_id );

						if ( $item_title_container == 'none' ) {
							$itm_container .= "<a href=\"$url\">$title</a>";
						} else {
							$itm_container .= "<$item_title_container class=\"sft-rlp-title\"><a href=\"$url\">$title</a></$item_title_container>";
						}
					}

					if ( $item_show_date === 'true' ) {
						$date          = get_the_date( get_option( 'date_format' ), $post_related_id );
						$itm_container .= "<p class=\"sft-rlp-date\">$date</p>";
					}

					if ( $item_show_author === 'true' ) {
						$author_id       = $post_tmp->post_author;
						$author_nicename = get_the_author_meta( 'user_nicename', $author_id );
						$itm_container   .= "<p class=\"sft-rlp-author\">by $author_nicename</p>";
					}

					if ( $item_show_feature_image === 'true' ) {
						$feature_image = get_the_post_thumbnail( $post_related_id, 'large' );
						$itm_container .= "<div class=\"sft-rlp-feature-image\">$feature_image</div>";
					}

					if ( $item_show_excerpt === 'true' ) {
						if ( has_excerpt( $post_tmp ) ) {
							$excerpt       = sft_get_the_excerpt( $post_tmp );
							$itm_container .= "<div class=\"sft-rlp-excerpt\">$excerpt</div>";
						}
					}

					if ( $item_show_content === 'true' ) {
						$content       = $post_tmp->post_content;
						$content       = do_shortcode( preg_replace( '/\[sftrelations(.*?)\]/s', '', $content ) );
						$itm_container .= "<div class=\"sft-rlp-content\">$content</div>";
					}

					$connected_relations_taxonomies = get_post_meta( $post_id, 'sftp_relations_taxonomies', true );
					if ( isset( $connected_relations_taxonomies[ $post_related_id ] ) ) {
						foreach ( $connected_relations_taxonomies[ $post_related_id ] as $taxonomy => $taxonomy_label ) {

							$tax_data = wp_get_post_terms( $post_related_id, $taxonomy, array( "fields" => "all" ) );

							$itm_container .= $item_terms_container != 'none' ? "<{$item_terms_container} class=\"{$item_terms_container_class}\">" : '';
							foreach ( $tax_data as $term ) {
								$itm_container .= "<{$item_term_container} class=\"{$item_term_container_class}\">{$term->name}</{$item_term_container}>";
							}
							$itm_container .= $item_terms_container != 'none' ? "</{$item_terms_container}>" : '';
						}
					}

					$itm_container .= "</$item_container>";
				}
				$itm_container .= "</$container>";

				return apply_filters( 'SFT_related_item_content', $itm_container, $connected_relations, $atts );

			}
		}

	}
}