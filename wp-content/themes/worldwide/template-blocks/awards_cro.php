<div class="container-wrapper white-container-wrapper content-block-3">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<h2><?php the_sub_field('title') ?></h2>
				<?php the_sub_field('content') ?>
			</div>
			<?php
				while (have_rows('columns')) {
					the_row();
					$img = get_sub_field('image');
					//print_r($img);
					$column_class = get_sub_field('column_class');
					if (trim($column_class) == '')
						$column_class = 'col-md-4 col-sm-4 col-xs-4 text-center'
			?> 
			<div class="<?php echo $column_class ?>">
				<div class="text-center float-left">
					<img alt="<?php echo $img['alt'] ?>" src="<?php echo $img['url'] ?>" />
					<h5><?php the_sub_field('label') ?></h5>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>