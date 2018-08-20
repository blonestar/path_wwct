<?php get_header(); ?>
<?php the_post(); ?>

<!--<section class="hero">
	<div class="container">
		<div class="row h-300">
			<div class="col h-300" style="background: url(<?php echo get_template_directory_uri() ?>/img/content/hero-00.jpg) no-repeat center center; background-size: cover;">
				<div class="hero-white-border text-center text-white">
					<div class="my-auto">
						<h1>THE CURE FOR THE COMMON CRO</h1>
						<h6>challenging everything you expected from CROs - in the best possible way.</h6>
						<a href="#" class="btn">LEARN MORE</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>-->

<?php if (get_the_content()) { ?>
<section class="main-content">
	<div class="container">
		<div class="row">
			<div class="col">
				<?php the_content() ?>
			</div>
		</div>
	</div>
</section>
<?php } ?>

<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer() ?> 