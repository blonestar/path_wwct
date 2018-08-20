<?php 
/*
 * Template name: Resources
 */
get_header(); ?>
<?php the_post() ?>

<?php


		
	// get filters if any
	$tax_query = array();

	$search = (isset($_GET['s'])) ? $_GET['s'] : false;

	$resourcetype_arr = false;
	$resourcetype = (isset($_GET['resourcetype'])) ? explode(',',$_GET['resourcetype']) : false;
	if (is_array($resourcetype)) {
		$resourcetype_arr = array(
				'taxonomy' => 'resources_tax',
				'field'    => 'slug',
				'terms'    => $resourcetype,
			);
	}

	$therapareas_arr = false;
	$therapareas = (isset($_GET['therapareas'])) ? explode(',',$_GET['therapareas']) : false;
	if (is_array($therapareas)) {
		$therapareas_arr = array(
				'taxonomy' => 'therapeutic_areas_tax',
				'field'    => 'slug',
				'terms'    => $therapareas,
			);
	}

	//	print_r($tax_query);

	$args = array(
						'post_status' => 'publish',
						'post_type'			=> 'resources',
						//'posts_per_page'	=> 3,
						'orderby'			=> 'date',
						'order'				=>  'desc',
						'tax_query' 		=> array(
													'relation' => 'OR',
													$resourcetype_arr,
													$therapareas_arr
												),
						's'					=> $search
					);
	$query = new WP_Query($args);

	//print_r($args);
	
?>

<section class="posts-filter">
	<div class="container">

		<div class="row">
			<div class="col-lg-8 offset-lg-1 col-md-9 posts-filter-left">
				<div class="filter-by"><span class="hidden-md-down hidden-xl-down">Filter by: &nbsp; </span>
					<span class="resources-cat-wrap">
						<select id="resources-cat" class="terms-filter multisel" multiple="multiple">
							<?php 
								$resources_tax = get_terms( 'resources_tax' );
								foreach ($resources_tax as $term) {
									$res_selected = (in_array($term->slug, $resourcetype)) ? ' selected' : '';
							?>
								<option value="<?php echo $term->slug ?>" data-term-id="<?php echo $term->term_taxonomy_id ?>"<?php echo $res_selected ?>><?php echo $term->name ?></option>
							<?php
								}
							?>
						</select> &nbsp; 
					</span>
					<span class="therapeutic_areas_tax-wrap">
						<select id="therapeutic_areas_tax" class="terms-filter multisel text-left1" multiple="multiple">
							<?php 
								$therapeutic_areas_tax = get_terms( 'therapeutic_areas_tax' );
								foreach ($therapeutic_areas_tax as $term) {
									$ther_selected = (in_array($term->slug, $therapareas)) ? ' selected' : '';
							?>
								<option value="<?php echo $term->slug ?>" data-term-id="<?php echo $term->term_taxonomy_id ?>"<?php echo $ther_selected ?>><?php echo $term->name ?></option>
							<?php
								}
							?>
						</select>
					</span>
					<form id="apply-filter" action="" method="get">
						<button class="btn btn-filter">Apply</button>
					</form>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 text-right blog posts-filter-right">
				<div id="widget_blog_search-3" class="widget search_form_widget">
					<form role="search" method="get" class="search-form" action="<?php echo get_permalink() ?>">
			            <div class="blog searchBox">
			                <input type="search" class="search-field form-control" autocomplete="off" placeholder="Search …" value="<?php echo @$search ?>" name="s" title="Search for:">
							<a id="btnSrch" href="#" onclick="jQuery(this).closest('form').submit();">
								<i class="fa fa-search"></i>
							</a>
			            </div>
			        </form>
		        </div>
			</div>
		</div>
	</div>
</section>

<script>
	
/* <![CDATA[ */
jQuery(document).ready(function($) {

	var query_obj = {};

	$('#apply-filter').submit(function(e){
		console.log('form submit');
		e.preventDefault();
		var url = location.protocol + '//' + location.host + location.pathname;
		var params = $.param(query_obj);
		//console.log('form submit inside');
		//console.log(location.protocol + '//' + location.host + location.pathname + '?' + $.param(query_obj));
		if (params != '') {
			document.location = location.protocol + '//' + location.host + location.pathname + '?' + params;
		} else if (window.location.href != url + '?' + params) {

			document.location = url;
		}
	});

	function create_query_string() {

		query_obj = {};

		var resources_tax = $('#resources-cat').find(":selected");
		var resources_tax_arr = [];
		var i = 0;
		resources_tax.each(function(index) {
			resources_tax_arr[i++] = $(this).val();
		});

		var therapeutic_areas_tax = $('#therapeutic_areas_tax').find(":selected");
		var therapeutic_areas_tax_arr = [];
		var i = 0;
		therapeutic_areas_tax.each(function(index) {
			therapeutic_areas_tax_arr[i++] = $(this).val();
		});
		

		
		if (resources_tax_arr.length > 0) {
			query_obj['resourcetype'] = resources_tax_arr.join();
		}
		if (therapeutic_areas_tax_arr.length > 0) {
			query_obj['therapareas'] = therapeutic_areas_tax_arr.join();
		}

console.log(query_obj);
console.log($.param(query_obj));
			console.log(location.protocol + '//' + location.host + location.pathname + '?' + $.param(query_obj));

		
	}
	$('#resources-cat').on('change', function(){
		create_query_string();
	});
	$('#therapeutic_areas_tax').on('change', function(){
		create_query_string();
	});
	$('#resources-cat').SumoSelect({
					//okCancelInMulti: true ,
			       triggerChangeCombined: true,
			       forceCustomRendering: true,
				   placeholder: 'ASSET TYPE'
		    })
	$('#therapeutic_areas_tax').SumoSelect({
					//okCancelInMulti: true ,
			       triggerChangeCombined: true,
			       forceCustomRendering: true,
				   placeholder: 'Categories or Therapeutic Areas'
		    });


	//var dropdown = document.getElementById( "resources-cat" );
	//function onCatChange() {
	//	if ( dropdown.options[ dropdown.selectedIndex ].value != '' ) {
	//		location.href = dropdown.options[ dropdown.selectedIndex ].value;
	//	}
	//}
	//dropdown.onchange = onCatChange;
});
/* ]]> */
</script>

<section class="main-content posts-list resources-list">
	<div class="container">
		<?php if ($search != '') { ?>
		<div class="row">
			<div class="offset-1 col">
				<h2>Search results for: <strong><?php echo $search ?></strong></h2> 
				<p>Results found: <?php echo $query->found_posts ?></p>
			</div>
		</div>
		<?php } ?>
		<div class="row">
			<div class="col-2 col-lg-1 hidden-md-down">
				<?php get_template_part( 'template-parts/tpl-part-share-vertical' ) ?>
			</div>
			<div class="col">
						<div class="row">
				<?php while ( $query->have_posts() ) { $query->the_post();

						// destroy vars
						if (isset($resources_tax_terms)) unset($resources_tax_terms, $resource_types_arr);
						if (isset($therapeutic_areas_tax_terms)) unset($therapeutic_areas_tax_terms, $therap_areas_arr);
						
						$resources_tax_terms = get_the_terms( get_the_ID(), 'resources_tax' );
						$therapeutic_areas_tax_terms = get_the_terms( get_the_ID(), 'therapeutic_areas_tax' );

						//print_r($resources_tax_terms);
						if ($resources_tax_terms!==false)
						foreach($resources_tax_terms as $resources_tax_term)
							$resource_types_arr[] = $resources_tax_term->name;
						
						

						//print_r($therapeutic_areas_tax_terms);
						if ($therapeutic_areas_tax_terms!==false)
						foreach($therapeutic_areas_tax_terms as $therapeutic_areas_tax_term)
							$therap_areas_arr[] = $therapeutic_areas_tax_term->name;

				?>
							<div class="col-12 col-md-6 col-xl-4 post-wrapper">
								<article class="resources-post h-100">
									<div class="article-border h-100">
										<div class="article-border-in">
											<?php if (isset($resource_types_arr)) {
												$resource_types = implode(', ', $resource_types_arr); ?>
											<p class="resource-type"><?php echo $resource_types ?></p>
											<?php } ?>
											<h1 class="post-title"><?php the_read_more_link(get_the_title()) ?></h1>
											<?php if (isset($therap_areas_arr)) {
													$therap_areas = implode(', ', $therap_areas_arr); ?>
											<p class="resource-therapeutic-area"><?php echo $therap_areas ?></p>
											<?php } ?>
											<?php if (has_post_thumbnail()) { ?>
												<?php the_read_more_link( get_the_post_thumbnail(get_the_ID(),'full', array('class' => 'post-img')) ); ?>
											<?php } else if (get_field('resources_default_featured_image', 'resources_tax_'.$resources_tax_terms[0]->term_id)) { ?>
												<img src="<?php echo get_field('resources_default_featured_image', 'resources_tax_'.$resources_tax_terms[0]->term_id) ?>" class="post-img">
											<?php } ?>
											<div class="excerpt"><?php the_excerpt(); ?></div>
											<div class="read_more"><?php the_read_more_link() ?></div>
										</div>
										<?php echo do_shortcode('[addtoany]'); ?>
									</div>
								</article>
							</div>
				<?php } // endwhile ?>
						</div>
						<?php if ($query->found_posts > get_option( 'posts_per_page' )) { ?>
						<div class="row">
							<div class="col text-center text-md-left">
								<a class="btn viewmorebutton">Show More</a>
							</div>
						</div>
						<?php } ?>
				
			</div>

		</div>

	</div>
</section>
<script>
jQuery(document).ready(function($){
	var page = <?php echo $page ?>;
	var s = '<?php echo $search ?>';
	var resources =  <?php echo json_encode($resourcetype_arr, JSON_HEX_QUOT) ?>;
	var therapareas = <?php echo json_encode($therapareas_arr, JSON_HEX_QUOT) ?>;
													
	var post_type = '<?php echo $post->post_type ?>';
	var ordby = '<?php echo $post->orderby ?>';
	var ord = '<?php echo $post->order ?>';
	
	function page_more() {
		page += 1;
	}
	
	$('.viewmorebutton').click(function(e) {
		e.preventDefault();
		$.ajax({
			url: '<?php echo get_admin_url() ?>admin-ajax.php?action=get_more_resources_posts',
			type: "POST",
			dataType: "json",
			data: {page: page, s: s, post_type: post_type, ord: ord, ordby: ordby, resources: resources, therapareas: therapareas },
			success: function(data) {
				console.log(data.query);
				if (data.html) {
					$('.post-wrapper:last').after(data.html);
					//a2a.init('feed');
					$( 'body' ).trigger( 'post-load' );
					page_more();

					var trigger = $("body").find('[data-toggle="modal"]');
					trigger.click(function() {
						var theModal = $(this).data( "target" );
						var videoSRC = $(this).attr( "data-theVideo" );
						//videoSRCauto = videoSRC+"?autoplay=1";
						videoSRCauto = videoSRC;
						$(theModal+' iframe').attr('src', videoSRCauto);
						$(theModal).on('hidden.bs.modal', function () {
							$(theModal+' iframe').removeAttr('src');
						})
					});
				}
				if (data.page >= data.pages) {
					$('.viewmorebutton').hide();
				}
				
			},
			error: function() {
				console.log('An error occured');
			}
		});
	
	});
});
</script>

<style>
.resources-cat-wrap p {
    min-width: 242px;
}
.therapeutic_areas_tax-wrap p {
    min-width: 292px;
}
</style>

<?php echo do_shortcode( '[templateblock id="14543"]' ); ?>

<?php get_footer() ?> 