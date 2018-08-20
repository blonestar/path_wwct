<?php
/*
 * Template name: Participate - Friendship Pays
 */

get_header();
the_post();


get_template_part( 'template-parts/tpl-part-mid-page-submenu' );

?>

<section class="main-content">
	<div class="container">
		<div class="row">
			<div class="col">
			<?php the_content() ?>



				<?php

					$study_share = get_field('study_to_showshare');
					//print_r($study_share);
/*
					$query = new WP_Query(array(
										'post_type'			=> 'studies',
										'posts_per_page'	=> 1,
										'meta_key'			=> 'study_active',
										'meta_value'		=> '1',
										'orderby'			=> 'date',
										'order'				=> 'desc'
									));
					while($query->have_posts()) {
						$query->the_post();
*/
				?>

				<div class="current-study">
					<div class="current-study-row">
						<div class="current-study-row-group">
							<div class="study-info">
								<h2><?php echo get_the_title($study_share) ?></h2>
								<div class=""><?php if (has_excerpt($study_share->ID)) echo get_the_excerpt($study_share) ?></div>
							</div>
							<div class="study-info">
								<span class="column-title">Compensation</span>
								<span class="column-content"><?php the_field('study_compensation', $study_share->ID) ?></span>
							</div>
							<div class="study-info">
								<span class="column-title">Needed</span>
								<span class="column-content more"><?php the_field('study_needed', $study_share->ID) ?></span>
							</div>
							<div class="study-info">
								<span class="column-title">Dates</span>
								<span class="column-content more"><?php the_field('study_dates', $study_share->ID) ?></span>
							</div>
							<div class="study-info">
								<span class="column-title">Location</span>
								<span class="column-content"><?php the_field('study_location', $study_share->ID) ?></span>
							</div>
						</div>
					</div>
					<div class="current-study-row">
						<div class="study-btns text-center">
							<div><a href="<?php echo get_the_permalink($study_share->ID) ?>" class="btn btn-small btn-default block">View Details</a></div>
							<!--<div><a href="<?php echo site_url('join-a-study/') . '?id=' . get_the_ID() . '#sign-up-study'; ?>" class="btn btn-small btn-default block study-sign-up">Sign Up</a></div>-->
							<div><a href="#" class="btn btn-small btn-default block btn-study-share">Share Study</a></div>
						</div>
					</div>
					<div class="current-study-row share-form text-center" style="display: none">
						<?php gravity_form(6, false, false, false, array('studyurl' => get_the_permalink($study_share->ID), 'studyjoin' => get_the_permalink(48), 'studyid' => $study_share->ID, 'studyname' => get_the_title($study_share)), true, 12); ?>
					</div>
				</div>
							
							
				<?php //} ?>
				<?php //wp_reset_query(); ?>
				
				
				<div class="social-share-block text-center" style="display: none;">
				<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { 
					ADDTOANY_SHARE_SAVE_KIT( array( 
						'buttons' => array( 'facebook', 'email', 'twitter' ),
						'linkname'  => 'Check out this clinical trial at Worldwide Clinical Trials in San Antonio. Don’t miss out on the opportunity to help others and help yourself!  When you schedule a screening visit tell them [Name] referred you!'
					) );
				} ?>
				</div>
				


			</div>
		</div>
		<?php if (get_field('content_bellow')) { ?>
		<div class="row">
			<div class="col my-3">
				<?php the_field('content_bellow'); ?>
			</div>
		</div>
		<?php } ?>
	</div>
</section>

<style>
#gform_6{
	text-align: center;
}
.less-link,
.more-link {
    display: block;
}
.less-link,
span.more-content  {
    display: none;
}
.current-study {
	margin: 20px 0 0;
	display: table;
	width: 100%;
}
.current-study-row {
	display: table-row;
}
.current-study-row-group {
	display: table;
	width: 100%;
}
.current-study-row-group > *{
	display: table-cell;
}

.current-study .study-info {
    border-top: none;
	border-left: 1px solid #999;
	height: 100%;
}
.current-study .study-btns {
	border-top: 1px solid #999;
	padding-top: 30px;
}
.current-study .study-btns a {
    display: inline-block;
    width: 300px;
}
.column-title {
	display: block;
	padding: 20px 0;
}
.column-content {
	display: block;
}
.current-study-row.share-form {
	margin-top: 40px;
	display: block;
}
.current-study-row.share-form .hs-form {
	margin-bottom: 10px;
}
.social-share-block {
	padding-top: 20px;
}
</style>

<script>
	jQuery(document).ready(function($){
		$('.btn-study-share').on('click', function(e){
			e.preventDefault();
			$(this).hide();
			$('.social-share-block').slideDown();
			$('.share-form').slideDown();
		});
		$(".gform_previous_button").addClass("btn btn-small btn-default block");
		$(".gform_next_button").addClass("btn btn-small btn-default block");
	});
</script>
	
<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer() ?> 