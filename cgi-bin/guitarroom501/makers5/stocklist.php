#!/usr/local/bin/php
<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	//$home_url ="http://demo.iolite.co.jp/guitarroom501/";
	$home_url ="http://www.guitarroom501/";

#$maker_name[1] = "FURCH GUITARS";
	$i = 5;
	$mkrpath = DATPATH."makers/makers".$i.".txt";
	if(!file_read($mkrpath,1000,$makerdat)){
		print("File read error!!( ".$path." )<BR>\n");
		exit;
	}
	mb_convert_variables("UTF-8", "SJIS-win", $makerdat);
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
	$i = 5;
	if($maker_name[$i]!=""){
		//1
		if($maker_title[$i][1] != "" || file_exists(DATPATH."makers/makers".$i."_1.jpg") || $maker_text[$i][1] != ""){
			print("<h2>");
			//--- 画像
			if(file_exists(DATPATH."makers/makers".$i."_1.jpg")){
				print("<img src=\"".$home_url."data/makers/makers".$i."_1.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][1])."\">\n");
			}
			//--- タイトルテキスト
			if($maker_title[$i][1] != ""){
				print("<p>".$maker_title[$i][1]."</p>\n");
			}
			print("</h2>");
			if($maker_text[$i][1] != ""){
				print('<div class="intro">');
				//--- 本文テキスト
				print("<p>".$maker_text[$i][1]."</p>\n");
				print("</div>");
			}
		}
		//2
		if($maker_title[$i][2] != "" || file_exists(DATPATH."makers/makers".$i."_2.jpg") || $maker_text[$i][2] != ""){
			print('<section class="item">');
			//--- タイトルテキスト
			if($maker_title[$i][2] != ""){
				print("<h3>".$maker_title[$i][2]."</h3>\n");
			}
			print('<div>');
			//--- 画像
			if(file_exists(DATPATH."makers/makers".$i."_2.jpg")){
				print("<img class=\"right\" src=\"".$home_url."data/makers/makers".$i."_2.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][2])."\">\n");
			}
			//--- 本文テキスト
			print("<p>".$maker_text[$i][2]."</p>\n");
			print("</div>");
			print("</section>");
		}
		//3
		if($maker_title[$i][3] != "" || file_exists(DATPATH."makers/makers".$i."_3.jpg") || $maker_text[$i][3] != ""){
			print('<section class="item">');
			//--- タイトルテキスト
			if($maker_title[$i][3] != ""){
				print("<h3>".$maker_title[$i][3]."</h3>\n");
			}
			print('<div>');
			//--- 画像
			if(file_exists(DATPATH."makers/makers".$i."_3.jpg")){
				print("<img class=\"left\" src=\"".$home_url."data/makers/makers".$i."_3.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][3])."\">\n");
			}
			//--- 本文テキスト
			print("<p>".$maker_text[$i][3]."</p>\n");
			print("</div>");
			print("</section>");
		}
		//4
		if($maker_title[$i][4] != "" || file_exists(DATPATH."makers/makers".$i."_4.jpg") || $maker_text[$i][4] != ""){
			print('<section class="item">');
			//--- タイトルテキスト
			if($maker_title[$i][4] != ""){
				print("<h3>".$maker_title[$i][4]."</h3>\n");
			}
			print('<div>');
			//--- 画像
			if(file_exists(DATPATH."makers/makers".$i."_4.jpg")){
				print("<img class=\"right\" src=\"".$home_url."data/makers/makers".$i."_4.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][4])."\">\n");
			}
			//--- 本文テキスト
			print("<p>".$maker_text[$i][4]."</p>\n");
			print("</div>");
			print("</section>");
		}
		//5
		if($maker_title[$i][5] != "" || file_exists(DATPATH."makers/makers".$i."_5.jpg") || $maker_text[$i][5] != ""){
			print('<section class="item">');
			//--- タイトルテキスト
			if($maker_title[$i][5] != ""){
				print("<h3>".$maker_title[$i][5]."</h3>\n");
			}
			print('<div>');
			//--- 画像
			if(file_exists(DATPATH."makers/makers".$i."_5.jpg")){
				print("<img class=\"left\" src=\"".$home_url."data/makers/makers".$i."_5.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][5])."\">\n");
			}
			//--- 本文テキスト
			print("<p>".$maker_text[$i][5]."</p>\n");
			print("</div>");
			print("</section>");
		}
		//6
		if($maker_title[$i][6] != "" || file_exists(DATPATH."makers/makers".$i."_6.jpg") || $maker_text[$i][6] != ""){
			print('<section class="item">');
			//--- タイトルテキスト
			if($maker_title[$i][6] != ""){
				print("<h3>".$maker_title[$i][6]."</h3>\n");
			}
			print('<div>');
			//--- 画像
			if(file_exists(DATPATH."makers/makers".$i."_6.jpg")){
				print("<img class=\"right\" src=\"".$home_url."data/makers/makers".$i."_6.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][6])."\">\n");
			}
			//--- 本文テキスト
			print("<p>".$maker_text[$i][6]."</p>\n");
			print("</div>");
			print("</section>");
		}
		//7
		if($maker_title[$i][7] != "" || file_exists(DATPATH."makers/makers".$i."_7.jpg") || $maker_text[$i][7] != ""){
			print('<section class="item">');
			//--- タイトルテキスト
			if($maker_title[$i][7] != ""){
				print("<h3>".$maker_title[$i][7]."</h3>\n");
			}
			print('<div>');
			//--- 画像
			if(file_exists(DATPATH."makers/makers".$i."_7.jpg")){
				print("<img class=\"left\" src=\"".$home_url."data/makers/makers".$i."_7.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][7])."\">\n");
			}
			//--- 本文テキスト
			print("<p>".$maker_text[$i][7]."</p>\n");
			print("</div>");
			print("</section>");
		}
		//8
		if($maker_title[$i][8] != "" || file_exists(DATPATH."makers/makers".$i."_8.jpg") || $maker_text[$i][8] != ""){
			print('<section class="item">');
			//--- タイトルテキスト
			if($maker_title[$i][8] != ""){
				print("<h3>".$maker_title[$i][8]."</h3>\n");
			}
			print('<div>');
			//--- 画像
			if(file_exists(DATPATH."makers/makers".$i."_8.jpg")){
				print("<img class=\"right\" src=\"".$home_url."data/makers/makers".$i."_8.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][8])."\">\n");
			}
			//--- 本文テキスト
			print("<p>".$maker_text[$i][8]."</p>\n");
			print("</div>");
			print("</section>");
		}
		//9
		if($maker_title[$i][9] != "" || file_exists(DATPATH."makers/makers".$i."_9.jpg") || $maker_text[$i][9] != ""){
			print('<section class="item">');
			//--- タイトルテキスト
			if($maker_title[$i][9] != ""){
				print("<h3>".$maker_title[$i][9]."</h3>\n");
			}
			print('<div>');
			//--- 画像
			if(file_exists(DATPATH."makers/makers".$i."_9.jpg")){
				print("<img class=\"left\" src=\"".$home_url."data/makers/makers".$i."_9.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][9])."\">\n");
			}
			//--- 本文テキスト
			print("<p>".$maker_text[$i][9]."</p>\n");
			print("</div>");
			print("</section>");
		}
		//10
		if($maker_title[$i][10] != "" || file_exists(DATPATH."makers/makers".$i."_10.jpg") || $maker_text[$i][10] != ""){
			print('<section class="item">');
			//--- タイトルテキスト
			if($maker_title[$i][10] != ""){
				print("<h3>".$maker_title[$i][10]."</h3>\n");
			}
			print('<div>');
			//--- 画像
			if(file_exists(DATPATH."makers/makers".$i."_10.jpg")){
				print("<img class=\"right\" src=\"".$home_url."data/makers/makers".$i."_10.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][10])."\">\n");
			}
			//--- 本文テキスト
			print("<p>".$maker_text[$i][10]."</p>\n");
			print("</div>");
			print("</section>");
		}
	}
?>
