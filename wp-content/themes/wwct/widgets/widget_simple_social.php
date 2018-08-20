<?php

/**
 * Adds Foo_Widget widget.
 */
class Simple_Social_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'simple_social_widget', // Base ID
			esc_html__( 'WCT Simple Social', 'worldwide' ), // Name
			array( 'description' => esc_html__( 'Displays Social Icons defined on WWCT Option page', 'worldwide' ), ) // Args
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
		<div class="">
			
			<?php if (have_rows('social', 'option')) { ?>
			<ul class="social text-center">
				<?php while(have_rows('social', 'option')) {  the_row(); ?>
				<li><a href="<?php the_sub_field('link') ?>" title="<?php the_sub_field('label') ?>" target="_blank"><?php the_sub_field('icon') ?></a></li>
				<?php } ?>
			</ul>
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
		//$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		//$text = ! empty( $instance['text'] ) ? $instance['text'] : '';
		?>
			<ul class="social">
				<li><a href="https://facebook.com"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
				<li><a href="https://twitter.com"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
				<li><a href="https://linked.com"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
				<li><a href="https://instagram.com"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
			</ul>
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
		//$instance['text'] =  $new_instance['text'];

		return $instance;
	}

} // class Foo_Widget

