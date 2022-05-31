<?php

require 'service.php';

$data_directory     = 'data'; // directory to get & store data, must be writable and readable
$csv_file_name      = 'customers.csv'; // Main file to be updated
$exported_file_name = 'idList.txt'; // Name of the exported file

convert( $csv_file_name, $exported_file_name, $data_directory );