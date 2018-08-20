<?php

/**
 * Adds Foo_Widget widget.
 */
class Subpages_Tree_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 * /
	function __construct() {
		parent::__construct(
			'subpages_widget', // Base ID
			esc_html__( 'WCT Subpages Tree', 'worldwide' ), // Name
			array( 'description' => esc_html__( 'Display Subpages in a Tree', 'worldwide' ), ) // Args
		);
	}*/
	
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'as-accord-holder',
			'description' => 'WCT Subpages Tree',
		);
		parent::__construct( 'subpages_widget', 'WCT Subpages Tree', $widget_ops );
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
		// . '<div class="'.$classname.'">';
		//if ( ! empty( $instance['title'] ) ) {
		//	echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		//}
		?>

			<div class="root-page">
				<a href="<?php echo get_permalink($parent->ID) ?>"><?php echo $parent->post_title ?></a>
			</div>
			<?php if ( $children ) : ?>
			<ul class="as-accord">
				<?php echo $children; ?>
			</ul>
			<?php endif; ?>
			<div class="btn-holder">
				<a class="btn" href="https://www.worldwide.com/contact-us/">Contact</a>
			</div>
	
		<?php

		//echo '</div>';
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
		//$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$type = ! empty( $instance['type'] ) ? $instance['type'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>"><?php esc_attr_e( 'Tree type:', 'worldwide' ); ?></label> 
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>" type="text" value="<?php echo esc_attr( $type ); ?>">
				<option value="widget-subpages-gray"<?php echo ($type=='widget-subpages-gray')?' selected':'' ?>>Gray</option>
				<option value="widget-subpages-hollow"<?php echo ($type=='widget-subpages-hollow')?' selected':'' ?>>Hollow</option>

			</select>
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
		//$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['type'] =  $new_instance['type'];

		return $instance;
	}

} // class Foo_Widget

