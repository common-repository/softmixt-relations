<p class="description js-update-your-post sft-update-your-post"><?php _e( 'Update your post in order to save your new relation changes.' , SFT_REL_TEXT_DOMAIN ); ?></p>

<div class="sft-rel-metabox">
	<h3><?php _e( 'All posts' , SFT_REL_TEXT_DOMAIN ); ?></h3>
	<select class="js-select-post-type">
		<?php foreach ( sft_get_all_post_types() as $pt ) : ?>
			<option value="<?php echo $pt; ?>"><?php _e( ucfirst( $pt ) , SFT_REL_TEXT_DOMAIN ); ?></option>
		<?php endforeach; ?>
	</select>
	<input type="text" size="50" class="sft-rel-service js-search-posts" placeholder="<?php _e( 'Search...' , SFT_REL_TEXT_DOMAIN ); ?>">
	<div class="sft-rel-list-container">
		<ul class="js-posts-to-connect sft-rel-relations">
			<?php foreach ( sft_get_all_post_types_posts() as $gaptp ) : ?>
				<li class="js-relations-itm sft-rel-not-connected" data-post-id="<?php echo $gaptp[ 'id' ]; ?>" <?php echo ! $connected_relations || ! in_array( $gaptp[ 'id' ] , $connected_relations ) ? '' : 'style="display:none;"'; ?> data-post-title="<?php echo $gaptp[ 'post_title' ]; ?>" data-post-type="<?php echo $gaptp[ 'post_type' ]; ?>">
					<span class="dashicons dashicons-plus js-add-connection" data-post-id="<?php echo $gaptp[ 'id' ]; ?>" data-post-title="<?php echo $gaptp[ 'post_title' ]; ?>" data-post-type="<?php echo $gaptp[ 'post_type' ]; ?>"></span> <?php _e( mb_strimwidth( $gaptp[ 'post_title' ] , 0 , 50 , '...' ) , SFT_REL_TEXT_DOMAIN ); ?>
					<?php foreach ( get_object_taxonomies( get_post_type( $gaptp[ 'id' ] ) , 'objects' ) as $taxonomy ) : ?>
						<input class="js-posts-to-connect-tax-data" data-post-id="<?php echo $gaptp[ 'id' ]; ?>" type="hidden" data-taxonomy-name="<?php echo $taxonomy->name; ?>" value="<?php echo $taxonomy->label; ?>">
					<?php endforeach; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<div class="sft-rel-metabox">
	<h3><?php _e( 'Posts related' , SFT_REL_TEXT_DOMAIN ); ?></h3>
	<select class="js-select-related-post-type" id="js-select-post-type" name="js-select-post-type">
		<?php foreach ( sft_get_all_post_types() as $pt ) : ?>
			<option value="<?php echo $pt; ?>"><?php _e( ucfirst( $pt ) , SFT_REL_TEXT_DOMAIN ); ?></option>
		<?php endforeach; ?>
	</select>
	<input type="text" size="50" class="sft-rel-service js-search-connected-posts" placeholder="<?php _e( 'Search...' , SFT_REL_TEXT_DOMAIN ); ?>">

	<div class="sft-rel-list-container">
		<ul class="js-connected-posts sft-rel-relations" id="connected-relations">
			<?php if ( $connected_relations ) : ?>
				<?php foreach ( $connected_relations as $cr ) : ?>

					<li class="js-connected-itm sft-rel-connected-item" data-post-title="<?php echo get_the_title( $cr ); ?>" data-post-type="<?php echo get_post_type( $cr ); ?>" data-post-id="<?php echo $cr; ?>">

						<div class="sft-rel-section-item-head">
							<span class="dashicons dashicons-trash js-remove-connection sft-rel-remove-connection" data-post-id="<?php echo $cr; ?>"></span> <?php _e( mb_strimwidth( get_the_title( $cr ) , 0 , 50 , '...' ) , SFT_REL_TEXT_DOMAIN ); ?>
							<span class="dashicons dashicons-arrow-down sft-rel-toggle-connected-item js-toggle-connected-item" data-post-id="<?php echo $cr; ?>"></span>
						</div>

						<div class="sft-rel-section-item js-section-item">
							<ul class="categorychecklist form-no-clear">
								<?php $tax = get_object_taxonomies( get_post_type( $cr ) , 'objects' ); ?>

								<?php if ( $tax ) : ?>

									<?php foreach ( $tax as $taxonomy ): ?>
										<li id="sft-rel-taxonomy-<?php echo $taxonomy->name; ?>" class="popular-category">
											<label class=""></label>
											<label class="selectit">
												<input class="js-connected-post-taxonomies-checkbox" value="<?php echo $taxonomy->name; ?>" type="checkbox" name="connected_post_taxonomies[<?php echo $cr; ?>][<?php echo $taxonomy->name; ?>]" id="in-taxonomy-<?php echo $taxonomy->name; ?>" <?php checked( isset( $connected_relations_taxonomies[ $cr ][ $taxonomy->name ] ) ); ?>><span> <?php echo $taxonomy->label; ?></span>
											</label>
										</li>
									<?php endforeach; ?>

								<?php else : ?>
									<li class="sft-rel-post-no-taxonomies"><?php _e( 'No available taxonomies.' , SFT_REL_TEXT_DOMAIN ); ?></li>
								<?php endif; ?>

							</ul>
						</div>
						<input type="hidden" name="connected_post[]" value="<?php echo $cr; ?>">
					</li>

				<?php endforeach; ?>
			<?php endif; ?>

			<li class="sft-rel-connected-no-connections js-connected-no-connections" <?php echo empty( $connected_relations ) ? '' : 'style="display: none;"'; ?>><?php _e( 'Add connections here.' , SFT_REL_TEXT_DOMAIN ); ?></li>

		</ul>
	</div>
	<p class="description" id="admin-email-description"><?php _e( 'You can change the order by dragging the items.' , SFT_REL_TEXT_DOMAIN ); ?></p>
	<span style="display: none" class="js-text-references" data-no-taxonomies="<?php _e( 'No available taxonomies.' , SFT_REL_TEXT_DOMAIN ); ?>" data-remove-taxonomy="<?php _e( 'Are you sure you want to remove this Related post ?' , SFT_REL_TEXT_DOMAIN ); ?>"></span>
</div>
