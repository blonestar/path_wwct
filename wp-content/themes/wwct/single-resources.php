<?php get_header(); ?>
<?php the_post(); ?>

<article class="main-content">
	<div class="container">
		<div class="row">

			<div class="col-2 col-lg-1 hidden-md-down">
				<?php get_template_part( 'template-parts/tpl-part-share-vertical' ) ?>
			</div>

			<div class="col blog-post">
				<h1><?php the_title() ?></h1>
				

				<div class="author">
					<?php if (get_field('author')) { ?> By <?php echo get_field('author') ?>, <?php } ?><span class="post-date"><?php the_date() ?></span>
				</div>
				<?php the_content() ?>

			</div>


			<?php if (get_field('show_sidebar')) { ?>
			<div class="col-12 col-sm-10 offset-sm-2 col-md-5 offset-md-0 col-lg-3 col-xl-3 ?>">
				<aside>
					<?php get_template_widgets(get_the_ID()) ?>
				</aside>
			</div>
			<?php } ?>

		</div>
	</div>
</article>

<?php echo do_shortcode( '[templateblock id="14543"]' ); ?>

<?php get_footer() ?> 