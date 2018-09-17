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
        'posts_per_page'	=> -1,
        'orderby'			=> 'menu_order',
        'order'				=>  'ASC',
        'tax_query' 		=> array(
                                    'relation' => 'OR',
                                    $eventstype_arr,
                                    $locations_arr
                                ),
        //'year'				=> $year,
        //'s'					=> $search
    );
    
	if( $year ) {
		$args['year'] = $year;
	}

	if( $search ) {
		$args['s'] = $search;
	}
$query = new WP_Query($args);

?>

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
			<?php
				$categories = get_terms( array(
					'taxonomy' => 'event_category_tax',
					'orderby' => 'name',
					'order' => 'DESC',
					'hide_empty' => true,
				));
				
				while($query->have_posts()) { 
					
					$query->the_post();
					
					$category_terms = get_the_terms( get_the_ID(), 'event_category_tax' );
					
					$category_lists = array();
					if ($category_terms!==false) {
						foreach($category_terms as $category_term) {
							$category_lists[] = $category_term->term_id;
						}
					}
					
					if( !empty($category_lists) ){
						foreach($category_lists as $category_list) {
							$events[$category_list][] = get_the_ID();
						}
					}
				}
				
				
			?>
			<div class="col-lg-11 col-md-11 col-sm-11">
				<?php if( !empty($events) ){
						foreach( $categories as $category ){
							
							if(isset($events[$category->term_id]) && !empty($events[$category->term_id])){
								 ?>
								<h2 class="event_cate_type"><?php echo $category->name;?></h2>
								<div class="row">
								<?php
								
								foreach($events[$category->term_id] as $post){
									
									setup_postdata($post);
									
									// destroy vars
									if (isset($locations_terms)) unset($locations_terms, $locations_term_arr);
									if (isset($event_type_terms)) unset($event_type_terms, $event_type_term_arr);

									$locations_terms = get_the_terms( get_the_ID(), 'locations' );
									$event_type_terms = get_the_terms( get_the_ID(), 'event_type_tax' );
									
									$button_text = get_field('event_button_text');
									$button_text = ($button_text) ? $button_text : 'Read More';

									$link = get_field('event_button_link');
									$link = ($link) ? $link : get_the_permalink();

									if ($locations_terms!==false)
									foreach($locations_terms as $locations_term)
										$locations_term_arr[] = $locations_term->name;

							?>
										
								<div class="col-sm-12 col-md-6 col-lg-4 post-wrapper">
									<article class="event-post h-100">
										<div class="article-border h-100">
											<a href="<?php echo $link;?>">
												<div class="event-item-img" style="background-image: url(<?php echo get_the_post_thumbnail_url( get_the_ID(),  'image-size-3') ?>);">
													<h2 class="event-title"><?php the_title(); ?></h2>
													<?php if (isset($locations_term_arr)) {
															$locations_str = implode(', ', $locations_term_arr); ?>
														<h3 class="event-locations"><?php echo $locations_str ?></h3>
													<?php } ?>
													<span class="event-item-date"><i class="fa fa-calendar"></i> <?php echo format_event_date(get_field('event_start_date'),get_field('event_end_date')) ?></span>
												</div>
												<div class="event-item-content">
													<p><?php echo truncatebychars(strip_tags(get_the_content()), 180); ?></p>
													<div class="event-item-btn">
													<a href="<?php echo $link;?>" class="event-item-more"><?php echo $button_text;?></a>
													</div>
												</div>
											</a>
										</div>
									</article>
								</div>
										
							<?php } ?>
							
							</div>
							
							<?php
								wp_reset_postdata($post);
							}
				
						}
				
					}
				?>
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