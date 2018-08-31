
<<?php echo $tag.$id.$class.$style?>>
	<div class="container-fluid">
		<div class="columns align-items-center">
            <?php $image = get_sub_field('image'); ?>
            <?php $pos = get_sub_field('image_side'); ?>
            <?php $bgstyle = ' style="background: url('.get_sub_field('image').') center center no-repeat; background-size: cover;"'; ?>
            <?php if ($pos=='left') { ?>
                <div class="column col-sm-12 col-md-6 text-nowrap text-right">
                    <div class="d-table w-100">
                    <div class="d-table-cell">
                        <div class="outer-half-circle-left">
                            <div class="img-circle-left vertical-center"<?php echo $bgstyle ?>></div>
                        </div><div class="center-line"></div>
                    </div>
                    </div>
                </div>
            <?php } ?>
            <div class="column col-sm-12 col-md-6">
                <div class="block-content">
                    <?php the_sub_field('content') ?>
                </div>
            </div>
            <?php if ($pos=='right') { ?>
                <div class="column col-sm-12 col-md-6 text-nowrap text-left">
                    <div class="d-table w-100">
                    <div class="d-table-cell">
                        <div class="center-line"></div><div class="outer-half-circle-right">
                            <div class="img-circle-right vertical-center"<?php echo $bgstyle ?>></div>
                        </div>
                    </div>
                    </div>
                </div>
            <?php } ?>
	    </div>
	</div>
    </<?php echo $tag ?>>
