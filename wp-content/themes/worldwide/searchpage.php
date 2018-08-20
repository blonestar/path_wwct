<?php
/*
 * Template Name: Search results
 */
get_header();
the_post();



$s = esc_html($_GET['s']);
query_posts("s=$s");
/*
var_dump(is_search());

global $query_string;

$query_args = explode("&", $query_string);
$search_query = array();

if( strlen($query_string) > 0 ) {
	foreach($query_args as $key => $string) {
		$query_split = explode("=", $string);
		$search_query[$query_split[0]] = urldecode($query_split[1]);
	} // foreach
} //if

$search_query = new WP_Query($search_query);
*/


$search_query = new WP_Query(array('s' => $_GET['s'], 'posts_per_page' => -1));
$total_results = $search_query->found_posts;



$main_col_width = 12;
if (have_rows('widgets')) {
	$main_col_width = 8;
}

	

?>

<div class="container-wrapper standard-container-wrapper ">
	<div class="container">
		<div class="row">
			<div>
				<div class="col-sm-10 col-sm-offset-1">
					<form id="" class="searchBox" onkeypress="" action="<?php echo site_url('search-results') ?>">

						<label for="p_lt_ctl05_pageplaceholder_p_lt_ctl00_RowLayout_Bootstrap_RowLayout_Bootstrap_1_ColumnLayout_Bootstrap_ColumnLayout_Bootstrap_1_SmartSearchBox_txtWord" id="" style="display:none;">Search for:</label>
						<input name="s" type="text" maxlength="1000" id="" class="form-control" value="<?php echo $s ?>"/>
						<input type="submit" value="Search" id="" class="btn-sm btn btn-default" />

					</form>
					<div class="search-details">Showing results for <strong><?php echo $s ?></strong> (<?php echo $total_results; ?>)</div>
					<div id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_RowLayout_Bootstrap_RowLayout_Bootstrap_1_ColumnLayout_Bootstrap_ColumnLayout_Bootstrap_1_SmartSearchResults_srchResults_pnlSearchResults">

						<?php if ($search_query->have_posts()) { ?>
							<?php while($search_query->have_posts()) { $search_query->the_post(); ?>
							<div class="search-result">
								<h2 class="search-result-title">
									<a href="<?php echo get_the_permalink($search_query->ID) ?>">
										<?php the_title() ?>
									</a>
								</h2>
								<div class="search-result-content">

								</div>
								<div class="search-result-url">
									<?php echo get_the_permalink($search_query->ID) ?>
								</div>
							</div>
							<?php } ?>
						<?php } else { ?>
						<div class="search-result">
							<span>
								No results were found. 
							</span>
						</div>
						<?php } ?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
  
  

<?php wp_reset_query() ?>

<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer() ?> 