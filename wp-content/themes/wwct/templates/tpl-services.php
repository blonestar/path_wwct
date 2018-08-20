<?php
/*
 * Template name: Services Page
 */
get_header();
the_post();

global $post;
$parents = get_post_ancestors( get_the_ID() );
$id = ($parents) ? $parents[count($parents)-1]: get_the_ID();
$parent = get_post( $id );
$parent->post_name;

$children = wp_list_pages( array(
    'title_li' => '',
    'child_of' => $parent->ID,
    'echo'     => 0
) );

 
?>
<?php if ( ! empty_content($post->post_content)) { ?>
<section class="main-content">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-7 push-sm-5 col-md-8 push-md-4 main-page-content">
				<?php the_content() ?>
			</div>
			<div class="col-12 col-sm-5 pull-sm-7 col-md-4 pull-md-8">
				<aside>
					<div class="widget as-accord-holder">
						<h2><a href="<?php echo get_permalink($parent->ID) ?>"><?php echo $parent->post_title ?></a></h2>
						<?php if ( $children ) : ?>
							<ul class="as-accord">
								<?php echo $children; ?>
							</ul>
						<?php endif; ?>
						<?php if (get_field('contact_page_link','options')) : ?>
						<div class="btn-holder">
							<a class="btn" href="<?php the_field('contact_page_link','options') ?>"><?php the_field('contact_page_button_text','options') ?></a>
						</div>
						<?php endif; ?>
					</div>
					<?php if (get_field('assay_method_widget_button_url','options')) : ?>
					<div class="widget assay-widget widget_green_with_button_widget widget_green_box text-center">
						<h2 class="widgettitle"><?php the_field('assay_method_widget_title','options') ?></h2>
						<div class="widget-content">
							<?php the_field('assay_method_widget_description','options') ?>						
								<a href="<?php the_field('assay_method_widget_button_url','options') ?>" class="btn btn-outline btn-white">
									<?php the_field('assay_method_widget_button_text','options') ?>
								</a>						
						</div>
					</div>
					<?php endif; ?>		
				</aside>
			</div>

		</div>
	</div>
</section>
<?php } ?>

<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer() ?> 
