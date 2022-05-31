<?php

require 'helpers.php';

function convert( $csv_file_name, $exported_file_name, $data_directory = 'data' ) {
    logger( 'Starting Convert process...', 'w' );

    logger( 'Checking if data directory exists...' );
    if ( !file_exists( $data_directory ) ) {
        logger( 'Data directory does not exist, creating...', 'w' );
        mkdir( $data_directory );
    }

    logger( 'Checking if data directory is writable...' );
    if ( !is_writable( $data_directory ) ) {
        logger( 'Data directory is not writable, exiting...', 'e' );
        exit;
    }

    try {
        logger( 'Checking if CSV file exists...' );
        $old_data = require $data_directory . '/' . $csv_file_name;
        logger( 'CSV file exists, ...', 's' );

        $id_store_array = [];
        $filename  = ($data_directory . '/' . $csv_file_name);

        logger( 'Opening CSV file ...' );
        $file = fopen($filename, "r");
		
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
				if($getData[0] !=null)
				{
					array_push($id_store_array,$getData[0]);
				}
	         }
			
	         fclose($file);	

		$array_list = implode($id_store_array, ',');
        logger( 'User array list are...');
        logger($array_list ,'s');
        logger('Please check your data directory, here you can find idList.txt file.');

		$myfile = fopen($data_directory . '/' ."idList.txt", "w") or die("Unable to open file!");
		$txt = implode($id_store_array, ',');
		fwrite($myfile, $txt);
        logger('Thank you, your data converted successfully');

    }catch ( \Throwable$th ) {
        logger( 'Error: ' . $th->getMessage(), 'e' );
    }
}