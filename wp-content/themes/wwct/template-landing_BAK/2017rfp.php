<?php get_header('landing'); ?>
<?php the_post(); ?>


<?php if( get_field('landing_header_image') ){ ?>
<section class="hero" style="background-image:url(<?php the_field('landing_header_image'); ?>);">
<?php } else { ?>
<section class="hero">	
<?php } ?>
			
		<div class="row">					
			<div class="col-7 text-center text-white">				
				<?php if( get_field('header_title') ){ ?>
				<div class="v-cent">
					<div class="title-wrap">
						<h2><?php the_field('header_title'); ?></h2>
							<?php if( get_field('header_sub_title') ){ ?>
								<h3><?php the_field('header_sub_title'); ?></h3>
							<?php } ?>
					</div>
						<?php if( get_field('header_description') ){ ?>
							<div class="header_description">
								<?php the_field('header_description'); ?>										
							</div>
						<?php } ?>
				</div>
				<?php } ?>
			</div>
			<?php if (get_field('landing_marketo_id')) { ?>
			<div class="col-5 text-left">
				<?php if( get_field('landing_marketo_above_text') ){ ?>
				<div class="marketo-form-before">
					<?php the_field('landing_marketo_above_text') ?>
				</div>
				<?php } ?>
				<div id="mktoForm_<?php echo get_field('landing_marketo_id') ?>" class="marketo-form external_form"></div>
				<script>
					jQuery(document).ready(function($){
						MktoForms2.loadForm("//app-ab07.marketo.com", "935-DOM-994", <?php echo get_field('landing_marketo_id') ?>, function (form) {
							MktoForms2.$("#mktoForm_<?php echo get_field('landing_marketo_id') ?>").append(form.getFormElem());
							$(".mktoFormRow:lt(4)").addClass('half-row');
							$(".mktoFormRow:lt(4)").addClass('half-row');
							form.onSuccess(function (values, followUpUrl) {
								form.getFormElem().hide();
								window.parent.location = followUpUrl;
								return false;
							});
						});
					});
				</script>
				<div class="marketo-form-success" style="display:none;">
					<?php the_field('landing_marketo_on_submit_message') ?>
				</div>
			</div>
			<?php } ?>
		</div>
				
</section>

<?php if( get_field('content') ){ ?>
<section class="main-content">
	<div class="container">
		<div class="row">
			<div class="col">
				<?php the_field('content') ?>
			</div>
        </div>
    </div>
</section>
<?php } ?>

<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer('landing'); ?>