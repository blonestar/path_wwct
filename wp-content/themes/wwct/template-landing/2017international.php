<?php get_header('landing'); ?>
<?php the_post(); ?>


<?php if( get_field('landing_header_image') ){ ?>
<section class="hero hero-form" style="background-image:url(<?php the_field('landing_header_image'); ?>);">
<?php } else { ?>
<section class="hero hero-form">	
<?php } ?>
			
		<div class="row">					
			<div class="hero-image-part col-12 text-center col-md-7 text-white" style="background-image:url(<?php the_field('landing_header_image'); ?>);">				
				<?php if( get_field('header_title') ){ ?>
				<div class="v-cent">
					<?php if (get_field('landing_header_disable_formating')) { ?>

						<?php the_field('header_text') ?>

					<?php } else { ?>
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
					<?php } ?>
				</div>
				<?php } ?>
			</div>
			<?php if (get_field('landing_marketo_id')) { ?>
			<div class="hero-form-part col-12 text-center col-md-5 text-md-left">
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
							//$(".mktoFormRow:lt(4)").addClass('half-row');

							MktoForms2.$('#Website_Comments__c').closest('.mktoFormRow').css('width','100%');
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
				<div class="marketo-form-success" style="display:none;">
					<?php the_field('landing_marketo_on_submit_message') ?>
				</div>
			</div>
			<?php } ?>
		</div>
				
</section>
<style>



/*

@media (min-width: 767px) {
	section.hero .hero-image-part {
		background: none !important;
		background-size: cover;
		background-position: center center;
		background-repeat: no-repeat;
	}
}
@media (max-width: 766px) {
	section.hero .v-cent {
		position: initial;
		transform: initial !important;
		left: initial;
		top: initial;
		width: auto;
	}
	section.hero:before {
		content: none;
	}
	section.hero {
		background: none !important;
		padding: 0;
		margin-top: 20px;
	}
	section.hero .hero-image-part {
		padding: 30px;
	}
	section.hero .hero-form-part {
		background-color: #d1d2d4;
		padding: 30px;
	}
	section.hero .marketo-form form {
		padding-left: 30px !important;
	}
	section.hero .marketo-form form span.mktoButtonWrap.mktoCupidBlue {
		margin-left: 0 !important;
	}
}

/* fix button on IE old * /
@media screen and (-ms-high-contrast: active), (-ms-high-contrast: none), (-ms-accelerator:true) {
	header .show-as-button a, .landing-rfp header .show-as-button #chatstatus a {
	    -webkit-transform: none;
	    -ms-transform: none;
	    transform: none;
	    margin-top: 20px;
   }
}
/* fix button on IE Edge * /
@supports (-ms-ime-align:auto) {
	header .show-as-button a, .landing-rfp header .show-as-button #chatstatus a {
	    -webkit-transform: none;
	    -ms-transform: none;
	    transform: none;
	    margin-top: 20px;
   }
}



*/












/*
.hero-small-form > .container > .row > div[class^="col"]:first-child {
	padding: 30px 0;
	--overflow: auto;
	box-sizing: content-box;
}
.hero-small-form .v-cent ul.two-col {
	margin-top: 1.6em;
}

.hero-small-form .v-cent ul.two-col li {
	margin-bottom: .8em;
	padding-left: 0;
	margin-left: .7em;
}

.border-white {
	font-size: 18px;
	margin: auto auto!important;
}

.hero-small-form .marketo-form-wrapper .marketo-form-before p {
	font-size: 16px;
	color: #FFF;
	text-align: center;
}

.orange-arrow-overlay {
	width: 210px;
	height: 60px;
	--cursor: none;
	background: url('<?php echo get_bloginfo('template_directory'); ?>/img/orange-arrow.png') no-repeat;
	background-size: contain;
	position: absolute;
	right: 108%;
	bottom: -70%;
	z-index: 10000;
	pointer-events: none;
}*/
.mktoLogicalField.mktoCheckboxList.mktoHasWidth {
	width: 22px !important;
}

@media (max-width: 1199px) {
	.hero-small-form .v-cent p {
		margin: 0 0 1.1em;
		font-size: 14px;
	}
	
	.hero-small-form h2 {
		font-size: 36px;
	}

	.hero-small-form h3 {
		font-size: 14px;
	}
	
	.hero-small-form .v-cent ul.two-col li {
		font-size: 14px;
	}

	.phone-as-text span:nth-child(1) {
		margin-top: 7%;
	}

}

@media (max-width: 991px) {

	.phone-as-text a {
	    font-size: 10px;
	}
	
	.phone-as-text span {
		font-size: 18px;
	}
	
	header .show-as-button a {
		padding: 10px 25px;
		font-size: .8rem;
	}
	
	.hero-small-form {
		padding: 3% 5%;
		
	}
	
	.hero-small-form .container {
		width: 100%;
	}
	
	.hero-small-form h2 {
		font-size: 28px;
		padding: 14px 0 14px;
	}

	.hero-small-form h3 {
		font-size: 14px;
	}
	

	.phone-as-text span:nth-child(1) {
		margin-top: 8%;
	}

}

/* form fields to single row */
@media only screen and (min-width: 768px) and (max-width: 900px) and (min-device-width: 768px) and (max-device-width: 900px) {
	.hero-small-form .external_form .mktoFormRow {
		width: 100% !important;
	}
}

@media (max-width: 880px) {
	
	.hero-small-form .v-cent p {
		margin: 0 0 1.1em;
		font-size: 14px;
	}
	
	.hero-small-form h2 {
		font-size: 24px;
	}

	.hero-small-form h3 {
		font-size: 14px;
	}
	
	.hero-small-form .v-cent ul.two-col li {
		font-size: 14px;
	}


	
}

@media (max-width: 840px) {

	.orange-arrow-overlay {
		display: none;
	}
	
}


@media (max-width: 768px) {
	
	header .container {
		width: 650px;
	}
	
	.hero-small-form {
		padding: 2% 0;
	}
	
	.hero-small-form .v-cent p {
		margin: 0 0 .9em;
		font-size: 12px;
	}
	
	.hero-small-form h2 {
		font-size: 20px;
	}

	.hero-small-form h3 {
		font-size: 12px;
	}
	
	.hero-small-form .v-cent ul.two-col {
		margin-top: 0;
	}
	
	.hero-small-form .v-cent ul.two-col li {
		font-size: 12px;
	}
	
	.border-white {
		padding: 1% 10%;
	}
	
	.hero-small-form > .container > .row > div[class^="col"]:first-child {
		padding: 0;
	}
}

@media (max-width: 660px) {
	
	.phone-as-text span {
	    font-size: 15px;
	}	
	
	.phone-as-text span:nth-child(1) {
		font-size: 10px;
	}

	
	header .show-as-button a {
	    padding: 10px;
	    font-size: .6rem;
	}		
}


@media (max-width: 650px) {
	
	header .container {
		width: 100%;
	}
	
}


@media (max-width: 560px) {
	
	.phone-as-text {
		display: block;
		margin-right: 0;
		text-align: right;
	}
	
	.phone-as-text a {
	    font-size: 10px;
	}
	
	header .show-as-button {
		display: none;
	}
	
}

@media (max-width: 400px) {
	
	.phone-as-text {
		display: block;
		margin-right: 0;
		text-align: right;
	}
	
	.phone-as-text a {
	    font-size: 10px;
	}
	
	header .show-as-button {
		display: none;
	}
	
	.phone-as-text a {
	    font-size: 8px;
	}
	
	.phone-as-text span:nth-child(1) {
		display: none;
	}
	
	.phone-as-text span:nth-child(2) {
		margin-top: 8%;
	}
}



@media (min-width: 767px) {
	section.hero .hero-image-part {
		background: none !important;
		background-size: cover;
		background-position: center center;
		background-repeat: no-repeat;
	}
}
@media (max-width: 766px) {
	section.hero .v-cent {
		position: initial;
		transform: initial !important;
		left: initial;
		top: initial;
		width: auto;
	}
	section.hero:before {
		content: none;
	}
	section.hero {
		background: none !important;
		padding: 0;
		margin-top: 20px;
	}
	section.hero .hero-image-part {
		padding: 30px;
	}
	section.hero .hero-form-part {
		background-color: #d1d2d4;
		padding: 30px;
	}
	section.hero .marketo-form form {
		padding-left: 30px !important;
	}
	section.hero .marketo-form form span.mktoButtonWrap.mktoCupidBlue {
		margin-left: 0 !important;
	}
}

/* fix button on IE old */
@media screen and (-ms-high-contrast: active), (-ms-high-contrast: none), (-ms-accelerator:true) {
	header .show-as-button a, .landing-rfp header .show-as-button #chatstatus a {
	    -webkit-transform: none;
	    -ms-transform: none;
	    transform: none;
	    margin-top: 20px;
   }
}
/* fix button on IE Edge */
@supports (-ms-ime-align:auto) {
	header .show-as-button a, .landing-rfp header .show-as-button #chatstatus a {
	    -webkit-transform: none;
	    -ms-transform: none;
	    transform: none;
	    margin-top: 20px;
   }
}






/* bojan */
.mktoFormRow.full-width {
	width: 100% !important;
}
.mktoFormRow.form-checkbox.full-width .mktoLabel {
	display: inline-block !important;
	width: 86% !important;
	float: none;
}
.mktoFormRow.form-checkbox.full-width input[type=checkbox] + label:before,
.mktoFormRow.form-checkbox.full-width input[type=radio] + label:before {
	--margin-left: 0;
	--top: 4px;
}


</style>

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