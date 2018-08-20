<?php

/**
 * Adds Foo_Widget widget.
 */
class Image_Text_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {

		// Add Widget scripts
		add_action('admin_enqueue_scripts', array($this, 'scripts'));

		parent::__construct(
			'image_text_widget', // Base ID
			esc_html__( 'WCT Image Text', 'worldwide' ), // Name
			array( 'description' => esc_html__( 'Witdget with image and text', 'worldwide' ), ) // Args
		);
	}

	public function scripts()
	{
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_media();
		wp_enqueue_script('our_admin', get_template_directory_uri() . '/js/wct_admin.js', array('jquery'));
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		$image = ! empty( $instance['image'] ) ? $instance['image'] : '';
		$text = (isset($instance['text'])) ? $instance["text"] : '';

		echo $args['before_widget'];
		?>
		<?php if ($instance['link'] != '') { ?>
		<a href="<?php echo $instance['link'] ?>" title="<?php echo $instance['title'] ?>">
		<?php } ?>
			<?php if($image): ?>
			<div class="text-center">
				<?php echo wp_get_attachment_image( $image, 'image-size-3' ) ?>
			</div>
			<?php endif; ?>
			<div class="widget-text-wrapp">
				<h3><?php echo $instance['title'] ?></h3>
				<p><?php echo $instance['text'] ?></p>
			</div>
		<?php if ($instance['link'] != '') { ?>
		</a>
		<?php } ?>
		<?php

		echo $args['after_widget'];
	}




	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$image = ! empty( $instance['image'] ) ? $instance['image'] : '';
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$text = ! empty( $instance['text'] ) ? $instance['text'] : '';
		$link = ! empty( $instance['link'] ) ? $instance['link'] : '';
		?>
		<p>
			<?php if($image): ?>
				<?php echo wp_get_attachment_image( $image, 'image-size-4' ) ?>
			<?php endif; ?>
			<input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="hidden" value="<?php echo esc_url( $image ); ?>" />
			<button class="upload_image_button button button-primary">Upload Image</button>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text:' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_attr( $text ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo esc_attr( $link ); ?>">
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
		$instance = array();
 		$instance['title'] =  ( ! empty( $new_instance['title'] ) ) ? $new_instance['title'] : '';
 		$instance['text'] =  ( ! empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';
		$instance['image'] = ( ! empty( $new_instance['image'] ) ) ? $new_instance['image'] : '';
 		$instance['link'] =  ( ! empty( $new_instance['link'] ) ) ? $new_instance['link'] : '';

		return $instance;
	}

} // class Foo_Widget

