jQuery(document).ready(function($) {
	$('.addressesbl:not(:first) .active').removeClass('active');
	$('.addressesbl:not(:first) .collapsible-content').hide();
	
	
	
	
	function calculate_phases() {
		//console.log('calculating...');
		var sum = 0;
		$('.gfield.phase-step input').each(function(index) {
			var value = parseFloat($(this).val());
			if ($.isNumeric(value)) {
				sum = sum + value;
			} else {
				$('.gfield.phase-step:last-child label').html('Please enter only numbers!');
				$('.gfield.phase-step:last-child label').css('color', 'red');
			}
		});
		
		var sum_text = sum + '%';
		$('.gfield.phase-step:last-child label').html(sum_text);
		if (sum > 100) {
			$('.gfield.phase-step:last-child label').css('color', 'red');
		} else {
			$('.gfield.phase-step:last-child label').css('color', '#000');
		}
		
	}
	$(document).on('keyup', '.gfield.phase-step input', function() {
		calculate_phases();
	});
	calculate_phases();

	// start bxslider
	$('.bxslider').bxSlider();
});