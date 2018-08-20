
<<?php echo $tag.$id.$class.$style?>>
	<div class="<?php echo $container ?>">
		<div class="row">

<?php if ( have_rows('boxes') ) : ?>

    <?php while( have_rows('boxes') ) : the_row(); ?>


        <div class="col-12 col-md-6 col-lg-4 my-3">
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

                    $dropdown_pages = wp_dropdown_pages( array(
                        'child_of'     => $page_obj->ID,
                        'echo'         => 0,
                        'class'        => 'select-pages w-100',
                        'selected'              => 0,
                        'selected'         => '0',
                        'show_option_none'     => '-- please select --', // string
                        'option_none_value'     => '0', // string
                        ) ); ?>
                    <?php if ($dropdown_pages) { ?>
                    <div class="box-page-dropdown">
                        <?php echo $dropdown_pages; ?>
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
            <div class="random-expert h-100 position-relative">
               
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
                        the_post_thumbnail();

                ?>
                    <div class="expert-inner-part text-center text-white text-center">
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
</<?php echo $tag ?>>
<style>
.template-block.block_page_description_blocks_with_subpages_in_dropdown .small-hero-link {
    text-decoration: none;
}
.template-block.block_page_description_blocks_with_subpages_in_dropdown .small-hero-link:hover {
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=85)";
  filter: alpha(opacity=85);
  -moz-opacity: 0.85;
  -khtml-opacity: 0.85;
  opacity: 0.85;
}
.template-block.block_page_description_blocks_with_subpages_in_dropdown .box-page {
     border: 1px solid #ddd;
     background-color: #f1f4f4;
     padding-bottom: 70px;
 }
 .template-block.block_page_description_blocks_with_subpages_in_dropdown .box-page .box-page-hero {
     background-size: cover;
     height: 148px;
     padding: 0 20px; 
 }
 .template-block.block_page_description_blocks_with_subpages_in_dropdown .box-page .box-page-hero  {
     font-size: 38px;
 }
 .template-block.block_page_description_blocks_with_subpages_in_dropdown .box-page .box-page-inner {
     padding: 20px;
 }
 .template-block.block_page_description_blocks_with_subpages_in_dropdown .box-page .box-page-dropdown {
     padding: 20px;
     border-bottom: 1px solid #ddd;
 }
 .template-block.block_page_description_blocks_with_subpages_in_dropdown .box-page .SumoSelect {
     width: 100%;
     max-width: 100%;
 }
 .template-block.block_page_description_blocks_with_subpages_in_dropdown .box-page .button-area {
     bottom: 0px;
     left: 0;
     right: 0;
     border-top: 1px solid #ddd;
     padding: 20px;
 }

 .template-block.block_page_description_blocks_with_subpages_in_dropdown .box-page .fa-angle-right::before {
    content: "\f105";
    position: absolute;
    top: 0;
    bottom: 0;
    line-height: 150px;
    font-size: 50px;
    font-weight: bold; 
 }
 .template-block.block_page_description_blocks_with_subpages_in_dropdown .box-page .title-wrapper {
     padding-left: 40px;
    /*
    position: absolute;
    top: 0;
    bottom: 0;
    left: 44px;
    right: 10px;
    */
}

.template-block.block_page_description_blocks_with_subpages_in_dropdown .random-expert {
     background-color: #005a84;
     min-height: 472px;
 }
 .template-block.block_page_description_blocks_with_subpages_in_dropdown .random-expert .expert-inner-part {
     padding: 20px;
 }
 /* SumoBox fix */
 .template-block.block_page_description_blocks_with_subpages_in_dropdown .box-page .SumoSelect label {
     padding-top: 2px;
     padding-bottom: 2px;
     margin: 0;
 }

.template-block.block_page_description_blocks_with_subpages_in_dropdown .random-expert img {
    position: absolute;
    top: -20px;
    left: 0;
}
.template-block.block_page_description_blocks_with_subpages_in_dropdown .expert-inner-part {
    padding-left: 20px;
    padding-right: 20px;
    padding-bottom: 15px;
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
}
.meet-all-experts {
    font-size: 13px
}
.expert-inner-part > * {
    margin-top: 4px;
    margin-bottom: 4px;
    display: block;
}
.expert-inner-part .btn {
    margin-top: 4px;
    margin-bottom: 4px;
}
.expert-name {
    font-size: 20px
}
</style>
<script>
    jQuery('.select-pages').SumoSelect();
    jQuery('.select-pages').on('change', function(d){
    // selection changed
    //alert('test');
    //console.log(d.currentTarget.value);
    if (d.currentTarget.value != '0') {
        location.href = "<?php echo get_option('home'); ?>/?page_id="+d.currentTarget.value;
    }
    //currentTarget.value
    })
</script>



