
<<?php echo $tag.$id.$class.$style?>>
    <div class="<?php echo $container ?>">
		<div class="row<?php echo $no_gutters ?>">
            <?php
                //$m=microtime(true);
                //sprintf("%8x%05x\n",floor($m),($m-floor($m))*1000000);
                $type = get_sub_field('card_type');
                $block_card_class = uniqid('block_card_inner_');

                

                $style = '';
                $block_bg_image = get_sub_field('block_background_image');
                if ($block_bg_image) {
                    $style = ' style="background-image: url('.$block_bg_image.')"';
                }
            ?>
            <?php
                $hex = get_sub_field('card_color');
                $opacity = get_sub_field('card_opacity');
                list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
                $card_style = " style=\"background-color: rgba($r,$g,$b,".($opacity/100).")\"";

            ?>
            <?php if ($type == 'side') { ?>
                <div class="col-12">
                    <div class="position-relative block-background-image-<?php the_sub_field('card_position') ?>"<?php echo $style ?>>
                        <div class="block_card block_card_inner <?php echo $block_card_class ?>"<?php echo $card_style ?>>
                            <h4><?php the_sub_field('title') ?></h4>
                            <?php the_sub_field('content') ?>
                            <?php if (get_sub_field('button_title') && get_sub_field('button_link')) { ?>
                                <?php include "part_button.php"; ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 block_card_flat_wrapper">
                    <div class="block_card block_card_flat <?php echo $block_card_class ?>">
                        <h4><?php the_sub_field('title') ?></h4>
                        <?php the_sub_field('content') ?>
                        <?php if (get_sub_field('button_title') && get_sub_field('button_link')) { ?>
                            <?php include "part_button.php"; ?>
                        <?php } ?>
                    </div>
                </div>
            <?php } else if ($type == 'middle') { ?>
            <div class="col-12">
                <div class="position-relative block-background-image-middle text-center"<?php echo $style ?>>
                    <h4><?php the_sub_field('title') ?></h4>
                    <br>
                    <br>
                    <div class="block_card block_card_inner <?php echo $block_card_class ?>"<?php echo $card_style ?>>
                        <?php the_sub_field('content') ?>
                    </div>
                    <br>
                    <br>
                    <?php if (get_sub_field('button_title') && get_sub_field('button_link')) { ?>
                        <?php include "part_button.php"; ?>
                    <?php } ?>
                </div>
            </div>
            <div class="col-12 block_card_flat_wrapper">
                <h4><?php the_sub_field('title') ?></h4>
                <br>
                <div class="block_card block_card_flat <?php echo $block_card_class ?>">
                    <?php the_sub_field('content') ?>
                </div>
                <br>
                <?php if (get_sub_field('button_title') && get_sub_field('button_link')) { ?>
                    <?php include "part_button.php"; ?>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
        
	</div>
</<?php echo $tag ?>>
<style>
    .block_background_image_text_card .block_card_flat_wrapper {
        display:none;
    }
    .block_background_image_text_card .block_card {
        
        padding: 20px;
    }
    .block_background_image_text_card .block-background-image-right {
        padding: 10% 10% 10% 50%;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
    }
    .block_background_image_text_card .block-background-image-left {
        padding: 10% 50% 10% 10%;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
    }
    .block_background_image_text_card .block-background-image-middle {
        padding: 10%;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
    }
    .block_background_image_text_card .block_card * {
        color: <?php the_sub_field('text_color') ?>;
    }
    @media (max-width: 990px) {
        .block_background_image_text_card .block_card_inner * {
            font-size: 90%;
        }

    }
    @media (max-width: 768px) {
        .block_background_image_text_card .block-background-image-left,
        .block_background_image_text_card .block-background-image-right,
        .block_background_image_text_card .block-background-image-middle {
            min-height: 300px;
            display:none;
        }

        .block_background_image_text_card .block_card_flat_wrapper {
            display: block;
        }
        .block_background_image_text_card .block_card_flat.<?php echo $block_card_class ?> {
            margin: 0;
            background-color: rgb(<?php echo "$r,$g,$b" ?>);
        }
    }
</style>