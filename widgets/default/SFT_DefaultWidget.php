<?php

class SFT_DefaultWidget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'SFT_DefaultWidget', // Base ID
			esc_html__( 'SFT Relations', SFT_REL_TEXT_DOMAIN ), // Name
			array( 'description' => esc_html__( 'Show post/page related items', SFT_REL_TEXT_DOMAIN ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		global $post;

		echo $args['before_widget'];
		if ( ! empty( $instance['sft_title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['sft_title'] ) . $args['after_title'];
		}
		$sft_container_element            = ! empty( $instance['sft_container_element'] ) ? $instance['sft_container_element'] : 'div';
		$sft_container_class              = ! empty( $instance['sft_container_class'] ) ? $instance['sft_container_class'] : '';
		$sft_item_container_element       = ! empty( $instance['sft_item_container_element'] ) ? $instance['sft_item_container_element'] : 'div';
		$sft_item_title_element           = ! empty( $instance['sft_item_title_element'] ) ? $instance['sft_item_title_element'] : 'none';
		$sft_custom_item_class            = ! empty( $instance['sft_custom_item_class'] ) ? $instance['sft_custom_item_class'] : '';
		$sft_show_post_title              = isset( $instance['sft_show_post_title'] ) ? $instance['sft_show_post_title'] : 0;
		$sft_show_post_date               = isset( $instance['sft_show_post_date'] ) ? $instance['sft_show_post_date'] : 0;
		$sft_show_post_author             = isset( $instance['sft_show_post_author'] ) ? $instance['sft_show_post_author'] : 0;
		$sft_show_post_feature_image      = isset( $instance['sft_show_post_feature_image'] ) ? $instance['sft_show_post_feature_image'] : 0;
		$sft_show_post_excerpt            = isset( $instance['sft_show_post_excerpt'] ) ? $instance['sft_show_post_excerpt'] : 0;
		$sft_show_post_content            = isset( $instance['sft_show_post_content'] ) ? $instance['sft_show_post_content'] : 0;
		$sft_item_terms_container_element = ! empty( $instance['sft_item_terms_container_element'] ) ? $instance['sft_item_terms_container_element'] : '';
		$sft_item_terms_container_class   = ! empty( $instance['sft_item_terms_container_class'] ) ? $instance['sft_item_terms_container_class'] : '';
		$sft_item_term_container_element      = ! empty( $instance['sft_item_term_container_element'] ) ? $instance['sft_item_term_container_element'] : 'span';
		$sft_item_term_container_class = ! empty( $instance['sft_item_term_container_class'] ) ? $instance['sft_item_term_container_class'] : '';

		echo do_shortcode(
			'[sftrelations post_id="' .
			$post->ID .
			'" container="' .
			$sft_container_element .
			'" item_container="' .
			$sft_item_container_element .
			'" item_title_container="' .
			$sft_item_title_element .
			'" item_show_title="' .
			( $sft_show_post_title ? 'true' : 'false' ) .
			'" item_show_date="' .
			( $sft_show_post_date ? 'true' : 'false' ) .
			'" item_show_author="' .
			( $sft_show_post_author ? 'true' : 'false' ) .
			'" container_class="' .
			$sft_container_class .
			'" item_container_class="' .
			$sft_custom_item_class .
			'" item_terms_container="' .
			$sft_item_terms_container_element .
			'" item_terms_container_class="' .
			$sft_item_terms_container_class .
			'" item_terms_container="' .
			$sft_item_term_container_element .
			'" item_term_container_class="' .
			$sft_item_term_container_class .
			'" item_show_feature_image="' .
			( $sft_show_post_feature_image ? 'true' : 'false' ) .
			'" item_show_excerpt="' .
			( $sft_show_post_excerpt ? 'true' : 'false' ) .
			'" item_show_content="' .
			( $sft_show_post_content ? 'true' : 'false' ) .
			'" ]'
		);

		echo $args['after_widget'];
	}

	/**
	 *  Back-end widget form.
	 *
	 * @return String
	 *
	 * @param array $instance
	 */
	public function form( $instance ) {
		$sft_title                        = ! empty( $instance['sft_title'] ) ? $instance['sft_title'] : esc_html__( 'Related Posts', SFT_REL_TEXT_DOMAIN );
		$sft_container_element            = ! empty( $instance['sft_container_element'] ) ? $instance['sft_container_element'] : 'div';
		$sft_container_class              = ! empty( $instance['sft_container_class'] ) ? $instance['sft_container_class'] : '';
		$sft_item_container_element       = ! empty( $instance['sft_item_container_element'] ) ? $instance['sft_item_container_element'] : 'div';
		$sft_item_title_element           = ! empty( $instance['sft_item_title_element'] ) ? $instance['sft_item_title_element'] : 'none';
		$sft_custom_item_class            = ! empty( $instance['sft_custom_item_class'] ) ? $instance['sft_custom_item_class'] : '';
		$sft_show_post_title              = isset( $instance['sft_show_post_title'] ) ? $instance['sft_show_post_title'] : 0;
		$sft_show_post_date               = isset( $instance['sft_show_post_date'] ) ? $instance['sft_show_post_date'] : 0;
		$sft_show_post_author             = isset( $instance['sft_show_post_author'] ) ? $instance['sft_show_post_author'] : 0;
		$sft_show_post_feature_image      = isset( $instance['sft_show_post_feature_image'] ) ? $instance['sft_show_post_feature_image'] : 0;
		$sft_show_post_excerpt            = isset( $instance['sft_show_post_excerpt'] ) ? $instance['sft_show_post_excerpt'] : 0;
		$sft_show_post_content            = isset( $instance['sft_show_post_content'] ) ? $instance['sft_show_post_content'] : 0;
		$sft_item_terms_container_element = ! empty( $instance['sft_item_terms_container_element'] ) ? $instance['sft_item_terms_container_element'] : '';
		$sft_item_terms_container_class   = ! empty( $instance['sft_item_terms_container_class'] ) ? $instance['sft_item_terms_container_class'] : '';
		$sft_item_term_container_element      = ! empty( $instance['sft_item_term_container_element'] ) ? $instance['sft_item_term_container_element'] : 'span';
		$sft_item_term_container_class = ! empty( $instance['sft_item_term_container_class'] ) ? $instance['sft_item_term_container_class'] : '';

		$html_elements = [
			'span'    => 'Span',
			'div'     => 'Div',
			'ul'      => 'Ul',
			'li'      => 'Li',
			'section' => 'Section',
			'article' => 'Article',
		];

		$html_title_elements = [
			'none' => 'None',
			'h1'   => 'H1',
			'h2'   => 'H2',
			'h3'   => 'H3',
			'h4'   => 'H4',
			'h5'   => 'H5',
			'h6'   => 'H6',
			'p'    => 'Paragraph',
			'span' => 'Span',
		];

		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'sft_title' ) ); ?>"><?php esc_attr_e( 'Title:', SFT_REL_TEXT_DOMAIN ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'sft_title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'sft_title' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $sft_title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'sft_container_element' ) ); ?>"><?php esc_attr_e( 'Container element:', SFT_REL_TEXT_DOMAIN ); ?></label>
            <select id="<?php echo $this->get_field_id( 'sft_container_element' ); ?>"
                    name="<?php echo $this->get_field_name( 'sft_container_element' ); ?>" class="widefat"
                    style="width:100%;">
				<?php foreach ( $html_elements as $elm => $elm_name ) : ?>
                    <option <?php selected( $sft_container_element, $elm ); ?>
                            value="<?php echo $elm; ?>"><?php echo $elm_name; ?></option>
				<?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'sft_container_class' ) ); ?>"><?php esc_attr_e( 'Custom container class:', SFT_REL_TEXT_DOMAIN ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'sft_container_class' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'sft_container_class' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $sft_container_class ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'sft_item_title_element' ) ); ?>"><?php esc_attr_e( 'Custom container item title element:', SFT_REL_TEXT_DOMAIN ); ?></label>
            <select id="<?php echo $this->get_field_id( 'sft_item_title_element' ); ?>"
                    name="<?php echo $this->get_field_name( 'sft_item_title_element' ); ?>" class="widefat"
                    style="width:100%;">
				<?php foreach ( $html_title_elements as $elm => $elm_name ) : ?>
                    <option <?php selected( $sft_item_title_element, $elm ); ?>
                            value="<?php echo $elm; ?>"><?php echo $elm_name; ?></option>
				<?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'sft_item_container_element' ) ); ?>"><?php esc_attr_e( 'Item container element:', SFT_REL_TEXT_DOMAIN ); ?></label>
            <select id="<?php echo $this->get_field_id( 'sft_item_container_element' ); ?>"
                    name="<?php echo $this->get_field_name( 'sft_item_container_element' ); ?>" class="widefat"
                    style="width:100%;">
				<?php foreach ( $html_elements as $elm => $elm_name ) : ?>
                    <option <?php selected( $sft_item_container_element, $elm ); ?>
                            value="<?php echo $elm; ?>"><?php echo $elm_name; ?></option>
				<?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'sft_custom_item_class' ) ); ?>"><?php esc_attr_e( 'Custom item class:', SFT_REL_TEXT_DOMAIN ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'sft_custom_item_class' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'sft_custom_item_class' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $sft_custom_item_class ); ?>">
        </p>
        <span><?php esc_attr_e( 'Show post meta:', SFT_REL_TEXT_DOMAIN ); ?></span>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'sft_item_terms_container_element' ) ); ?>"><?php esc_attr_e( 'Item terms container element:', SFT_REL_TEXT_DOMAIN ); ?></label>
            <select id="<?php echo $this->get_field_id( 'sft_item_terms_container_element' ); ?>"
                    name="<?php echo $this->get_field_name( 'sft_item_terms_container_element' ); ?>" class="widefat"
                    style="width:100%;">
				<?php foreach ( $html_elements as $elm => $elm_name ) : ?>
                    <option <?php selected( $sft_item_terms_container_element, $elm ); ?>
                            value="<?php echo $elm; ?>"><?php echo $elm_name; ?></option>
				<?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'sft_item_terms_container_class' ) ); ?>"><?php esc_attr_e( 'Custom item terms container class:', SFT_REL_TEXT_DOMAIN ); ?></label>
            <input class="widefat"
                   id="<?php echo esc_attr( $this->get_field_id( 'sft_item_terms_container_class' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'sft_item_terms_container_class' ) ); ?>"
                   type="text"
                   value="<?php echo esc_attr( $sft_item_terms_container_class ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'sft_item_term_container_element' ) ); ?>"><?php esc_attr_e( 'Item term container element:', SFT_REL_TEXT_DOMAIN ); ?></label>
            <select id="<?php echo $this->get_field_id( 'sft_item_term_container_element' ); ?>"
                    name="<?php echo $this->get_field_name( 'sft_item_term_container_element' ); ?>" class="widefat"
                    style="width:100%;">
				<?php foreach ( $html_elements as $elm => $elm_name ) : ?>
                    <option <?php selected( $sft_item_term_container_element, $elm ); ?>
                            value="<?php echo $elm; ?>"><?php echo $elm_name; ?></option>
				<?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'sft_item_term_container_class' ) ); ?>"><?php esc_attr_e( 'Custom item term container class:', SFT_REL_TEXT_DOMAIN ); ?></label>
            <input class="widefat"
                   id="<?php echo esc_attr( $this->get_field_id( 'sft_item_term_container_class' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'sft_item_term_container_class' ) ); ?>"
                   type="text"
                   value="<?php echo esc_attr( $sft_item_term_container_class ); ?>">
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $sft_show_post_title ); ?>
                   id="<?php echo $this->get_field_id( 'sft_show_post_title' ); ?>"
                   name="<?php echo $this->get_field_name( 'sft_show_post_title' ); ?>"/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'sft_show_post_title' ) ); ?>"><?php esc_attr_e( 'Show post title', SFT_REL_TEXT_DOMAIN ); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $sft_show_post_date ); ?>
                   id="<?php echo $this->get_field_id( 'sft_show_post_date' ); ?>"
                   name="<?php echo $this->get_field_name( 'sft_show_post_date' ); ?>"/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'sft_show_post_date' ) ); ?>"><?php esc_attr_e( 'Show post date', SFT_REL_TEXT_DOMAIN ); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $sft_show_post_author ); ?>
                   id="<?php echo $this->get_field_id( 'sft_show_post_author' ); ?>"
                   name="<?php echo $this->get_field_name( 'sft_show_post_author' ); ?>"/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'sft_show_post_author' ) ); ?>"><?php esc_attr_e( 'Show post author', SFT_REL_TEXT_DOMAIN ); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $sft_show_post_feature_image ); ?>
                   id="<?php echo $this->get_field_id( 'sft_show_post_feature_image' ); ?>"
                   name="<?php echo $this->get_field_name( 'sft_show_post_feature_image' ); ?>"/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'sft_show_post_feature_image' ) ); ?>"><?php esc_attr_e( 'Show post feature image', SFT_REL_TEXT_DOMAIN ); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $sft_show_post_excerpt ); ?>
                   id="<?php echo $this->get_field_id( 'sft_show_post_excerpt' ); ?>"
                   name="<?php echo $this->get_field_name( 'sft_show_post_excerpt' ); ?>"/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'sft_show_post_excerpt' ) ); ?>"><?php esc_attr_e( 'Show post excerpt', SFT_REL_TEXT_DOMAIN ); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $sft_show_post_content ); ?>
                   id="<?php echo $this->get_field_id( 'sft_show_post_content' ); ?>"
                   name="<?php echo $this->get_field_name( 'sft_show_post_content' ); ?>"/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'sft_show_post_content' ) ); ?>"><?php esc_attr_e( 'Show post content', SFT_REL_TEXT_DOMAIN ); ?></label>
        </p>

		<?php

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                                         = array();
		$instance['sft_title']                            = ( ! empty( $new_instance['sft_title'] ) ) ? strip_tags( $new_instance['sft_title'] ) : '';
		$instance['sft_container_element']                = ( ! empty( $new_instance['sft_container_element'] ) ) ? strip_tags( $new_instance['sft_container_element'] ) : '';
		$instance['sft_container_class']                  = ( ! empty( $new_instance['sft_container_class'] ) ) ? strip_tags( $new_instance['sft_container_class'] ) : '';
		$instance['sft_item_container_element']           = ( ! empty( $new_instance['sft_item_container_element'] ) ) ? strip_tags( $new_instance['sft_item_container_element'] ) : '';
		$instance['sft_item_title_element']               = ( ! empty( $new_instance['sft_item_title_element'] ) ) ? strip_tags( $new_instance['sft_item_title_element'] ) : 'none';
		$instance['sft_custom_item_class']                = ( ! empty( $new_instance['sft_custom_item_class'] ) ) ? strip_tags( $new_instance['sft_custom_item_class'] ) : '';
		$instance['sft_show_post_title']                  = isset( $new_instance['sft_show_post_title'] ) ? 1 : 0;
		$instance['sft_show_post_date']                   = isset( $new_instance['sft_show_post_date'] ) ? 1 : 0;
		$instance['sft_show_post_author']                 = isset( $new_instance['sft_show_post_author'] ) ? 1 : 0;
		$instance['sft_show_post_feature_image']          = isset( $new_instance['sft_show_post_feature_image'] ) ? 1 : 0;
		$instance['sft_show_post_excerpt']                = isset( $new_instance['sft_show_post_excerpt'] ) ? 1 : 0;
		$instance['sft_show_post_content']                = isset( $new_instance['sft_show_post_content'] ) ? 1 : 0;
		$instance['sft_item_terms_container_element']     = ( ! empty( $new_instance['sft_item_terms_container_element'] ) ) ? strip_tags( $new_instance['sft_item_terms_container_element'] ) : '';
		$instance['sft_item_terms_container_class']       = ( ! empty( $new_instance['sft_item_terms_container_class'] ) ) ? strip_tags( $new_instance['sft_item_terms_container_class'] ) : '';
		$instance['sft_item_term_container_element']      = ( ! empty( $new_instance['sft_item_term_container_element'] ) ) ? strip_tags( $new_instance['sft_item_term_container_element'] ) : '';
		$instance['sft_item_term_container_class']        = ( ! empty( $new_instance['sft_item_term_container_class'] ) ) ? strip_tags( $new_instance['sft_item_term_container_class'] ) : '';

		return $instance;
	}

}

add_action(
	'widgets_init',
	function () {
		register_widget( 'SFT_DefaultWidget' );
	}
);
