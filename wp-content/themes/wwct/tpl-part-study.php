
<?php

// format date field
$study_dates = preg_replace('/(.*?\:)/', "<br><i>$1</i>", trim(get_field('study_dates')));
$study_dates = preg_replace('/\n+/', "\n", $study_dates);
$study_dates = trim(preg_replace('/\n+/', "<br>", $study_dates));
//$study_dates = trim(preg_replace('/(<br>)+/', "<br>", $study_dates));
//echo "<pre>";
//echo $study_dates;
//echo "</pre>";

?>

<article class="current-study">

        <header>
            <h2><?php the_title() ?></h2>
            <p class="study-summary"><?php if (has_excerpt()) the_excerpt() ?></p>
        </header>
        
        <div class="study-info compensation">
            <strong>Compensation</strong>
            <?php the_field('study_compensation') ?>
        </div>
        
        <div class="study-info needed">
            <strong>Needed</strong>
            <?php the_field('study_needed') ?>
        </div>
        
        <div class="study-info dates1 long-dates1">
            <strong>Dates</strong>
            <?php // echo $study_dates ?>
            <div class="more">
                <?php echo $study_dates ?>
            </div>
            <?php /*<span class="more-dates">Show more <i class="fa fa-caret-down" aria-hidden="true"></i></span>*/  ?>
        </div>
        
        <div class="study-info location">
            <strong>Location</strong> <?php the_field('study_location') ?>
        </div>

        <div class="study-btns">
            <a href="<?php the_permalink() ?>" class="btn btn-small btn-default block">Sign Up</a>
            <div class="a2a_kit " data-a2a-url="<?php the_permalink() ?>" data-a2a-title="<?php the_title() ?>">
                <a class="a2a_button_email stf" data-animation="false" data-toggle="modal" data-target="#sharestudyform" data-studyid="<?php the_ID() ?>" data-studytitle="<?php the_title() ?>" data-studyurl="<?php the_permalink() ?>">Send to a friend</a>
            </div>
        </div>

        <footer>
            <div class="ata-block">                    
                <?php echo do_shortcode('[addtoany]'); ?>
                <div class="clear"></div>                   
            </div>
        </footer>

</article>