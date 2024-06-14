#!/usr/local/bin/php
<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	$site_url ="http://demo.iolite.co.jp/guitarroom501/";
	$home_url ="http://demo.iolite.co.jp/guitarroom501/";
	//$site_url ="http://www.guitarroom501/";
	//$home_url ="http://www.guitarroom501/";

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
	
/*
	//----- 最新の10件目の更新日付を取得する
	$idxpath = DATPATH."guitar/upd_index.txt";

	//INDEXファイルRead
	if(!file_read($idxpath,800,$upd_index)){
		print("File read error!!( ".$idxpath." )<BR>\n");
		exit;
	}

	rsort($upd_index);

	$disp_cnt = 0;

	for($i=0;$i<800;$i++){
		//INDEXファイルの内容が空の場合、ループ脱出
		if($upd_index[$i] == ""){
			break;
		//表示した件数が10件を超えた場合、ループ脱出
		}elseif($disp_cnt >= 10){
			break;
		}else{
			$path = DATPATH."guitar/".substr($upd_index[$i],14,1)."/".substr($upd_index[$i],15,4).".txt";
			//データファイルRead
			if(!file_read($path,100,$dat)){
				print("File read error!!( ".$path." )<BR>\n");
				exit;
			}
			$new_time = $dat[0] - 1;
			//カウント インクリメント
			$disp_cnt++;
		}
	}
*/
?>
						<table>
							<thead>
								<tr>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th>メーカー / モデル名</th>
									<th>年式</th>
									<th>CONDITION</th>
									<th>
										価格（税込）
<?php
	if($bar_flg){
		print("<strong><font color=\"#FF6600\">バーゲン</font></strong>");
	}
?>
									</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
<?php
	if($_GET['type'] == 1){
		$item_num = CATALOG_TYPE_1;
	}elseif($_GET['type'] == 2){
		$item_num = CATALOG_TYPE_2;
	}elseif($_GET['type'] == 3){
		$item_num = CATALOG_TYPE_3;
	}elseif($_GET['type'] == 4){
		$item_num = CATALOG_TYPE_4;
	}

	$idxpath = DATPATH."guitar/".$_GET['type']."/name_index.txt";

	//INDEXファイルRead
	if(!file_read($idxpath,$item_num,$name_index)){
		print("File read error!!( ".$idxpath." )<BR>\n");
		exit;
	}

	sort($name_index);

	$old_day = date('Ymd',time()-5184000)+0;

	for($i=0;$i<$item_num;$i++){
		//INDEXファイルの内容が空の場合、なにもしない
		if($name_index[$i] != ""){
			$path = DATPATH."guitar/".$_GET['type']."/".substr($name_index[$i],125,4).".txt";
			$img_flont_path = "<img src=\"".$home_url."data/guitar/".$_GET['type']."/".substr($name_index[$i],125,4)."_front.jpg\" alt=\"".$dat[1]." ".$dat[2]." FRONT\" style=\"width:auto; height:100px;\">";
			//データファイルRead
			if(!file_read($path,100,$dat)){
				print("File read error!!( ".$path." )<BR>\n");
				exit;
			}
			mb_convert_variables("UTF-8", "SJIS-win", $dat);

			//売り切れで、内容が二ヶ月より古い場合 or 非表示の場合、表示しない
			if((($dat[11]+0) < $old_day && trim($dat[8]) == "checked") || $dat[49] == "checked"){

			//バーゲンの場合、バーゲン商品のみ
			}elseif(isset($_GET['bargain']) && (!$bar_flg || $dat[7] == "")){

			}else{
				print("<tr>\n");
				print("<td>\n");
				if($dat[8] == "checked"){
					print("<img src=\"./img/soldout.svg\" width=\"34\" height=\"25\" alt=\"sold out\" />\n");
				}elseif($dat[9] == "checked"){
					print("<img src=\"./img/onhold.svg\" width=\"34\" height=\"25\" alt=\"on hold\" />\n");
//				}elseif($dat[0] > $new_time){
//					print("<img src=\"img/new.gif\">\n");
				}elseif($dat[5] != "" && $dat[5] != 0 && $dat[6] != "" && $dat[6] != 0 && $dat[5] < $dat[6]){
					print("<img src=\"./img/markdown.svg\" width=\"34\" height=\"25\" alt=\"mark down\" />\n");
				}
				print("</td>\n");
				print("<td>\n");
				print($img_flont_path);
				print("</td>\n");
				if($dat[8] == "checked"){
					print("<td><span>".$dat[1]."</span>".$dat[2]."</td>\n");
				}else{
					print("<td><span>".$dat[1]."</span><a href=\"".PHPPATH."catalog/detail.php?maker=".$_GET['type']."&cd=".substr($name_index[$i],125,4)."\">".$dat[2]."</a></td>\n");
				}
				print("<td>".$dat[3]."</td>\n");
				print("<td>".$dat[12]."</td>\n");
				$pd_color = "";
				if($dat[5] != "" && $dat[5] != 0 && $dat[6] != "" && $dat[6] != 0 && $dat[5] < $dat[6]){
					$pd_color = " class=\"red\"";
				}
				print("<td".$pd_color.">");
				print(kingaku($dat[5],3,"Y"));
				if($bar_flg && $dat[7] != ""){
					print("<font color=\"#FF6600\"><strong>→".kingaku($dat[7],3,"Y")."</strong></font>");
				}
				print("</td>\n");
				print("<td>");
				if($dat[8] != "checked"){
					print("<a href=\"".PHPPATH."catalog/detail.php?maker=".$_GET['type']."&cd=".substr($name_index[$i],125,4)."\">詳細</a>");
				}
				print("</td>\n");
				print("</tr>\n");
			}
		}
	}

?>
							</tbody>
						</table>