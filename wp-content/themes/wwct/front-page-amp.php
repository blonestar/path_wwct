<?php get_header('amp'); ?>
<?php the_post(); ?>


<?php if (get_the_content()) { ?>
<section class="main-content">
        <?php the_content() ?>
</section>
<?php } ?>

<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer('amp') ?> 