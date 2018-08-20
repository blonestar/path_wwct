
<<?php echo $tag.$id.$class.$style?>>
	<div class="<?php echo $container ?>">
		<div class="row">
            <div class="col-12 mb-4 text-center text-md-left">
                <h3><?php the_sub_field('title') ?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-7   mb-4 mb-md-0">
                <div class="vertical-center border p-4 text-center ">
                    <?php echo wp_get_attachment_image( get_sub_field('image'), 'full', null, array( "class" => "mb-2" ) ); ?> 
                    <div class="caption">
                        <?php the_sub_field('image_caption') ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-5">
                <div class="block_content vertical-center">
                    <?php the_sub_field('content') ?>
                </div>
            </div>



	    </div>
	</div>
</<?php echo $tag ?>>
<style>
    .block_2_column_content_imagecaption_text .h3 {
        font-size: 24px;
    }
    .block_2_column_content_imagecaption_text .border {
        border-color: #ddd !important;
    }
    .block_2_column_content_imagecaption_text .caption p {
        font-size: 13px;
    }
    .block_2_column_content_imagecaption_text .block_content p {
        font-size: 16px;
        line-height: 32px;
    
    }
</style>