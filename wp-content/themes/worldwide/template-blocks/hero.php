<!--<div class="hero-video-webpart hero-xl  dark-image  mobile-scaled ">
	<div class="img-bg" style="background-image: url(http://147.75.128.123/~pthdevco/worldwide.com/wp-content/uploads/2016/09/Screen-Shot-2016-09-28-at-6-09-09-PM.png); background-repeat: no-repeat;"></div>
	<video src="http://147.75.128.123/~pthdevco/worldwide.com/wp-content/uploads/2016/09/WW-v2901091-624H.mp4" loop poster="http://147.75.128.123/~pthdevco/worldwide.com/wp-content/uploads/2016/09/Screen-Shot-2016-09-28-at-6-09-09-PM.png" autoplay="" muted=""></video>
	<div class="container">
		<div class="row hero-content textInMiddle heroContentBanner ">
			<div class="col-sm-10 col-sm-push-1">
				<div class="hero-container centerText" style="width: 95%;">
					<h1 style="text-align: center;">TALKING CLINICAL TRIALS<br />
					WITH WORLDWIDE EXPERTS</h1>
					<div class="col-sm-12 ">
						<p style="text-align: center;">
							<a class="btn btn-hollow btn-lg _gt" data-action="Learn More" href="http://147.75.128.123/~pthdevco/worldwide.com/blog/" target="_blank">VISIT OUR BLOG</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="down-arrow">
		<span class="scroll-text">Scroll Down</span>
		<span class="icon-down-arrow"></span>
	</div>
</div>



<div class="about-video-hero">
	<div id="" class="hero-video-webpart">
		<div id="" class="img-bg"></div>
		<video src="http://147.75.128.123/~pthdevco/worldwide.com/wp-content/uploads/2016/09/WCT-Website-30-Second-About-Us.mp4" id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_HeroVideoWithContent_videoHero" muted="" autoplay="" loop=""></video>
		<div class="container">
			<div id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_HeroVideoWithContent_divContentRow" class="row hero-content">
				<div class="col-sm-8 col-sm-push-2">
					<div id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_HeroVideoWithContent_divCopy">
						<p>&nbsp;</p>
						<br />
						<br />
						<br />
						<br />
						<br />
						<br />
						<br />
						<a class="btn btn-default btn-lg" data-target=".video-modal" data-title="About Worldwide Clinical Trials" data-toggle="modal" href="http://www.youtube.com/watch?v=oghnDN57yKY"><span class="fa fa-play"></span>&nbsp;Full Video</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="hero-image-webpart  dark-image mobile-scaled">
	<div class="img-bg" style="background-image:url(http://147.75.128.123/~pthdevco/worldwide.com/wp-content/uploads/2016/09/therapeutic-areas-hero.jpg);"></div>
	<div class="container">
		<div class="hero-content">
			<h1 id="stcpDiv" style="text-align: center;">CRO Services: Therapeutic Areas of Clinical Trials</h1>
		</div>
	</div>
	<div class="down-arrow">
		<span class="icon-down-arrow"></span>
	</div>
</div>


<div class="hero-image-webpart hero-sm dark-image mobile-scaled">
	<div class="img-bg" style="background-image:url(http://147.75.128.123/~pthdevco/worldwide.com/wp-content/uploads/2016/09/resourcelibraryheader.jpg); height: 312px"></div>
	<div class="container">
		<div class="hero-content">
			<div class="container">
				<div class="hero-content">
					<div class="no-line-breaks">
						<h1 style="text-align: center;">Clinical, Pharmaceutical and Contract Research Resources</h1>
						<h3 style="text-align: center;">We offer a large database of scientific articles and papers, most of which include authors from our esteemed leadership team.</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
-->



<div class="hero-image-webpart mobile-scaled<?php echo (get_field('header_dark_image')) ? " dark-image" : "" ?>"<?php echo (get_field('header_type') == 'color') ? ' style="background-color: ' . get_field('header_background_color') . '"' : "" ?>>
	<?php if (get_field('header_image')) { ?>
	<div class="img-bg" style="background-image:url(<?php the_field('header_image') ?>);"></div>
	<?php } ?>
	<div class="container">
		<div class="hero-content">
			<h1 id="stcpDiv" style="text-align: center;">CRO Services: Therapeutic Areas of Clinical Trials</h1>
		</div>
	</div>
	<?php if (get_field('header_scroll_button')) { ?>
	<div class="down-arrow">
		<?php if (get_field('header_scroll_text')) { ?>
		<span class="scroll-text"><?php the_field('header_scroll_text') ?></span>
		<?php } ?>
		<span class="icon-down-arrow"></span>
	</div>
	<?php } ?>
</div>