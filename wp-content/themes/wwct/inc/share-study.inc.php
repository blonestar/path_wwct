<?php


/* Share Study form on submit - wp_mail() version */
add_action( 'gform_after_submission_6', 'post_to_third_party', 10, 2 ); // Form ID: 6 (Share Study)
function post_to_third_party( $entry, $form ) {
	add_filter( 'wp_mail_content_type', 'set_content_type' );
	
	//add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
	//$headers[] = 'MIME-Version: 1.0';
	//$headers[] = 'Content-type: text/html; charset=UTF-8';
	$headers[] = 'From: Worldwide Clinical Trials <noreply@'.$_SERVER['HTTP_HOST'].'>';
	//$headers[] = 'From: Sharif Karim <skarim@pathinteractive.com>';
	
    error_log('Server HTTP_HOST: ' . $_SERVER['HTTP_HOST']);
	
	// to ref
	$to			= rgar( $entry, '4' );
	$subject	= 'A Study '.rgar($entry, '11').' sent to ' . rgar($entry, '3');
	$body = 'Hi '.rgar($entry, '2').",\n<br>\n<br>\nStudy <a href=\"\">".rgar($entry, '11')."</a> successfuly sent to " . rgar($entry, '6') . '.';
	$sending_message = wp_mail( $to, $subject, $body, $headers );
    error_log('Trying to send email (share study) to referer...');
    error_log($sending_message);
	//error_log(mail( $to, $subject, $body, $headers ));
	
	// to friend
	$headers_friend = $headers;
	//$headers_friend[] = 'Reply-To: '.rgar($entry, '2').' <'.rgar( $entry, '4' ).'>' . "\r\n";
	$to			= rgar( $entry, '6' );
	$subject	= 'A Study '.rgar($entry, '11').' sent from ' . rgar($entry, '2');
	//$body = 'Hi '.rgar($entry, '3').",\n<br>\n<br>\nPlease take a look, you could be inrested in <a href=\"".rgar($entry, '12').'?id='.rgar($entry, '10').'&reffr='.rgar($entry, '4')."\">Study ".rgar($entry, '11')."</a> and you can earn money.\n<br>\n<br>\n" . rgar($entry, '2') . ', ' . rgar($entry, '4');
	//$body = 'Hi '.rgar($entry, '3').",\n<br>\n<br>\nPlease take a look, you could be inrested in <a href=\"#\">Study ".rgar($entry, '11')."</a> and you can earn money.\n<br>\n<br>\n" . rgar($entry, '2') . ', ' . rgar($entry, '4');
	$body = 'Hi '.rgar($entry, '3').",\r\n<br>\r\n<br>\r\nPlease visit link:<br>\r\n" . rgar($entry, '12').'?id='.rgar($entry, '10').'&reffr='.rgar($entry, '4')."\r\n<br>\r\n<br>\r\n" . rgar($entry, '2') . ', ' . rgar($entry, '4');
	//$body = 'Hi '.rgar($entry, '3').",\r\n<br>\r\n<br>\r\nPlease visit link:<br>\r\n<br>\r\n<br>\r\n" . rgar($entry, '2') . ', ' . rgar($entry, '4');
	$sending_message = wp_mail( $to, $subject, $body, $headers_friend ); 
    error_log('Trying to send email (share study) to referer...');
    error_log($sending_message);
	//error_log(mail( $to, $subject, $body, $headers_friend )); 

	remove_filter( 'wp_mail_content_type', 'set_content_type' );
}
add_action('wp_mail_failed', 'log_mailer_errors', 10, 1);
function log_mailer_errors($wp_error){
	error_log("Mailer Error: " . print_r($wp_error, true));
}

function set_content_type( $content_type ) {
	return 'text/html';
}