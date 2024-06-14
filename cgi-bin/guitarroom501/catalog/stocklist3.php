#!/usr/local/bin/php
<?
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
			$path = DATPATH."guitar/".$_GET['type']."/".substr($upd_index[$i],15,4).".txt";
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

	if($bar_flg){
		//print("<strong><font color=\"#FF6600\">バーゲン</font></strong>");
	}

	if($_GET['type'] == 1){
		$item_num = CATALOG_TYPE_1;
	}elseif($_GET['type'] == 2){
		$item_num = CATALOG_TYPE_2;
	}elseif($_GET['type'] == 3){
		$item_num = CATALOG_TYPE_3;
	}elseif($_GET['type'] == 4){
		$item_num = CATALOG_TYPE_4;
	}

	$idxpath = DATPATH."guitar/upd_index.txt";

	//INDEXファイルRead
	if(!file_read($idxpath,2700,$upd_index)){
		print("File read error!!( ".$idxpath." )<BR>\n");
		exit;
	}

	rsort($upd_index);

	$disp_cnt = 0;

	$old_day = date('Ymd',time()-5184000)+0;

	for($i=0;$i<2700;$i++){
		//INDEXファイルの内容が空の場合、ループ脱出
		if($upd_index[$i] == ""){
			break;
		//表示した件数が12件を超えた場合、ループ脱出
		}elseif($disp_cnt >= 2700){
			break;
		}else{
			$path = DATPATH."guitar/".substr($upd_index[$i],14,1)."/".substr($upd_index[$i],15,4).".txt";
			//データファイルRead
			if(!file_read($path,100,$dat)){
				print("File read error!!( ".$path." )<BR>\n");
				exit;
			}
			mb_convert_variables("UTF-8", "SJIS-win", $dat);

			//売り切れで、内容が二ヶ月より古い場合 or 非表示の場合、表示しない
			if((((int)$dat[11]+0) < $old_day && trim($dat[8]) == "checked") || $dat[49] == "checked"){

			//バーゲンの場合、バーゲン商品のみ
			}elseif(isset($_GET['bargain']) && (!$bar_flg || $dat[7] == "")){

			}else{
				//画像部セット
				//画像ファイルチェック
				$item_name = htmlspecialchars($dat[1])." ".htmlspecialchars($dat[2]);
				if(file_exists(DATPATH."guitar/".substr($upd_index[$i],14,1)."/".substr($upd_index[$i],15,4)."_small.jpg")){
					if($dat[8] != "checked"){
						$dat1txt = "<img src=\"".DATPATH3."guitar/".substr($upd_index[$i],14,1)."/".substr($upd_index[$i],15,4)."_small.jpg\" alt=\"".$item_name."\">";
					}else{
						$dat1txt = "<img src=\"".DATPATH3."guitar/".substr($upd_index[$i],14,1)."/".substr($upd_index[$i],15,4)."_small.jpg\" alt=\"".$item_name."\">";
					}
				}else{
					$dat1txt = "";
				}

				//説明部セット
				$img_txt = "";
				if($dat[8] == "checked"){
					$img_txt .= "<span class=\"red\">SOLD OUT</span>\n";
				}elseif($dat[9] == "checked"){
					$img_txt .= "<span class=\"red\">ON HOLD</span>\n";
				}elseif($dat[5] != "" && $dat[5] != 0 && $dat[6] != "" && $dat[6] != 0 && $dat[5] < $dat[6]){
					$img_txt .= "<span class=\"purple\">MARK DOWN</span>\n";
				}
				if($dat[33] == "new"){
					$img_txt .= "<span class=\"red\">NEW</span>\n";
				}elseif($dat[33] == "used"){
					$img_txt .= "<span class=\"purple\">USED</span>\n";
				}elseif($dat[33] == "vintage"){
					$img_txt .= "<span class=\"purple\">VINTAGE</span>\n";
				}
				$dat2txt = "";
				$dat2txt .= $img_txt;
				$dat2txt .= $dat1txt;
				$dat2txt .= $dat[1]." ".$dat[2];
				if($dat[3] != ""){
					$dat2txt .= " (".$dat[3].")\n";
				}
				$dat2txt .= "<br><span>";
				if($dat[32] == "checked"){
					$dat2txt .="¥ASK";
				}elseif($dat[5] != "" && $dat[5] != 0 && $dat[6] != "" && $dat[6] != 0 && $dat[5] < $dat[6]){
					//旧価格あり
					$dat2txt .= kingaku($dat[6],3,"Y")."　→　<font color=\"#CC0000\">".kingaku($dat[5],3,"Y")."</font>";
				}else{
					//旧価格なし
					$dat2txt .= kingaku($dat[5],3,"Y");
				}

				if($bar_flg && $dat[7] != ""){
					//バーゲン中でバーゲン価格あり
					$dat2txt .= "　→　<font color=\"#FF6600\">".kingaku($dat[7],3,"Y")."</font>";
				}
				$dat2txt .= "</span>";
				$txt[$disp_cnt] .= "<a href=\"".PHPPATH."catalog/detail.php?maker=".substr($upd_index[$i],14,1)."&cd=".substr($upd_index[$i],15,4)."\">".$dat2txt."</a>";
				//カウント インクリメント
				$disp_cnt++;
			}
		}
	}

	//表示
	print('<ul class="product-list">');
	for($i=0;$i<2700;$i++){
		if(isset($txt[$i])){
			print("<li style=\"position: relative;\">");
			print($txt[$i]);
			print("</li>");
		}
	}
	print("</ul>");
?>