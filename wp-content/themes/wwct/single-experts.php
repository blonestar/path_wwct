<?php get_header() ?>
<?php the_post() ?>

<article>
	<div class="container">
		<?php /*
		<div class="row">
			<div class="col">
				<div class="back-link">
					<a href="<?php echo site_url('about-us/meet-the-experts') ?>"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back to Experts</a>
				</div>
			</div>
		</div>
		*/ ?>
		<div class="row leadership-member-detail">
			<div class="col-md-12 offset-md-0 col-lg-8 offset-lg-2">
				<div class="expert-outline-box">
					<div class="expert-content text-center">
						<h3>Have specific questions?</h3>
						<h2>Talk with Expert</h2>
						<h1><?php the_title() ?></h1>
						<p class="leadership-title"><?php the_field('position') ?></p>
						<?php /*
						<div class="expert-buttons row">
						<div class="col-6">
								<a href="#" class="btn"><span>Ask a Question</span></a>
								</div>
							<div class="col-6">
								<a href="#" class="btn"><span>Schedule a Consultation</span></a>
								</div>
								</div>
								*/ ?>
						
						<a href="<?php echo site_url('about-us/meet-the-experts/') ?>">Meet All Worldwide's Experts</a>
					</div>
					<?php the_post_thumbnail()?>
				</div>
				
				<?php /*
				<div class="widget widget_green_box text-center">
					<h2>GET IN TOUCH</h2>
					<div class="widget-content">
						See what Worldwide Clinical Trials can do for you.
						<div>
							<a href="http://pthdev.com/worldwide.com/contact-us/" class="btn btn-outline">Contact Us</a>
						</div>
					</div>
				</div>
				*/ ?>
			</div>

		</div>
		<div class="row leadership-member-description">
			<div class="col-md-12 offset-md-0 col-lg-8 offset-lg-2">
				<?php the_content() ?>
			</div>
		</div>
		
	</div>
</article>


<section class="experts-form external_form single-experts">

	<div class="container">
		<div class="row">
			<div class="col-8 offset-2">
				<div>
					<?php //echo do_shortcode( '[gravityform id=5 title=false description=false ajax=true]' ); ?>

					

					<form id="mktoForm_<?php echo get_field('experts_marketo_form_id', 'option') ?>" class="mktoForm home-page-form"></form>
					<script>
						loadAsync('//app-ab07.marketo.com/js/forms2/js/forms2.min.js' , function(){
							MktoForms2.loadForm("//app-ab07.marketo.com", "935-DOM-994", <?php echo get_field('experts_marketo_form_id', 'option') ?>, function (form) {
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
			</div>
		</div>
	</div>

</section>





<?php

/* 
	$main_col_width = 10;
	if (have_rows('widgets')) {
		$main_col_width = 7;
	}
	
		
	$terms_arr = get_terms( array(
		'taxonomy' => 'team_members_tax',
		'hide_empty' => false,
		'posts_per_page' => -1,
		'orderby'	=> 'menu_order',
		'order'	=> 'asc'
	) );
	/* sort taxonomies by tax_order field * /
	$count = count($terms_arr);	for ($i=0; $i<$count; $i++) {
		$terms_arr[$i]->sort_order = get_field('tax_order', 'team_members_tax_'.$terms_arr[$i]->term_id);
	}
	usort($terms_arr, 'worldwide_sort_terms_function');		
	
	
?>


<?php

//print_r($terms_arr);
$i = 0;
foreach($terms_arr as $term_arr) {

	$query = new WP_Query(array(
					'post_type' => 'team_members',
					'orderby'	=> 'menu_order',
					'order'		=> 'asc',
					'posts_per_page'	=> -1,
					'tax_query' => array(
									array(
										'taxonomy' => 'team_members_tax',
										'field' => 'term_id',
										'terms' => $term_arr->term_id
										)
									)
				));
	if ( $query->have_posts() ) {
	?>
	<section class="team-members">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<h2><?php echo $term_arr->name ?></h2>
					<br>
				</div>
				<?php
				
				while ( $query->have_posts() ) {
					$query->the_post();	?>
		
				<?php if($i==0): ?>
				<div class="col-xs-6 col-sm-4 col-md-4 leadership-member-summary">
				<?php else: ?>
				<div class="col-xs-6 col-sm-3 col-md-3 leadership-member-summary">
				<?php endif; ?>
				
					<a href="<?php the_permalink() ?>">
						<div class="leadership-image">
							<?php the_post_thumbnail() ?>
						</div>
						<div class="leadership-name">
							<h2><?php the_title() ?></h2>
						</div>
						<div class="leadership-title"><?php the_field('position') ?></div>
					</a>
				</div>
				
				<?php } ?>
			</div>
		</div>
	</section>
<?php 
	}
	$i++;
}
*/
wp_reset_postdata();
?>


<?php get_footer() ?> 