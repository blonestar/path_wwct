<?php
/*
 * Template name: Form (xlsx) Reports test
 */


 
global $wp;
$current_url = home_url(add_query_arg(array(),$wp->request));

 if (@$_POST['submitted']) {
    generate_xlsx();

    //echo $current_url;
 }

 




		/** Sends an e-mail out, good stuff */
		function generate_xlsx( ) {
            global $current_url;
			
            $forms = GFAPI::get_forms();

			/* Gather all the leads and update the last_sent counters */
			foreach ( $forms as $i => $form ) {
				$last_sent = isset( $form['digests']['digest_last_sent'] ) ? $form['digests']['digest_last_sent'] : 0;
$last_sent = 0;

				/* Retrieve form entries newer than the last sent ID */
				global $wpdb;
				$leads_table = RGFormsModel::get_lead_table_name();
				$leads = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $leads_table WHERE form_id = %d AND id > %d AND status = 'active';", $form['id'], $last_sent ) );

				if ( !sizeof( $leads ) ) {
					if( !$digest_report_always ) {
						continue; // Nothing to report on
					}
				} else {
					/* Update the reported id counter */
					$form['digests']['digest_last_sent'] = $leads[sizeof($leads) - 1]->id;
				}

				if ( version_compare( GFCommon::$version, '1.7' ) >= 0 ) {
					/* Seems like 1.7 really messed up the meta structure */
					unset( $form['notifications'] );
					unset( $form['confirmations'] );
				}
				RGFormsModel::update_form_meta( $form['id'], $form );

				$forms[$i]['leads'] = $leads;

				/* Also make a lookup table of all e-mail addresses to forms * /
				foreach ( $form['digests']['digest_emails'] as $email ) {
					if ( !isset( $emails[$email] ) ) $emails[$email] = array();
					$emails[$email] []= $form['id'];
				}
                */
			}

            
            include_once(get_template_directory().'/inc/xlsxwriter.class.php');

			/* Now, let's try and mail stuff */
			//foreach ( $emails as $email => $form_ids ) {



					/* XLSX e-mails */
					$report = 'Report generated at ' . date( 'Y-m-d H:i:s' ) . "\n";
					//$xlsx_attachment = tempnam( sys_get_temp_dir(), '' );
					//$xlsx = fopen( $xlsx_attachment, 'w' );
$xlsx = new XLSXWriter();

					$from = null; $to = null;

//error_log(print_r($form_ids, true));
					$names = array();
					foreach ( $forms as $form_id => $form ) {
						//$form = $forms[$form_id];


error_log($form['title']);
						$names []= $form['title'];
						//fputcsv( $xlsx, array( 'Form: ' . $form['title'] . ' (#' . $form_id . ')' ) );

						$headers = array( 'Date Submitted' );

                        $digest_export_all_fields = true;

						if ( $digest_export_all_fields ) {
							foreach ( $form['fields'] as $field )
								if ( $field['label'] ) $headers []= $field['label'];
						} else {
							foreach ( $form['fields'] as $field )
								if ( $field['label'] && in_array( $field['id'], $digest_export_field_list ) ) $headers []= $field['label'];
						}

						$xlsx_sheet[$form_id] = $headers;
						//fputcsv( $csv, $headers );


						if ( !$form['leads'] ) {
							/* No new entries (but user has opted to receive digests always) */
							$xlsx_sheet[$form_id] = array( 'No new entries.' );
						} else {
							
							$xlsx_data[$form_id]['title'] = $form['title'];
							// labels as first row
							$xlsx_data[$form_id]['data'][] = $xlsx_sheet[$form_id];


							foreach ( $form['leads'] as $lead ) {
								$data = array();

								$lead_data = RGFormsModel::get_lead( $lead->id );
								$data []= $lead->date_created;

								if ( !$from )
									$from = $lead->date_created;
								else
									$to = $lead->date_created;

								foreach ( $form['fields'] as $field ) {
									if ( !$field['label'] ) continue;
									if ( !$digest_export_all_fields && !in_array( $field['id'], $digest_export_field_list ) ) continue;
									$raw_data = RGFormsModel::get_lead_field_value( $lead_data, $field );
                                    if (($raw_data_unserialized = @unserialize($raw_data)) !== false ) {
                                        $raw_data = $raw_data_unserialized;
                                        error_log(print_r($raw_data, true));
                                    }
									if( !is_array( $raw_data ) ) $data []= $raw_data;
									else {
                                        if (!is_array($raw_data[0]))
                                            $data []= implode( ', ', array_filter( $raw_data ) );
                                        else {
                                            $ser_data_row = array();
                                            foreach ($raw_data as $raw_data_single => $raw_data_singlev)
                                                if (is_array($raw_data_singlev))
                                                    foreach ($raw_data_singlev as $rdsk => $rdsv)
                                                        $ser_data_row[] = $rdsk . ": " . $rdsv;
                                                else
                                                    $ser_data_row[] = $raw_data_single . ": " . $raw_data_singlev;
                                                
                                            
                                            $data []= implode( "\n",  $ser_data_row );
                                        }
                                    }   
								}

								//fputcsv( $csv, $data );
								//error_log(print_r($data, true));
								$xlsx_data[$form_id]['data'][] = $data;
							}
						}
						//error_log(print_r($data, true));

						//fputcsv( $csv, array( '--' ) ); /* new line */
					}

					if ( !$to )
						$to = $from;

					$report .= 'Contains entries from ' . $from . " to $to\n";
					$report .= 'See CSV attachment';


					//fclose( $csv );
					//$new_csv_attachment = $csv_attachment . '-' . date( 'YmdHis' ) . '.csv';
					//rename( $csv_attachment, $new_csv_attachment );

$filename = "test-reports.xlsx";
header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');

foreach($xlsx_data as $sheet) {
    foreach($sheet['data'] as $row)
    	$xlsx->writeSheetRow($sheet['title'], $row);
}

$upload_dir = wp_upload_dir();
//$xlsx->writeToFile($upload_dir['basedir'].'/example.xlsx');
$xlsx->writeToStdOut();

//error_log($upload_dir['basedir'].'/example.xlsx');


//error_log('names: ' . print_r($names, true));
//error_log('$lead_data: ' . print_r($lead_data, true));
//error_log('$xlsx_sheet: ' . print_r($xlsx_sheet, true));
//error_log('$xlsx_data: ' . print_r($xlsx_data, true));


//wp_redirect( $current_url);
exit;


					$from = 'From: ' . strtoupper(preg_replace('/www\./i', '', $_SERVER['SERVER_NAME'])) . ' <noreply@' . preg_replace('/www\./i', '', $_SERVER['SERVER_NAME']) . '>';
/*
					wp_mail(
						$email,
						apply_filters(
							'gf_digest_email_subject',
							'Form Digest Report (XLSX): ' . implode( ', ', $names ),
							$names, array( $from, $to ), $new_csv_attachment ),
						$report, null, array( $new_csv_attachment )
					);
					*/

				}
			//}


		

?>
<form action="<?php echo $current_url ?>" method="post">
    <button type="submit">Generate XLSX</button>
    <input type="hidden" name="submitted" value="1">
</form>