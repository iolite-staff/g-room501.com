#!/usr/local/bin/php
<?php
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	//$site_url ="http://demo.iolite.co.jp/guitarroom501/";
	//$home_url ="http://demo.iolite.co.jp/guitarroom501/";
	$site_url =" https://www.g-room501.com/";
	$home_url =" https://www.g-room501.com/";

	//--- infoフォルダ内のテキストファイルを取得する
	$fp_cnt = 0;
	for($fp=0;$fp<7;$fp++){
		$datpath = DATPATH."info/".$fp.".txt";
		//テキストファイルRead
		if(!file_read($datpath,100,$dat[$fp])){
			print("File read error!!( /".$datpath." )<BR>\n");
			exit;
		}
		//非表示フラグがCheckedでなければ表示する
		if($dat[$fp][3] != "checked"){
			$fp_cnt++;
		}
	}

	//--- 0件でなければ表示
	if($fp_cnt == 0){
?>
					<ul class="news-list">
						<li>
							<p>新着情報はありません。</p>
						</li>
					</ul>
<?php
		exit;
	}
	mb_convert_variables("UTF-8", "SJIS-win", $dat);
?>
					<ul class="news-list">
<?php

	//--- 表示する(MAX7件)
	for($fp=0;$fp<7;$fp++){
		//非表示フラグがCheckedでなければ表示する
		if($dat[$fp][3] != "checked"){
			print("<li>");
			//--- New
			if($dat[$fp][2] == "checked"){
				print("<font color=\"#CC0033\"><span>New!</span></font><br>\n");
			}
			print("<a href=\"".$site_url."cgi-bin/guitarroom501/info/detail.php?cd=".$fp."\">");
			//--- タイトルテキスト
			if($dat[$fp][0] != ""){
				print("<h3>".$dat[$fp][0]."</h3>");
			}
/*
			//--- 画像
			if($dat[$fp][1] != ""){
				$imgpath = DATPATH2."info/".$fp.".jpg";
				print("<img align=\"".$dat[$fp][1]."\" src=\"".$imgpath."\" vspace=\"10\" hspace=\"10\">\n");
			}
*/
			//--- 本文テキスト
			//最大行数を求める
			$gyosuu = 0;
			for($j=5;$j<100;$j++){
				if($dat[$fp][$j] != ""){
					$gyosuu = $j;
				}
			}
			//マルチラインテキスト
			$txt = "";
			for($j=5;$j<$gyosuu+1;$j++){
				$txt .= strip_tags($dat[$fp][$j]);
			}
			$txt = mb_strimwidth($txt, 0, 100, "...", 'utf-8');
			$txt = "<p>".$txt."</p>";
			print($txt);
			print("</a>");
			print("</li>");
		}
	}
?>
					</ul>
