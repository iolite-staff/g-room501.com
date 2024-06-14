#!/usr/local/bin/php
<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	//$home_url ="http://demo.iolite.co.jp/guitarroom501/home/";
	$home_url ="https://g-room501.com/";

#$maker_name[1] = "FURCH GUITARS";
	$i = 1;
	$mkrpath = DATPATH."makers/makers".$i.".txt";
	if(!file_read($mkrpath,1000,$makerdat)){
		print("File read error!!( ".$path." )<BR>\n");
		exit;
	}
	mb_convert_variables("UTF-8", "SJIS-win", $makerdat);
	//���[�J�[��
	$maker_name[$i] = $makerdat[5];
	//�^�C�g���P
	$maker_title[$i][1] = "";
	//�{���P
	//�ő�s�������߂�
	$gyosuu = 0;
	for($j=10;$j<99;$j++){
		if($makerdat[$j] != ""){
			$gyosuu = $j;
		}
	}
	//�}���`���C���e�L�X�g�̐���
	$text = "";
	for($j=10;$j<$gyosuu+1;$j++){
		$maker_text[$i][1] .= $makerdat[$j]."<br>\n";
	}

	for($bl=1;$bl<10;$bl++){
		//�^�C�g��
		$maker_title[$i][$bl+1] = $makerdat[$bl];
		//�{��
		//�ő�s�������߂�
		$gyosuu = 0;
		for($j=($bl*100);$j<(($bl*100)+99);$j++){
			if($makerdat[$j] != ""){
				$gyosuu = $j;
			}
		}
		//�}���`���C���e�L�X�g�̐���
		$text = "";
		for($j=($bl*100);$j<$gyosuu+1;$j++){
			$maker_text[$i][$bl+1] .= $makerdat[$j]."<br>\n";
		}
	}
	//print_r($maker_title);
	$i = 1;
	if($maker_name[$i]!=""){
		//1
		if($maker_title[$i][1] != "" || file_exists(DATPATH."makers/makers".$i."_1.jpg") || $maker_text[$i][1] != ""){
			print("<h2>");
			//--- �摜
			if(file_exists(DATPATH."makers/makers".$i."_1.jpg")){
				print("<img src=\"".$home_url."data/makers/makers".$i."_1.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][1])."\">\n");
			}
			//--- �^�C�g���e�L�X�g
			if($maker_title[$i][1] != ""){
				print("<p>".$maker_title[$i][1]."</p>\n");
			}
			print("</h2>");
			if($maker_text[$i][1] != ""){
				print('<div class="intro">');
				//--- �{���e�L�X�g
				print("<p>".$maker_text[$i][1]."</p>\n");
				print("</div>");
			}
		}
		//2
		if($maker_title[$i][2] != "" || file_exists(DATPATH."makers/makers".$i."_2.jpg") || $maker_text[$i][2] != ""){
			print('<section class="item">');
			//--- �^�C�g���e�L�X�g
			if($maker_title[$i][2] != ""){
				print("<h3>".$maker_title[$i][2]."</h3>\n");
			}
			print('<div>');
			//--- �摜
			if(file_exists(DATPATH."makers/makers".$i."_2.jpg")){
				print("<img class=\"right\" src=\"".$home_url."data/makers/makers".$i."_2.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][2])."\">\n");
			}
			//--- �{���e�L�X�g
			print("<p>".$maker_text[$i][2]."</p>\n");
			print("</div>");
			print("</section>");
		}
		//3
		if($maker_title[$i][3] != "" || file_exists(DATPATH."makers/makers".$i."_3.jpg") || $maker_text[$i][3] != ""){
			print('<section class="item">');
			//--- �^�C�g���e�L�X�g
			if($maker_title[$i][3] != ""){
				print("<h3>".$maker_title[$i][3]."</h3>\n");
			}
			print('<div>');
			//--- �摜
			if(file_exists(DATPATH."makers/makers".$i."_3.jpg")){
				print("<img class=\"left\" src=\"".$home_url."data/makers/makers".$i."_3.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][3])."\">\n");
			}
			//--- �{���e�L�X�g
			print("<p>".$maker_text[$i][3]."</p>\n");
			print("</div>");
			print("</section>");
		}
		//4
		if($maker_title[$i][4] != "" || file_exists(DATPATH."makers/makers".$i."_4.jpg") || $maker_text[$i][4] != ""){
			print('<section class="item">');
			//--- �^�C�g���e�L�X�g
			if($maker_title[$i][4] != ""){
				print("<h3>".$maker_title[$i][4]."</h3>\n");
			}
			print('<div>');
			//--- �摜
			if(file_exists(DATPATH."makers/makers".$i."_4.jpg")){
				print("<img class=\"right\" src=\"".$home_url."data/makers/makers".$i."_4.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][4])."\">\n");
			}
			//--- �{���e�L�X�g
			print("<p>".$maker_text[$i][4]."</p>\n");
			print("</div>");
			print("</section>");
		}
		//5
		if($maker_title[$i][5] != "" || file_exists(DATPATH."makers/makers".$i."_5.jpg") || $maker_text[$i][5] != ""){
			print('<section class="item">');
			//--- �^�C�g���e�L�X�g
			if($maker_title[$i][5] != ""){
				print("<h3>".$maker_title[$i][5]."</h3>\n");
			}
			print('<div>');
			//--- �摜
			if(file_exists(DATPATH."makers/makers".$i."_5.jpg")){
				print("<img class=\"left\" src=\"".$home_url."data/makers/makers".$i."_5.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][5])."\">\n");
			}
			//--- �{���e�L�X�g
			print("<p>".$maker_text[$i][5]."</p>\n");
			print("</div>");
			print("</section>");
		}
		//6
		if($maker_title[$i][6] != "" || file_exists(DATPATH."makers/makers".$i."_6.jpg") || $maker_text[$i][6] != ""){
			print("<h2>");
			//--- �摜
			if(file_exists(DATPATH."makers/makers".$i."_6.jpg")){
				print("<img class=\"right\" src=\"".$home_url."data/makers/makers".$i."_6.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][6])."\">\n");
			}
			//--- �^�C�g���e�L�X�g
			if($maker_title[$i][6] != ""){
				print("<p>".$maker_title[$i][6]."</p>\n");
			}
			print("</h2>");
			if($maker_text[$i][6] != ""){
				print('<div class="intro">');
				//--- �{���e�L�X�g
				print("<p>".$maker_text[$i][6]."</p>\n");
				print("</div>");
			}
		}
		//7
		if($maker_title[$i][7] != "" || file_exists(DATPATH."makers/makers".$i."_7.jpg") || $maker_text[$i][7] != ""){
			print('<section class="item">');
			//--- �^�C�g���e�L�X�g
			if($maker_title[$i][7] != ""){
				print("<h3>".$maker_title[$i][7]."</h3>\n");
			}
			print('<div>');
			//--- �摜
			if(file_exists(DATPATH."makers/makers".$i."_7.jpg")){
				print("<img class=\"left\" src=\"".$home_url."data/makers/makers".$i."_7.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][7])."\">\n");
			}
			//--- �{���e�L�X�g
			print("<p>".$maker_text[$i][7]."</p>\n");
			print("</div>");
			print("</section>");
		}
		//8
		if($maker_title[$i][8] != "" || file_exists(DATPATH."makers/makers".$i."_8.jpg") || $maker_text[$i][8] != ""){
			print('<section class="item">');
			//--- �^�C�g���e�L�X�g
			if($maker_title[$i][8] != ""){
				print("<h3>".$maker_title[$i][8]."</h3>\n");
			}
			print('<div>');
			//--- �摜
			if(file_exists(DATPATH."makers/makers".$i."_8.jpg")){
				print("<img class=\"right\" src=\"".$home_url."data/makers/makers".$i."_8.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][8])."\">\n");
			}
			//--- �{���e�L�X�g
			print("<p>".$maker_text[$i][8]."</p>\n");
			print("</div>");
			print("</section>");
		}
		//9
		if($maker_title[$i][9] != "" || file_exists(DATPATH."makers/makers".$i."_9.jpg") || $maker_text[$i][9] != ""){
			print('<section class="item">');
			//--- �^�C�g���e�L�X�g
			if($maker_title[$i][9] != ""){
				print("<h3>".$maker_title[$i][9]."</h3>\n");
			}
			print('<div>');
			//--- �摜
			if(file_exists(DATPATH."makers/makers".$i."_9.jpg")){
				print("<img class=\"left\" src=\"".$home_url."data/makers/makers".$i."_9.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][9])."\">\n");
			}
			//--- �{���e�L�X�g
			print("<p>".$maker_text[$i][9]."</p>\n");
			print("</div>");
			print("</section>");
		}
		//10
		if($maker_title[$i][10] != "" || file_exists(DATPATH."makers/makers".$i."_10.jpg") || $maker_text[$i][10] != ""){
			print('<section class="item">');
			//--- �^�C�g���e�L�X�g
			if($maker_title[$i][10] != ""){
				print("<h3>".$maker_title[$i][10]."</h3>\n");
			}
			print('<div>');
			//--- �摜
			if(file_exists(DATPATH."makers/makers".$i."_10.jpg")){
				print("<img class=\"right\" src=\"".$home_url."data/makers/makers".$i."_10.jpg"."\" alt=\"".htmlspecialchars($maker_title[$i][10])."\">\n");
			}
			//--- �{���e�L�X�g
			print("<p>".$maker_text[$i][10]."</p>\n");
			print("</div>");
			print("</section>");
		}
	}
?>
