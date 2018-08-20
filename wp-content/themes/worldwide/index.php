<?php get_header();
/*
global $paged, $page;
echo $paged;echo $page;
echo get_query_var( 'paged', 1 );
echo get_query_var( 'page', 1 );
echo "<br>";
echo $paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;
echo $page = (get_query_var( 'page' )) ? get_query_var( 'page' ) : 1;
*/

$s_arr = (isset($_GET['s'])) ? array('s' => esc_html($_GET['s'])) : array();

$post_type = (get_query_var( 'post_type' )) ? get_query_var( 'post_type' ) : 'post';

$page = (isset($_GET['page']) && (int)$_GET['page']>0) ? (int)$_GET['page'] : 1;


$orderby = isset($_GET['ordby']) ? $_GET['ordby'] : 'date';
$order = (isset($_GET['ord']) && ($_GET['ord'] == 'asc' || $_GET['ord'] == 'desc')) ? $_GET['ord'] : 'desc';
if ($orderby == 'title' || $orderby == 'date') {
	
}	
$read_widgets_from_page = get_page_by_path( 'blog' );
$widgets_page_id = $read_widgets_from_page->ID;

$main_col_width = 12;
		
if ( is_active_sidebar( 'sidebar-blog' ) ) {
	$main_col_width = 8;
}
?>

<div class="container-wrapper standard-container-wrapper " style="background-color: <?php echo get_field('background_color') ?>">
	<div class="container">
		<div class="row">
			<div class="col-sm-<?php echo $main_col_width ?> blog-posts">
<?php				//echo count($posts); ?>
				<?php if (count($s_arr)>0) { ?><div class="search-details">Showing results for <strong><?php echo $s_arr['s']; ?></strong></div><?php } ?>
				<?php query_posts(array_merge(array('orderby' => $orderby, 'order' => $order, 'post_type' => $post_type), $s_arr)); ?>
				<?php while(have_posts()) { the_post(); ?>
				<div class="blog-post">
					<div class="title">
						<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
					</div>
					<a href="<?php the_permalink() ?>">
						<?php the_post_thumbnail('full', array('class' => 'post-img')) ?>
					</a>
					<div class="author"><?php if (get_field('author')) { ?> By <?php echo get_field('author') ?>, <?php } ?><span class="post-date"><?php the_date() ?></span></div>
					<div class="teaser">
						<p><?php the_excerpt() ?></p>
					</div>
					<a href="<?php the_permalink() ?>">Read More ></a>
						
				</div>
				<?php } 
				$posts_per_page = get_option( 'posts_per_page' );
				$pages = ceil($wp_query->found_posts / $posts_per_page);
				?>
				<?php if ($page < $pages) { ?>
				<button class="btn btn-default btn-sm viewmorebutton" type="button">See More Posts</button>
				<?php } ?>
			</div>
			
			<?php //if ( is_active_sidebar( 'sidebar-blog' ) || have_rows('widgets')) { ?>
			<div class="col-sm-3 col-sm-offset-1">
				<?php dynamic_sidebar( 'sidebar-blog' ); ?>
				<div class="blog search-sort">
				  <select onchange="if( this.options[this.selectedIndex].value != '' ) location.href=this.options[this.selectedIndex].value;">
					<option value="" disabled="" selected="" hidden="">&nbsp;Sort by</option>
					<!--<option value="<?php echo esc_url( add_query_arg('ordby','author') ) ?>">Author</option>-->
					<option value="<?php echo esc_url( add_query_arg(array('ordby'=>'date', 'ord' => 'desc')) ) ?>">Date</option>
					<option value="<?php echo esc_url( add_query_arg(array('ordby'=>'title', 'ord' => 'asc')) ) ?>">Title</option>
				  </select>
				</div>
			</div>
			<?php //} ?>
			
			<?php if (have_rows('widgets', $widgets_page_id)) { ?>
			<div class="col-sm-3 col-sm-offset-1">
				<?php get_template_widgets($widgets_page_id) ?>
			</div>
			<?php } ?>
			
		</div>
	</div>
</div>
<script>
jQuery(document).ready(function($){
	var page = <?php echo $page ?>;
	var s = '<?php echo $s ?>';
	var post_type = '<?php echo $post_type ?>';
	var ordby = '<?php echo $orderby ?>';
	var ord = '<?php echo $order ?>';
	
	function page_more() {
		page += 1;
	}
	
	$('.viewmorebutton').click(function(e) {
		e.preventDefault();
		$.ajax({
			url: BASE+'/wp-admin/admin-ajax.php?action=get_more_blog_posts',
			type: "POST",
			dataType: "json",
			data: {page: page, s: s, post_type: post_type, ord: ord, ordby: ordby},
			success: function(data) {
				console.log(data.query);
				if (data.html) {
					$('.blog-post:last').after(data.html);
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


<?php get_footer() ?> 