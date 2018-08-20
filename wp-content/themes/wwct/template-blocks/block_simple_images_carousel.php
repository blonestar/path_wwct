
<<?php echo $tag.$id.$class.$style?>>
	
    <div class="<?php echo $container ?>">
		<div class="row">
            <div class="col">

                <?php the_sub_field('content'); ?>

                <?php $images = get_sub_field('images'); ?>
                <ul class="simple-carousel">
                <?php foreach( $images as $image ): ?>
                    <li class="">
                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                    </li>
                <?php endforeach; ?>
                </ul>

	        </div>
	    </div>
    </div>
    <script>
        jQuery(document).ready(function($){
            $('.simple-carousel').bxSlider({
                minSlides: 1,
                maxSlides: 3,
                slideWidth: 545,
                slideMargin: 10
            });
        })
    </script>
	
</<?php echo $tag ?>>
