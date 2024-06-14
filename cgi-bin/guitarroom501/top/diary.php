#!/usr/local/bin/php
<?php
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	//--- diaryフォルダ内の全てのテキストファイルを取得する
	$fp=0;
	$path = DATPATH."diary";
	if($dir = @dir($path)){
		//フォルダ内の全ファイル取得
		while($file_nm = $dir->read()){
			if($file_nm == ""){
				break;
			}elseif($file_nm != "." && $file_nm != ".."){
				$index[$fp] = $file_nm;
				$fp++;
			}
		}
		$dir->close();
	}

	$max_fp = $fp;

	//--- 0件でなければ表示
	if($max_fp == 0){
		exit;
	}
?>
      <table width="500" height="81" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="14" align="center" background="img/bar_brown.gif"><img src="img/diary.gif" width="105" height="14"></td>
        </tr>
        <tr>
          <td height="67">
<?php
	//--- ファイル名の逆順に並び替える
	rsort($index);

	//--- ファイルを読み表示する
	for($fp=0;$fp<$max_fp;$fp++){
		$datpath = DATPATH."diary/".$index[$fp];
		//テキストファイルRead
		if(!file_read($datpath,100,$dat)){
			print("File read error!!( /".$path." )<BR>\n");
			exit;
		}
		//非表示フラグがCheckedでなければ表示する
		if($dat[1] != "checked"){
			//--- 登録日
			$ymd = substr($dat[0],0,4)."/".substr($dat[0],4,2)."/".substr($dat[0],6,2);

			//--- 本文テキスト
			//最大行数を求める
			$gyosuu = 0;
			for($i=5;$i<100;$i++){
				if($dat[$i] != ""){
					$gyosuu = $i;
				}
			}
			//マルチラインテキストの生成
			$text = "";
			for($i=5;$i<$gyosuu+1;$i++){
				$text .= $dat[$i]."<br>\n";
			}
?>
<p><font size="2"><strong><?=$ymd?></strong><br>
<?=$text?></font></p>
<?php
		}
	}
?>
</td>
        </tr>
      </table>
