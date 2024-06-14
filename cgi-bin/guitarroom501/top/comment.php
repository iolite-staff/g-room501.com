#!/usr/local/bin/php
<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	$path = DATPATH."comment.txt";

	if(!file_read($path,2,$comment)){
		exit;
	}elseif($comment[0] != "checked"){
		print($comment[1]);
	}
?>