<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

	<?php if (get_field('page_language')) { ?>
	<link rel="alternate" href="<?php the_field('alternate_url') ?>" hreflang="<?php the_field('page_language') ?>" />
	<?php } ?>
	
	<link rel="shortcut icon" href="<?php echo get_field('favicon', 'option'); ?>" type="image/x-icon">
	<?php wp_head(); ?>

	<script> var $ = jQuery; </script>

	<script>
		function loadAsync(src, callback, relative){
			var baseUrl = "/resources/script/";
			var script = document.createElement('script');
			if(relative === true){
				script.src = baseUrl + src;  
			}else{
				script.src = src; 
			}

			if(callback !== null){
				if (script.readyState) { // IE, incl. IE9
					script.onreadystatechange = function() {
						if (script.readyState == "loaded" || script.readyState == "complete") {
							script.onreadystatechange = null;
							callback();
						}
					};
				} else {
					script.onload = function() { // Other browsers
						callback();
					};
				}
			}
			document.getElementsByTagName('head')[0].appendChild(script);
		}
	</script>

	<?php if (get_field('landing_custom_css')) { ?>
	<style>
		<?php the_field('landing_custom_css') ?>
	</style>
	<?php } ?>		
	
	<?php if (get_field('landing_header_scripts')) { ?>
	<script>
		<?php the_field('landing_header_scripts') ?>
	</script>
	<?php } ?>
	
	<?php echo get_field('tracking_codes_header_1', 'option'); ?>
</head>
<body <?php body_class(__FILE__) ?>>
<?php echo get_field('tracking_codes_header_2', 'option');  ?>

<?php
	
	// include cookies info banner
	set_query_var( 'cookies_pageID', 'option' );
	get_template_part('tpl-part', 'cookies-info');

?>

	<header style="background-image:url(<?php the_field('landing_header_image'); ?>);>"<?php if (get_field('landing_header_dark')) { ?> class="text-white"<?php } ?>>
		<div class="header-line-up"></div>
		<div class="header-line-down"></div>
		<img id="logo" alt="logo" src="<?php echo get_template_directory_uri() ?>/img/worldwide-clinical-trials-globe-logo.png">
		<div class="container h-100">
			<div class="row h-100">
				<div class="col-lg-7  h-100 hero-title-wrapper">
				
					<h1><?php the_title() ?></h1>
					<h6>Please take the quick survey below to see the 2018 results</h6>

				</div>
				<div class="col-lg-5 text-left text-md-left text-lg-right phone-wrapper">
					
					<div class="phone-as-text">
						<span>SPEAK TO A SALES REPRESENTATIVE</span>
						<span>+1-610-964-2000</span>
					</div>
					
				</div>
			</div>
		</div>
	</header>

	<main id="main">


<?php the_post(); ?>


<section class="hero-small-form2">	
		
		<div class="container">					
		<div class="row">					
			<?php if (get_field('landing_marketo_id')) { ?>
			<div class="col-12">
				<div class="marketo-form-wrapper">
							
					<div class="orange-arrow-overlay"></div>
		

					<?php if( get_field('landing_marketo_above_text') ){ ?>
					<div class="marketo-form-before">
						<?php the_field('landing_marketo_above_text') ?>
					</div>
					<?php } ?>
					<div id="mktoForm_<?php echo get_field('landing_marketo_id') ?>" class="marketo-form external_form"></div>
					<script>
						//jQuery(document).ready(function($){
							MktoForms2.loadForm("//app-ab07.marketo.com", "935-DOM-994", <?php echo get_field('landing_marketo_id') ?>, function (form) {
								MktoForms2.$("#mktoForm_<?php echo get_field('landing_marketo_id') ?>").append(form.getFormElem())
								 .find("form")
								 .append("<div class=\"form-column form-column-1 two-fifth\"></div>")
								 .append("<div class=\"form-column form-column-2 three-fifth\"></div>");
								//MktoForms2.$("#mktoForm_<?php echo get_field('landing_marketo_id') ?> form").append("<p>Test 2</p>");
								//console.log(MktoForms2);

								//$(".mktoFormRow:lt(4)").addClass('half-row');
								//$(".mktoFormRow:lt(4)").addClass('half-row');

								var radiolist_num = 0;
								MktoForms2.$( ".mktoFormRow" ).each(function( index ) {
									//console.log( $(this).find('.mktoHtmlText').html() );
									//console.log( index + ": " + $( this ).text() );


									//.html().replace(/(\d)+/g, '<span class="circle-digit">AAA $1</span>');
									if (index <= 13) {
										$(this).detach().appendTo('.form-column-1');
									} else {
										
										$(this).detach().appendTo('.form-column-2');
									}
									

									$(this).find('.mktoCheckboxList').parent().parent().parent().addClass('mkto-checkboxes');
									$(this).find('select').parent().parent().parent().addClass('mkto-select');
									$(this).find('textarea').parent().parent().parent().addClass('mkto-textarea');
									$(this).find( ".mktoRadioList" ).css('width', 'auto');
									
									//console.log('radiolist_num: '+radiolist_num);
									var radiolist = $(this).find('.mktoRadioList');
									//console.log(radiolist.length);
									if (typeof radiolist != 'undefined' && radiolist.length > 0) {
										radiolist.parent().parent().parent().addClass('mkto-radios');
										radiolist_num++;
									} else {
										radiolist_num = 0;
									}
									if (radiolist_num == 1) {
										//	var radiolist_head = radiolist.parent().parent().parent().clone( true );
										//radiolist_head.find('label.mktoLabel').html('&nbsp;');
										//	radiolist.parent().parent().parent().before( radiolist_head.parent().html() );
										//radiolist.parent().parent().parent().before( '<div class="mktoFormRow mkto-radios"><h1>TTTT</h1></div>' );
										
									//	radiolist.parent().parent().parent().clone().insertBefore( this );
										
										var radiolist_head = $(radiolist.parent().parent().parent().clone().wrap('<div></div>').parent().html());
										radiolist.find( "label" ).html('');
										
										radiolist_head.find('label.mktoLabel').html('&nbsp;');
										radiolist_head.addClass('label-only-numbers');
										radiolist_head.find('.mktoRadioList label:before').css('display', 'none');
										radiolist_head.find('.mktoRadioList label').addClass('text-blue').removeAttr('for');
										radiolist_head.find('.mktoRadioList input').remove();
										radiolist_head.find('.mktoFieldDescriptor').removeClass('mktoFieldDescriptor');
										radiolist_head.find('.mktoRequiredField').removeClass('mktoRequiredField');
										radiolist_head.find('.mktoRequired').removeClass('mktoRequired');
										
										radiolist_head.insertBefore( radiolist.parent().parent().parent() );
									}
									if (radiolist_num > 1) {
										radiolist.find( "label" ).html('');
									}
									
									var mktoHtmlText = $(this).find('.mktoHtmlText');
									if (typeof mktoHtmlText.html() != 'undefined') {
										//mktoHtmlText.html().replace(/(\/d)/g, '<span class="circle-digit">AAA</span>');
										mktoHtmlText.html(function(index, html){
											return html.replace(/(\d)\./g, '<span class="circle-digit">$1</span> ');
										});
										mktoHtmlText.html(function(index, html){
											return html.replace(/^<strong>/g, '<strong class="big-title text-blue">');
										});
										//
										//console.log('HEREEEE');
										//console.log(mktoHtmlText.html());
									}
								});
								MktoForms2.$( ".mktoButtonRow" ).detach().appendTo('.form-column-2')
									.find('button').addClass('wide-button').css({ padding: "10px 72px" });
								//MktoForms2.find( ".mktoRadioList" ).css('width', 'auto');
								/*
								MktoForms2
									.$(".mktoFormRow:lt(1)").addClass('two-fifth')
									.$(".mktoFormRow:lt(2)").addClass('two-fifth')
									.$(".mktoFormRow:lt(3)").addClass('two-fifth')
									.$(".mktoFormRow:lt(4)").addClass('three-fifth')
									.$(".mktoFormRow:lt(5)").addClass('three-fifth');*/
								//console.log(MktoForms2.$('#Website_Comments__c'));
								//console.log(MktoForms2.$('#Website_Comments__c').closest('.mktoFormRow'));

								/*
								MktoForms2.$('#Website_Comments__c').closest('.mktoFormRow').css('width','100%');
								MktoForms2.$('input[type="checkbox"]')
									.closest('.mktoFormRow').addClass('form-checkbox').addClass('full-width');
								MktoForms2.$('input[type="checkbox"]').parent().parent()
								.find('.mktoLogicalField.mktoCheckboxList.mktoHasWidth').css('width','25px');
								
								$(".orange-arrow-overlay").detach().appendTo('.mktoButtonWrap.mktoCupidBlue');
								*/
								

								form.onSuccess(function (values, followUpUrl) {
									form.getFormElem().hide();
									window.parent.location = followUpUrl;
									return false;
								});
							});
						//});
					</script>
					<div class="marketo-form-success" style="display:none;">
						<?php the_field('landing_marketo_on_submit_message') ?>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		</div>
				
</section>

<?php if( get_field('content') ){ ?>
<section class="main-content">
	<div class="container">
		<div class="row">
			<div class="col">
				<?php the_field('content') ?>
			</div>
        </div>
    </div>
</section>
<?php } ?>

<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>


	</main>
<!--
	<footer id="footer">


		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col text-center">
						<p>©Worldwide Clinical Trials <?php echo date('Y') ?></p>
					</div>
				</div>
			</div>
		</div>

	</footer>
-->
<?php wp_footer() ?>

<style>

#main {
	min-width: 320px;
}

.phone-as-text {
	-webkit-transition-property: left, top -webkit-transform;
    -webkit-transition-duration: 1s, 1s;
    -webkit-transition-timing-function: ease-out, ease-in;
}
.hero-title-wrapper {
	padding-right: 77px;
}

.text-blue {
	color: #00587c; // dark blue;
}
.mktoFormRow {
	color: #585755;
}
body > header {
	position: relative;
	min-height: 300px;
	border-bottom: 1px solid gray;
	padding: 150px 0 40px 0;
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center center;
}
#logo {
	--border: 1px solid gray;
	position: absolute;
	top: 52%;
	left: 55%;
	width: 80px;
	height: 80px;
	--border-radius: 50%;

	-webkit-transition-property: left, top -webkit-transform;
    -webkit-transition-duration: 1s, 1s;
    -webkit-transition-timing-function: ease-out, ease-in;
}
.header-line-up {
	position: absolute;
	border-top: 1px solid #fff;
	border-right: 1px solid #fff;
	left: 0;
	right: 43%;
	right: calc(45% - 40px);
	top: 30%;
	bottom: 50%;
	bottom: calc(48% + 6px);

	-webkit-transition-property: right -webkit-transform;
    -webkit-transition-duration: 1s;
    -webkit-transition-timing-function: ease-out, ease-in;
}
.header-line-down {
	position: absolute;
	border-right: 1px solid #fff;
	left: 0;
	right: 43%;
	right: calc(45% - 40px);
	top: 80%;
	top: calc(52% + 86px);
	bottom: 0;
	-webkit-transition-property: right -webkit-transform;
    -webkit-transition-duration: 1s;
    -webkit-transition-timing-function: ease-out, ease-in;
}
body > header h1 {
	font-weight: bold;
}

#main {
	margin: 30px 0;
}
.label-only-numbers .mktoRadioList > label:before {
	display: none;
}
.label-only-numbers .mktoRadioList {
	padding: 2px 0px 2px 4px;
}
.label-only-numbers .mktoRadioList > label {
	margin: 0 13px !important;
}

.big-title {
	font-size: 20px;
}

.mktoHtmlText.mktoHasWidth {
	width: 100% !important;
}
.mktoForm .mktoFormRow {
	margin: 14px 0 0px;
}

.mkto-select,
.mkto-radios,
.mkto-checkboxes,
.mkto-textarea {
	padding-left: 42px !important;
	margin-top: 0px;
}
.mkto-textarea textarea {
	resize: vertical !important;
}
.mkto-checkboxes .mktoCheckboxList {
	columns: 2;
	width: 100% !important;
	-webkit-column-break-inside: avoid;
	page-break-inside: avoid;
	break-inside: avoid;
}
.mkto-checkboxes .mktoCheckboxList > *:first-of-type:last-of-type {
    display: inline-block !important;
}

.marketo-form-wrapper .two-fifth {
    width: 40%;
    margin: 0;
    float: left;
    clear: none;
    padding: 0 6px;
}

.marketo-form-wrapper .three-fifth {
    width: 59%;
    margin: 0;
    float: left;
    clear: none;
	margin-left: 10px;
	padding: 0 6px 0 20px;
	border-left: 1px dotted gray;

}

.mkto-radios .mktoGutter,
.form-column-2 .mkto-radios .mktoLabel {
	display: block !important;
	text-align: right;
	text-transform: uppercase;
	font-size: smaller;
}
.form-column-1 .mkto-radios .mktoLabel {
	display: block !important;
	text-align: left;
	text-transform: uppercase;
	font-size: smaller;
}



.mktoRadioList {
	text-align: right;
	width: 174px !important;
}
.mktoRadioList > * {
	float: left;
}
.mktoRadioList label::before {
	--display: none;
}
.form-column-1 .mktoLabel {
	width: 45% !important;
}
.form-column-2 .mktoLabel {
	width: 66% !important;
}
.mktoLabel .mktoAsterix {
	display: inline !important;
	float: none !important;
}
.mktoRadioList ,
.mktoLabel {
	--border: 1px solid gray;
}

.circle-digit {
	display: block;
	width: 32px;
	height: 32px;
	--border: 1px solid gray;
	border-radius: 50%;
	float: left;
	margin: 0 10px 0 0 !important;
	line-height: 32px;
	text-align: center !important;
	background-color: #a2aaad;
	color: #fff;
	font-weight: bold;
}

.mktoForm .mktoButtonRow {
	width: 100% !important;
	text-align: right !important;
}
.mktoButtonRow,
.mktoButtonRow span,
.mktoForm .mktoButtonWrap {
	text-align: right !important;
}

.external_form .mktoButtonRow .mktoButtonWrap.mktoCupidBlue .mktoButton,
.external_form .mktoForm .mktoButtonWrap.mktoRound .mktoButton,
button.mktoButton.wide-button {
	padding: 10px 72px !important;
}
.external_form .mktoButtonRow .mktoButtonWrap.mktoCupidBlue .mktoButton:active,
.external_form .mktoButtonRow .mktoButtonWrap.mktoCupidBlue .mktoButton:hover,
.external_form .mktoForm .mktoButtonWrap.mktoRound .mktoButton:active,
.external_form .mktoForm .mktoButtonWrap.mktoRound .mktoButton:hover {
	padding: 10px 72px !important;
}
.text-white .phone-as-text {
	color: #fff !important;
}

@media (max-width: 1200px) {
	.marketo-form-wrapper .two-fifth,
	.marketo-form-wrapper .three-fifth {
		width: auto;
	}
	.marketo-form-wrapper .three-fifth {
		padding: 0;
		margin: 0;
		border: none;
	}
	.mkto-radios .mktoLabel {
		text-align: right;
	}
	.mkto-radios .mktoGutter,
	.form-column-1 .mkto-radios .mktoLabel {
		text-align: right;
	}
	.form-column-1 .mktoLabel {
		width: 66%;
	}

	#logo {
		left: 60%;
	}
	.header-line-up {
		right: calc(40% - 40px);
	}
	.header-line-down {
		right: calc(40% - 40px);
	}

	.form-column-1 .mktoLabel,
	.form-column-2 .mktoLabel {
		width: 66% !important;
	}
	.phone-wrapper {
		-moz-transition: none;
		-webkit-transition: none;
		-o-transition: color 0 ease-in;
		transition: none;
	}
}

@media (max-width: 990px) {
	
	
	.form-column-1 .mktoLabel,
	.form-column-2 .mktoLabel {
		width: 66% !important;
	}
	
	#logo {
		left: 80%;
	}
	.header-line-up {
		right: calc(20% - 40px);
	}
	.header-line-down {
		right: calc(20% - 40px);
	}
}

@media (max-width: 768px) {
	body > header {
		min-height: 225px;
		padding: 60px 0 25px 0;
	}
	.header-line-up {
    	top: 15%;
	}
	header h1 {
		font-size: 32px;
	}
	.form-column-1 .mktoLabel,
	.form-column-2 .mktoLabel {
		width: 58% !important;
	}
}
@media (max-width: 550px) {
	.mktoForm .mktoRadioList {
		width: 130px !important;
	}
	.mktoForm .mktoRadioList > label,
	.mktoForm .mktoCheckboxList > label {
    	margin-left: 10px;
	}
	.mkto-select,
	.mkto-radios,
	.mkto-checkboxes,
	.mkto-textarea {
		padding-left: 0 !important;
		margin-top: 0px;
	}
	.label-only-numbers .mktoRadioList > label {
		margin: 0 9px 0 7px !important;
	}
	.form-column-1 .mktoLabel,
	.form-column-2 .mktoLabel {
		width: 70% !important;
	}

}
@media (max-width: 524px) {
	.mkto-checkboxes .mktoCheckboxList {
		columns: unset;
	}
	.form-column-1 .mktoLabel,
	.form-column-2 .mktoLabel {
		width: 65% !important;
	}

}
@media (max-width: 514px) {
	.form-column-1 .mktoLabel,
	.form-column-2 .mktoLabel {
		--width: 50% !important;
	}
}
@media (max-width: 480px) {
	header h1 {
		font-size: 26px;
	}
	.mktoForm .mktoFormRow .mktoField {
		clear: none; 
	}
	.mktoForm input[type="url"],
	.mktoForm input[type="text"],
	.mktoForm input[type="date"],
	.mktoForm input[type="tel"],
	.mktoForm input[type="email"],
	.mktoForm input[type="number"],
	.mktoForm textarea.mktoField,
	.mktoForm select.mktoField {
		font-size: 12px;
	}
	.external_form .mktoForm input[type="text"],
	.external_form .mktoForm input[type="url"],
	.external_form .mktoForm input[type="email"],
	.external_form .mktoForm input[type="tel"],
	.external_form .mktoForm input[type="number"],
	.external_form .mktoForm input[type="date"],
	.external_form .mktoForm select.mktoField,
	.external_form .mktoForm textarea.mktoField {
	    padding: 8px 2% !important;
	}
	
	body > header {
		min-height: 150px;
		padding: 60px 0 25px 0;
	}
	#logo {
		top: 44%;
		left: 82%;
		width: 50px;
		height: 50px;
	}
	.header-line-up {
    	top: 22%;
		right: calc(18% - 25px);
		bottom: calc(55% + 6px);
	}
	.header-line-down {
		top: calc(55% + 38px);
		right: calc(18% - 25px);
		bottom: 0;
	}
	.form-column-1 .mktoRadioList ,
	.form-column-2 .mktoRadioList  {
		margin-left: 8px !important;
	}
	.phone-wrapper {
		display: none;
	}
}
@media (max-width: 442px) {
	.form-column-1 .mktoLabel,
	.form-column-2 .mktoLabel {
		width: 58% !important;
	}
}
@media (max-width: 410px) {
	.form-column-1 .mktoLabel,
	.form-column-2 .mktoLabel {
		--width: 50% !important;
	}
	body > header {
		min-height: 135px;
	}
	header h1 {
		font-size: 20px;
	}


}
@media (max-width: 380px) {
	.form-column-1 .mktoLabel,
	.form-column-2 .mktoLabel {
		width: 50% !important;
	}
	.form-column-1 .mktoRadioList ,
	.form-column-2 .mktoRadioList  {
		margin-left: 4px !important;
	}
}

</style>

</body>
</html>