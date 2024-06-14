#!/usr/local/bin/php
<?php
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');
require_once('../inc/h_top.inc');

?>
<?php
	$Ym = date('Ym',time());
	dispCalender($Ym);
?>
<?php
	if(date('m') == 12){
		$Ym = (date('Y')+1) . "01";
	}else{
		$Ym = date('Ym') + 1;
	}
	dispCalender($Ym);
?>
