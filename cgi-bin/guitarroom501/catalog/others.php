#!/usr/local/bin/php
<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	//$home_url ="http://demo.iolite.co.jp/guitarroom501/";
	$home_url ="https://www.g-room501.com/";

	//文字化け対策（エスケープ処理：表示用）
	$post = make_up_bs($_POST,0);
	$get = make_up_bs($_GET,0);

	//GETのページを格納
	if(isset($get['page'])){
		if($get['page'] > 0
		&& $get['page'] < 11
		){
			$page = $get['page'];
		}else{
			$page = 1;
		}
	}else{
		$page = 1;
	}

	//--- ページタイトルの取得
	$idxpath = DATPATH."others/index.txt";
	//INDEXファイルRead
	if(!file_read($idxpath,10,$title)){
		print("File read error!!( ".$idxpath." )<BR>\n");
		exit;
	}

	//ページ一覧
	for($i=1;$i<11;$i++){
		if($title[$i-1]){
			$title_list[$i] = $title[$i-1];
		}
	}
	mb_convert_variables("UTF-8", "SJIS-win", $title_list);

	foreach($title_list as $page => $value){
		for($lp=(0 + ($page-1)*10);$lp<(10 + ($page-1)*10);$lp++){
			$cd = sprintf('%03d',$lp);
			$path = DATPATH."others/".$cd.".txt";
			//データファイルRead
			if(!file_read($path,100,$dat)){
				print("File read error!!( ".$path." )<BR>\n");
				exit;
			}
			mb_convert_variables("UTF-8", "SJIS-win", $dat);

			//非表示フラグがcheckedなら表示しない
			$title = $dat[1]." ".$dat[3]." ".$dat[4];
			if($title){
				if($dat[0] == "checked"){

				}else{
					//画像ファイルチェック
					if(file_exists(DATPATH."others/".sprintf('%03d',$lp).".jpg")){
						$imgpath = "<img src=\"".$home_url."data/others/".sprintf('%03d',$lp).".jpg\" alt=\"".htmlspecialchars($title)."\">";
					}else{
						$imgpath = "";
					}

					//--- 本文テキスト
					//最大行数を求める
					$gyosuu = 0;
					for($i=10;$i<100;$i++){
						if($dat[$i] != ""){
							$gyosuu = $i;
						}
					}
					//マルチラインテキストの生成
					$text = "";
					for($i=10;$i<$gyosuu+1;$i++){
						$text .= $dat[$i]."<br>\n";
					}

					$items[$page][] = "<li><a href=\"".PHPPATH."catalog/accessory.php?cd=".$cd."\">".$imgpath.$title."<span>".kingaku($dat[5],3,"Y")."</span></a></li>\n";
				}
			}
		}
	}

	foreach($title_list as $page => $value){
		if(isset($items[$page]) > 0){
?>
				<h2 class="times"><?php echo $value ?></h2>
				<ul class="product-list">
<?php
			foreach($items[$page] as $item){
?>
					<?php echo $item ?>
<?php
			}
?>
				</ul>
<?php
		}
	}
?>
