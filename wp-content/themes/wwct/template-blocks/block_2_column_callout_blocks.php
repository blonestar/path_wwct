
<<?php echo $tag.$id.$class.$style?>>
	<div class="<?php echo $container ?>">
		<div class="row">
            <?php

            if( have_rows('expert') ): 

                while( have_rows('expert') ): the_row(); 
    
                //$left_block = get_sub_field('expert');
                $exbgcolor =  get_sub_field('expert_background_color');
                $inner_style = ' style="background-color: '.$exbgcolor.';"';
            ?>
            <div class="col-12 col-md-8 mt-5 mt-md-0 mb-5 mb-md-0">
                <?php

                //$experts = $left_block['experts'];
                $experts = get_sub_field('experts');

                $args = array(
                    'post_type'         => 'experts',
                    'post_status'       => array( 'publish' ),
                    //'orderby'           => 'rand',
                    'ignore_sticky_posts'   => true,
                    'posts_per_page'    => -1,
                   // 'suppress_filters'   => false,
                    'post__in'          => $experts                    
                );
                //remove_all_filters('posts_orderby');
                $query = new WP_Query( $args );

                // randomize posts in query object
                shuffle($query->posts);

                if ( $query->have_posts() ) {
                    $query->the_post();
                        
                    $button_title = get_sub_field('button_title');
                    $button_title = str_replace('[name]', get_the_title(), $button_title);
                        /*
                        ?>
                    <div class="expert-inner-part position-relative h-100 text-center text-md-left"<?php echo $inner_style ?>>
                        <?php the_post_thumbnail(); ?>
                        <div class="vertical-center">
                            <h4 class="expert-title text-uppercase"><?php echo $left_block['title'] ?></h4>
                            <p class="expert-name"><?php echo get_the_title() ?></p>
                            <p class="expert-link"><a href="<?php the_permalink() ?>" class="btn btn-outline btn-white">Ask me a Question</a></p>
                            <?php /* <p class="expert-schedule"><a href="#" class="">Schedule a Conversation</a> <i class="fa fa-calendar" aria-hidden="true"></i></p> * / ?>
                            <p class="expert-all"><a href="<?php  echo site_url('about-us/meet-the-experts') ?>" class="text-uppercase">Meet All Of WorldWide's Experts  <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                        </div>
                    </div>
                    */ ?>
                    

                        <div class="expert-outline-box">
                            <div class="expert-content text-center">

                                    <?php if (get_sub_field('above_title')) { ?>
                                    <h3><?php  the_sub_field('above_title') ?></h3>
                                    <?php } ?>

                                    <?php if (get_sub_field('title')) { ?>
                                    <h2><?php  the_sub_field('title') ?></h2>
                                    <?php } ?>

                                    <?php if ( ! get_sub_field('hide_expert_name')) { ?>
                                    <h1><?php the_title() ?></h1>
                                    <?php } ?>
                                        
                                    <?php if ( ! get_sub_field('hide_expert_position')) { ?>
                                    <p class="leadership-title"><?php the_field('position') ?></p>
                                    <?php } ?>

                                    <?php if ($button_title) { ?>
                                    <div class="btn-wrapper">
                                        <a href="<?php the_permalink() ?>" class="btn"><?php echo $button_title ?></a>
                                    </div>
                                    <?php } ?>

                                    <a href="<?php  the_sub_field('url') ?>"><?php the_sub_field('link') ?></a>
                            </div>
                            <?php the_post_thumbnail()?>
                        </div>

                <?php
                   // }
                }
            
                wp_reset_postdata();
            endwhile;
        endif;
            

            

?>
               
            </div>

            <?php


        if( have_rows('right_block') ): 

            
            while( have_rows('right_block') ): the_row(); 

                //$right_block = get_sub_field('right_block');

                //print_r($right_block);
                if ( get_sub_field('have_background_image') )
                    $bgstyle = ' style="background: url('.get_sub_field('image').') center center no-repeat; background-size: cover; min-height: 250px;"';
                else
                    $bgstyle = ' style="background-color: ' . get_sub_field('background_color') . '"';
            ?>
            <div class="col-12 col-md-4 my-4 my-md-0">

                <div class="assay-search-callout-small h-100 d-table"<?php echo $bgstyle ?>>
                <div class="d-table-cell align-middle">

                    
                    <?php echo get_sub_field('content') ?>
                    
                </div>
                </div>
            </div>
<?php

            endwhile;
        endif;
?>
            
        </div>
	</div>
</<?php echo $tag ?>>
<style>
    .expert-outline-box {
        margin: 0 !important;
    }
    .block_2_column_callout_blocks {
        min-height: 260px;
    }
    .expert-inner-part {
        padding: 30px;
        margin: 0;
        padding-left: 16vw;
    }
    .expert-inner-part > img {
        position: absolute;
        left: 10px;
        bottom: 0;
        max-height: 110%;
        width: auto;
        height: auto;
        margin:0;
        max-width: 30vw;
    }
    .expert-schedule,
    .expert-all {
        font-size: 12px;
        
    }
    .assay-search-callout-small {
        padding: 20px 10px;
    }

@media (max-width: 768px) {
    .expert-inner-part {
        padding: 132px 20px 20px 20px;
        --margin-top: 40px;
    }
    .expert-inner-part > img {
        height: 220px;
        left: 50%;
        transform: perspective(1px) translateX(-50%);
        top: -100px;
        max-width: initial;
    }
    .expert-inner-part > .vertical-center {
        position: initial;
        -webkit-transform: none;
        -ms-transform: none;
        transform: none;
    }
}
</style>