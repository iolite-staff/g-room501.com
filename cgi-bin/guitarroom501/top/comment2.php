#!/usr/local/bin/php
<?PHP
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	$path = DATPATH."comment2.txt";

	if(!file_read($path,300,$dat)){
		exit;
	}elseif($dat[0] == "Y"){
		//–{•¶‚ð®Œ`‚µ‚Äy$txtz‚ÉŠi”[
		for($i=1;$i<=5;$i++){
			$txt[$i] = "\n";
			$ln = 0;
			$k = $i * 50;
			for($j = 0; $j < 50; $j++){
				if($dat[$j+$k] != ""){
					$ln = $j + 1;
				}
			}
			if($ln != 0){
				for($j = 0; $j < $ln; $j++){
					$dat[$j+$k] = link_url($dat[$j+$k]);
					$dat[$j+$k] = link_mail($dat[$j+$k]);
					$txt[$i] .= $dat[$j+$k]."\n<br>";
				}
			}
?>
	<font color="<?=$dat[$i]?>" size="<?=$dat[$i+5]?>"><?=$txt[$i]?></font>
<?PHP
		}
	}
?>