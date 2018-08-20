<?php
/*
 * Template Name: Homepage
 */
?><?php get_header() ?>
<?php the_post() ?>
<?php get_template_blocks(get_the_ID()) ?>

	<div class="container-wrapper pattern-container-wrapper " style="background-image: url(<?php echo site_url('wp-content/uploads/2016/10/bg-pattern.jpg') ?>)">
		<div class="container">
			<h2 class="h1" style="text-align: center;">Interested in Becoming a Healthy Volunteer?</h2>
			&nbsp;
			<p style="text-align: center;"><a class="btn btn-hollow btn-lg _gt" data-action="Join A Study" data-category="Healthy Studies" data-label="Home POP-Join A Study" href="https://www.healthystudies.com/join-a-study/?_vsrefdom=null" target="_blank">Join A Study</a></p>
		</div>
	</div>

<?php get_footer() ?> 