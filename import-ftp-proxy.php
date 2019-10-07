<?php
// Note: Anyone could access your data if they guess this URL. You should remove this file from the server
// after importing or name it to something "unguessable". For even better security use an .htaccess rule.
//
// If you're experiencing problems you can uncomment the following line so errors will be sent to the file.
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
//
// Enter the FTP (or HTTP) URL of your data file below.
// $url = "ftp://username:password{@ftp_server/filepath";

// Connection credentials
$ftp_server = 'ftp.server.com';
$ftp_user_name = 'username';
$ftp_user_pass = 'password';

// set up basic connection
$conn_id = ftp_connect($ftp_server);

// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// get contents of the current directory
$filenames = ftp_nlist($conn_id, "HUB/O");

// loop through filenames and extract date in each filename and put it to new array $dates
$dates = array();
$pattern = '/(?<=-)[0-9]+(?=-)/';
foreach ($filenames as $key=>$value) {
    if (preg_match($pattern, $value, $matches)) {
        $dates[$key] = $matches[0];
    }
}

// Get most recent date from an array of dates
$max_date = max(array_map('strtotime', $dates));
$most_recent_date = date('Ymd', $max_date);
$most_recent_date_key = array_search($most_recent_date, $dates);

// Construct URL of the appropriate file
$url = "ftp://phT3025597614406:Ohl1oos8{@pftp.centprod.com/HUB/O" . $filenames[$most_recent_date_key];

// These headers aren't strictly needed but can be helpful
$header_filename = "Content-Disposition: attachment; filename=" . $filenames[$most_recent_date_key];
header('Content-Type: text/plain');
header($header_filename);
header('Pragma: no-cache');

// Fetch the file and echo it
readfile($url);
?>
