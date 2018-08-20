<?php 
/*
 * Template name: Page with inner Blocks
 */
get_header();
the_post();
?>

<section class="main-content">
	<div class="container">
		<div class="row">

			<?php if (get_field('show_sidebar') && get_field('sidebar_side') == 'left' && have_rows('template_widgets')) { ?>
			<div class="col-md-<?php the_field('sidebar_column_width') ?> col-sm-12">
				<aside> 
					<?php get_template_widgets(get_the_ID()) ?>
				</aside>
			</div>
			<?php } ?>

			<div class="col-md-8 col-sm-12">
				<?php the_content() ?>

                <?php if( have_rows('template_blocks') ): ?>
                    <?php get_template_blocks(get_the_ID()) ?>
                <?php endif; ?>
			</div>

			<?php if (get_field('show_sidebar') && get_field('sidebar_side') == 'right' && have_rows('template_widgets')) { ?>
			<div class="col-md-<?php the_field('sidebar_column_width') ?> col-sm-12">
				<aside>
					<?php get_template_widgets(get_the_ID()) ?>
				</aside>
			</div>
			<?php } ?>
			
		</div>
	</div>
</section>

<?php get_footer() ?> 