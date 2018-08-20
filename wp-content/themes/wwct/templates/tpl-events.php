<?php
/*
 * Template name: Events
 */
get_header();
the_post();


// get filters if any
$tax_query = array();

// get query search (s)
$search = (isset($_GET['s'])) ? trim($_GET['s']) : false;

// get year
$year = (isset($_GET['year'])) ? $_GET['year'] : false;

// get query locations
$locations_arr = false;
$locations = (isset($_GET['locations'])) ? explode(',',$_GET['locations']) : false;
if (is_array($locations)) {
    $locations_arr = array(
            'taxonomy' => 'locations',
            'field'    => 'slug',
            'terms'    => $locations,
			);
	}



// get query events type
$eventstype_arr = false;
$eventstype = (isset($_GET['eventstype'])) ? explode(',',$_GET['eventstype']) : false;
if (is_array($eventstype)) {
    $eventstype_arr = array(
            'taxonomy' => 'event_type_tax',
            'field'    => 'slug',
            'terms'    => $eventstype,
			);
	}


$args = array(
        'post_status'       => 'publish',
        'post_type'			=> 'events',
        //'posts_per_page'	=> 1,
        'orderby'			=> 'date',
        'order'				=>  'desc',
        'tax_query' 		=> array(
                                    'relation' => 'OR',
                                    $eventstype_arr,
                                    $locations_arr
                                ),
        'year'				=> $year,
        's'					=> $search
    );
$query = new WP_Query($args);

?>

<section class="posts-filter">
	<div class="container">     
		<div class="row">
			<div class="col-9 col-lg-8 offset-lg-1 posts-filter-left ">
                <form id="apply-filter" action="" method="get">
					<span class="events-type-cat-wrap">
						<select id="events-type-cat" class="terms-filter multisel" multiple="multiple">
							<?php 
								$event_type_tax = get_terms( 'event_type_tax' );
								foreach ($event_type_tax as $term) {
									$res_selected = (in_array($term->slug, $eventstype)) ? ' selected' : '';
							?>
								<option value="<?php echo $term->slug ?>" data-term-id="<?php echo $term->term_taxonomy_id ?>"<?php echo $res_selected ?>><?php echo $term->name ?></option>
							<?php
								}
							?>
						</select>
					</span>
                    &nbsp;
                    <?php 
                        $locations_all_arr = get_terms( array('taxonomy' => 'locations', 'hierarchical' => false ) );
                        //echo "<pre>";
                        //print_r($locations_arr);
                        //echo "</pre>";
                        ?>
					<span class="events-location-cat-wrap">
						<select id="events-location-cat" class="terms-filter multisel" multiple="multiple">
							<?php
								foreach ($locations_all_arr as $term) {
									$selected = (in_array($term->slug, $locations_arr)) ? ' selected' : '';
							?>
								<option value="<?php echo $term->slug ?>" data-term-id="<?php echo $term->term_taxonomy_id ?>"<?php echo $selected ?>><?php echo $term->name ?></option>
							<?php
								}
							?>
						</select>
					</span>
                    &nbsp;
					<span class="styled-date----">
						<select id="select-year" placeholder="Year" name="year">
							<?php for($yeari = date('Y'); $yeari >= 2017; $yeari--) { ?>
							<option value="<?php echo $yeari ?>"<?php echo ($year==$yeari) ? ' selected':''?>><?php echo $yeari ?></option>
							<?php } ?>
						</select>
					</span>
                    <button class="btn btn-filter">Apply</button>
                </form>
			</div>
            <div class="col-3 text-right blog posts-filter-left">
                            <div id="widget_blog_search-3" class="widget search_form_widget">
                                <form role="search" id="search-form-widget" method="get" class="search-form" action="<?php echo get_permalink() ?>">
                                    <div class="blog searchBox">
                                        <input type="search" class="search-field form-control" autocomplete="off" placeholder="Search …" value="<?php echo @$search ?>" name="s" title="Search for:">
                                        <a id="btnSrch" href="#" onclick="document.getElementById('search-form-widget').submit();">
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
		</div>
	</div>
</section>




<section class="main-content posts-list news-posts-list">
	<div class="container">
		<?php if ($search != '') { ?>
		<div class="row">
			<div class="offset-1 col">
				<h2>Search results for: <strong><?php echo $search ?></strong></h2> 
				<p>Results found: <?php echo $query->post_count ?></p>
			</div>
		</div>
		<?php } ?>   
        <?php /*
		<div class="row">
			<div class="offset-1 col-4">
				<span class="date"><?php echo date('F Y'); ?></span>
			</div>
			<div class="col-4 text-right">
				<a href="#" class="sort">SORT BY NEWEST <i class="fa fa-angle-up" aria-hidden="true"></i></a>
			</div>

		</div>
        */ ?>
		<div class="row">
			<div class="col-lg-1 hidden-md-down">
				<?php get_template_part( 'template-parts/tpl-part-share-vertical' ) ?>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8">
						<div class="row">
				<?php
                
                    while($query->have_posts()) { $query->the_post();
                
                        // destroy vars
						if (isset($locations_terms)) unset($locations_terms, $locations_term_arr);
						if (isset($event_type_terms)) unset($event_type_terms, $event_type_term_arr);

                        $locations_terms = get_the_terms( get_the_ID(), 'locations' );
                        $event_type_terms = get_the_terms( get_the_ID(), 'event_type_tax' );

						if ($locations_terms!==false)
						foreach($locations_terms as $locations_term)
							$locations_term_arr[] = $locations_term->name;
						
                        if ($event_type_terms!==false)
						foreach($event_type_terms as $event_type_term)
							$event_type_term_arr[] = $event_type_term->name;

                ?>
							<div class="col-sm-12 col-md-12 col-lg-6 post-wrapper">
								<article class="event-post h-100">
									<div class="article-border h-100">
										<header style="background-image: url(<?php echo get_the_post_thumbnail_url( get_the_ID(),  'image-size-3') ?>);">

											<p class="event-date"><?php echo format_event_date(get_field('event_start_date'),get_field('event_end_date')) ?></p>

											<?php if (isset($locations_term_arr)) {
													$locations_str = implode(', ', $locations_term_arr); ?>
												<p class="event-locations"><?php echo $locations_str ?></p>
											<?php } ?>
											<h1 class="event-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
											<?php if (isset($event_type_term_arr)) {
													$event_types_str = implode(', ', $event_type_term_arr); ?>
												<p class="filter event-type"><?php echo $event_types_str ?></p>
											<?php } ?>
										</header>
										<div class="event-exerpt">
											<?php echo get_excerpt(); ?>
											<p><a href="<?php the_permalink() ?>" class="read-more">Read More <i class="fa fa-chevron-right" aria-hidden="true"></i></a></p>
										</div>
										<footer>
											<?php echo do_shortcode( '[addtoany url="'.get_permalink().'" title="'.get_the_title().'"]' ); ?>
											
										</footer>
									</div>
								</article>
							</div>
				<?php } // endwhile ?>
						</div>

				<?php if ($query->found_posts > get_option( 'posts_per_page' )) { ?>
				<div class="row">
					<div class="col">
						<a class="btn viewmorebutton">Show More</a>
					</div>
				</div>
				<?php } ?>
				
			</div>
			<div class="col-lg-3 col-md-4 col-sm-4">
				<aside>
					<?php dynamic_sidebar( 'sidebar-events' ); ?>
				</aside>
			</div>
		</div>
		
	</div>
</section>

<?php wp_reset_query() ?>


<script>
jQuery(document).ready(function($){

// Events
	if ($().SumoSelect) {
		$('#events-type-cat').SumoSelect({
				triggerChangeCombined: true,
				forceCustomRendering: true,
				placeholder: 'EVENTS TYPE'
		})
		$('#events-location-cat').SumoSelect({
				triggerChangeCombined: true,
				forceCustomRendering: true,
				placeholder: 'LOCATIONS',
				floatWidth: 768
		});
		$('#select-year').SumoSelect({
				triggerChangeCombined: true,
				forceCustomRendering: true,
				placeholder: 'YEAR'
		});
	} else {
		console.log('SumoSelect not loaded!');
	}


var query_obj = {};
	$('#apply-filter').submit(function(e){
		//console.log('form submit');
		e.preventDefault();
		var url = location.protocol + '//' + location.host + location.pathname;
		var params = $.param(query_obj);
		//console.log('form submit inside');
		//console.log(location.protocol + '//' + location.host + location.pathname + '?' + $.param(query_obj));
		if (params != '') {
			document.location = location.protocol + '//' + location.host + location.pathname + '?' + params;
		} else if (window.location.href != url + '?' + params) {

//			document.location = url;
		}
	});

	function create_query_string() {

		query_obj = {};

		var eventstype = $('#events-type-cat').find(":selected");
		var eventstype_arr = [];
		var i = 0;
		eventstype.each(function(index) {
			eventstype_arr[i++] = $(this).val();
		});
		if (eventstype_arr.length > 0) {
			query_obj['eventstype'] = eventstype_arr.join();
		}
		
		var locations = $('#events-location-cat').find(":selected");
		var locations_arr = [];
		var i = 0;
		locations.each(function(index) {
			locations_arr[i++] = $(this).val();
		});
		if (locations_arr.length > 0) {
			query_obj['locations'] = locations_arr.join();
		}
		
		var year = $('#select-year').find(":selected");
		var year_arr = [];
		var i = 0;
		year.each(function(index) {
			year_arr[i++] = $(this).val();
		});
		if (year_arr.length > 0) {
			query_obj['year'] = year_arr.join();
		}

		//console.log(query_obj);
		//console.log($.param(query_obj));
		//console.log(location.protocol + '//' + location.host + location.pathname + '?' + $.param(query_obj));
	}
	$('#events-type-cat').on('change', function(){
		create_query_string();
	});
	$('#events-location-cat').on('change', function(){
		create_query_string();
	});
	$('#select-year').on('change', function(){
		create_query_string();
	});

	var page = <?php echo $page ?>;
	var s = '<?php echo $search ?>';
	var year = '<?php echo $year ?>';
	var eventtypes =  <?php echo json_encode($eventstype_arr, JSON_HEX_QUOT) ?>;
	var locations = <?php echo json_encode($locations_arr, JSON_HEX_QUOT) ?>;
													
	var post_type = '<?php echo $post->post_type ?>';
	var ordby = '<?php echo $post->orderby ?>';
	var ord = '<?php echo $post->order ?>';
	
	function page_more() {
		page += 1;
	}
	
	$('.viewmorebutton').click(function(e) {
		e.preventDefault();
		$.ajax({
			url: '<?php echo get_admin_url() ?>admin-ajax.php?action=get_more_events_posts',
			type: "POST",
			dataType: "json",
			data: {page: page, s: s, post_type: post_type, ord: ord, ordby: ordby, eventtypes: eventtypes, locations: locations, year: year },
			success: function(data) {
				//console.log(data.query);
				if (data.html) {
					$('.post-wrapper:last').after(data.html);
					//a2a.init('feed');
					$( 'body' ).trigger( 'post-load' );
					page_more();
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
.events-location-cat-wrap p {
    min-width: 192px;
}
</style>


<?php get_footer() ?> 