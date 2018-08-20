<div class="container-wrapper light-container-wrapper content-block-4">
	<div class="container">
		<div class="row">

			<h2 style="text-align: center;"><?php the_sub_field('title') ?></h2>
			<div>
				<?php the_sub_field('content') ?>
				<br>
				<div class="container">
					<div class="row">

						<?php
							while (have_rows('columns')) {
								the_row();
								$img = get_sub_field('image');
								//print_r($img);
								$column_class = get_sub_field('column_class');
								if (trim($column_class) == '')
									$column_class = 'col-md-3 col-sm-3 col-xs-6 text-center'
						?> 
						<div class="<?php echo $column_class ?>">
							<img alt="<?php echo $img['alt'] ?>" src="<?php echo $img['url'] ?>" />
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>