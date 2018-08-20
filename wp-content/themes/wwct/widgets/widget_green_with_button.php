<?php

/**
 * Adds Foo_Widget widget.
 */
class Green_with_Button_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'green_with_button_widget', // Base ID
			esc_html__( 'WCT Green with Button', 'worldwide' ), // Name
			array( 'description' => esc_html__( 'Colored widget with button', 'worldwide' ), ) // Args
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
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		?>

			<div class="widget-content">
				<?php echo $instance['text'] ?>
				<?php if ($instance['button_label'] != '' && $instance['button_link'] !='') { ?>
				<div>
					<a href="<?php echo $instance['button_link'] ?>" class="btn btn-outline btn-white"><?php echo $instance['button_label'] ?></a>
				</div>
				<?php } ?>
			</div>

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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$text = ! empty( $instance['text'] ) ? $instance['text'] : '';
		$button_label = ! empty( $instance['button_label'] ) ? $instance['button_label'] : '';
		$button_link = ! empty( $instance['button_link'] ) ? $instance['button_link'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'worldwide' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_attr_e( 'Content:', 'worldwide' ); ?></label> 
			<textarea rows="" cols class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"><?php echo esc_attr( $text ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button_label' ) ); ?>"><?php esc_attr_e( 'Button Label:', 'worldwide' ); ?></label> 
			<input rows="" cols class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_label' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_label' ) ); ?>" value="<?php echo esc_attr( $button_label ); ?>">

		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button_link' ) ); ?>"><?php esc_attr_e( 'Btton link:', 'worldwide' ); ?></label> 
			<input rows="" cols class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_link' ) ); ?>" value="<?php echo esc_attr( $button_link ); ?>">

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
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['text'] =  $new_instance['text'];
		$instance['button_label'] =  ( ! empty( $new_instance['button_label'] ) ) ? strip_tags( $new_instance['button_label'] ) : '';
		$instance['button_link'] =  ( ! empty( $new_instance['button_link'] ) ) ? strip_tags( $new_instance['button_link'] ) : '';

		return $instance;
	}

} // class Foo_Widget

