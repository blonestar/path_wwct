<?php
/*
 * Template name: Opt In
 */
get_header();
the_post();

$subscription_form_ID = 2160;
?>

<section class="main-content">
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<?php the_content() ?>
			</div>
			<div class="col-lg-5">


                <div id="subscription-form">
                    <p>Update your preferences below:</p>
                    <form id="mktoForm_<?php echo $subscription_form_ID ?>" class="home-page-form"></form>
                </div>
                <script>
                   // (function( $ ) {
                        MktoForms2.loadForm("//app-ab07.marketo.com", "935-DOM-994", <?php echo $subscription_form_ID ?>, function (form) {

                            //alert('aaa');
                            //console.log('first');
                            form.onSuccess(function (values, followUpUrl) {
                                //console.log('onSuccess');
                                form.getFormElem().parent().hide();
                                //form.getFormElem().hide();
                                // Return false to prevent the submission handler from taking the lead to the follow up url
                               // window.parent.location = followUpUrl;

                               window.parent.location = '<?php echo '//' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . 'confirmation/' ?>';
                
                                // Return false to prevent the submission handler from taking the lead to the follow up url
                                return false;
                            });
                        });
                  //  })(jQuery);
                </script>
                <style>
                    #subscription-form {
                        padding: 16px 20px;
                        border: 3px solid #005a84;
                        text-align: center;
                        margin: auto;
                    }
                    #subscription-form form {
                        width: 100% !important;
                    }
                    #subscription-form form .mktoFieldDescriptor,
                    #subscription-form form .mktoFieldWrap {
                        width: 100% !important;
                        float: none !important;
                    }
                    #subscription-form form .mktoLabel {
                        width: auto !important;
                        max-width: 90% !important;
                        float: none !important;
                        display: inline-block !important;
                    }
                    #subscription-form form .mktoLogicalField,
                    #subscription-form form .mktoLogicalField label {
                        width: auto !important;
                        --float: none !important;
                    }
                    #subscription-form form .mktoOffset,
                    #subscription-form form .mktoGutter  {
                        display: none !important;
                    }
                    #subscription-form form .mktoButtonWrap {
                        margin-left: 0 !important;
                    }
                    #subscription-form form .mktoButton {
                        background-color: #629e3d;
                        border-radius: 5px 5px 5px 5px;
                        -moz-border-radius: 5px 5px 5px 5px;
                        -webkit-border-radius: 5px 5px 5px 5px;
                        border: none;
                        color: #fff !important;
                        padding: 12px 22px;
                        margin: 0 10px;
                        font-weight: 500;
                    }
                </style>
                <div class="home-page-form-success">
                    <?php the_sub_field('on_submit_message') ?>
                </div>

			</div>

		</div>
	</div>
</section>

<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer() ?> 
