<?php get_header('amp'); ?>
<?php the_post(); ?>
<?php // $sidebar = wwct_get_sidebar_data(); ?>




<?php the_content() ?>
<?php
/*
 if ( ! empty_content($post->post_content)) {
	?>
	
<section class="main-content">
	<div class="container">
		<div class="row">

			<?php if ($sidebar['side'] == 'left') { ?>
			<div class="col-12 col-md-<?php echo $sidebar['columns'] ?>">
				<aside>
				<?php wwct_get_sidebar($sidebar); ?>
				</aside>
			</div>
			<?php } ?>

			<div class="col-12 col-md main-page-content">
				<?php the_content() ?>
			</div>

			<?php if ($sidebar['side'] == 'right') { ?>
			<div class="col-12 col-md-<?php echo $sidebar['columns'] ?>">
				<aside>
				<?php wwct_get_sidebar($sidebar); ?>
				</aside>
			</div>
			<?php } ?>
			
		</div>
	</div>
</section>
<?php }
*/ ?>

<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer('amp') ?> 