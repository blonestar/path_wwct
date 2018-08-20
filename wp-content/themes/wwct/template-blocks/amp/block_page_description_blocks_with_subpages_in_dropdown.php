
	<div class="container">
		<div class="columns">

<?php if ( have_rows('boxes') ) : ?>

    <?php while( have_rows('boxes') ) : the_row(); ?>


        <div class="col-12">
        <?php if (get_sub_field('content_type') == 'page')  { ?>
            <?php $title = get_sub_field('title');       
            ?>

            <div class="box-page h-100 position-relative">
                <div class="h-100">
                    <a class="small-hero-link" href="<?php echo get_the_permalink( $page_obj->ID ) ?>">
                    <div class="box-page-hero text-white position-relative d-table w-100" style="background: url(<?php the_sub_field('hero_image') ?>) no-repeat center center; background-size: cover;">
                        <?php
                            $page_obj = get_sub_field('page');
                            if ($title == '') {
                                //var_dump($page_obj);
                                $title = $page_obj->post_title;
                            }
                        ?>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                        <div class="title-wrapper d-table-cell align-middle">
                             <h4 class="my-0">
                                <?php echo $title; ?>
                            </h4>
                        </div>
                    </div>
                    </a>
                    <?php

                    //$dropdown_pages = wp_dropdown_pages( array(
                    $dropdown_pages = get_pages( array(
                        'child_of'           => $page_obj->ID,
                        'echo'              => 0,
                        'class'             => 'select-pages w-100',
                        'selected'          => 0,
                        'selected'          => '0',
                        'show_option_none'     => '-- please select --', // string
                        'option_none_value'     => '0', // string
                        ) ); ?>
                    <?php if ($dropdown_pages) { ?>
                    <div class="box-page-dropdown">
                        <select on="change:AMP.setState({ url<?php echo @++$urlnum ?>: event.value })">
                        <?php foreach($dropdown_pages as $dp) { ?>
                            <?php //print_r($dp); ?>
                            <option value="<?php echo get_the_permalink( $dp->ID ) ?>"><?php echo $dp->post_title; ?></option>
                        <?php } ?>
                        </select>
                        <a class="btn" [href]="url<?php echo @$urlnum ?>">Go</a>

                    </div>
                    <?php } ?>
                    <div class="box-page-inner">
                    <?php the_sub_field('description') ?>
                    </div>
                    <?php if (get_sub_field('button_title')) { ?>
                    <div class="button-area text-center position-absolute">
                        <a class="btn" href="<?php echo get_the_permalink( $page_obj->ID ) ?>"><?php the_sub_field('button_title') ?></a>
                    </div>
                    <?php } ?>
                </div>
            </div>


        <?php } else { // display random Expert ?>
            <div class="random-expert">
               
               <?php
                // TODO
                // get random expert query

                $experts = get_sub_field('expert');

                $args = array(
                    'post_type'         => 'experts',
                    'post_status'       => array( 'publish' ),
                    //'orderby'           => 'rand',
                    'ignore_sticky_posts'   => true,
                    'posts_per_page'    => -1,
                    //'suppress_filters'   => false,
                    'post__in'          => $experts
                    
                );
                //remove_all_filters('posts_orderby');
                $query = new WP_Query( $args );

                // randomize posts in query object
                shuffle($query->posts);

                if ( $query->have_posts() ) {


                   // while ( $query->have_posts() ) {
                        $query->the_post();
                        
                        ?>
                    <amp-img src="<?php echo get_the_post_thumbnail_url() ?>" width="1" height="1"></amp-img>
                    <div class="expert-inner-part text-center text-white">
                        <h4 class="text-uppercase"><?php  the_sub_field('title') ?></h4>
                        <p class="expert-name"><?php echo get_the_title() ?></p>
                        <p><a href="<?php the_permalink() ?>" class="btn btn-outline btn-white">Ask me a Question</a></p>
                        <p><a href="<?php echo site_url( 'about-us/meet-the-experts/' ) ?>" class="text-uppercase meet-all-experts">meet all of worldwide’s experts</a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></p>
                    </div>

                <?php
                   // }
                }
                wp_reset_postdata();

                ?>
            </div>
        <?php } ?>
        </div>


    <?php endwhile; ?>

<?php endif; ?>

	    </div>
	</div>




