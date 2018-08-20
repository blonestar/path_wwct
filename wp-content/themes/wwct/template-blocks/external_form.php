
<<?php echo $tag.$id.$class ?><?php echo $style ?>>

<div class="<?php echo $container ?>">
	<div class="row">
		<div class="col-12">			
			<h2 class="text-center"><?php echo get_sub_field('title') ?></h2>
			<?php the_sub_field('subtitle') ?>
			<div>
				<div id="mktoForm_<?php echo get_sub_field('form_id') ?>" class="home-page-form"></div>
				<script>
					loadAsync('//app-ab07.marketo.com/js/forms2/js/forms2.min.js' , function(){
						MktoForms2.loadForm("//app-ab07.marketo.com", "935-DOM-994", <?php echo get_sub_field('form_id') ?>, function (form) {
							MktoForms2.$("#mktoForm_<?php echo get_sub_field('form_id') ?>").append(form.getFormElem());
							MktoForms2.$('#mktoForm_<?php echo get_sub_field('form_id') ?> #Website_Comments__c').closest('.mktoFormRow').addClass('full-area');
							MktoForms2.$('#mktoForm_<?php echo get_sub_field('form_id') ?> #Website_Comments__c').attr('rows','6');

							MktoForms2.$('input:checkbox')
								.closest('.mktoFormRow').addClass('form-checkbox').addClass('full-width');
							MktoForms2.$('input:checkbox')
								.parent().parent().find('.mktoLogicalField.mktoCheckboxList.mktoHasWidth').css('width','25px');

							form.onSuccess(function (values, followUpUrl) {
								form.getFormElem().hide();
								// Return false to prevent the submission handler from taking the lead to the follow up url
								window.parent.location = followUpUrl;
								// Return false to prevent the submission handler from taking the lead to the follow up url
								return false;
							});
						});
					});
				</script>
				<div class="home-page-form-success">
					<?php the_sub_field('on_submit_message') ?>
				</div>
			</div>
			<?php the_sub_field('content_bellow_form') ?>
		</div>
	</div>
</div>

</<?php echo $tag ?>>
