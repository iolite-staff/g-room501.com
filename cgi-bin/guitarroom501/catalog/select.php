<?php
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

//バーゲン中か判断
$path = DATPATH."bargain.txt";
if(!file_read($path,2,$bargain)){
	print("File read error!!( ".$path." )<BR>\n");
	exit;
}
if($bargain[0] <= date('Ymd') && $bargain[1] >= date('Ymd')){
	$bar_flg = TRUE;
}else{
	$bar_flg = FALSE;
}

?>
<select name="brand" id="">
	<option value="">ブランド</option>
	<option value="">ALL</option>
<?php

$type = 0;
$search_index = array();

for($type=1;$type<=5;$type++){
	if($type == 1){
		$item_num = CATALOG_TYPE_1;
	}elseif($type == 2){
		$item_num = CATALOG_TYPE_2;
	}elseif($type == 3){
		$item_num = CATALOG_TYPE_3;
	}elseif($type == 4){
		$item_num = CATALOG_TYPE_4;
	}elseif($type == 5){
		$item_num = CATALOG_TYPE_5;
	}
	
	$idxpath = DATPATH."guitar/".$type."/name_index.txt";

	//INDEXファイルRead
	if(!file_read($idxpath,$item_num,$name_index)){
		print("File read error!!( ".$idxpath." )<BR>\n");
		continue;
	}
		
	sort($name_index);

	$old_day = date('Ymd',time()-5184000)+0;

	$cnt = 0;

	for($i=0;$i<$item_num;$i++){
		//INDEXファイルの内容が空の場合、なにもしない
		if($name_index[$i] != ""){
			$path = DATPATH."guitar/".$type."/".substr($name_index[$i],125,4).".txt";
			//データファイルRead
			if(!file_read($path,100,$dat)){
				print("File read error!!( ".$path." )<BR>\n");
				continue;
			}
			mb_convert_variables("UTF-8", "SJIS-win", $dat);

			//売り切れで、内容が二ヶ月より古い場合 or 非表示の場合、表示しない
			if((((int)$dat[11]+0) < $old_day && trim($dat[8]) == "checked") || $dat[49] == "checked"){

			//バーゲンの場合、バーゲン商品のみ
			}elseif(isset($_GET['bargain']) && (!$bar_flg || $dat[7] == "")){

			}else{
				//説明部セット
				$txt = "";
				if($_GET['brand'] != "" && stripos($name_index[$i], $_GET['brand']) !== false){
					$txt .= "<option value=\"".trim($dat[1])."\" selected>".trim($dat[1])."</option>";
				}else{
					$txt .= "<option value=\"".trim($dat[1])."\">".trim($dat[1])."</option>";
				}
				array_push($search_index,$txt);
			}
		}
	}
	$name_index = [];
}

	//表示
	$search_index = array_unique($search_index);
	sort($search_index);
	foreach ($search_index as $index) {
		print($index);
	}	
?>
</select>
<?php
	$txt = [];
?>