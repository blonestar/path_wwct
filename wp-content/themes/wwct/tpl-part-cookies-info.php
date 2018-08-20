
<!-- tpl-part-cookies-info.php -->
<?php

if (!isset($cookies_pageID)) {
    $cookies_pageID = get_the_ID();

    $cookies_visible = get_field('cookies_visible', $cookies_pageID);
    if ($cookies_visible !== true){
        $cookies_pageID = 'option';
    }
}
?>
<?php if (get_field('cookies_visible', $cookies_pageID)) { ?>
<div id="cookies-info" style="display: none; background-color: <?php the_field('cookies_background_color', $cookies_pageID) ?>" class="position-relative">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12">
                <h4 class="cookies-title"><?php the_field('cookies_title', $cookies_pageID) ?></h4>
                <div class="cookies-content"><?php the_field('cookies_content', $cookies_pageID) ?></div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 cookies-nav">
                <a class="btn btn-orange cookies-accept"><?php the_field('cookies_accept_button_label', $cookies_pageID) ?></a>
                <a href="<?php the_field('cookies_link_to_page', $cookies_pageID) ?>" class="cookies-more"><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> <?php the_field('cookies_link_to_label', $cookies_pageID) ?></a>
            </div>
        </div>
    </div>
    <a class="cookies-close position-absolute"><i class="fa fa-times" aria-hidden="true"></i></a>
</div>
<?php } ?>
<!-- end / tpl-part-cookies-info.php -->
