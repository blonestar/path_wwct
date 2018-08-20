
<<?php echo $tag.$id.$class.$style?>>
    
    <div class="<?php echo $container ?>">
		<div class="row">
		    <div class="col">
                <h1><?php the_sub_field('part_name') ?></h1>
                <?php while (have_rows('countries')) { the_row(); ?>
                    <div class="global-country">
                        <h2><?php the_sub_field('country_name') ?></h2>
                        <ul class="global-country-addresses two-colum  row">
                        <?php while (have_rows('adressess')) { the_row(); ?>
                            <li class="global-country-single-address two-item">
                                <p><strong><?php the_sub_field('location') ?></strong></p>
                                <?php the_sub_field('address') ?>
                            </li>
                        <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
	        </div>
	    </div>
    </div>
	
</<?php echo $tag ?>>
