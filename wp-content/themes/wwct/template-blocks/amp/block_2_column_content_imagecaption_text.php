
<<?php echo $tag.$id.$class.$style?>>
	<div class="container">
		<div class="columns">
            <div class="column col-12 mb-4 text-center text-md-left">
                <h3><?php the_sub_field('title') ?></h3>
            </div>
        </div>
        <div class="columns">
            <div class="column col-lg-7  col-md-12  mb-4 mb-md-0">
                <div class="vertical-center border p-4 text-center ">
                    <?php echo wp_get_attachment_image( get_sub_field('image'), 'full', null, array( "class" => "mb-2" ) ); ?> 
                    <div class="caption">
                        <?php the_sub_field('image_caption') ?>
                    </div>
                </div>
            </div>
            <div class="column col-lg-5 col-md-12 text-sm-center">
                <div class="block_content vertical-center">
                    <?php the_sub_field('content') ?>
                </div>
            </div>



	    </div>
	</div>
</<?php echo $tag ?>>
