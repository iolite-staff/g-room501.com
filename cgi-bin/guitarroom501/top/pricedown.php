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
	if($bargain[0] <= date('Ymd')
	&& $bargain[1] >= date('Ymd')
	){
		$bar_flg = TRUE;
	}else{
		$bar_flg = FALSE;
	}
?>
<table width="250" border="0" cellpadding="0" cellspacing="0">
<?php

	$idxpath = DATPATH."guitar/upd_index.txt";

	//INDEXファイルRead
	if(!file_read($idxpath,1300,$upd_index)){
		print("File read error!!( ".$idxpath." )<BR>\n");
		exit;
	}

	rsort($upd_index);

	$disp_cnt = 0;

	for($i=0;$i<1300;$i++){
		//INDEXファイルの内容が空の場合、ループ脱出
		if($upd_index[$i] == ""){
			break;
		//表示した件数が10件を超えた場合、ループ脱出
		}elseif($disp_cnt >= 10){
			break;
//		//INDEXファイルの内容が二週間より古い場合、ループ脱出
//		}elseif(substr($upd_index[$i],0,14) < date('YmdHis',time()-1209600)){
//			break;
		}else{
			$path = DATPATH."guitar/".substr($upd_index[$i],14,1)."/".substr($upd_index[$i],15,4).".txt";
			//データファイルRead
			if(!file_read($path,100,$dat)){
				print("File read error!!( ".$path." )<BR>\n");
				exit;
			}
			//プライスダウン欄表示フラグが"checked"で、
			//現在価格・旧価格ともセットされている場合でかつ、
			//現在価格＜旧価格の場合、プライスダウンでかつ、
			//SOLD OUTでないか、SOLD OUTになってから2ヶ月経過していない場合でかつ、
			//Marks Down欄表示設定日が二週間より古い場合でかつ、
			//非表示フラグがcheckedでない場合、表示
			if($dat[10] == "checked"
			&& $dat[5] != ""
			&& $dat[5] != 0
			&& $dat[6] != ""
			&& $dat[6] != 0
			&& $dat[5] < $dat[6]
			&& (($dat[11]+0) >= date('Ymd',time()-5184000)
			 || trim($dat[8]) != "checked"
			 )
			&& ($dat[48]+0) >= date('Ymd',time()-1209600)
			&& $dat[49] != "checked"
			){
		if($disp_cnt == 0){
?>
  <tr>
    <td width="20" height="12">&nbsp;</td>
    <td width="230" height="12" align="center" background="img/bar_red.gif"><img src="img/marksdown.gif" width="93" height="12"></td>
  </tr>
<?
		}
				if($back == ""){
					$back = " background=\"img/bg_sand2.gif\"";
				}else{
					$back = "";
				}

				print("<tr> \n");
				print("  <td>&nbsp;</td>\n");
				print("  <td".$back.">&nbsp;</td>\n");
				print("</tr>\n");
				print("<tr> \n");
				print("  <td height=\"14\">&nbsp;</td>\n");
				print("  <td".$back." height=\"14\"><font size=\"2\">\n");
				if($dat[8] == "checked"){
					print("<font color=\"#CC0000\"><strong>SOLD</strong></font><br>\n");
				}elseif($dat[9] == "checked"){
					print("<font color=\"#336633\"><strong>HOLD</strong></font><br>\n");
				}
				if(mb_strlen($dat[1]) > 10){
					$dat1txt = mb_substr($dat[1],0,10)."<font size=\"2\">...</font>";
				}else{
					$dat1txt = $dat[1];
				}
				if(mb_strlen($dat[2]) > 10){
					$dat2txt = mb_substr($dat[2],0,10)."<font size=\"2\">...</font>";
				}else{
					$dat2txt = $dat[2];
				}
				if($dat[8] != "checked"){
					print($dat1txt." <a href=\"".PHPPATH."catalog/detail.php?maker=".substr($upd_index[$i],14,1)."&cd=".substr($upd_index[$i],15,4)."\">".$dat2txt."</a>　（".$dat[3]."）</font></td>\n");
				}else{
					print($dat1txt." ".$dat2txt."　（".$dat[3]."）</font></td>\n");
				}
				print("</tr>\n");
				print("<tr> \n");
				print("  <td height=\"14\">&nbsp;</td>\n");
				print("  <td".$back." height=\"14\"><font size=\"2\">\n");
				print("".kingaku($dat[6],1)."→<font color=\"#CC0000\"><strong>".kingaku($dat[5],1)."</strong></font>\n");
				if($bar_flg
				&& $dat[7] != ""
				){
					//バーゲン中でバーゲン価格あり
					print("→<font color=\"#FF6600\"><strong>".kingaku($dat[7],1)."</strong></font>\n");
				}
				print("    </font></td>\n");
				print("</tr>\n");
				//カウント インクリメント
				$disp_cnt++;
			}
		}
	}

?>
</table>
