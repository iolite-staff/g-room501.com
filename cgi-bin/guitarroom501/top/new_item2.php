#!/usr/local/bin/php

<table>
							<thead>
								<tr>
									<th>&nbsp;</th>
									<th>ブランド</th>
									<th>器種</th>
									<th>モデル名</th>
									<th>年代</th>
									<th>コンディション</th>
									<th>
										価格<small>（税込）</small>

<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');
?>
										</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>

	<?php

	//バーゲン中か判断
	$path = DATPATH."bargain.txt";
	if(!file_read($path,2,$bargain)){
		print("File read error!!( ".$path." )<BR>\n");
		exit;
	}
	if($bargain[0] <= date('Ymd')
	&& $bargain[1] >= date('Ymd')
	){
		$bar_flg = TRUE;
	}else{
		$bar_flg = FALSE;
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
				$imgpath[$disp_cnt] = "";
				$txt[$disp_cnt] = "";
			//バーゲンの場合、バーゲン商品のみ
			}elseif(isset($_GET['bargain']) && (!$bar_flg || $dat[7] == "")){
			}else{
				//画像部セット
				//画像ファイルチェック
/* 				$item_name = htmlspecialchars($dat[1])." ".htmlspecialchars($dat[2]);
				if(file_exists(DATPATH."guitar/".substr($upd_index[$i],14,1)."/".substr($upd_index[$i],15,4)."_small.jpg")){
					if($dat[8] != "checked"){
						$dat1txt = "<img src=\"".DATPATH3."guitar/".substr($upd_index[$i],14,1)."/".substr($upd_index[$i],15,4)."_small.jpg\" alt=\"".$item_name."\">";
					}else{
						$dat1txt = "<img src=\"".DATPATH3."guitar/".substr($upd_index[$i],14,1)."/".substr($upd_index[$i],15,4)."_small.jpg\" alt=\"".$item_name."\">";
					}
				}else{
					$dat1txt = "";
				}
 */
				//説明部セット
				$img_txt = "";
				$img_txt .= "<tr><td>";
				if($dat[8] == "checked"){
					$img_txt .= "<span class=\"new\">SOLD OUT</span>\n";
				}elseif($dat[9] == "checked"){
					$img_txt .= "<span class=\"new\">ON HOLD</span>\n";
				}elseif($dat[5] != "" && $dat[5] != 0 && $dat[6] != "" && $dat[6] != 0 && $dat[5] < $dat[6]){
					$img_txt .= "<span class=\"new\">MARK DOWN</span>\n";
				}
				if($dat[33] == "new"){
					$img_txt .= "<span class=\"new\">NEW</span>\n";
				}elseif($dat[33] == "used"){
					$img_txt .= "<span class=\"new\">USED</span>\n";
				}elseif($dat[33] == "vintage"){
					$img_txt .= "<span class=\"new\">VINTAGE</span>\n";
				}
				if(substr($upd_index[$i],14,1)=="1"){
					$inst_cat = "<a href=\"".BASEPATH."inventory/category1.html\">Electric Guitar</a>";
				}elseif(substr($upd_index[$i],14,1)=="2"){
					$inst_cat = "<a href=\"".BASEPATH."inventory/category2.html\">Electric Bass</a>";
				}elseif(substr($upd_index[$i],14,1)=="3"){
					$inst_cat = "<a href=\"".BASEPATH."inventory/category3.html\">Acoustic Guitar</a>";
				}elseif(substr($upd_index[$i],14,1)=="4"){
					$inst_cat = "<a href=\"".BASEPATH."inventory/category4.html\">Others</a>";
				}			
				$img_txt .= "</td>";
				$dat2txt = "";
				$dat2txt .= $img_txt;
				$dat2txt .= $dat1txt;
				$dat2txt .= "<td>".$dat[1]."</td><td>".$inst_cat."</td><td>";
				$dat2txt .= "<a href=\"".PHPPATH."catalog/detail.php?maker=".substr($upd_index[$i],14,1)."&cd=".substr($upd_index[$i],15,4)."\">".$dat[2]."</a></td>";
				$dat2txt .= "<td>".$dat[3]."</td>\n<td>".$dat[12]."</td>\n<td>";
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
				$dat2txt .= "</td></tr>";
				$txt[$disp_cnt] .= "<a href=\"".PHPPATH."catalog/detail.php?maker=".substr($upd_index[$i],14,1)."&cd=".substr($upd_index[$i],15,4)."\">".$dat2txt."</a>";

				//カウント インクリメント
				$disp_cnt++;
			}
		}
	}

	//表示
	for($i=0;$i<count($upd_index);$i++){
		if(isset($txt[$i])){
			print($txt[$i]);
		}
	}	
?>

</tbody>
</table>

<?php
	if($bargain[0] <= date('Ymd')
	&& $bargain[1] >= date('Ymd')
	&&(!strstr($_SERVER['REQUEST_URI'], 'bargain'))
	){
		print("<a href=\"./bargain.html\" class=\"btn_more\" style=\"margin:20px auto 0; display:block;\">バーゲン中の商品</a>\n");
	}elseif($bargain[0] <= date('Ymd')
	&& $bargain[1] >= date('Ymd')
	&&(strstr($_SERVER['REQUEST_URI'], 'bargain'))
	){
		print("<a href=\"./index.html\" class=\"btn_more\" style=\"margin:20px auto 0; display:block;\">全ての商品をみる</a>\n");
	}else{
}
?>