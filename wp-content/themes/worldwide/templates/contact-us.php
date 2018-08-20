<?php 
/*
 * Template Name: Contact Us
 */
get_header() ?>
<?php the_post() ?>

<?php
	$main_col_width = 8;

	if (have_rows('widgets')) {
		$main_col_width = 6;
	}

	if (get_the_content() != "") {
?>
<div class="container-wrapper standard-container-wrapper " style="background-color: <?php echo get_field('background_color') ?>">
	<div class="container">
		<div class="row">
			<div class="col-sm-<?php echo $main_col_width ?> col-sm-offset-2">
				<?php the_content() ?>
				
				
				
				
<div class="contact-us-webpart">

<?php

//get_field('info_option_label');
$select_items = get_field('contact_menu_item');
while(have_rows('contact_menu_item')) { the_row();
	$options[] = array(sanitize_title(get_sub_field('label')), get_sub_field('label'));
}



?>
    <select class="contact-options">
		<option value="" disabled="disabled" selected="selected"><?php echo get_field('info_option_label') ?></option>
		<?php foreach($options as $option) { ?>
		<option value="<?php echo $option[0] ?>"><?php echo $option[1] ?></option>
		<?php } ?>
	</select>
	
	<?php
		$i = 0;
		while(have_rows('contact_menu_item')) { the_row();
	?>
    
        <?php if (get_sub_field('type') == 'text') { ?>
		
				<div class="<?php echo $options[$i][0] ?> contact-text" style="display: none">
				<?php the_sub_field('text'); ?>
				</div>
			
		<?php } else if (get_sub_field('type') == 'form') { ?>
		
		        <div class="<?php if (get_sub_field('two_column_form')) echo 'two-rows-form ' ?><?php echo $options[$i][0] ?>" style="display: none">
					<div class="<?php echo $options[$i][0] ?>-form">
					  <div id="mktoForm_<?php the_sub_field('form_id') ?>" class="marketo-form"></div>
					</div>
					<script>
						MktoForms2.loadForm("//app-ab07.marketo.com", "935-DOM-994", <?php the_sub_field('form_id') ?>, function (form) {
							MktoForms2.$("#mktoForm_<?php the_sub_field('form_id') ?>").append(form.getFormElem());
								form.onSuccess(function (values, followUpUrl) {
									form.getFormElem().hide();
									window.parent.location = followUpUrl;
									return false;
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
<div style="clear: both;"></div>







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
<?php //wp_reset_query() ?>
	
<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer() ?>