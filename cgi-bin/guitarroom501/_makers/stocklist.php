#!/usr/local/bin/php
<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

$maker_name[1] = "FURCH GUITARS";

	//バーゲン中か判断
	$path = DATPATH."bargain.txt";
	if(!file_read($path,2,$bargain)){
		print("File read error!!( ".$path." )<BR>\n");
		exit;
	}
	if($bargain[0] <= date('Ymd')
	&& $bargain[1] >= date('Ymd')
	){
//2005/5/16 H.Yamamura Del Makersはバーゲンなし
//		$bar_flg = TRUE;
	}else{
		$bar_flg = FALSE;
	}

	for($i=0;$i<10;$i++){
		$mkrpath = DATPATH."makers/makers".$i.".txt";
		if(!file_read($mkrpath,1000,$makerdat)){
			print("File read error!!( ".$path." )<BR>\n");
			exit;
		}
	//メーカー名
		$maker_name[$i] = $makerdat[0];
	//タイトル１
		$maker_title[$i][1] = $makerdat[0];
	//本文１
		//最大行数を求める
		$gyosuu = 0;
		for($j=10;$j<99;$j++){
			if($makerdat[$j] != ""){
				$gyosuu = $j;
			}
		}
		//マルチラインテキストの生成
		$text = "";
		for($j=10;$j<$gyosuu+1;$j++){
			$maker_text[$i][1] .= $makerdat[$j]."<br>\n";
		}

		for($bl=1;$bl<10;$bl++){
		//タイトル
			$maker_title[$i][$bl+1] = $makerdat[$bl];
		//本文
			//最大行数を求める
			$gyosuu = 0;
			for($j=($bl*100);$j<(($bl*100)+99);$j++){
				if($makerdat[$j] != ""){
					$gyosuu = $j;
				}
			}
			//マルチラインテキストの生成
			$text = "";
			for($j=($bl*100);$j<$gyosuu+1;$j++){
				$maker_text[$i][$bl+1] .= $makerdat[$j]."<br>\n";
			}
		}
	}


//メーカーループ
	for($i=0;$i<10;$i++){
		if($maker_name[$i]!=""){
?>
<a name="ank<?=$i?>"></a>
<table width="640" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <th height="20"><a href="#ank0"><font size="2"><?=$maker_name[0]?></font></a></th>
    <th><a href="#ank1"><font size="2"><?=$maker_name[1]?></font></a></th>
    <th><a href="#ank2"><font size="2"><?=$maker_name[2]?></font></a></th>
    <th><a href="#ank3"><font size="2"><?=$maker_name[3]?></font></a></th>
    <th><a href="#ank4"><font size="2"><?=$maker_name[4]?></font></a></th>
  </tr>
  <tr>
    <th height="20"><a href="#ank5"><font size="2"><?=$maker_name[5]?></font></a></th>
    <th><a href="#ank6"><font size="2"><?=$maker_name[6]?></font></a></th>
    <th><a href="#ank7"><font size="2"><?=$maker_name[7]?></font></a></th>
    <th><a href="#ank8"><font size="2"><?=$maker_name[8]?></font></a></th>
    <th><a href="#ank9"><font size="2"><?=$maker_name[9]?></font></a></th>
  </tr>
</table>
<table width="640" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr valign="top">
    <td height="7" colspan="4" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td width="7" height="4" background="../img/bg_top.gif"><font size="1"><img src="img/clear.gif" width="7" height="7"></font></td>
    <td width="321" height="4" background="../img/bg_top.gif"><font size="1"><img src="img/clear.gif" width="7" height="7"></font></td>
    <td width="321" height="4" align="right" background="../img/bg_top.gif"><font size="1"><img src="img/clear.gif" width="7" height="7"></font></td>
    <td width="8" align="right" background="../img/bg_right_side.gif"><font size="1"><img src="img/clear.gif" width="7" height="7"></font></td>
  </tr>
  <tr>
    <td width="7" background="../img/bg_left_side.gif">&nbsp;</td>
    <td valign="middle" background="../img/bg_sand.gif"><img src="../img/nail.gif" alt="画像" width="25" height="36"><font color="#660033" size="2">
    </font></td>
    <td align="right" background="../img/bg_sand.gif"><img src="../img/nail.gif" alt="画像" width="25" height="36"></td>
    <td width="8" align="right" background="../img/bg_right_side.gif">&nbsp;</td>
  </tr>
  <tr>
    <td width="7" background="../img/bg_left_side.gif">&nbsp;</td>
    <td colspan="2" valign="middle" background="../img/bg_sand.gif">
<?php

		//1
			if($maker_title[$i][1] != ""
			|| file_exists(DATPATH."makers/makers".$i."_1.jpg")
			|| $maker_text[$i][1] != ""
			){
				print("<p><font size=\"2\">");
				//--- タイトルテキスト
				if($maker_title[$i][1] != ""){
					print("<strong>■".$maker_title[$i][1]."</strong><br>\n");
				}
				//--- 画像
				if(file_exists(DATPATH."makers/makers".$i."_1.jpg")){
					print("<img align=\"left\" src=\"".DATPATH2."makers/makers".$i."_1.jpg"."\" vspace=\"10\" hspace=\"10\">\n");
				}
				//--- 本文テキスト
				print($maker_text[$i][1]."<br>\n");
				print("<br clear=\"all\"></font></p>");
			}
		//2
			if($maker_title[$i][2] != ""
			|| file_exists(DATPATH."makers/makers".$i."_2.jpg")
			|| $maker_text[$i][2] != ""
			){
				print("<p><font size=\"2\">");
				//--- タイトルテキスト
				if($maker_title[$i][2] != ""){
					print("<strong>■".$maker_title[$i][2]."</strong><br>\n");
				}
				//--- 画像
				if(file_exists(DATPATH."makers/makers".$i."_2.jpg")){
					print("<img align=\"right\" src=\"".DATPATH2."makers/makers".$i."_2.jpg"."\" vspace=\"10\" hspace=\"10\">\n");
				}
				//--- 本文テキスト
				print($maker_text[$i][2]."<br>\n");
				print("<br clear=\"all\"></font></p>");
			}
		//3
			if($maker_title[$i][3] != ""
			|| file_exists(DATPATH."makers/makers".$i."_3.jpg")
			|| $maker_text[$i][3] != ""
			){
				print("<p><font size=\"2\">");
				//--- タイトルテキスト
				if($maker_title[$i][3] != ""){
					print("<strong>■".$maker_title[$i][3]."</strong><br>\n");
				}
				//--- 画像
				if(file_exists(DATPATH."makers/makers".$i."_3.jpg")){
					print("<img align=\"right\" src=\"".DATPATH2."makers/makers".$i."_3.jpg"."\" vspace=\"10\" hspace=\"10\">\n");
				}
				//--- 本文テキスト
				print($maker_text[$i][3]."<br>\n");
				print("<br clear=\"all\"></font></p>");
			}
		//4
			if($maker_title[$i][4] != ""
			|| file_exists(DATPATH."makers/makers".$i."_4.jpg")
			|| $maker_text[$i][4] != ""
			){
				print("<p><font size=\"2\">");
				//--- タイトルテキスト
				if($maker_title[$i][4] != ""){
					print("<strong>■".$maker_title[$i][4]."</strong><br>\n");
				}
				//--- 画像
				if(file_exists(DATPATH."makers/makers".$i."_4.jpg")){
					print("<img align=\"right\" src=\"".DATPATH2."makers/makers".$i."_4.jpg"."\" vspace=\"10\" hspace=\"10\">\n");
				}
				//--- 本文テキスト
				print($maker_text[$i][4]."<br>\n");
				print("<br clear=\"all\"></font></p>");
			}
		//5
			if($maker_title[$i][5] != ""
			|| file_exists(DATPATH."makers/makers".$i."_5.jpg")
			|| $maker_text[$i][5] != ""
			){
				print("<p><font size=\"2\">");
				//--- タイトルテキスト
				if($maker_title[$i][5] != ""){
					print("<strong>■".$maker_title[$i][5]."</strong><br>\n");
				}
				//--- 画像
				if(file_exists(DATPATH."makers/makers".$i."_5.jpg")){
					print("<img align=\"right\" src=\"".DATPATH2."makers/makers".$i."_5.jpg"."\" vspace=\"10\" hspace=\"10\">\n");
				}
				//--- 本文テキスト
				print($maker_text[$i][5]."<br>\n");
				print("<br clear=\"all\"></font></p>");
			}

			print("<table width=\"485\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n");

			$idxpath = DATPATH."makers/".$i."/name_index.txt";

			//INDEXファイルRead
			if(!file_read($idxpath,50,$name_index)){
				print("File read error!!( ".$idxpath." )<BR>\n");
				exit;
			}

			sort($name_index);

			$disp_cnt = 0;
			$imgpath[0] = "<img src=\"img/clear.gif\" width=\"56\" height=\"100\" border=\"0\">";
			$imgpath[1] = "<img src=\"img/clear.gif\" width=\"56\" height=\"100\" border=\"0\">";
			$imgpath[2] = "<img src=\"img/clear.gif\" width=\"56\" height=\"100\" border=\"0\">";
			$imgpath[3] = "<img src=\"img/clear.gif\" width=\"56\" height=\"100\" border=\"0\">";
			$imgpath[4] = "<img src=\"img/clear.gif\" width=\"56\" height=\"100\" border=\"0\">";
			$txt[0] = "<td>&nbsp;</td>";
			$txt[1] = "<td>&nbsp;</td>";
			$txt[2] = "<td>&nbsp;</td>";
			$txt[3] = "<td>&nbsp;</td>";;
			$txt[4] = "<td>&nbsp;</td>";;
			$background[0] = "";
			$background[1] = "";
			$background[2] = "";
			$background[3] = "";;
			$background[4] = "";;

			$old_day = date('Ymd',time()-5184000)+0;

			$back = "";
			for($j=0;$j<50;$j++){
				//INDEXファイルの内容が空の場合、なにもしない
				if($name_index[$j] != ""){
					$path = DATPATH."makers/".$i."/".substr($name_index[$j],125,4).".txt";
					//データファイルRead
					if(!file_read($path,100,$dat)){
						print("File read error!!( ".$path." )<BR>\n");
						exit;
					}
			print("<!--");
			print_r($dat);
			print("-->");
					//売り切れで、内容が二ヶ月より古い場合 or 非表示の場合、表示しない
					if((($dat[11]+0) < $old_day
					 && trim($dat[8]) == "checked"
					 )
					|| $dat[49] == "checked"
					){

					//バーゲンの場合、バーゲン商品のみ
					}elseif(isset($_GET['bargain'])
					&& (!$bar_flg
					 || $dat[7] == ""
					 )
					){

					}else{
						//背景
						$background[$disp_cnt] = " background=\"img/minipaper.gif\"";

						//画像部セット
						//画像ファイルチェック
						if(file_exists(DATPATH."makers/".$i."/".substr($name_index[$j],125,4)."_small.jpg")){
							if($dat[8] != "checked"){
								$imgpath[$disp_cnt] = "<a href=\"".PHPPATH."makers/detail.php?maker=".$i."&cd=".substr($name_index[$j],125,4)."\"><img src=\"".DATPATH2."makers/".$i."/".substr($name_index[$j],125,4)."_small.jpg\" width=\"56\" height=\"100\" border=\"0\"></a>";
							}else{
								$imgpath[$disp_cnt] = "<img src=\"".DATPATH2."makers/".$i."/".substr($name_index[$j],125,4)."_small.jpg\" width=\"56\" height=\"100\" border=\"0\">";
							}
						}else{
							$imgpath[$disp_cnt] = "<img src=\"img/clear.gif\" width=\"56\" height=\"100\" border=\"0\">";
						}

						//説明部セット
						if($dat[8] == "checked"){
							$txt[$disp_cnt] = "<td background=\"img/sold.gif\" style=\"background-repeat:no-repeat;\"><strong>\n";
//						}elseif($dat[9] == "checked"){
//							$txt[$disp_cnt] = "<td background=\"img/hold.gif\" style=\"background-repeat:no-repeat;\"><strong>\n";
						}else{
							$txt[$disp_cnt] = "<td><strong>\n";
						}
						if(mb_strlen($dat[1]) > 9){
							$dat1txt = mb_substr($dat[1],0,9)."<font size=\"2\">...</font>";
						}else{
							$dat1txt = $dat[1];
						}
						$txt[$disp_cnt] .= "<div align=\"center\"><font size=\"2\">".$dat1txt."<br>\n";
						if(mb_strlen($dat[2]) > 9){
							$dat2txt = mb_substr($dat[2],0,9)."<font size=\"2\">...</font>";
						}else{
							$dat2txt = $dat[2];
						}
						if($dat[8] != "checked"){
							$txt[$disp_cnt] .= "<a href=\"".PHPPATH."makers/detail.php?maker=".$i."&cd=".substr($name_index[$j],125,4)."\">".$dat2txt."</a><br>\n";
						}else{
							$txt[$disp_cnt] .= $dat2txt."<br>\n";
						}
						$txt[$disp_cnt] .= $dat[4]."<br>\n";
						if($dat[5] != ""
						&& $dat[5] != 0
						&& $dat[6] != ""
						&& $dat[6] != 0
						&& $dat[5] < $dat[6]
						){
							//旧価格あり
							$txt[$disp_cnt] .= "".kingaku($dat[6],1)."<br>\n";
							$txt[$disp_cnt] .= "　→　<font color=\"#CC0000\">".kingaku($dat[5],1)."</font><br>\n";
						}else{
							//旧価格なし
							$txt[$disp_cnt] .= "".kingaku($dat[5],1)."<br>\n";
						}

						if($bar_flg
						&& $dat[7] != ""
						){
							//バーゲン中でバーゲン価格あり
							$txt[$disp_cnt] .= "　→　<font color=\"#FF6600\">".kingaku($dat[7],1)."</font><br>\n";
						}
						if($dat[9]=="checked"){
							$txt[$disp_cnt] .= "<font color=\"#663333\">在庫無し</font><br>\n";
						}else{
							$txt[$disp_cnt] .= "<font color=\"#336633\">在庫有り</font><br>\n";
						}
						$txt[$disp_cnt] .= "</font></div></strong></td>\n";

						//カウント インクリメント
						$disp_cnt++;

						if($disp_cnt == 5){
							print("  <tr> \n");
							print("    <td width=\"97\" height=\"117\" align=\"center\"".$background[0].">".$imgpath[0]."</td>\n");
							print("    <td width=\"97\" height=\"117\" align=\"center\"".$background[1].">".$imgpath[1]."</td>\n");
							print("    <td width=\"97\" height=\"117\" align=\"center\"".$background[2].">".$imgpath[2]."</td>\n");
							print("    <td width=\"97\" height=\"117\" align=\"center\"".$background[3].">".$imgpath[3]."</td>\n");
							print("    <td width=\"97\" height=\"117\" align=\"center\"".$background[4].">".$imgpath[4]."</td>\n");
							print("  </tr>\n");
							print("  <tr> \n");
							print($txt[0]."\n");
							print($txt[1]."\n");
							print($txt[2]."\n");
							print($txt[3]."\n");
							print($txt[4]."\n");
							print("  </tr>\n");

							$disp_cnt = 0;
							$imgpath[0] = "<img src=\"img/clear.gif\" width=\"56\" height=\"100\" border=\"0\">";
							$imgpath[1] = "<img src=\"img/clear.gif\" width=\"56\" height=\"100\" border=\"0\">";
							$imgpath[2] = "<img src=\"img/clear.gif\" width=\"56\" height=\"100\" border=\"0\">";
							$imgpath[3] = "<img src=\"img/clear.gif\" width=\"56\" height=\"100\" border=\"0\">";
							$imgpath[4] = "<img src=\"img/clear.gif\" width=\"56\" height=\"100\" border=\"0\">";
							$txt[0] = "<td>&nbsp;</td>";
							$txt[1] = "<td>&nbsp;</td>";
							$txt[2] = "<td>&nbsp;</td>";
							$txt[3] = "<td>&nbsp;</td>";
							$txt[4] = "<td>&nbsp;</td>";
							$background[0] = "";
							$background[1] = "";
							$background[2] = "";
							$background[3] = "";
							$background[4] = "";
						}
					}
				}
			}

			if($disp_cnt != 0){
				print("  <tr> \n");
				print("    <td width=\"97\" height=\"117\" align=\"center\"".$background[0].">".$imgpath[0]."</td>\n");
				print("    <td width=\"97\" height=\"117\" align=\"center\"".$background[1].">".$imgpath[1]."</td>\n");
				print("    <td width=\"97\" height=\"117\" align=\"center\"".$background[2].">".$imgpath[2]."</td>\n");
				print("    <td width=\"97\" height=\"117\" align=\"center\"".$background[3].">".$imgpath[3]."</td>\n");
				print("    <td width=\"97\" height=\"117\" align=\"center\"".$background[4].">".$imgpath[4]."</td>\n");
				print("  </tr>\n");
				print("  <tr> \n");
				print($txt[0]."\n");
				print($txt[1]."\n");
				print($txt[2]."\n");
				print($txt[3]."\n");
				print($txt[4]."\n");
				print("  </tr>\n");

				$disp_cnt = 0;
			}

			print("</table>\n");

		//6
			if($maker_title[$i][6] != ""
			|| file_exists(DATPATH."makers/makers".$i."_6.jpg")
			|| $maker_text[$i][6] != ""
			){
				print("<p><font size=\"2\">");
				//--- タイトルテキスト
				if($maker_title[$i][6] != ""){
					print("<strong>■".$maker_title[$i][6]."</strong><br>\n");
				}
				//--- 画像
				if(file_exists(DATPATH."makers/makers".$i."_6.jpg")){
					print("<img align=\"left\" src=\"".DATPATH2."makers/makers".$i."_6.jpg"."\" vspace=\"10\" hspace=\"10\">\n");
				}
				//--- 本文テキスト
				print($maker_text[$i][6]."<br>\n");
				print("<br clear=\"all\"></font></p>");
			}
		//7
			if($maker_title[$i][7] != ""
			|| file_exists(DATPATH."makers/makers".$i."_7.jpg")
			|| $maker_text[$i][7] != ""
			){
				print("<p><font size=\"2\">");
				//--- タイトルテキスト
				if($maker_title[$i][7] != ""){
					print("<strong>■".$maker_title[$i][7]."</strong><br>\n");
				}
				//--- 画像
				if(file_exists(DATPATH."makers/makers".$i."_7.jpg")){
					print("<img align=\"right\" src=\"".DATPATH7."makers/makers".$i."_7.jpg"."\" vspace=\"10\" hspace=\"10\">\n");
				}
				//--- 本文テキスト
				print($maker_text[$i][7]."<br>\n");
				print("<br clear=\"all\"></font></p>");
			}
		//8
			if($maker_title[$i][8] != ""
			|| file_exists(DATPATH."makers/makers".$i."_8.jpg")
			|| $maker_text[$i][8] != ""
			){
				print("<p><font size=\"2\">");
				//--- タイトルテキスト
				if($maker_title[$i][8] != ""){
					print("<strong>■".$maker_title[$i][8]."</strong><br>\n");
				}
				//--- 画像
				if(file_exists(DATPATH."makers/makers".$i."_8.jpg")){
					print("<img align=\"right\" src=\"".DATPATH2."makers/makers".$i."_8.jpg"."\" vspace=\"10\" hspace=\"10\">\n");
				}
				//--- 本文テキスト
				print($maker_text[$i][8]."<br>\n");
				print("<br clear=\"all\"></font></p>");
			}
		//9
			if($maker_title[$i][9] != ""
			|| file_exists(DATPATH."makers/makers".$i."_9.jpg")
			|| $maker_text[$i][9] != ""
			){
				print("<p><font size=\"2\">");
				//--- タイトルテキスト
				if($maker_title[$i][9] != ""){
					print("<strong>■".$maker_title[$i][9]."</strong><br>\n");
				}
				//--- 画像
				if(file_exists(DATPATH."makers/makers".$i."_9.jpg")){
					print("<img align=\"right\" src=\"".DATPATH2."makers/makers".$i."_9.jpg"."\" vspace=\"10\" hspace=\"10\">\n");
				}
				//--- 本文テキスト
				print($maker_text[$i][9]."<br>\n");
				print("<br clear=\"all\"></font></p>");
			}
		//10
			if($maker_title[$i][10] != ""
			|| file_exists(DATPATH."makers/makers".$i."_10.jpg")
			|| $maker_text[$i][10] != ""
			){
				print("<p><font size=\"2\">");
				//--- タイトルテキスト
				if($maker_title[$i][10] != ""){
					print("<strong>■".$maker_title[$i][10]."</strong><br>\n");
				}
				//--- 画像
				if(file_exists(DATPATH."makers/makers".$i."_10.jpg")){
					print("<img align=\"right\" src=\"".DATPATH2."makers/makers".$i."_10.jpg"."\" vspace=\"10\" hspace=\"10\">\n");
				}
				//--- 本文テキスト
				print($maker_text[$i][10]."<br>\n");
				print("<br clear=\"all\"></font></p>");
			}
?>
    </td>
    <td width="8" align="right" background="../img/bg_right_side.gif">&nbsp;</td>
  </tr>
  <tr>
    <td width="7">&nbsp;</td>
    <td colspan="2" align="center" valign="middle" background="../img/bg_yabure5_r.gif">&nbsp;</td>
    <td width="8" align="right">&nbsp;</td>
  </tr>
</table>
<?php
		}
	}

?>
