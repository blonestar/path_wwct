<?php 
/*
 * Template name: Awards
 */
get_header(); 
the_post();
?>

<section class="main-content">
	<div class="container">
		<div class="row">

			<?php if (get_field('show_sidebar') && get_field('sidebar_side') == 'left' && have_rows('template_widgets')) { ?>
			<div class="col-md-<?php the_field('sidebar_column_width') ?> col-sm-12">
				<aside> 
					<?php get_template_widgets(get_the_ID()) ?>
				</aside>
			</div>
			<?php } ?>

        	<div class="col">
                <div class="row">
                    <div class="col awards-head">
                        <p>MOST RECENT AWARDS</p>
                    </div>
                    <div class="col awards-head text-right">
                        <p>2017 &#38; 2018</p>
                    </div>
                </div>
				
                <?php
                    $from_year = 2017;
                    $awards_query = new WP_Query( array(
                            'post_type'     => 'awards',
                            'orderby'       => 'date',
                            'order'         => 'desc',
                            //'year'          => $year
                            'date_query' => array(
                                array(
                                    'year'  => $from_year,
                                    'compare'   => '>=',
                                )
                            )
                        ) );
                    
                ?>
                <?php while ($awards_query->have_posts()) { $awards_query->the_post(); ?>
                <article class="award-box-horizontal">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="award-box-image h-100">
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'vertical-center')) ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            <div class="award-box-content">
                                <h1><?php the_title() ?></h1>
                                <?php the_content() ?>
                            </div>
                        </div>
                    </div>
                </article>
                <?php } ?>
                <?php wp_reset_query(); ?>


			</div>

			<?php if (get_field('show_sidebar') && get_field('sidebar_side') == 'right' && have_rows('template_widgets')) { ?>
			<div class="col-md-<?php the_field('sidebar_column_width') ?> col-sm-12">
				<aside>
					<?php get_template_widgets(get_the_ID()) ?>
				</aside>
			</div>
			<?php } ?>
			
		</div>
	</div>
</section>

<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer() ?> 