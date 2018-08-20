<?php

/**
 * Adds Foo_Widget widget.
 */
class Files_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'files_widget', // Base ID
			esc_html__( 'WCT File', 'worldwide' ), // Name
			array( 'description' => esc_html__( 'Green File Attachment', 'worldwide' ), ) // Args
		);
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

		echo $args['before_widget'];

		?>
		<a href="<?php echo $instance['file_url'] ?>" target="_blank" class="widget_file-link"><?php echo $instance['label'] ?><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
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
		$label = ! empty( $instance['label'] ) ? $instance['label'] : '';
		$file_url = ! empty( $instance['file_url'] ) ? $instance['file_url'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'label' ) ); ?>"><?php esc_attr_e( 'Label:', 'worldwide' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'label' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'label' ) ); ?>" type="text" value="<?php echo esc_attr( $label ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'file_url' ) ); ?>"><?php esc_attr_e( 'File URL:', 'worldwide' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'file_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'file_url' ) ); ?>" type="text" value="<?php echo esc_attr( $file_url ); ?>">
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
		$instance['label'] = ( ! empty( $new_instance['label'] ) ) ? strip_tags( $new_instance['label'] ) : '';
		$instance['file_url'] =  ( ! empty( $new_instance['file_url'] ) ) ? strip_tags( $new_instance['file_url'] ) : '';

		return $instance;
	}

} // class Foo_Widget

