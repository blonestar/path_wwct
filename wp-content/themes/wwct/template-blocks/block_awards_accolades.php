
<<?php echo $tag.$id.$class.$style?>>
	
    <div class="<?php echo $container ?>">
		<div class="row">
		    <div class="col awards-head">
                <p><?php the_sub_field('text_left') ?></p>
            </div>
		    <div class="col awards-head text-right">
                <p><?php the_sub_field('text_right') ?></p>
            </div>
        </div>
		<div class="row">

            <?php
                $from_year = (get_sub_field('from_year')) ? get_sub_field('from_year') : (date('Y')-1);
                $to_year = (get_sub_field('to_year')) ? get_sub_field('to_year') : (date('Y'));
                $awards_query = new WP_Query( array(
                    'post_type' => 'awards',
                    'orderby'   => 'date',
                    'order'     => 'desc',
                    'posts_per_page'     => -1,
                    'date_query' => array(
                        array(
                            'year'  => $from_year,
                            'compare'   => '>=',
                        ),
                        array(
                            'year'  => $to_year,
                            'compare'   => '<=',
                        ),
                    )
                ) );
            ?>

            <?php while ($awards_query->have_posts()) { $awards_query->the_post(); ?>
                <div class="col-12 col-xs-12 col-sm-6 col-lg-4">
                    <article class="award-box-vertical">
                        <div class="award-box-border">
                            <header>
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'full') ?>
                            </header>
                            <div class="award-box-content">
                                <h1><?php the_title() ?></h1>
                                <?php the_content() ?>
                            </div>
                        </div>
                    </article>
                </div>
            <?php } ?>

	    </div>
    </div>
	
</<?php echo $tag ?>>
