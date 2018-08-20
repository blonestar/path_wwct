<?php get_header('landing'); ?>
<?php the_post(); ?>


<?php if( get_field('landing_header_image') ){ ?>
<section class="hero" style="background-image:url(<?php the_field('landing_header_image'); ?>);">
<?php } else { ?>
<section class="hero">	
<?php } ?>
			
		<div class="row h-100">					
			<div class="col-12 text-center text-white h-100">	
			
				<div class="hero-lines hero-white-border text-center text-white">			
					<div class="hero-content">
					<div class="hv-cent">
						<?php the_field('header_text') ?>
					</div>
					</div>
				</div>
			</div>
		</div>
				
</section>
<style>

@media (max-width: 920px) {
	section.hero * {
		font-size: 112% !important;
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
	section.hero * {
		font-size: 110% !important;
	}
	section.hero .v-cent {
		position: initial;
		transform: initial !important;
		left: initial;
		top: initial;
		width: auto;
	}
	
}
@media (max-width: 576px) {
	section.hero {
		margin-top: 20px;
	}

}
</style>

<section class="main-content">
	<div class="container">
		<div class="row">
			<div class="col">
				<?php the_content() ?>
			</div>
        </div>
    </div>
</section>

<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer('landing'); ?>