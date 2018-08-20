
<<?php echo $tag.$id.$class.$style ?>>

	<div class="container">
		<div class="columns">
			<div class="col-12">
				<?php the_sub_field('content'); ?>
			</div>
		</div>
		<div class="columns">


                    <?php
                        $items = get_sub_field('items');
                        $first_row_count = round( count($items) / 2 );
                        while(have_rows('items')) { the_row(); @$item_count++; ?>
                            <?php if ($item_count == 1 || $item_count == $first_row_count + 1) { ?>
                            <div class="col-12 text-center">
                            <?php } ?>
                                <div class="two-item">
                                    <div class="preli">
                                        <span></span>
                                    </div>
                                    <div class="mainli">
                                        <h3>
                                            <a href='<?php the_sub_field('link') ?>'><?php the_sub_field('label') ?></a>
                                        </h3>
                                        <?php //the_sub_field('content') ?>
                                    </div>
                                </div>
                            <?php if ($item_count == $first_row_count || $item_count == count($items)) { ?>
                            </div>
                            <?php  } ?>
                        <?php } ?>

		</div>
		<?php if (get_sub_field('button_title') && get_sub_field('button_link')) { ?>
		<div class="columns">
			<div class="col-12">
				<?php include "part_button.php"; ?>
			</div>
		</div>
		<?php } ?>
	</div>

</<?php echo $tag ?>>
