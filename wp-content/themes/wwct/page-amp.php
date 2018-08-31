<?php get_header('amp'); ?>
<?php the_post(); ?>

<div class="container">
    <div class="columns">
        <div class="column">
            <?php the_content() ?>
        </div>
    </div>
</div>

<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer('amp') ?> 