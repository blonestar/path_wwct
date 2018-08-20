<?php get_header(); ?>
<?php the_post(); ?>

<article class="main-content in-the-news">
	<div class="container">
		<div class="row">
			<div class="offset-sm-0 col-sm-12  col-md-12 offset-md-0 col-lg-11 offset-lg-1 col-xl-11 offset-xl-1">
				<h1><?php the_title() ?></h1>
			</div>
		</div>
		<div class="row">

			<div class="col-2 col-lg-1 hidden-md-down">
				<?php get_template_part( 'template-parts/tpl-part-share-vertical' ) ?>
			</div>

			<div class="col">
				<hr class="gray-top">
				<div class="row">
					<div class="col-2">
						<?php echo format_event_date(get_field('event_start_date'),get_field('event_end_date')) ?>
					</div>
					<div class="col">
						<?php the_content() ?>
					</div>
				</div>
			</div>

			<div class="col-10 offset-2 col-md-5 offset-md-0 col-lg-4 col-xl-3">
				<aside>
					<?php dynamic_sidebar( 'sidebar-events' ); ?>
				</aside>
			</div>

		</div>
	</div>
</article>

<?php get_footer() ?> 