
<<?php echo $tag.$id.$class.$style?>>
	<div class="<?php echo $container ?>">
		<div class="columns expert-outline-box">
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

                // TODO
                // get random expert query
                $experts = get_sub_field('experts');

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
                        
 
            ?>
            <div class="column col-4 <?php echo $columns ?> text-center">
                <div class="expert-img-wrap">
                   <?php the_post_thumbnail()?>
                </div>
            </div>
            <div class="column col-8 <?php echo $columns ?> text-center">
                <div class="h-100 position-relative <?php echo $size ?>"<?php echo $inner_style ?>>


                                <div class="">
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
                                            <a href="<?php the_permalink() ?>" class="btn btn-primary"><?php echo $button_title ?></a>
                                        </div>
                                        <?php } ?>

                                        <a href="<?php  the_sub_field('url') ?>"><?php the_sub_field('link') ?></a>
                                    </div>
                                    
                                </div>
                                
                    

                
                </div>
            </div>
            <?php
                    //}
                }
                wp_reset_postdata();


?>
        </div>
	</div>
</<?php echo $tag ?>>

