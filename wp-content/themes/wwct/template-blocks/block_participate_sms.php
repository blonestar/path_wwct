
<<?php echo $tag.$id.$class.$style?>>
    <div class="<?php echo $container ?>">
        <div class="row">
            <div class="col text-white text-center">
                <?php the_sub_field('content') ?>
		    	<a class="btn btn-outline btn-white" href="<?php the_sub_field('link_to') ?>" data-category="Home Page" data-action="Join Now SMS" data-label="Join Now" data-toggle="modal" data-target=".join-sms"><?php the_sub_field('button_label') ?></a>
            </div>
        </div>
    </div>
    <div class="modal fade join-sms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <h2>Study Notifications</h2>
                </div>
                <div class="modal-body">
                    <!-- iframe -->
                    <iframe src="https://api.mosio.com/par/c/optin/wctmb" name="tpraframe" height="450" width="320" marginheight="0" marginheight="0" allowtransparency="yes" frameborder="0" scrolling="no"></iframe>
                </div>
            </div>
        </div>
    </div>
</<?php echo $tag ?>>

