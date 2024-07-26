#!/usr/local/bin/php

<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

$site_url ="http://demo.iolite.co.jp/guitarroom501/";
$home_url ="http://demo.iolite.co.jp/guitarroom501/";
//$site_url ="https://www.g-room501.com/";
//$home_url ="https://www.g-room501.com/";

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
			$path = DATPATH."guitar/".$cat_num."/".substr($name_index[$i],125,4).".txt";
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
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="description" content="2024年 6月2日 OPEN!!厳選した新品、中古、ヴィンテージのエレキギターを中心に、新品海外スタッフが独自に開拓したルートから個人製作家や小規模工房で生産されるユニークで質の高い楽器をご紹介。店内にはリペアマンが常駐するリペアルームを完備。防音室等の試奏環境も整っており、落ち着いた雰囲気の店頭でゆったりと楽器をご覧いただけます。">
<meta name="keywords" content="guitarroom501,ギタールーム501,ギター販売,ギター修理,千代田区,神田">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<meta name="format-detection" content="telephone=no, email=no, address=no">
<title>Inventory | Guitar Room 501</title>
<link rel="stylesheet" type="text/css" href="<?php echo $home_url ?>lib/bxslider.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $home_url ?>css/common.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $home_url ?>css/screen.css" />
<link rel="stylesheet" type="text/css" media="screen and (max-width:660px)" href="<?php echo $home_url ?>css/screen_sp.css" />
<link rel="stylesheet" type="text/css" media="screen and (min-width:661px) and (max-width:1023px)" href="<?php echo $home_url ?>css/screen_tb.css" />
<link rel="stylesheet" type="text/css" media="screen and (min-width:1024px)" href="<?php echo $home_url ?>css/screen_pc.css" />
<link rel="stylesheet" href="<?php echo $home_url ?>css/fancybox.min.css" />
<link rel="stylesheet" type="text/css" media="print" href="<?php echo $home_url ?>css/print.css" />
<link rel="apple-touch-icon" href="<?php echo $home_url ?>apple-touch-icon.png" />
<link rel="icon" type="image/png" href="<?php echo $home_url ?>favicon-.png" sizes="16x16">
<link rel="icon" type="image/png" href="<?php echo $home_url ?>favicon.png" sizes="32x32">
<link rel="stylesheet" type="text/css" href="<?php echo $home_url ?>lib/jquery/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $home_url ?>lib/jquery/slick/slick-theme.css"/>
<script type="text/javascript" src="<?php echo $home_url ?>lib/jquery/jquery-3.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo $home_url ?>lib/jquery/slick/slick.min.js"></script>
</head>
<body>
	<header>
	<a href="<?php echo $home_url ?>index.html"><img src="<?php echo $home_url ?>img/interface/logo_header.png" alt="Guitar Room 501"></a>
		<span class="pc"></span>
		<a class="insta_link_sp" href="https://www.instagram.com/guitarroom501/?img_index=1" target="_blank"><img src="<?php echo $home_url ?>img/interface/insta_icon.png" alt="instagram"></a>
		<nav>
			<ul>
				<li class="menu-item"><a href="<?php echo $home_url ?>index.html">Home</a></li>
				<li class="menu-item"><a href="<?php echo $home_url ?>inventory/index.html">Inventory</a>
					<ul class="submenu">
						<li><a href="<?php echo $home_url ?>inventory/category.html">All</a></li>
						<li><a href="<?php echo $home_url ?>inventory/category1.html">Electric Guitar</a></li>
						<li><a href="<?php echo $home_url ?>inventory/category2.html">Electric Bass</a></li>
						<li><a href="<?php echo $home_url ?>inventory/category3.html">Acoustic Guitar</a></li>
						<li><a href="<?php echo $home_url ?>inventory/category4.html">Others</a></li>
						<li><a href="<?php echo $home_url ?>inventory/category5.html">Parts & Accessories</a></li>
					</ul>
				</li>
				<li class="menu-item"><a href="<?php echo $home_url ?>shopguide/index.html">Shop Guide</a></li>
				<li class="menu-item"><a href="<?php echo $home_url ?>buy-sell/index.html">Buy-Sell</a></li>
				<li class="menu-item"><a href="<?php echo $home_url ?>makers/index.html">Makers</a></li>
				<li class="menu-item"><a href="<?php echo $home_url ?>repairs/index.html">Repairs</a></li>
			</ul>
			<a class="insta_link_pc" href="https://www.instagram.com/guitarroom501/?img_index=1" target="_blank"><img src="<?php echo $home_url ?>img/interface/insta_icon.png" alt="instagram"></a>
		</nav>
		<span id="nav_sp"><span></span><span></span></span>
	</header>
	<article id="sub_contents_area">
		<h1><span>Inventory</span>在庫</h1>
		<section id="search_area" style="text-align: center;margin: 20px auto 60px;">
			<form method="get" action="./index.php">
				<select name="type" id="">
					<option value="">カテゴリー</option>
					<option value="">ALL</option>
					<option value="1"<?PHP if($_GET['type'] == 1){echo " selected";}?>>Electric Guitar</option>
					<option value="2"<?PHP if($_GET['type'] == 2){echo " selected";}?>>Electric Bass</option>
					<option value="3"<?PHP if($_GET['type'] == 3){echo " selected";}?>>Acoustic Guitar</option>
					<option value="4"<?PHP if($_GET['type'] == 4){echo " selected";}?>>Others</option>
					<option value="5"<?PHP if($_GET['type'] == 5){echo " selected";}?>>Parts & Accessories</option>
				</select>
<?php include_once('../catalog/select.php'); ?>
				<select name="condition" id="">
					<option value="">状態</option>
					<option value="">ALL</option>
					<option value="new"<?PHP if($_GET['condition'] == "new"){echo " selected";}?>>NEW</option>
					<option value="used"<?PHP if($_GET['condition'] == "used"){echo " selected";}?>>USED</option>
					<option value="vintage"<?PHP if($_GET['condition'] == "vintage"){echo " selected";}?>>VINTAGE</option>
				</select>
				<div id="search_text">
				<input type="text" name="search" <?PHP if($_GET['search'] != ""){?> value="<?PHP echo $_GET['search'];?>"<?PHP }?> placeholder="検索">
				<button type="submit" name="submit" id="search_btn"></button>
				</div>
			</form>
		</section>
		<div class="inner inv">
			<main>

		<?php

$disp_cnt = 0;

for($type=1;$type<=5;$type++){
	if($bar_flg){
		//print("<strong><font color=\"#FF6600\">バーゲン</font></strong>");
	}
	if($type == 1){
		$item_num = CATALOG_TYPE_1;
		$cat_num = "1";
		$cat_title = "Electric Guitar";
	}elseif($type == 2){
		$item_num = CATALOG_TYPE_2;
		$cat_num = "2";
		$cat_title = "Electric Bass";
	}elseif($type == 3){
		$item_num = CATALOG_TYPE_3;
		$cat_num = "3";
		$cat_title = "Acoustic Guitar";
	}elseif($type == 4){
		$item_num = CATALOG_TYPE_4;
		$cat_num = "4";
		$cat_title = "Others";
	}elseif($type == 5){
		$item_num = CATALOG_TYPE_5;
		$cat_num = "5";
		$cat_title = "Parts & Accessories";
	}

	$idxpath = DATPATH."guitar/".$type."/name_index.txt";

	//INDEXファイルRead
	if(!file_read($idxpath,$item_num,$name_index)){
		print("File read error!!( ".$idxpath." )<BR>\n");
		exit;
	}

	sort($name_index);

	$search_cat = $_GET['type'];
	$search_brand = mb_convert_encoding($_GET['brand'],"sjis-win","utf-8");
	$search_condition = $_GET['condition'];
	$search_txt = mb_convert_encoding($_GET['search'],"sjis-win","utf-8");

	$old_day = date('Ymd',time()-5184000)+0;

	for($i=0;$i<$item_num;$i++){
		//INDEXファイルの内容が空の場合、なにもしない
		if($name_index[$i] != ""){
			//search_txtが空またはname_indexの値に含まれる場合、以下の処理を実行
			if (empty($search_txt) || stripos($name_index[$i], $search_txt) !== false){
				//search_brandが空またはname_indexの値に含まれる場合、以下の処理を実行
				if (empty($search_brand) || stripos($name_index[$i], $search_brand) !== false){
					//search_catが空またはtypeと一致した場合、以下の処理を実行
					if (empty($search_cat) || ($search_cat != "" && $type == $search_cat)){
						$path = DATPATH."guitar/".$type."/".substr($name_index[$i],125,4).".txt";
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

						//コンディション表示制御
						}elseif(!empty($search_condition) && stripos($dat[33], $search_condition) === false){

						}else{
							//画像部セット
							//画像ファイルチェック
							$item_name = htmlspecialchars($dat[1])." ".htmlspecialchars($dat[2]);
							if(file_exists(DATPATH."guitar/".$type."/".substr($name_index[$i],125,4)."_small.jpg")){
								if($dat[8] != "checked"){
									$dat1txt = "<img src=\"".DATPATH4."guitar/".$type."/".substr($name_index[$i],125,4)."_small.jpg\" alt=\"".$item_name."\" loading=\"lazy\">";
								}else{
									$dat1txt = "<img src=\"".DATPATH4."guitar/".$type."/".substr($name_index[$i],125,4)."_small.jpg\" alt=\"".$item_name."\" loading=\"lazy\">";
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
				$txt[$disp_cnt] .= "<a href=\"".PHPPATH."catalog/detail.php?maker=".$type."&cd=".substr($name_index[$i],125,4)."\">".$dat2txt."</a>";
				//カウント インクリメント
				$disp_cnt++;
						}
					}
				}
			}
		}
	}
	$name_index = [];
?>

<?php
		if($disp_cnt != ""){
?>
	<section class="category">
	<h2 class="times"><?php echo $cat_title ?></h2>
	<div id="inventory_area">
	<ul class="product-list">
<?php
	//表示
	for($i=0;$i<$item_num;$i++){
		if(isset($txt[$i])){
			print("<li style=\"position: relative;\">");
			print($txt[$i]);
			print("</li>");
		}
	}	
?>
</ul>
</div>
</section>

<?php
		}
?>
<?php
		$txt = [];
		$disp_cnt = 0;
}
?>

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
	</div>
	</article>
	<footer>
		<div id="footer_content_area">
			<div id="footer_info_area">
				<div>
					<img src="<?php echo $home_url ?>img/interface/logo_footer.png" alt="Guitar Room 501">
					<address>
					<p>
							〒101-0052<br>東京都千代田区神田小川町2-12 信愛ビル501
						</p>
						<p>
							tel：03-6281-7550<br>
							mail：info@g-room501.com
						</p>
						<p>
							営業時間：11:00～19：00　　<span>定休日:月曜日</span>
						</p>
					</address>
				</div>
				<img src="<?php echo $home_url ?>img/interface/shop_pic.jpg" alt="店内画像">
			</div>
			<div id="footer_schedule_area">
<?php include_once("../top/calender2.php"); ?>
			</div>
		</div>
		<div id="footer_copyright_area">
			<small>&copy; 2024 Guitar Room 501 All Rights Reserved.</small>
		</div>
	</footer>
<!-- js -->
<script src="<?php echo $home_url ?>lib/jquery/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="<?php echo $home_url ?>js/global.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.slider').bxSlider({
			mode: 'fade',
			auto: true,
			controls: false,
			speed: 2500
		});
		$("body>div>header .nav-menu").click(function () {
			$("body>div>header nav").slideToggle(200);
			$(this).toggleClass("active");
		});
	});

	$(function() {
			var offset = $('nav').offset();
		
			$(window).scroll(function () {
				if ($(window).scrollTop() > offset.top) {
					$('nav').addClass('fixed');
				} else {
					$('nav').removeClass('fixed');
				}
			});
		});
</script>
</body>
</html>