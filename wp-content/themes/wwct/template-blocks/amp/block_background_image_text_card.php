
<<?php echo $tag.$id.$class.$style?>>
    <div class="<?php echo $container ?>">
		<div class="columns<?php echo $no_gutters ?>">
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
                <div class="column col-12">
                    <div class="position-relative block-background-image-<?php the_sub_field('card_position') ?>"<?php echo $style ?>>
                        <div class="block_card block_card_inner <?php echo $block_card_class ?>"<?php echo $card_style ?>>
                            <h3><?php the_sub_field('title') ?></h3>
                            <?php the_sub_field('content') ?>
                            <?php if (get_sub_field('button_title') && get_sub_field('button_link')) { ?>
                                <?php include "part_button.php"; ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="column col-12 block_card_flat_wrapper">
                    <div class="block_card block_card_flat <?php echo $block_card_class ?>">
                        <h3><?php the_sub_field('title') ?></h3>
                        <?php the_sub_field('content') ?>
                        <?php if (get_sub_field('button_title') && get_sub_field('button_link')) { ?>
                            <?php include "part_button.php"; ?>
                        <?php } ?>
                    </div>
                </div>
            <?php } else if ($type == 'middle') { ?>
            <div class="column col-12">
                <div class="position-relative block-background-image-middle text-center"<?php echo $style ?>>
                    <h3><?php the_sub_field('title') ?></h3>
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
            <div class="column col-12 block_card_flat_wrapper text-center">
                <h3><?php the_sub_field('title') ?></h3>
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