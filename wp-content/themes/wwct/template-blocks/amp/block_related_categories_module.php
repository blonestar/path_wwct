
<<?php echo $tag.$id.$class.$style?>>
	<div class="<?php echo $container ?>">
		<div class="columns">
            <?php if (trim(get_sub_field('content')) != '') { ?>
            <div class="col-4 mb-12">

                <?php the_sub_field('content') ?>
                
            </div>
            <?php } ?>
	    </div>
		<div class="columns">
            <?php
                $columns_count = count(get_sub_field('columns'));
                $lg = (12 / $columns_count);
                $md = ($columns_count == 4) ? 6 : (12 / $columns_count);

                if( have_rows('columns') ):
                    
                    while ( have_rows('columns') ) : the_row();
                        $link_title = get_sub_field('title');
                        $link_url = get_sub_field('category');
                        $link = get_sub_field('link');
                        if (!$link_title)
                            $link_title = $link['title'];
                ?>

                    <div class="column col-sm-12 col-md-<?php echo $md ?> col-lg-<?php echo $lg ?> my-2 my-md-3 my-lg-0">
                        <?php if ($link) { ?>
                        <a class="column-block h-100" href="<?php echo $link['url'] ?>">
                        <?php } else { ?>
                        <div class="column-block h-100">
                        <?php } ?>
                        <div class="column-block-inner position-relative text-center text-white" style="background-image: url(<?php the_sub_field('image') ?>);">
                            <amp-fit-text width="1" height="0.5" layout="responsive">
                                <h3 class="column_title"><?php echo $link_title ?></h3>
                                <h5 class="column_category"><?php the_sub_field('category') ?></h5>
                            </amp-fit-text>
                        </div>

                        <?php if ($link) { ?>
                        </a>
                        <?php } else { ?>
                        </div>
                        <?php } ?>
                    </div>
            <?php
                    endwhile;
                endif;    

            ?>

	    </div>
	</div>
</<?php echo $tag ?>>
