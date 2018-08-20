<?php 
/*
 * Template Name: Contact Us
 */
get_header() ?>
<?php the_post() ?>

<?php if ( ! empty_content($post->post_content)) { ?>
<section class="main-content">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-8 offset-lg-2 col-md-12 col-md-offset-2 col-sm-12 col-sm-offset-0">
				<?php the_content() ?>	
				<div class="contact-us-webpart">
				<?php

				//get_field('info_option_label');
				$select_items = get_field('contact_menu_item');
				while(have_rows('contact_menu_item')) { the_row();
					$options[] = array(sanitize_title(get_sub_field('label')), get_sub_field('label'));
				} ?>
				<div class="select-style">
					<select class="contact-options">
						<option value="" disabled="disabled" selected="selected"><?php echo get_field('info_option_label') ?></option>
						<?php foreach($options as $option) { ?>
						<option value="<?php echo $option[0] ?>"><?php echo $option[1] ?></option>
						<?php } ?>
					</select>
				</div>	
					<?php
						$i = 0;
						while(have_rows('contact_menu_item')) { the_row();
					?>
					
						<?php if (get_sub_field('type') == 'text') { ?>
						
								<div class="<?php echo $options[$i][0] ?> contact-text" style="display: none">
								<?php the_sub_field('text'); ?>
								</div>
							
						<?php } else if (get_sub_field('type') == 'gravity-form') { ?>

								<div class="<?php echo $options[$i][0] ?> contact-text contact-gravity-form" style="display: none">
									<?php the_sub_field('text'); ?>
									<?php echo do_shortcode( '[gravityform id='.get_sub_field('form_id').' title=false description=false ajax=true]' ); ?>
								</div>

						<?php } else if (get_sub_field('type') == 'marketo-form') { ?>
						
								<div class="external_form <?php if (get_sub_field('two_column_form')) echo 'two-rows-form ' ?><?php echo $options[$i][0] ?>" style="display: none">
									<div class="<?php echo $options[$i][0] ?>-form">
									  <div id="mktoForm_<?php the_sub_field('form_id') ?>" class="marketo-form"></div>
									</div>
									<script>
										loadAsync('//app-ab07.marketo.com/js/forms2/js/forms2.min.js' , function(){
											MktoForms2.loadForm("//app-ab07.marketo.com", "935-DOM-994", <?php the_sub_field('form_id') ?>, function (form) {
												MktoForms2.$("#mktoForm_<?php the_sub_field('form_id') ?>").append(form.getFormElem());
												MktoForms2.$('#mktoForm_<?php echo get_sub_field("form_id") ?> #Website_Comments__c').closest('.mktoFormRow').addClass('full-area');
												MktoForms2.$('#mktoForm_<?php echo get_sub_field("form_id") ?> #Website_Comments__c').attr('rows','6');

												MktoForms2.$('input[type="checkbox"]')
													.closest('.mktoFormRow').addClass('form-checkbox').addClass('full-width');
												MktoForms2.$('input[type="checkbox"]').parent().parent()
													.find('.mktoLogicalField.mktoCheckboxList.mktoHasWidth').css('width','25px');
												
												form.onSuccess(function (values, followUpUrl) {
													form.getFormElem().hide();
													window.parent.location = followUpUrl;
													return false;
												});
											});
										});
									</script>
									<div class="marketo-form-success">
										<?php the_sub_field('form_success_text') ?>
									</div>
								</div>
						
						<?php
								
							}
						?>

					
					<?php 
							$i++;
						}
					?>

				</div>

			</div>

		</div>
	</div>
</section>
<?php } ?>
	
<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer() ?>