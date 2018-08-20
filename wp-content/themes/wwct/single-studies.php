<?php get_header() ?>
<?php the_post() ?>

<?php

$form_parameters = array(
	'id'				=> get_the_ID(),
	'studyName'	=> get_the_title(),
);
$form_parameters_query = http_build_query($form_parameters);

/*
// TODO move outside
// navigation part below hero
$parent = get_page_by_path('participate-in-a-study');
$children = wp_list_pages( array(
    'title_li' 				=> '',
    'child_of' 				=> $parent->ID,
    'echo'     				=> 0,
	'depth'					=> 1,
	'exclude'				=> '8424', // join-a-study page
	'item_spacing'   		=> 'discard',
	'walker'				=> new Walker_Page_study() // what menus should be selected
) );
?>
<nav class="hero-menu">
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<?php if ( $children ) : ?>
					<ul>
						<li<?php echo ($parent->ID == get_the_ID()) ? ' class="current_page_item"' : ''?>><a href="<?php the_permalink($parent->ID) ?>"><?php echo $parent->post_title ?></a></li><?php echo $children; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>
</nav>
<?php
// end navigation
*/

get_template_part( 'template-parts/tpl-part-mid-page-submenu' );

?>


<section class="main-study">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12">

				<?php get_template_part('tpl-part-study'); ?>


			</div>
			<div class="col-lg-8 col-md-8 col-sm-12">

				<?php echo do_shortcode( '[gravityforms id="4" field_values="'.$form_parameters_query.'"]') ?>

			</div>
		</div>
	</div>
</section>

<?php if( have_rows('template_blocks', $page_id) ): ?>
		<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<div id="overlay-calc" style="display: none">
	<div class="overlay-calc-in">
		<div class="bmi-calc stand-active">
			<span class="close-bmi">Close <i class="fa fa-times" aria-hidden="true"></i></span>
				<h2>What's your BMI?</h2>
				<div class="as-radio">
					<div class="as-radio-item active"><span></span> Standard</div>
					<div class="as-radio-item"><span></span> Metric</div>
				</div>
			<div class="as-form">
				<label>weight</label>
				<div id="bmi-weight" class="input-wrap">
					<input type="number" min="20" max="300">
					<span class="stand">LB</span>
					<span class="metric">Kg</span>
				</div>
				<label>height</label>
				<div id="bmi-height" class="input-wrap">
					<input type="number" min="100" max="260">
					<span class="stand">FT</span>
					<span class="metric">cm</span>
				</div>
				<div id="bmi-height-2" class="input-wrap stand">
					<input type="number" min="0" max="500">
					<span>IN</span>
				</div>
			</div>
			<div id="bmi-result">
				<div class="bmi-result-in">
					<p>Your BMI is</p>
					<p id="xl-bmi">22</p>
					<p id="strong-bmi"><span>Normal</span> BMI</p>
					<span id="bmi-done" class="btn">Done</span>
				</div>
			</div>
			
		</div>			
	</div>
</div>
	

<div class="modal fade" id="sharestudyform" tabindex="-1" role="dialog" aria-labelledby="Share with friend" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="studyModalLabel">Share with friend</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<?php echo do_shortcode( '[gravityform id="6" title="false" description="false" ajax="true"]' ) ?>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		</div>
		</div>
	</div>
</div>
<script>
jQuery(document).ready(function($){
	//var form_content = [];
	var form_html = $("#sharestudyform").find(".modal-body").html();
	$('#sharestudyform').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
		var studyid = button.data('studyid'); // Extract info from data-* attributes
		var studytitle = button.data('studytitle'); // Extract info from data-* attributes
		var studyurl = button.data('studyurl'); // Extract info from data-* attributes
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this);
		modal.find('.modal-body').html(form_html);
		modal.find('.modal-title').text('Share Study "'+studytitle+'" with Your Friend');
		modal.find('#input_6_10').val(studyid);
		modal.find('#input_6_11').val(studytitle);
		modal.find('#input_6_12').val(studyurl);
	});
});
</script>

<?php get_footer() ?> 