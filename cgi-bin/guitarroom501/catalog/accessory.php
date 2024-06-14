#!/usr/local/bin/php
<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	$site_url ="http://demo.iolite.co.jp/guitarroom501/";
	$home_url ="http://demo.iolite.co.jp/guitarroom501/";
	//$site_url ="http://www.guitarroom501/";
	//$home_url ="http://www.guitarroom501/";

	//文字化け対策（エスケープ処理：表示用）
	$post = make_up_bs($_POST,0);
	$get = make_up_bs($_GET,0);

	//GET値のチェック
	if($get['cd'] == ""){
		disp_err(make_err("エラー","ページの呼び出しが不正です。"));
		exit;
	}

	//データファイルパスのセット
	$path = DATPATH."others/".$get['cd'].".txt";

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
		disp_err(make_err("エラー","この商品は既に売り切れております。"));
		exit;
	}

	$title = $dat[1]." ".$dat[3]." ".$dat[4];
	//画像ファイルチェック
	if(file_exists(DATPATH."others/".$get['cd'].".jpg")){
		$imgpath = "<img src=\"".$home_url."data/others/".$get['cd'].".jpg\" alt=\"".htmlspecialchars($title)."\">";
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
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="description" content="Guitar Room 501 "Adirondack / Madagascar Rosewood"の詳細ページです。" />
<meta name="keywords" content="guitarroom501,ギタールーム501,ギター販売,ギター修理,千代田区,神田">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<meta name="format-detection" content="telephone=no, email=no, address=no">
<!-- ページ公開時に削除 -->
<meta name="robots" content="noindex">
<!-- ここまで -->
<title>ケース＆アクセサリー/<?=$dat[1]?> <?=$dat[3]?> | Guitar room 501</title>
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
		<nav>
			<ul>
			<li>
				<a href="<?php echo $home_url ?>index.html">Home</a></li>
				<li><a href="<?php echo $home_url ?>inventory/index.html">Inventory</a></li>
				<li><a href="<?php echo $home_url ?>shopguide/index.html">Shop Guide</a></li>
				<li><a href="<?php echo $home_url ?>howtoorder/index.html">How to Order</a></li>
				<li><a href="<?php echo $home_url ?>makers/index.html">Makers</a></li>
				<li><a href="<?php echo $home_url ?>repairs/index.html">Repairs</a></li>
			</ul>
		</nav>
		<span id="nav_sp"><span></span><span></span></span>
	</header>
	<article id="sub_detail_area">
		<div>
			<div class="slider-for">
				<div><?=$imgpath?></div>
			</div>
			<div class="info">
				<p class="brand"><?=$dat[1]?></p>
				<h1><?=$dat[3]?></h1>
				<p class="price" style="margin-top:15px;">
<?php
	print(kingaku($dat[5],3,"Y"));
?>
				</p>

<!-- 						<h2><span><?=$dat[1]?></span><?=$dat[3]?></h2>
						<p><?=$dat[4]?></p>
 -->
			</div>
		</div>
		<section id="sub_contents_detail">
				<h2>商品詳細</h2>
				<p><?=$text?></p>
		</section>
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
</script>
</body>
</html>