
<<?php echo $tag.$id.$class.$style?>>
    <div class="<?php echo $container ?>">
		<div class="columns">
			<div class="column">

                <amp-carousel class="hero-carousel" width="800" height="300" layout="responsive" type="slides" autoplay delay="2000">
                <?php
                    while (have_rows('slides')) :
                        the_row(); 
                        $slide_img = get_sub_field('image');
                ?>
                    <div class="slide">
                        <amp-img src="<?php echo $slide_img['url'] ?>" layout="fill" alt="<?php echo $slide_img['alt'] ?>"></amp-img>
                        <amp-fit-text layout="responsive" width="1" height="1">
                        </amp-fit-text>
                    </div>
                <?php
                    endwhile;
                ?>
                </amp-carousel>

			</div>
		</div>
	</div>
</<?php echo $tag ?>>



