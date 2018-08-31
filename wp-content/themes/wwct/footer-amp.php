
            </div>
        </main>
        
        <footer id="footer">
            <div id="footer-content-wrapper">
                <div id="footer-content">

                    <div class="container">
                        <div class="columns">
                            <div class="column col-3 col-md-12 text-center text-white">

  

                                    <a href="<?php echo home_url() ?>" class="foot-logo">
                                        <!--<img class="footer-logo" src="<?php echo get_template_directory_uri() ?>/img/worldwide-logo-footer.jpg" alt="worldwide-logo-footer" title="WORLDWIDE CLINICAL TRIALS">-->
                                        <amp-img height="63" width="222" src="<?php echo get_template_directory_uri() ?>/img/wwct-logo-white.svg" alt="WorldWide Clinical Trials" noloading></amp-img>
                                    </a>
                                    <hr>
                                    <div class="footer-social-wrapper">
                                        CONNECT WITH WORLDWIDE<br>
                                        <?php if (have_rows('social', 'option')) { ?>
                                        <ul class="social">
                                            <?php while(have_rows('social', 'option')) {  the_row(); ?>
                                            <li><a href="<?php the_sub_field('link') ?>" title="<?php the_sub_field('label') ?>" target="_blank"><?php the_sub_field('icon') ?></a></li>
                                            <?php } ?>
                                        </ul>
                                        <?php } ?>
                                    </div>

                            </div>
                            <div class="column col-9 col-md-12 text-center footer-menu-wrapper">
                                <hr class="show-sm">
                                <?php
                                    wp_nav_menu( array(
                                        'menu' => 'Footer Menu 1',
                                        'container'	=> false
                                    ));
                                ?>
                                <?php
                                    wp_nav_menu( array(
                                        'menu' => 'Footer Menu 2',
                                        'container'	=> false
                                    ));
                                ?>
                            </div>
                        </div>
                    </div>
                    
				</div>
			</div>

			<div id="footer-copyright-wrapper">
				<div id="footer-copyright">
					<ul>
						<li>© Worldwide Clinical Trials 2018</li>
						<li>
							<a href="<?php echo site_url('/privacy-statement-terms-of-use/') ?>">Privacy Statement &amp; Cookie Policy</a>
						</li>
						<li>
							<a href="<?php echo site_url('/ethics-compliance/') ?>">Ethics &amp; Compliance</a>
						</li>
						<li>
							<a href="<?php echo site_url('/sitemap/') ?>">Sitemap</a>
						</li>
					</ul>
				</div>
			</div>


		</footer>

	</body>
</html>