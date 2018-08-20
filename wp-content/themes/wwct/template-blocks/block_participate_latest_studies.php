
<<?php echo $tag.$id.$class.$style?>>
	<div class="<?php echo $container ?>">
        <?php if (get_sub_field('content')) { ?>
		<div class="row">
		    <div class="col">
                <?php the_sub_field('content') ?>
            </div>
        </div>
        <?php } ?>
		<div class="row">
            <?php
                $query = new WP_Query(array(
                                    'post_type'			=> 'studies',
                                    'posts_per_page'	=> (get_sub_field('num_studies') > 0) ? get_sub_field('num_studies') : -1, // 3 per page default
                                    //'posts_per_page'	=> -1, // all
                                    'meta_key'			=> 'study_active',
                                    'meta_value'		=> '1'/*
,
                                    'orderby'           => 'date',
                                    'order'             => 'desc'
*/
                                ));
                while($query->have_posts()) {
                    $query->the_post();
            ?>
            <div class="<?php the_sub_field('study-col-classes') ?> post-wrapper">

                <?php get_template_part('tpl-part-study'); ?>
                
                
            </div>
            <?php
                } // endwhile
            ?>
        </div>
        <?php if (get_sub_field('button_title') && get_sub_field('button_link')) { ?>
		<div class="row">
			<div class="col">
				<?php include "part_button.php"; ?>               
			</div>
		</div>
		<?php } /* else if ($query->found_posts > 3) { ?>
		<div class="row">
			<div class="col text-center">
				<a class="btn viewmorebutton">Show More</a>
			</div>
		</div>
		<?php } */ ?>       
    </div>

<?php // AJAX loading more posts
/*
	<script>
	jQuery(document).ready(function($){
		var page = 1;
		var ordby = 'date';
		var ord = 'desc';
		var classes = '<?php the_sub_field("study-col-classes") ?> post-wrapper';
		function page_more() {
			page += 1;
		}
		
		$('.viewmorebutton').click(function(e) {
			e.preventDefault();
			$.ajax({
				url: '<?php echo get_admin_url() ?>admin-ajax.php?action=get_more_studies_posts',
				type: "POST",
				dataType: "json",
				data: {page: page, ord: ord, ordby: ordby, classes: classes },
				success: function(data) {
					console.log(data.query);
					if (data.html) {
						$('.post-wrapper:last').after(data.html);
						
						$( 'body' ).trigger( 'post-load' ); // cause of anytoshare

						$('.more-dates').on('click', function(){
							console.log('clicked');
							$this = $(this);
							if(!$this.parent().hasClass('active')){
								$this.html('Show less <i class="fa fa-caret-up" aria-hidden="true"></i>');
								$this.parent().addClass('active').removeAttr('style');	
							} else {			
								$(this).parent().animate({height: 144},600,'linear', 
									function(){		          
										$this.html('Show more <i class="fa fa-caret-down" aria-hidden="true"></i>');
										$('html,body').animate({scrollTop: $this.closest('.current-study').offset().top -100},'fast');
										$this.parent().removeClass('active');			      
									});									
							}
							
						});
						
						page_more();
					}
					if (data.page >= data.pages) {
						$('.viewmorebutton').hide();
					}
					
				},
				error: function() {
					console.log('An error occured');
				}
			});
		
		});
	});
	</script>
*/
?>

	<div class="modal fade1" id="sharestudyform" tabindex="-1" role="dialog" aria-labelledby="Share with friend" aria1-hidden1="true1">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="studyModalLabel">Share with friend</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php echo do_shortcode( '[gravityform id="6" title="false" description="false" ajax="true"]' ) ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			</div>
		</div>
	</div>
	<script>
	jQuery(document).ready(function($){
		//var form_content = [];
		var form_html = $("#sharestudyform").find(".modal-body").html();
		$('#sharestudyform').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget); // Button that triggered the modal
			var studyid = button.data('studyid'); // Extract info from data-* attributes
			var studytitle = button.data('studytitle'); // Extract info from data-* attributes
			var studyurl = button.data('studyurl'); // Extract info from data-* attributes
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this);
			modal.find('.modal-body').html(form_html);
			modal.find('.modal-title').text('Share Study "'+studytitle+'" with Your Friend');
			modal.find('#input_6_10').val(studyid);
			modal.find('#input_6_11').val(studytitle);
			modal.find('#input_6_12').val(studyurl);
		});
	});
	</script>
 
</<?php echo $tag ?>>
