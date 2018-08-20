<?php

/**
 * Adds Foo_Widget widget.
 */
class Simple_Text_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'simple_text_widget', // Base ID
			esc_html__( 'Simple Text', 'worldwide' ), // Name
			array( 'description' => esc_html__( 'Simple text widget', 'worldwide' ), ) // Args
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

		
		global $post;
		$parents = get_post_ancestors( get_the_ID() );
		$id = ($parents) ? $parents[count($parents)-1]: get_the_ID();
		$parent = get_post( $id );
		$parent->post_name;

		$children = wp_list_pages( array(
			'title_li' => '',
			'child_of' => $parent->ID,
			'echo'     => 0
		) );

		$classname = (isset($instance['type'])) ? $instance["type"] : 'widget-subpages-gray';

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		?>
		<div class="">
			<?php echo $instance['text'] ?>
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
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'worldwide' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_attr_e( 'Content:', 'worldwide' ); ?></label> 
			<textarea rows="" cols class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" value="<?php echo esc_attr( $text ); ?>">
			</textarea>
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

		return $instance;
	}

} // class Foo_Widget

