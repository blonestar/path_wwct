
<<?php echo $tag.$id.$class.$style?>>
    <div class="<?php echo $container ?>">
        <?php if (get_sub_field('content')) { ?>
		<div class="columns">
		    <div class="column col-12">
                <?php the_sub_field('content') ?>
            </div>
        </div>
        <?php } ?>
		<div class="columns">
            <?php
                $query = new WP_Query(array(
                                    'post_type'			=> 'studies',
                                    'posts_per_page'	=> (get_sub_field('num_studies') > 0) ? get_sub_field('num_studies') : -1, // 3 per page default
                                    //'posts_per_page'	=> -1, // all
                                    'meta_key'			=> 'study_active',
                                    'meta_value'		=> '1'/*
,
                                    'orderby'           => 'date',
                                    'order'             => 'desc'
*/
                                ));
                while($query->have_posts()) {
                    $query->the_post();
            ?>
            <div class="col-4 post-wrapper text-center">

                <?php get_template_part('tpl-part-study-amp'); ?>
                
                
            </div>
            <?php
                } // endwhile
            ?>
        </div>
        <?php if (get_sub_field('button_title') && get_sub_field('button_link')) { ?>
		<div class="columns">
			<div class="column col-12">
				<?php include "part_button.php"; ?>               
			</div>
		</div>
		<?php } ?>       
    </div>

 
</<?php echo $tag ?>>
