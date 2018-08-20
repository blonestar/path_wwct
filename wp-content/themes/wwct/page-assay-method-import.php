<?php


/*
 * CSV parser - the REAL one!
 */
function csv_to_array($filename='', $delimiter=',')
{
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;
    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        {
			$row = array_map("utf8_encode", $row); //added
            if(!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}


if ( isset($_POST["submit"]) ) {

   if ( isset($_FILES["file"])) {

            //if there was an error uploading the file
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";

        }
        else {
						
			//$insert =  $_GET['insert'];
			//if ($insert==2) {
				$csv = csv_to_array($_FILES["file"]["tmp_name"]);
				echo "<pre>";
				print_r($csv);
				echo "</pre>";
				
				
				foreach($csv as $line) {
					$title = preg_replace('/\n+/', '; ', $line['name']);
						// Gather post data.
					$post_data = array(
						'post_type'		=> 'assays',
						'post_title'    => $title,
						'post_content'  => '',
						'post_status'   => 'publish',
						'post_author'   => 1,
						'comment_status' => 'closed',
						'ping_status' => 'closed'
						//'post_category' => array( 8,39 )
					);
					 
					 
					// Insert the post into the database.
					$post_id = wp_insert_post( $post_data );
					update_field('assay_atm', $line['atm'], $post_id);
					update_field('assay_analytename', $line['name'], $post_id);
					update_field('assay_lloq', $line['lloq'], $post_id);
					update_field('assay_uloq', $line['uloq'], $post_id);
					update_field('assay_units', $line['units'], $post_id);
					update_field('assay_species', $line['species'], $post_id);
					update_field('assay_matrix', $line['matrix'], $post_id);
					update_field('assay_status', $line['status'], $post_id);
					
					
				}
				echo "Finished.";
				
				
			//}

		}
   }
} else {

?>


<table width="600">
	<form action="" method="post" enctype="multipart/form-data">

	<tr>
		<td width="20%">Select file</td>
		<td width="80%"><input type="file" name="file" id="file" /></td>
	</tr>

	<tr>
		<td>Submit</td>
		<td><input type="submit" name="submit" /></td>
	</tr>

	</form>
</table>

<?php } ?>