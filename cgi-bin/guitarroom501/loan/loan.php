#!/usr/local/bin/php
<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	//$site_url ="http://demo.iolite.co.jp/guitarroom501/";
	//$home_url ="http://demo.iolite.co.jp/guitarroom501/";
	$site_url ="http://www.guitarroom501/";
	$home_url ="http://www.guitarroom501/";

	$msg = "";

	//文字化け対策（エスケープ処理：表示用）
	$post = make_up_bs($_POST,0);
	$get = make_up_bs($_GET,0);

	//POSTを変数itemにセット
	$item = $post;

	//手数料テーブル
	$ritu[1] = 130;
	$ritu[3] = 134;
	$ritu[6] = 235;
	$ritu[10] = 370;
	$ritu[12] = 439;
	$ritu[15] = 542;
	$ritu[18] = 645;
	$ritu[20] = 715;
	$ritu[24] = 855;
	$ritu[30] = 1066;
	$ritu[36] = 1281;
	$ritu[42] = 1498;
	$ritu[48] = 1718;
	$ritu[54] = 1941;
	$ritu[60] = 2166;
	$ritu[66] = 2394;
	$ritu[72] = 2624;
	$ritu[84] = 3092;
	$today_Y = date(Y);
	$today_n = date(n);
	//$to_Y = $today_Y + floor($item['item3'] / 12) + floor(($today_n + ($item['item3'] % 12))/12);
	//if(($today_n + ($item['item3'] % 12))/12 == 1){
	//	$to_Y--;
	//}
	$to_Y = $today_Y + floor(($today_n + $item['item3'] - 1) / 12);
	$to_n = ($today_n + $item['item3']) % 12;
	$to_n = $to_n == 0 ? 12 : $to_n;
	$from_n = ($today_n % 12) + 1;
	$from_Y = $today_n == 12 ? $today_Y + 1 : $today_Y ;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="description" content="アコースティック・ギターの店『Guitar room 501(ホーボーズ)』。MARTIN・2-45 Custom "Adirondack / Madagascar Rosewood"の詳細ページです。" />
<meta name="keywords" content="中古ギター,ヴィンテージギター,アコースティックギター,VINTAGE,GUITAR,USED,御茶ノ水" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5" />
<meta name="msapplication-TileImage" content="<?php echo $home_url ?>msapplication-TileImage.png" />
<meta name="msapplication-TileColor" content="#000" />
<title>ローンシミュレーション | Guitar room 501</title>
<link rel="stylesheet" type="text/css" href="<?php echo $home_url ?>lib/bxslider.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $home_url ?>css/common.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $home_url ?>css/screen.css" />
<link rel="stylesheet" type="text/css" media="screen and (max-width:660px)" href="<?php echo $home_url ?>css/screen_sp.css" />
<link rel="stylesheet" type="text/css" media="screen and (min-width:661px) and (max-width:1023px)" href="<?php echo $home_url ?>css/screen_tb.css" />
<link rel="stylesheet" type="text/css" media="screen and (min-width:1024px)" href="<?php echo $home_url ?>css/screen_pc.css" />
<link rel="stylesheet" type="text/css" media="print" href="<?php echo $home_url ?>css/print.css" />
<link rel="apple-touch-icon" href="<?php echo $home_url ?>apple-touch-icon.png" />
<link rel="icon" type="image/png" href="<?php echo $home_url ?>favicon-.png" sizes="16x16">
<link rel="icon" type="image/png" href="<?php echo $home_url ?>favicon.png" sizes="32x32">
<script type="text/javascript">
	function setItem2(){
		document.basic.item2.value = document.basic.item0.value - document.basic.item1.value;
	}
</script>
</head>
<body>
<div id="sub">
	<header>
		<div class="inner">
			<a href="<?php echo $home_url ?>index.html"><img src="<?php echo $home_url ?>img/interface/logo_brown.png" width="212" height="83" alt="ACOUSTIC GUITER SHOP Guitar room 501" /></a>
			<nav class="times">
				<ul>
					<li><a href="<?php echo $home_url ?>inventory/index.html"><span>在庫リスト</span>Inventory</a></li>
					<li><a href="<?php echo $home_url ?>shop/index.html"><span>アクセス</span>Shop Guide</a></li>
					<li><a href="<?php echo $home_url ?>order/index.html"><span>ご購入</span>How to Order</a></li>
					<li><a href="<?php echo $home_url ?>ca/index.html"><span>ケース＆アクセサリー</span>Parts & Accessories</a></li>
					<li><a href="<?php echo $home_url ?>links/index.html"><span>リンク</span>Links</a></li>
					<li><a href="<?php echo $home_url ?>repairs/index.html"><span>リペア</span>Repairs</a></li>
				</ul>
			</nav>
			<span class="nav-menu"></span>
		</div>
	</header>
	<div id="contents">
		<h1 class="times">Loan Simulation</h1>
		<div class="inner">
			<main id="article-area" class="news-area">
			<div class="or-table02">
<?php
	if($msg == ""
	&& isset($item['result'])
	){
		//--- 入力値チェック
		if($item['item0'] == ""){
			$msg = make_err("エラー","購入金額が未入力です。");
		}
		if($item['item1'] == ""){
			$item['item1'] = 0;
		}
		if($item['item3'] == ""){
			$msg = make_err("エラー","希望支払い回数が選択されていません。");
		}
		if($item['item4'] == ""){
			$item['item4'] = 0;
		}
	}

	if($msg == ""
	&& isset($item['result'])
	){
		$item['item2'] = $item['item0'] - $item['item1'];

		//--- 入力値チェック
		if($item['item2'] < 100){
			$msg = make_err("エラー","ローン金額が適正でありません。");
		}elseif($item['item2'] < $item['item4']){
			$msg = make_err("エラー","ボーナス月加算支払額が適正でありません。");
		}
	}

	if($msg == ""
	&& isset($item['result'])
	){
		//---- 計算
		$kaisuu = $item['item3'];
		print("<!-".($item['item2'] * $ritu[$kaisuu])."--->");
		$tanri = (int)($item['item2'] * $ritu[$kaisuu]/10000);
		$sougaku = $item['item2'] + $tanri;						//分割支払金合計

		$bonus_cnt = floor($kaisuu / 6);
		if($bonus_cnt > 0){
			$bonus = $item['item4'] * $bonus_cnt;
		}else{
			$bonus = 0;
		}

		$bunkatu = $sougaku - $bonus;

		$after = floor(($bunkatu / $kaisuu)/100)*100;		//第2回目以降分割支払金

		$first = $bunkatu - ($after * ($kaisuu-1));		//第1回目分割支払金

		//エラーチェック
		if($after < 1
		|| $first < 1
		|| $sougaku < ($bonus*2)
		){
			$msg = make_err("エラー","ボーナス支払額の合計が、支払金額合計の半分以下になるように設定してください。");
		}
	}
	disp_err($msg);
?>
				<form name="basic" method="post" action="loan.php">
					<table>
						<tr>
							<td><strong>購入金額</strong></td>
							<td style="text-align:right">
								<input type="text" name="item0" size="11" maxlength="8" value="<?=$item['item0']?>" style="text-align:right" onChange="setItem2();">円
						</td>
						</tr>
						<tr>
							<td><strong>頭金</strong></td>
							<td style="text-align:right">
								<input type="text" name="item1" size="11" maxlength="8" value="<?=$item['item1']?>" style="text-align:right" onChange="setItem2();">円
							</td>
						</tr>
						<tr>
							<td><strong>ローン希望額</strong></td>
							<td style="text-align:right">
								<input type="text" name="item2" size="11" maxlength="8" value="<?=$item['item2']?>" style="text-align:right" readonly>円
							</td>
						</tr>
						<tr>
							<td><strong>希望支払い回数 </strong></td>
							<td style="text-align:right">
								<select name="item3">
<?php
		foreach($ritu as $key => $value){
			print("<option value=\"".$key."\" ");
			if($item['item3'] == $key){
				print("selected");
			}
			print(">".$key."</option>\n");
		}
?>
								</select>
								回
							</td>
						</tr>
						<tr valign="middle">
							<td><strong>ボーナス月加算支払額</strong></td>
							<td style="text-align:right">
								<input type="text" name="item4" size="11" maxlength="8" style="text-align:right" value="<?=$item['item4']?>">円
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center;padding-bottom:50px;border:none"><input type="submit" name="result" value="計算する"></td>
						</tr>
<?php
	if($msg == ""
	&& isset($item['result'])
	){
?>
						<tr>
							<td><strong>お支払回数</strong></td>
							<td style="text-align:right"><strong><font color="#CC0000"><?=$item['item3']?>回払</strong></td>
						</tr>
<?php
		if($bonus_cnt > 0
		&& $item['item4'] != 0
		){
?>
						<tr>
							<td height="30"><strong>ボーナス月加算支払額</strong></td>
							<td style="text-align:right"><font color="#CC0000"><strong><?=fig_form($item['item4'])?>円</strong></td>
						</tr>
<?php
		}
?>
						<tr>
							<td><strong>第1回目分割支払金</strong></td>
							<td style="text-align:right"><strong><font color="#CC0000"><?=fig_form($first)?>円</strong></td>
						</tr>
<?php
		if($kaisuu > 1){
?>
						<tr>
							<td><strong>第2回目以降分割支払金</strong></td>
							<td style="text-align:right"><strong><font color="#CC0000"><?=fig_form($after)?>円</strong></td>
						</tr>
<?php
		}
?>
						<tr>
							<td valign="middle"><strong>分割手数料</strong></td>
							<td style="text-align:right"><strong><font color="#CC0000"><?=fig_form($tanri)?>円</strong></td>
						</tr>
						<tr>
							<td><strong>分割支払金合計 </strong></td>
							<td style="text-align:right"><strong><font color="#CC0000"><?=fig_form($sougaku)?>円</strong></td>
						</tr>
						<tr>
							<td><strong>総合計金額 </strong></td>
							<td style="text-align:right"><strong><font color="#CC0000"><?=fig_form($sougaku+$item['item1'])?>円</strong></td>
						</tr>
						<tr>
							<td><strong>お支払期間 </strong></td>
							<td style="text-align:right"><strong><font color="#CC0000"><?=$from_Y."年".$from_n."月"?>～<?=$to_Y."年".$to_n."月"?></strong></td>
						</tr>
<?php
	}
?>
					</table>
				</form>
				</div>
			</main>
			<aside>
				<ul class="banner-list">
					<li><a href="<?php echo $home_url ?>article/works.html">
						<img src="<?php echo $home_url ?>img/bnr01.jpg" alt="Guitar room 501 Works" />
					</a></li>
					<li><a href="<?php echo $home_url ?>article/collings.html">
						<img src="<?php echo $home_url ?>img/bnr02.jpg" alt="Collings CUITER" />
					</a></li>
					<li><a href="<?php echo $home_url ?>article/sumi.html">
						<img src="<?php echo $home_url ?>img/bnr03.jpg" alt="Sumi工房" />
					</a></li>
					<li><a href="<?php echo $home_url ?>article/furch.html">
						<img src="<?php echo $home_url ?>img/bnr04.jpg" alt="FURCH GUITARS" />
					</a></li>
					<li><a href="<?php echo $home_url ?>article/tsk.html">
						<img src="<?php echo $home_url ?>img/bnr05.jpg" alt="TSK" />
					</a></li>
					<li><a href="<?php echo $home_url ?>article/sakata.html">
						<img src="<?php echo $home_url ?>img/bnr07.jpg" alt="Sakata Guitars" />
					</a></li>
					<li><a href="https://www.instagram.com/hobos.acoustic/" target="_blank">
						<img src="<?php echo $home_url ?>img/bnr06.jpg" alt="Guitar room 501 INSTAGRAM" />
					</a></li>
				</ul>
				<section>
					<h2 class="times infor">Information</h2>
<?php
	//--- infoフォルダ内のテキストファイルを取得する
	$fp_cnt = 0;
	for($fp=0;$fp<7;$fp++){
		$datpath = DATPATH."info/".$fp.".txt";
		//テキストファイルRead
		if(!file_read($datpath,100,$info[$fp])){
			print("File read error!!( /".$datpath." )<BR>\n");
			exit;
		}
		//非表示フラグがCheckedでなければ表示する
		if($info[$fp][3] != "checked"){
			$fp_cnt++;
		}
	}

	//--- 0件でなければ表示
	if($fp_cnt == 0){
		exit;
	}
	mb_convert_variables("UTF-8", "SJIS-win", $info);
?>
					<ul class="news-list">
<?php

	//--- 表示する(MAX7件)
	for($fp=0;$fp<7;$fp++){
		//非表示フラグがCheckedでなければ表示する
		if($info[$fp][3] != "checked"){
			print("<li>");
			//--- New
			if($info[$fp][2] == "checked"){
				print("<font color=\"#CC0033\"><i>New!</i></font><br>\n");
			}
			print("<a href=\"".$site_url."cgi-bin/guitarroom501/info/detail.php?cd=".$fp."\">");
			//--- タイトルテキスト
			if($info[$fp][0] != ""){
				print("<time>".$info[$fp][0]."</time>");
			}
/*
			//--- 画像
			if($info[$fp][1] != ""){
				$imgpath = DATPATH2."info/".$fp.".jpg";
				print("<img align=\"".$info[$fp][1]."\" src=\"".$imgpath."\" vspace=\"10\" hspace=\"10\">\n");
			}
*/
			//--- 本文テキスト
			//最大行数を求める
			$gyosuu = 0;
			for($j=5;$j<100;$j++){
				if($info[$fp][$j] != ""){
					$gyosuu = $j;
				}
			}
			//マルチラインテキスト
			$txt = "";
			for($j=5;$j<$gyosuu+1;$j++){
				$txt .= strip_tags($info[$fp][$j]);
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

				</section>
			</aside>
		</div>
	</div>
	<footer>
		<div class="inner">
			<h1 class="times">Calendar</h1>
<?php include_once("../top/calender2.php"); ?>
			<div class="footer-shop-area">
				<a href="../index.html"><img src="<?php echo $home_url ?>img/interface/logo_white.png" width="212" height="83" alt="ACOUSTIC GUITER SHOP Guitar room 501" /></a>
				<p>アコースティックギターショップ Hobo’s</p>
				<address>
					<p>〒101-0052 東京都千代田区神田小川町2-12 信愛ビルB1</p>
					<p>TEL：0120-182845(フリーダイヤル)</p>
					<p>または　03-3518-4249</p>
					<p>営業時間：11:00～19:00　定休日は水曜日です</p>
					<p>（日曜日、祝・祭日 19:00 閉店）</p>
					<p>E-mail：<a href="mailto:hobo@guitarroom501">hobo@guitarroom501</a></p>
				</address>
				<img src="<?php echo $home_url ?>img/shop.jpg" />
			</div>
		</div>
		<div class="footer-copy-area">
			<small>Copyright(C) 2018 Guitar room 501 All Rights Reserved.</small>
		</div>
	</footer>
</div>

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
</script>
</body>
</html>
