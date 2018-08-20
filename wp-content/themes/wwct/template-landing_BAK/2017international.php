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
<style>

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