
<<?php echo $tag.$id.$class.$style?>>
	<div class="<?php echo $container ?>">
		<div class="row align-items-center">
            <?php $image = get_sub_field('image'); ?>
            <?php $pos = get_sub_field('image_side'); ?>
            <?php $bgstyle = ' style="background: url('.get_sub_field('image').') center center no-repeat; background-size: cover;"'; ?>
            <?php if ($pos=='left') { ?>
                <div class="col-12 col-sm-12 col-md-6 text-nowrap text-right">
                    <div class="d-table w-100">
                    <div class="d-table-cell">
                        <div class="outer-half-circle-left">
                            <div class="img-circle-left vertical-center"<?php echo $bgstyle ?>></div>
                        </div><div class="center-line"></div>
                    </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-12 col-sm-12 col-md-6">
                <div class="block-content">
                    <?php the_sub_field('content') ?>
                </div>
            </div>
            <?php if ($pos=='right') { ?>
                <div class="col-12 col-sm-12 col-md-6 text-nowrap text-left">
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
    <style>
.outer-half-circle-right {
    width: 16vw;
    height: 32vw;
    border-top-left-radius: 100% 50%;
    border-bottom-left-radius: 100% 50%;
    border: 2px solid #00527d;
    border-right: 0;
    --padding: 25px;
   --margin-right: 167px;
    
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    position: relative;
    display: inline-block;
    vertical-align: middle;
}
.outer-half-circle-left {
    width: 16vw;
    height: 32vw;
    border-top-right-radius: 100% 50%;
    border-bottom-right-radius: 100% 50%;
    border: 2px solid #00527d;
    border-left: 0;
    --padding: 25px;
    --margin-left: 167px;
    
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    position: relative;
    display: inline-block;
    vertical-align: middle;
}
.img-circle {
    width: 250%;
    height: 100%;
}
.img-circle-left {
    position: absolute;
    width: 28vw;
    top: 50%;
    border-radius: 50%;
    right: 2vw;
    height: 28vw;
    transform: translateY(-50%);
}
.img-circle-right {
    position: absolute;
    width: 28vw;
    top: 50%;
    border-radius: 50%;
    left: 2vw;
    height: 28vw;
    transform: translateY(-50%);
}
.center-line {
    border-top: 1px solid #00527d;
    border-bottom: 1px solid #00527d;
    height: 2px;
    width: 33%;
    display: inline-block;
    vertical-align: middle;
}
</style>