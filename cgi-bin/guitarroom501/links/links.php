#!/usr/local/bin/php
<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	//$home_url ="http://demo.iolite.co.jp/guitarroom501/";
	$home_url ="http://www.guitarroom501/";
?>
				<div class="link-list">
					<ul>
<?php
	for($lp=0;$lp<10;$lp++){
		$cd = sprintf('%03d',$lp);
		$path = DATPATH."links/".$cd.".txt";
		//データファイルRead
		if(!file_read($path,100,$dat)){
			print("File read error!!( ".$path." )<BR>\n");
			exit;
		}
		mb_convert_variables("UTF-8", "SJIS-win", $dat);

		//非表示フラグがcheckedなら表示しない
		$title = $dat[1];
		if($title){
			if($dat[0] == "checked"){

			}else{
				//画像ファイルチェック
				if(file_exists(DATPATH."links/".sprintf('%03d',$lp).".jpg")){
					$imgpath = "<img src=\"".$home_url."data/links/".sprintf('%03d',$lp).".jpg\" alt=\"".htmlspecialchars($title)."\">";
				}else{
					$imgpath = "";
				}

				print("<li><a href=\"".$dat[2]."\" target=\"blank\">".$imgpath.$title."</a></li>\n");
			}
		}
	}
?>
					</ul>
				</div>
