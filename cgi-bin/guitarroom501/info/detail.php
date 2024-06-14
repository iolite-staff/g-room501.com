#!/usr/local/bin/php
<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	//$site_url ="http://demo.iolite.co.jp/guitarroom501/";
	//$home_url ="http://demo.iolite.co.jp/guitarroom501/";
	$site_url ="https://www.g-room501.com/";
	$home_url ="https://www.g-room501.com/";

	//文字化け対策（エスケープ処理：表示用）
	$post = make_up_bs($_POST,0);
	$get = make_up_bs($_GET,0);

	//GET値のチェック
	if($get['cd'] == ""){
		disp_err(make_err("エラー","ページの呼び出しが不正です。"));
		exit;
	}

	//データファイルパスのセット
	$path = DATPATH."info/".$get['cd'].".txt";

	//データファイル存在チェック
	if(!file_exists($path)){
		disp_err(make_err("エラー","ページの呼び出しが不正です。"));
		exit;
	}

	//データファイルREAD
	if(!file_read($path,301,$dat)){
		print("File read error!!( ".$path." )<BR>\n");
		exit;
	}
	mb_convert_variables("UTF-8", "SJIS-win", $dat);

	//売り切れ or 非表示の場合、表示しない
	if($dat[0] == "checked"){
		disp_err(make_err("エラー","ページの呼び出しが不正です。"));
		exit;
	}

	$title = $dat[0];
	//画像ファイルチェック
	if(file_exists(DATPATH."info/".$get['cd'].".jpg")){
		$imgpath = "<img src=\"".$home_url."data/info/".$get['cd'].".jpg\" class=\"".$dat[1]."\" alt=\"".htmlspecialchars($title)."\">";
	}else{
		$imgpath = "";
	}

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
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="description" content="（解説）">
<meta name="keywords" content="guitarroom501,ギタールーム501,ギター販売,ギター修理,千代田区,神田">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<meta name="format-detection" content="telephone=no, email=no, address=no">
<title>Information/<?=$dat[0]?> | Guitar room 501</title>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $home_url ?>css/common.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $home_url ?>css/screen.css" />
<link rel="stylesheet" type="text/css" media="screen and (max-width:660px)" href="<?php echo $home_url ?>css/screen_sp.css" />
<link rel="stylesheet" type="text/css" media="screen and (min-width:661px) and (max-width:1023px)" href="<?php echo $home_url ?>css/screen_tb.css" />
<link rel="stylesheet" type="text/css" media="screen and (min-width:1024px)" href="<?php echo $home_url ?>css/screen_pc.css" />
<link rel="stylesheet" type="text/css" media="print" href="<?php echo $home_url ?>css/print.css" />
<link rel="apple-touch-icon" href="<?php echo $home_url ?>apple-touch-icon.png" />
<link rel="icon" type="image/png" href="<?php echo $home_url ?>favicon-.png" sizes="16x16">
<link rel="icon" type="image/png" href="<?php echo $home_url ?>favicon.png" sizes="32x32">
<script type="text/javascript" src="<?php echo $home_url ?>lib/jquery/jquery-3.7.1.min.js"></script>
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
						<li><a href="<?php echo $home_url ?>inventroy/category.html">All</a></li>
						<li><a href="<?php echo $home_url ?>inventory/category1.html">Electric Guitar</a></li>
						<li><a href="<?php echo $home_url ?>inventory/category2.html">Electric Bass</a></li>
						<li><a href="<?php echo $home_url ?>inventory/category3.html">Acoustic Guitar</a></li>
						<li><a href="<?php echo $home_url ?>inventory/category4.html">Others</a></li>
						<!--<li><a href="../ca/index.html">Case & Accessories</a></li>-->
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
	<article id="sub_contents_area" class="info_area">
		<h1><span>Information</span></h1>
		<div class="inner">
			<h2><?=$dat[0]?></h2>
			<div class="item">
				<?=$imgpath?>
				<p><?=$text?></p>
			</div>
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
	$(document).ready(function(){
			var windowsize = window.matchMedia('screen and (max-width:767px)');
			function checkBreakPoint(windowsize) {
				if (windowsize.matches) {
					$('body>header>nav').css({'display':'none'});
				} else {
					$('body>header>nav').css({'display':'block'});
				}
			}
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