<?php 
/*
 * Template name: In The News
 */
get_header(); ?>
<?php the_post() ?>


<?php


		
	// get filters if any
	$tax_query = array();

	$year = (isset($_GET['year'])) ? $_GET['year'] : false;
	$month = (isset($_GET['month'])) ? $_GET['month'] : false;
	$search = (isset($_GET['s'])) ? $_GET['s'] : false;

	$args = array(
						'post_status' => 'publish',
						'post_type'			=> 'in_the_news',
						//'posts_per_page'	=> -1,
						'orderby'			=> 'date',
						'order'				=>  'desc',
            
                        'year'              => $year,
                        'monthnum'          => $month,
						's'					=> $search
    
                        /*
						'tax_query' 		=> array(
													'relation' => 'OR',
													$month,
													$year
												),*/
					);
	$query = new WP_Query($args);

//print_r($query->query_vars);
	
?>

<section class="posts-filter">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-1 col-md-8 text-center text-md-left">
                <form id="apply-filter" action="" method="get">

					<select  id="select-month" placeholder="Month" name="month">
						<option value="" selected="selected" disabled>Month</option>
						<?php for($monthi = 1; $monthi <= 12; $monthi++) { ?>
						<option value="<?php echo date('m', mktime(0, 0, 0, $monthi, 10)) ?>"<?php echo ($month==$monthi) ? ' selected':''?>><?php echo date('F', mktime(0, 0, 0, $monthi, 10)) ?></option>
						<?php } ?>
					</select>

					&nbsp;

					<select id="select-year" placeholder="Year" name="year">
						<option value="" selected="selected" disabled>Year</option>
						<?php for($yeari = date('Y'); $yeari >= 2015; $yeari--) { ?>
						<option value="<?php echo $yeari ?>"<?php echo ($year==$yeari) ? ' selected':''?>><?php echo $yeari ?></option>
						<?php } ?>
					</select>

                    <button class="btn btn-filter">Apply</button>
                </form>
			</div>
			<div class="col-lg-3 col-md-3 text-right text-md-center blog">
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
				<span class="date"><?php echo date('F Y'); ?> News</span>
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
				<?php while($query->have_posts()) { $query->the_post(); ?>
							<div class="col-sm-12 col-md-12 col-lg-6 post-wrapper">
								<article class="news-post h-100">
									<div class="article-border h-100">
										<header>
										<span class="post-date news-post-date"><?php the_date() ?></span>
										<h1 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
										</header>
										<div class="news-excerpt">
										<?php the_post_thumbnail('image-size-3', array('class' => 'post-img')) ?>
										<?php echo get_excerpt(); ?>
										<p><a href="<?php the_permalink() ?>" class="read-more">Read More <i class="fa fa-chevron-right" aria-hidden="true"></i></a></p>
										</div>
										<footer>
											<?php echo do_shortcode('[addtoany]'); ?>
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
					<?php dynamic_sidebar( 'sidebar-news' ); ?>
				</aside>
			</div>
		</div>
		
	</div>
</section>


<script>

(function( $ ) {
  $(function() {
//jQuery(document).ready(function($){





	var page = <?php echo $page ?>;
	var s = '<?php echo $search ?>';
	var year = '<?php echo $year ?>';
	var month = '<?php echo $month ?>';

	var ordby = '<?php echo $post->orderby ?>';
	var ord = '<?php echo $post->order ?>';
	
	function page_more() {
		page += 1;
	}
	
	$('.viewmorebutton').click(function(e) {
		e.preventDefault();
		$.ajax({
			url: '<?php echo get_admin_url() ?>admin-ajax.php?action=get_more_news_posts',
			type: "POST",
			dataType: "json",
			data: {page: page, s: s,  ord: ord, ordby: ordby, year: year, month: month },
			success: function(data) {
				//console.log(data);
				if (data.html) {
					$('.post-wrapper:last').after(data.html);
					//a2a.init('feed');
					$( 'body' ).trigger( 'post-load' );
					//a2a.init('page');
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
//});

  });
})(jQuery);

</script>


<?php get_footer() ?> 