#!/usr/local/bin/php
<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	$path = DATPATH."update_day.txt";

	if(!file_read($path,1,$update_day)){
		exit;
	}else{
		print($update_day[0]);
	}

?>