<?php get_header() ?>
<?php the_post() ?>

<?php
	$main_col_width = 10;

	if (have_rows('widgets')) {
		$main_col_width = 7;
	}

	if (get_the_content() != "") {
?>
<div class="container-wrapper standard-container-wrapper " style="background-color: <?php echo get_field('background_color') ?>">
	<div class="container">
		<div class="row">
			<div class="col-sm-<?php echo $main_col_width ?> col-sm-offset-1">
				<?php the_content() ?>
			</div>
			<?php if (have_rows('widgets')) { ?>
			<div class="col-sm-3 col-sm-offset-1">
				<?php get_template_widgets(get_the_ID()) ?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php } ?>

<?php 
// back button
if (get_field('back_button')) { ?>
<div class="container-wrapper gradient-container-wrapper back-bar click-first-link">
	<div class="container">
		<?php if (get_field('back_to') == 'parent') { ?>
			<?php $parent_post = get_post($post->post_parent); ?>
		<a href="<?php echo get_permalink($post->post_parent) ?>">
			Back to <?php echo $parent_post->post_title ?>
			<br>
			<span class="fa fa-angle-down"></span>
		</a>
		<?php } else if (get_field('back_to') == 'tl_parent') { ?>
			<?php 
				$parents = get_post_ancestors( $post->ID ); 
				$tl_parent_id = ($parents) ? $parents[count($parents)-1]: $post->ID;
				$tl_parent_page = get_post( $tl_parent_id );
				
				?>
		<a href="<?php echo get_permalink($tl_parent_id) ?>">
			Back to <?php echo $tl_parent_page->post_title ?>
			<br>
			<span class="fa fa-angle-down"></span>
		</a>
		<?php } else if (get_field('back_to') == 'custom') { ?>
		<a href="<?php the_field('back_to_button_link') ?>">
			<?php the_field('back_to_button_label') ?>
			<br>
			<span class="fa fa-angle-down"></span>
		</a>
		<?php } ?>
	</div>
</div>
<?php } ?>

<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer() ?> 