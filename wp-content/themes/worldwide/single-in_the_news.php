<?php get_header() ?>
<?php the_post() ?>

<?php
	$main_col_width = 10;

	if (have_rows('widgets')) {
		$main_col_width = 7;
	}

?>

<div class="container-wrapper standard-container-wrapper " style="background-color: <?php echo get_field('background_color') ?>">
	<div class="container">
		<div class="row">
			<div class="col-sm-<?php echo $main_col_width ?> col-sm-offset-1">
				<div class="news-list">
					<div class="newsItemDetail">
						<h1><?php the_title() ?></h1>
						<div class="newsSummary">
							<div class="newsContent">
								<h4><?php the_date('n/d/Y') ?></h4>
								<div class="textContent">
									<?php the_content() ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
			  

<?php get_footer() ?> 