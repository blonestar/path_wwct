
<<?php echo $tag.$id.$class.$style?>>
	<div class="<?php echo $container ?>">
		<div class="row">
            <?php
                //var_dump( get_sub_field('layout') );
                switch (get_sub_field('layout')) {
                    case 'narrow':
                        $columns =  'col-lg-4 col-md-6';
                        $size = " narrow";
                        break;
                    case 'half-width':
                        $columns =  'col-md-7';
                        $size =  ' half-width';
                        break;
                    default:
                        $columns =  'col-md-12';
                        $size =  'full-width';
                }
                //$bgstyle = ' style="background-image: url(); background"';

                $inner_style = ' style="background-color: '.get_sub_field('box_background_color').';"';
                $inner_style = '';
            ?>
            <div class="col-12 <?php echo $columns ?> text-center">
            <div class="h-100 position-relative <?php echo $size ?>"<?php echo $inner_style ?>>
                <?php
                // TODO
                // get random expert query

                $experts = get_sub_field('experts');

                //print_r($experts);

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
                        $query->the_post();

                        $button_title = get_sub_field('button_title');
                        $button_title = str_replace('[name]', get_the_title(), $button_title);
                        

/*
                ?>
                    <div class="expert-inner-part text-center text-md-left vertical-center">
                        <h4 class="text-uppercase"><?php  the_sub_field('title') ?></h4>
                        <p><?php echo get_the_title() ?></p>
                        <div class="buttons">
                            <a href="<?php the_permalink() ?>" class="btn btn-outline btn-white">Ask me a Question</a> &nbsp; 
                            <?php /* <a href="#" class="btn btn-outline btn-white">Schedule a Conversation</a> * / ?>
                        </div>
                        <a href="<?php  the_sub_field('url') ?>" class="text-uppercase"><?php the_sub_field('link') ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
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
                    //}
                }
                wp_reset_postdata();


?>
               
            </div>
            </div>
<?php /*
            <?php $pos = get_sub_field('image_side'); ?>
            <?php $bgstyle = ' style="background: url('.get_sub_field('image').') center center no-repeat; background-size: cover; min-height: 250px;"'; ?>
            <?php if ($pos=='left') { ?>
            <div class="col-12 col-sm-12 col-md-6"<?php echo $bgstyle ?>>
                &nbsp;
            </div>
            <?php } ?>
            <div class="col-12 col-sm-12 col-md-6 block-content">

                
                <?php the_sub_field('content') ?>
                
            </div>
            <?php if ($pos=='right') { ?>
                <div class="col-12 col-sm-12 col-md-6"<?php echo $bgstyle ?>>
                    &nbsp;
                        
                </div>
            <?php } ?>
            */ ?>
        </div>
	</div>
</<?php echo $tag ?>>

<style>
    .template-block.block_talk_with_an_expert .full-width .wp-post-image, .template-block.block_talk_with_an_expert .half-width .wp-post-image {
        bottom: -20px !important;
    }
    .template-block.block_full-width_2_column .block-content {
        <?php if (get_sub_field('content_background_color')) { ?>
        background-color: <?php the_sub_field('content_background_color') ?>;
        <?php } ?>
        padding: 26px 40px;
    }
    @media (max-width: 986px) {
        .template-block.block_talk_with_an_expert .full-width .wp-post-image {
            left: -20px;
        }   
    }
    @media (max-width: 570px) {
        .template-block.block_talk_with_an_expert .expert-outline-box {
            padding: 20px;
        }
        .template-block.block_talk_with_an_expert .expert-outline-box .wp-post-image {
            position: initial;
            margin-bottom: -40px;
        }

    }
</style>
