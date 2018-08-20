//window.$ = jQuery.noConflict(true);
var $ = jQuery;

(function( $ ) {
	

	var fullwid = $(window).width();
	if(fullwid>600){
		$("body").removeClass('mob-brow');	
	} else {
		$("body").addClass('mob-brow');	
	}




	// Cookies Info Popup
	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		var expires = "expires="+d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}
	function getCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}
	function checkCookie() {
		var accepted = getCookie("cookie-accepted");
		if (accepted != 1) {
			$('#cookies-info').show();
		}
	}
	checkCookie();
	$('#cookies-info .cookies-close').click(function(){
		setCookie('cookie-accepted', 1, 365);
		$('#cookies-info').hide();
	})
	$('#cookies-info .cookies-accept').click(function(){
		setCookie('cookie-accepted', 1, 365);
		$('#cookies-info').hide();
	})


	
	// In The News
	if ($().SumoSelect) {
		$('#select-year').SumoSelect({
			triggerChangeCombined: true,
			forceCustomRendering: true,
			placeholder: 'YEAR'
		});
		$('#select-month').SumoSelect({
			triggerChangeCombined: true,
			forceCustomRendering: true,
			placeholder: 'MONTH'
		});
	} else {
		console.log('SumoSelect not loaded!');
	}

	// check bxslider is loaded
	if ($().bxSlider) {

		// all sliders
		$('.bxslider').bxSlider();

		// homepage slider
		$('.image-slider-hero').bxSlider({
			auto: true,
			pause: 6000,
			autoHover: true
			//onSlideAfter: function($el, oldIndex, newIndex){
				//
        	//}
		});

	} else {
		console.log('bxSlider not loaded');
	}
	



	// close opened top bar
	$('.close-top-bar-slide').click(function(event){
		$(this).closest('.top-bar-slide').slideUp('fast');
	});

	// click on search icon - open top search bar
	$('.search-btn').click(function(event){
		$('#top-search').slideDown('fast');
		$('#top-search').find('#top-search-field').focus();
	});

	// open submenu as top bar
	$('nav.navbar .menu-item-has-children').click(function(e){
		e.preventDefault();
		var id = $(this).attr('id');
		//$('.top-bar-slide:not(#top-'+id+'):not(.top-bar-search)').slideUp('fast', function() {
		$('.top-bar-slide:not(.top-bar-search)').slideUp('fast', function() {
			$('#top-'+id).slideDown('fast');
		});
	})
	$('.top-bar-slide .current-menu-item').closest('.top-bar-slide').slideDown('fast');

	$('.info_links_block .main-block').click(function(e){		
		$(this).find('a.block-link')[0].click()	;		
	});

	$('.five_items_button .container > .row.as-main > div').click(function(e){		
		$(this).find('h3 a')[0].click()	;		
	});

	$('li.two-item').click(function(e){		
		$(this).find('.mainli h3 a')[0].click()	;		
	});

    // jump to link onselect
    $("select.jump-on-select").on("change", function(){
        var url = $(this).val();
		if (url != '') {
			$('#overlay').fadeIn('fast');
				setTimeout(function(){
					$('#overlay').fadeOut();				
				}, 5000);
			location.href = url;
		}
    });

/*
	// gray overlay on click
	$('a').click(function(){
		if(!$(this).hasClass('hero-call-us')){
			var href = $(this).attr('href');
			var target = $(this).attr('target');		
			//console.log('a clicked! target: ' + target);
			if (typeof href != 'undefined' && href != '#' && href != '' && (typeof target == 'undefined' || target == '_self')) {
				$('#overlay').fadeIn('fast');
				setTimeout(function(){
					$('#overlay').fadeOut();				
				}, 5000);
			}
		}
	});*/


	// contact us
	var $contactUsWebpart = $('.contact-us-webpart');
	var $currentDetail = null;
	if ($contactUsWebpart.length > 0) {
		var $contactOptions = $contactUsWebpart.find('.contact-options');
		$contactOptions.on('change', function() {
			var $detail = $contactUsWebpart.find('.' + this.value);
			if ($detail.length > 0) {
				if ($currentDetail != null) {
					$currentDetail.hide();
				}
				$detail.show();
				$currentDetail = $detail;
				console.log('contact-us js 1');
			}
		});
		console.log('contact-us js 2');
	}

	

	$('.single-studies #field_4_22 .gfield_description').click(function(){
			$('#overlay-calc').fadeIn('fast');
	});
	$('#gform_submit_button_4 span').text('Signup for this study');

	$('.close-bmi').click(function(){
			$('#overlay-calc').fadeOut('fast');
	});

	if($('.bmi-calc').hasClass('stand-active')){
				$('#bmi-weight input').attr({
				    min:"70", 
				    max:"450"
				});
				$('#bmi-height input').attr({
				    min:"3", 
				    max:"7"
				});
			} else {
				$('#bmi-weight input').attr({
				    min:"20", 
				    max:"300"
				});
				$('#bmi-height input').attr({
				    min:"90", 
				    max:"260"
				});
			}
	
	$('.as-radio-item').click(function(){
			$('.as-radio .active').removeClass('active');
			$('.bmi-calc input').val('');
			$(this).addClass('active');
			$('.bmi-calc').toggleClass('stand-active');
			if($('.bmi-calc').hasClass('stand-active')){
				$('#bmi-weight input').attr({
				    min:"70", 
				    max:"450"
				});
				$('#bmi-height input').attr({
				    min:"3", 
				    max:"7"
				});
			} else {
				$('#bmi-weight input').attr({
				    min:"20", 
				    max:"300"
				});
				$('#bmi-height input').attr({
				    min:"90", 
				    max:"260"
				});
			}
			$('#bmi-result .bmi-result-in').slideUp();

	});

	$('.bmi-calc input').change(function() {
		var minv = Number($(this).attr('min'));
		var maxv = Number($(this).attr('max'));
		var curv = $(this).val();
		if((curv < minv)||(curv > maxv)){
            $(this).val(minv);
        }

			if($('.bmi-calc').hasClass('stand-active')){
				var weigh = Number($('#bmi-weight input').val());
				var heigh1 = Number(($('#bmi-height input').val())*12);
				if (heigh1 === Infinity || heigh1 === "" || heigh1 === NaN || heigh1 === 0) {
				    heigh1 = 0;
				}					
				var heigh2 = Number(($('#bmi-height-2 input').val()));
				if (heigh2 === Infinity || heigh2 === "" || heigh2 === NaN || heigh2 === 0) {
				    heigh2 = 0;
				}
				var heigh = heigh1 + heigh2;				
				var bmi = Math.round((weigh/(heigh*heigh))*703);

			} else {
				var weigh = Number($('#bmi-weight input').val());
				var heigh = Number(($('#bmi-height input').val())/100);				
				var bmi = Math.round(weigh/(heigh*heigh));
				
			}

			if (bmi === Infinity || bmi === "" || bmi === NaN || bmi === 0) {
				    bmi = 0;
				    $('#bmi-result .bmi-result-in').slideUp();
				} else {
					$('#xl-bmi').text(bmi);
					if(bmi < 19){
						var res = "Underweight";
					} else if((bmi >= 19)&&(bmi <= 25)){
						var res = "Normal";
					} else if((bmi > 25)&&(bmi < 30)){
						var res = "Overweight";
					} else {
						var res = "Obese";
					}
					$('#strong-bmi span').text(res);
					$('#bmi-result .bmi-result-in').slideDown();
				}
	});

	$('#bmi-done').click(function(){
		var res = Number($('#xl-bmi').text());
		$('#overlay-calc').fadeOut('fast');
		if($("#input_4_22 option[value="+res+"]").length){
			$("#input_4_22").val(res);
		}
	});

	$('.widget.as-accord-holder').each(function(){
		$(this).find('.current_page_item').closest('.as-accord > li').addClass('active');
		$(this).find('.current_page_parent').addClass('active');
		$(this).find('.current_page_item').addClass('active');
		$(this).find('.current_page_item.active').parents('.children li.page_item_has_children.active').addClass('child-active');
		$(this).find('.active > .children').slideToggle();
	});

	$('.global-country h2').click(function(){
		$(this).next('.global-country-addresses').slideToggle();
		$(this).toggleClass('active');
	});

/*
	$('#menu-main-menu').addClass('mega-menu');

	$('#mega-helper .menu-addon').each(function(){
		var pos = ($(this).attr('data-pos'))-1;
		var html = $(this);
		$('.mega-menu').find( "li:eq("+pos+") > .sub-menu" ).append(html);
		$('#mega-helper').remove();

	});

	$('.mega-menu li').each(function(){
		$(this).hover(function(){
		    $(this).children('.sub-menu').fadeIn();
		}, function(){
		    $(this).children('.sub-menu').hide();
		});
	});
	*/

	$('.widget.widget_categories select').parent().each(function(){
		$(this).wrap("<div class='styled-select'></div>");
	});

	$('.widget.widget_green_with_button_widget').each(function(){
		$(this).addClass("widget_green_box").addClass('text-center');
	});

/*
	$('section.main-content iframe').each(function(){
		$(this).wrap("<div class='videoWrapper'></div>");
	});
	*/




	/*$('.as-accord > li > a').click(function(event){	
		if($(this).parent().find('.children').length){
			if(!$(this).attr('clicked')){				
				if(!$(this).closest('.as-accord > li').hasClass('active')){
					event.preventDefault();	
					$(this).closest('.as-accord').find('.active > a').removeAttr('clicked');
					$(this).attr('clicked','once');
					$(this).closest('.as-accord').find('.active .children').slideToggle();
					$(this).closest('.as-accord').find('.active').removeClass('active');
					$(this).closest('.as-accord > li').addClass('active');
					$(this).closest('.as-accord').find('.active .children').slideToggle();
				} else {
					event.preventDefault();	
					$(this).attr('clicked','once');				
				}			
			} else if($(this).attr('clicked') == 'once') {
				if($(this).parent().hasClass('active')){
					var href = $(this).attr('href');
					var target = $(this).attr('target');		
					//console.log('a clicked! target: ' + target);
					if (typeof href != 'undefined' && href != '#' && href != '' && (typeof target == 'undefined' || target == '_self')) {
						$('#overlay').fadeIn('fast');
						setTimeout(function(){
							$('#overlay').fadeOut();				
						}, 5000);
					}
				}
			} else {
				$(this).attr('clicked','twice');
			}
		}	
	});*/

	$('.accordian h3').click(function(){
		$(this).next('.accordian-content').slideToggle();
		$(this).toggleClass('active');
		$(this).find('i').toggleClass('fa-plus-square-o').toggleClass('fa-minus-square-o');
	});

	function long_dates_check_set() {
		var bh = $(this).height();
		if(bh>144){$(this).addClass('long-dates')}
	}
	$('.current-study .dates').each(function(){
		long_dates_check_set();
	});

	$('.more-dates').on('click', function(){
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



	/* --- read more, studies --- */
	
    var moretext = 'Show more <i class="fa fa-caret-down" aria-hidden="true"></i>';
    var lesstext = 'Show less <i class="fa fa-caret-up" aria-hidden="true"></i>';
	
    $('.study-info .more').each(function() {
        var content = $(this).html();
		var c = content.replace(/<p.*?>|<\/p>/g,'')
					.trim()
					.replace(/<br\s*[\/]?>/gi,"\n")
					.split('\n');
		//console.log(c);
		//console.log(c.length);
		var html = '';
		for (var i = 1, len = c.length; i <= len; i++) {
			if (len > 2 && i == 3) {
				html += '<span class="more-content">';
			}
			html += c[i-1] + "<br>";
			if (len > 2 && i == len) {
				html += '</span>\n<a href="" class="more-link text-right">' + moretext + '</a><a href="" class="less-link text-right">' + lesstext + '</a>';
			}
		}
		$(this).html(html);
    });
 
    $(".more-link").click(function(){
		$(this).hide();
		$(this).parent().find('.more-content').slideDown();
		$(this).parent().find('.less-link').css('display', 'block');
        return false;
    });
 
    $(".less-link").click(function(){
		$(this).hide();
		$(this).parent().find('.more-content').slideUp();
		$(this).parent().find('.more-link').show();
        return false;
    });




	$('.hero-contact a.hero-call-us').click(function(event){
		if($('body').hasClass('mob-brow')){
           $(this).addClass('active');
		} else {
			event.preventDefault();
			$(this).removeClass('active');
		}		
	});

	$('.single-studies .gform_fields > li').each(function(){
		var name = $(this).find('.gfield_label').text();
		$(this).find('input[type="text"]').attr('placeholder',name).closest('.gfield').addClass('made-place');
	});
	$('.single-studies .gform_fields > li.dual-emails .ginput_complex span').each(function(){
		var name = $(this).find('label').text();
		$(this).find('input[type="text"],input[type="email"]').attr('placeholder',name).closest('.gfield').addClass('made-place');
	});






	// slider
	/*
	$('.image-slider-webpart').each(function() {
		var $slider = $(this);
		$slider.slick({
			arrows: true,
			dots: true,
			autoplay: true,
			autoplaySpeed: 12000,
			slide: '.image-slide',
			prevArrow: '.prev-slide',
			nextArrow: '.next-slide'
		});
	});*/





	// Initialize Slidebars
	var controller = new slidebars();
	controller.init();

	// Toggle Slidebars
	$( '#mobile-menu-button' ).on( 'click', function ( event ) {
	  // Stop default action and bubbling
	  event.stopPropagation();
	  event.preventDefault();

	  // Toggle the Slidebar with id 'id-1'
	  controller.toggle( 'id-1' );
	} );

    var t = 1;
	$('nav.mobile-menu-wrapper li a').each(function() {
		var text = $(this).text();
		var par = $(this).parent();
		if(par.hasClass('menu-item-has-children')){
			par.prepend('<label for="drop-'+t+'" class="toggle">'+text+' +</label>');
			par.children('.sub-menu').before('<input type="checkbox" id="drop-'+t+'"/>')
		}
		t++;
	});




	// image modal
	$('#imageModal').on('shown.bs.modal', function (e) {
		var invoker = $(e.relatedTarget);
		var src = invoker.data('imagesrc');
		$('#imageModal img').attr('src', src);
		//console.log('test');
		//console.log($(this).data('imagesrc'));
		//$('#imageModal img').src('')
	});
	$('#imageModal').click(function(){
		$(this).modal('hide');
		//$('#imageModal img').attr('src', '/wp-admin/images/wpspin_light-2x.gif');
		$('#imageModal img').attr('src', $('#imageModal img').data('spinner'));
	});


	
	//FUNCTION TO GET AND AUTO PLAY YOUTUBE VIDEO FROM DATATAG
	function autoPlayYouTubeModal(){
		var $ = jQuery;
		var trigger = $("body").find('[data-toggle="modal"]');
		trigger.click(function() {
			var theModal = $(this).data( "target" );
			var videoSRC = $(this).attr( "data-theVideo" );
			//videoSRCauto = videoSRC+"?autoplay=1";
			videoSRCauto = videoSRC;
			$(theModal+' iframe').attr('src', videoSRCauto);
			$(theModal).on('hidden.bs.modal', function () {
				$(theModal+' iframe').removeAttr('src');
			})
		});
	}
	autoPlayYouTubeModal();


	
})(jQuery);




/*
* Button chat
* - change button status
* - open chat popup
*/ 

if (typeof Tawk_API == 'undefined') { 
	Tawk_API = {}; 
}

Tawk_API = Tawk_API || {};

(function( $ ) {

	Tawk_API.onLoad = function(){
		var pageStatus = Tawk_API.getStatus();
		tawk_butt_set_button_title(pageStatus);
	};

	$('.btn-chat').on('click',function(e){
		//console.log('tawk button clicked');
		e.preventDefault();
		//Tawk_API.showWidget();
		//Tawk_API.popup();
		Tawk_API.maximize();
	})

	Tawk_API.onStatusChange = function (status){
		tawk_butt_set_button_title(status);
	};

	function tawk_butt_set_button_title(status) {

		var title = '';
		
		if(status === 'online')
		{
			$('.btn-chat').each(function(){
				title = $(this).attr('data-title-online');
				$(this).find('span').html(title);
			});
		}
		else if(status === 'away')
		{
			$('.btn-chat').each(function(){
				title = $(this).attr('data-title-away');
				if (title == '') {
					title = $(this).attr('data-title-online');
				}
				$(this).find('span').html(title);
			});
		}
		else if(status === 'offline')
		{
			$('.btn-chat').each(function(){
				title = $(this).attr('data-title-offline');
				if (title == '') {
					title = $(this).attr('data-title-online');
				}
				$(this).find('span').html(title);
			});
		}

	}

})(jQuery);