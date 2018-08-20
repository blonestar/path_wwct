<?php
/*
 * Template Name: Resources - Assays
 */
get_header();
the_post();
?>
<?php
	$main_col_width = 10;
	if (have_rows('widgets')) {
		$main_col_width = 7;
	}
	
?>
<section class="main-content">
	<div class="container">
		<div class="row">
			<div class="col">

				<?php 
					$query = new WP_Query(array(
								'post_type'			=> 'assays',
								'posts_per_page'	=> -1,
								'orderby'			=> 'name',
								'order'				=> 'asc'
							));
					if ( $query->have_posts() ) :
				?>


						<table id="assays" class="display">
							<thead>
								<tr>
									<th>Analyte Name</th>
									<th>LLOQ</th>
									<th>ULOQ</th>
									<th>Units</th>
									<th>Species</th>
									<th>Matrix</th>
									<th>Status</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Analyte Name</th>
									<th>LLOQ</th>
									<th>ULOQ</th>
									<th>Units</th>
									<th>Species</th>
									<th>Matrix</th>
									<th>Status</th>
								</tr>
							</tfoot>
						</table>

				<?php 
					endif;
				?>

			</div>
		</div>
	</div>
</section>
			
	
<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>
<?php //if (isset($_GET['keyword']) && $_GET['keyword'] == 'ALL') { ?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css"> 
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>
<script>
	jQuery(document).ready(function($){
		$('#assays').DataTable({
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			ajax: {
				url: '<?php echo admin_url('admin-ajax.php?action=assays_ajax_search') ?>',
				dataSrc: '',
			},
				columns: [
					{ data: 'name' },
					{ data: 'lloq' },
					{ data: 'uloq' },
					{ data: 'units' },
					{ data: 'species' },
					{ data: 'matrix' },
					{ data: 'status' }
				]
		});
	});
</script>
<style>
.sorting_1 > p {
    white-space: nowrap;
}
</style>
<?php //} ?>

<?php get_footer() ?>