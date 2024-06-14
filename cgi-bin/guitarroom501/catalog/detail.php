#!/usr/local/bin/php
<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	//$site_url ="http://demo.iolite.co.jp/guitarroom501/";
	//$home_url ="http://demo.iolite.co.jp/guitarroom501/";
	$site_url ="https://www.g-room501.com/";
	$home_url ="https://www.g-room501.com/";

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

	//文字化け対策（エスケープ処理：表示用）
	$post = make_up_bs($_POST,0);
	$get = make_up_bs($_GET,0);

	//GET値のチェック
	if($get['maker'] == "" || $get['cd'] == ""){
		disp_err(make_err("エラー","ページの呼び出しが不正です。"));
		exit;
	}

	//データファイルパスのセット
	$path = DATPATH."guitar/".$_GET['maker']."/".$_GET['cd'].".txt";

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

	//--- 本文テキスト
	//最大行数を求める
	$gyosuu = 0;
	for($i=50;$i<300;$i++){
		if($dat[$i] != ""){
			$gyosuu = $i;
		}
	}
	//マルチラインテキストの生成
	$text = "";
	for($i=50;$i<$gyosuu+1;$i++){
		$text .= $dat[$i]."<br>\n";
	}
	//--- ギターリストテキスト
	//最大行数を求める
	$gyosuu = 0;
	for($i=100;$i<300;$i++){
		if($dat[$i] != ""){
			$gyosuu = $i;
		}
	}
	//マルチラインテキストの生成
	$text2 = "";
	for($i=100;$i<$gyosuu+1;$i++){
		$text2 .= $dat[$i]."<br>\n";
	}
	$item_name = htmlspecialchars($dat[1])." ".htmlspecialchars($dat[2]);

	//画像ファイルチェック（SMALL）
	if(file_exists(DATPATH."guitar/".$_GET['maker']."/".$_GET['cd']."_small.jpg")){
		$img_list[] = "<img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_small.jpg\" alt=\"".$item_name." SMALL\">";
		$imgpath_list[] = "<a href=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_small.jpg\" data-fancybox=\"images\"><img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_small.jpg\" alt=\"".$item_name." SMALL\"></a>";
	}
	//画像ファイルチェック（FRONT_S）
	if(file_exists(DATPATH."guitar/".$_GET['maker']."/".$_GET['cd']."_front_s.jpg")){
		$img_list[] = "<img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_front_s.jpg\" alt=\"".$item_name." FRONT_S\">";
		$imgpath_list[] = "<a href=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_front_s.jpg\" data-fancybox=\"images\"><img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_front_s.jpg\" alt=\"".$item_name." FRONT_S\"></a>";
	}
	//画像ファイルチェック（BACK_S）
	if(file_exists(DATPATH."guitar/".$_GET['maker']."/".$_GET['cd']."_back_s.jpg")){
		$img_list[] = "<img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_back_s.jpg\" alt=\"".$item_name." BACK_S\">";
		$imgpath_list[] = "<a href=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_back_s.jpg\" data-fancybox=\"images\"><img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_back_s.jpg\" alt=\"".$item_name." BACK_S\"></a>";
	}

	//画像ファイルチェック（FRONT）
	if(file_exists(DATPATH."guitar/".$_GET['maker']."/".$_GET['cd']."_front.jpg")){
		$imgpath_front = "<img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_front.jpg\" alt=\"".$item_name." FRONT\">";
		$img_list[] = "<img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_front.jpg\" alt=\"".$item_name." FRONT\">";
		$imgpath_list[] = "<a href=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_front.jpg\" data-fancybox=\"images\"><img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_front.jpg\" alt=\"".$item_name." FRONT\"></a>";
	}else{
		$imgpath_front = "";
	}

	//画像ファイルチェック（BACK）
	if(file_exists(DATPATH."guitar/".$_GET['maker']."/".$_GET['cd']."_back.jpg")){
		$img_list[] = "<img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_back.jpg\" alt=\"".$item_name." BACK\">";
		$imgpath_list[] = "<a href=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_back.jpg\" data-fancybox=\"images\"><img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_back.jpg\" alt=\"".$item_name." BACK\"></a>";
	}else{
		$imgpath_back = "";
	}

	//画像ファイルチェック（ギターリスト）
	if(file_exists(DATPATH."guitar/".$_GET['maker']."/".$_GET['cd']."_gList.jpg")){
		$img_list[] = "<img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_gList.jpg\" alt=\"".$item_name." GUITAR LIST\">";
		$imgpath_list[] = "<a href=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_gList.jpg\" data-fancybox=\"images\"><img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_gList.jpg\" alt=\"".$item_name." GUITAR LIST\"></a>";
	}else{
		$imgpath_gList = "";
	}
	for($i=1;$i<=8;$i++){
		if(file_exists(DATPATH."guitar/".$_GET['maker']."/".$_GET['cd']."_part".$i.".jpg")){
			$img_list[] = "<img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_part".$i.".jpg\" alt=\"".$item_name." ".$i."\">";
			$imgpath_list[] = "<a href=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_part".$i.".jpg\" data-fancybox=\"images\"><img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_part".$i.".jpg\" alt=\"".$item_name." ".$i."\"></a>";
		}
	}

	//画像ファイルチェック（CASE）
	if(file_exists(DATPATH."guitar/".$_GET['maker']."/".$_GET['cd']."_case.jpg")){
		$img_list[] = "<img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_case.jpg\" alt=\"".$item_name." CASE\">";
		$imgpath_list[] = "<a href=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_case.jpg\" data-fancybox=\"images\"><img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_case.jpg\" alt=\"".$item_name." CASE\"></a>";
	}
	//画像ファイルチェック（特殊１）
	if(file_exists(DATPATH."guitar/".$_GET['maker']."/".$_GET['cd']."_special1.jpg")){
		$img_list[] = "<img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_special1.jpg\" alt=\"".$item_name." SPECIAL1\">";
		$imgpath_list[] = "<a href=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_special1.jpg\" data-fancybox=\"images\"><img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_special1.jpg\" alt=\"".$item_name." SPECIAL1\"></a>";
	}
	//画像ファイルチェック（特殊２）
	if(file_exists(DATPATH."guitar/".$_GET['maker']."/".$_GET['cd']."_special2.jpg")){
		$img_list[] = "<img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_special2.jpg\" alt=\"".$item_name." SPECIAL2\">";
		$imgpath_list[] = "<a href=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_special2.jpg\" data-fancybox=\"images\"><img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_special2.jpg\" alt=\"".$item_name." SPECIAL2\"></a>";
	}
	//画像ファイルチェック（特殊３）
	if(file_exists(DATPATH."guitar/".$_GET['maker']."/".$_GET['cd']."_special3.jpg")){
		$img_list[] = "<img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_special3.jpg\" alt=\"".$item_name." SPECIAL3\">";
		$imgpath_list[] = "<a href=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_special3.jpg\" data-fancybox=\"images\"><img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_special3.jpg\" alt=\"".$item_name." SPECIAL3\"></a>";
	}
	//画像ファイルチェック（特殊４）
	if(file_exists(DATPATH."guitar/".$_GET['maker']."/".$_GET['cd']."_special4.jpg")){
		$img_list[] = "<img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_special4.jpg\" alt=\"".$item_name." SPECIAL4\">";
		$imgpath_list[] = "<a href=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_special4.jpg\" data-fancybox=\"images\"><img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_special4.jpg\" alt=\"".$item_name." SPECIAL4\"></a>";
	}
	//画像ファイルチェック（その他）
	if(file_exists(DATPATH."guitar/".$_GET['maker']."/".$_GET['cd']."_others.jpg")){
		$img_list[] = "<img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_others.jpg\" alt=\"".$item_name." その他\">";
		$imgpath_list[] = "<a href=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_others.jpg\" data-fancybox=\"images\"><img src=\"".$home_url."data/guitar/".$_GET['maker']."/".$_GET['cd']."_others.jpg\" alt=\"".$item_name." その他\"></a>";
	}else{
		$imgpath_back = "";
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
<title>在庫情報/<?=$dat[1]?> <?=$dat[2]?> | Guitar Room 501</title>
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
	<article id="sub_detail_area">
	<div>
			<div class="slider-for">
<?php
	foreach($imgpath_list as $key => $value){
?>
				<div>
				<?php echo $value ?>
				</div>
<?php
}
?>
</div>
			<div class="info">
				<div class="tag">
<?php
	if($dat[8] == "checked"){
		print("<span class=\"red\">SOLD OUT</span>\n");
	}elseif($dat[9] == "checked"){
		print("<span class=\"red\">ON HOLD</span>\n");
//	}elseif($dat[0] > $new_time){
//		print("<img src=\"img/new.gif\">\n");
	}
	if($dat[33] == "new"){
		print("<span class=\"red\">NEW</span>\n");
	}elseif($dat[33] == "used"){
		print("<span class=\"purple\">USED</span>\n");
	}elseif($dat[33] == "vintage"){
		print("<span class=\"purple\">VINTAGE</span>\n");
	}elseif($dat[5] != "" && $dat[5] != 0 && $dat[6] != "" && $dat[6] != 0 && $dat[5] < $dat[6]){
		print("<span class=\"purple\">MARK DOWN</span>\n");
	}
?>
				</div>
				<p class="brand"><?=$dat[1]?></p>
				<h1><?=$dat[2]?></h1>
				<p><?=$dat[3]?></p>
				<p class="price">
<?
	if($dat[32] == "checked"){
		print("¥ASK");
	}elseif($dat[5] != "" && $dat[5] != 0 && $dat[6] != "" && $dat[6] != 0 && $dat[5] < $dat[6]){
		//旧価格あり
		print(kingaku($dat[6],3,"Y"));
		print("→".kingaku($dat[5],3,"Y"));
	}else{
		//旧価格なし
		print(kingaku($dat[5],3,"Y"));
	}
	if($bar_flg && $dat[7] != ""){
		print("→".kingaku($dat[7],3,"Y"));
	}
?>
				</p>
						<div class="slider-nav">
<?php
	foreach($img_list as $key => $value){
?>
							<div class="slider_pic"><a href="javascript:void(0);"><?php echo $value ?></a></div>
<?php
	}
?>
						</div>
					</div>
				</div>
				<section id="sub_contents_detail">
<?php
	if($dat[34] != ""){
?>
					<div class="video">
						<iframe src="<?=$dat[34]?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
					</div>
<?php
	}
?>
					<h2>商品詳細</h2>
					<p>
						<?=$text?>
					</p>
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
<div id="grayDisplay"></div>
<!-- js -->
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
		$(".img_switch").on("click", function() {
			var img = $(this).children("img").attr('src');
			$("#img_area a").attr('href',img);
			$("#img_area a img").attr('src',img);
		});
	});
</script>
<script src="<?php echo $home_url ?>js/fancybox.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
      // 基本構成
      $('.fancybox').fancybox();
  });
</script>
<script type="text/javascript">
		$(document).ready(function(){
			var windowsize = window.matchMedia('screen and (max-width:767px)');
			function checkBreakPoint(windowsize) {
				if (windowsize.matches) {
					$('body>header>nav').css({'display':'none'});
				} else {
					$('body>header>nav').css({'display':'block'});
				}
			}
		});
		$(document).ready(function(){
			$('#sub_detail_area .slider-for').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				asNavFor: '.slider-nav'
			});
			$('#sub_detail_area .slider-nav').slick({
				slidesToShow: 20,
				slidesToScroll: 1,
				asNavFor: '.slider-for',
				focusOnSelect: true
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