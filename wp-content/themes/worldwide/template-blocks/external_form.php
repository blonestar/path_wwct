<?php
$class_width = 'col-sm-12';
if (get_sub_field('width') == 'col12')
	$class_width = 'col-sm-12';
if (get_sub_field('width') == 'col10')
	$class_width = 'col-sm-10 col-sm-offset-1';
if (get_sub_field('width') == 'col8')
	$class_width = 'col-sm-8 col-sm-offset-2';
?>
<div class="container-wrapper standard-container-wrapper home-form">
	<div class="container">
		<div class="row">
			<div>
				<div class="<?php echo $class_width ?>">
				
					<h2 class="blue text-center"><?php echo get_sub_field('title') ?></h2>
					
					<?php the_sub_field('subtitle') ?>
					
					<div class="home-page-form">
						<div id="mktoForm_<?php echo get_sub_field('form_id') ?>" class="home-page-form"></div>
						<script>
							MktoForms2.loadForm("//app-ab07.marketo.com", "935-DOM-994", <?php echo get_sub_field('form_id') ?>, function (form) {
								MktoForms2.$("#mktoForm_<?php echo get_sub_field('form_id') ?>").append(form.getFormElem());
								form.onSuccess(function (values, followUpUrl) {
									form.getFormElem().hide();
									// Return false to prevent the submission handler from taking the lead to the follow up url
									window.parent.location = followUpUrl;
									// Return false to prevent the submission handler from taking the lead to the follow up url
									return false;
								});
							});
						</script>
						<div class="home-page-form-success">
							<?php the_sub_field('on_submit_message') ?>
						</div>
					</div>
					
				</div>
				<div style="clear: both;"></div>
			</div>
		</div>
	</div>
</div>