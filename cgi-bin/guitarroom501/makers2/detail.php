#!/usr/local/bin/php
<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	//バーゲン中か判断
	$path = DATPATH."bargain.txt";
	if(!file_read($path,2,$bargain)){
		print("File read error!!( ".$path." )<BR>\n");
		exit;
	}
	if($bargain[0] <= date('Ymd')
	&& $bargain[1] >= date('Ymd')
	){
		$bar_flg = TRUE;
	}else{
		$bar_flg = FALSE;
	}

	//文字化け対策（エスケープ処理：表示用）
	$post = make_up_bs($_POST,0);
	$get = make_up_bs($_GET,0);

	//GET値のチェック
	if($get['maker'] == ""
	|| $get['cd'] == ""
	){
		disp_err(make_err("エラー","ページの呼び出しが不正です。"));
		exit;
	}

	//データファイルパスのセット
	$path = DATPATH."makers/".$_GET['maker']."/".$_GET['cd'].".txt";

	//データファイル存在チェック
	if(!file_exists($path)){
		disp_err(make_err("エラー","ページの呼び出しが不正です。"));
		exit;
	}

	//データファイルREAD
	if(!file_read($path,100,$dat)){
		print("File read error!!( ".$path." )<BR>\n");
		exit;
	}

	//売り切れ or 非表示の場合、表示しない
	if($dat[8] == "checked"
	|| $dat[49] == "checked"
	){
		disp_err(make_err("エラー","この商品は既に売り切れております。"));
		exit;
	}


	//--- 本文テキスト
	//最大行数を求める
	$gyosuu = 0;
	for($i=50;$i<100;$i++){
		if($dat[$i] != ""){
			$gyosuu = $i;
		}
	}
	//マルチラインテキストの生成
	$text = "";
	for($i=50;$i<$gyosuu+1;$i++){
		$text .= $dat[$i]."<br>\n";
	}

	//画像ファイルチェック（FRONT）
	if(file_exists(DATPATH."makers/".$_GET['maker']."/".$_GET['cd']."_front_s.jpg")){
		$imgpath_front = "<img src=\"".DATPATH2."makers/".$_GET['maker']."/".$_GET['cd']."_front_s.jpg\">";
	}else{
		$imgpath_front = "";
	}

	//画像ファイルチェック（BACK）
	if(file_exists(DATPATH."makers/".$_GET['maker']."/".$_GET['cd']."_back_s.jpg")){
		$imgpath_back = "<img src=\"".DATPATH2."makers/".$_GET['maker']."/".$_GET['cd']."_back_s.jpg\">";
	}else{
		$imgpath_back = "";
	}

?>
<HTML>
<HEAD>
<meta http-equiv=Content-Type content="text/html; charset=Shift_JIS">
<TITLE>Guitar room 501 Stock List</TITLE>
</HEAD>
<BODY background="<?=IMGPATH?>bg_wood.gif" link="#CC0000" vlink="#666666" leftmargin="0" topmargin="10">
<table width="640" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="6" colspan="4" align="center" valign="top">
	<?php disp_menu(); ?></td>
  </tr>
  <tr>
    <td height="30" colspan="4" align="center">&nbsp;</td>
  </tr>
</table>
<div style="background-color:#FFECFD;">
<table width="640" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr valign="top"> 
      <td height="7" colspan="4" align="center">&nbsp;</td>
    </tr>
  <tr bgcolor="#CCCCCC">
    <td width="8" height="4"><font size="1"><img src="<?=IMGPATH?>clear.gif" width="7" height="7"></font></td>
    <td width="130" height="4"><font size="1"><img src="<?=IMGPATH?>clear.gif" width="7" height="7"></font></td>
    <td width="494" height="4" align="right"><font size="1"><img src="<?=IMGPATH?>clear.gif" width="7" height="7"></font></td>
    <td width="8" align="right"><font size="1"><img src="<?=IMGPATH?>clear.gif" width="7" height="7"></font></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td width="8">&nbsp;</td>
    <td colspan="2" align="center" valign="middle"><font color="#660033" size="2">&nbsp;</font><font color="#660033" size="2">&nbsp;</font>
      <table width="610" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="3" align="center"><strong><font size="4">
            <?=$dat[1]?>
            <?=$dat[2]?>
            <br>
<!--            (
            <?=$dat[3]?>
            )<br>
-->
            <?
	if($dat[5] != ""
	&& $dat[5] != 0
	&& $dat[6] != ""
	&& $dat[6] != 0
	&& $dat[5] < $dat[6]
	){
		//旧価格あり
		print("<strong>".kingaku($dat[6],0)."</strong>");
		print("→<font color=\"#CC0000\"><strong>".kingaku($dat[5],0)."</strong></font>");
	}else{
		//旧価格なし
		print("<strong>".kingaku($dat[5],0)."</strong>");
	}
	if($bar_flg
	&& $dat[7] != ""
	){
		print("<font color=\"#FF6600\"><strong>→".kingaku($dat[7],0)."</strong></font>");
	}
?>
            </font></strong></td>
        </tr>
        <?php
	//売り切れの場合、表示しない
	if($dat[8] != "checked"){
?>
        <tr>
          <td colspan="3" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td width="160"><font color="#660033" size="1">拡大して見たい部分（<font color="#CC0000"><strong>○</strong><font color="#660033">部分）<br>
            </font><font color="#660033" size="1">を</font><font color="#660033">クリックして下さい。<br>
            <br>
            </font></font><img src="<?=DETAILIMGPATH?>guitar.gif" width="120" height="290" border="0" usemap="#Map" target="_blank"><br>
            <a href="detail_photo.php?maker=<?=$_GET['maker']?>&cd=<?=$_GET['cd']?>&case" target="_blank"><img src="<?=DETAILIMGPATH?>guitarcase.gif" width="18" height="45" border="0"></a>
            <br>
            <?php
		//画像ファイルチェック（特殊１）
		if(file_exists(DATPATH."makers/".$_GET['maker']."/".$_GET['cd']."_special1.jpg")){
			print("<a href=\"detail_photo.php?maker=".$_GET['maker']."&cd=".$_GET['cd']."&special=1\" target=\"_blank\">特別写真１</a><br>\n");
		}
		//画像ファイルチェック（特殊２）
		if(file_exists(DATPATH."makers/".$_GET['maker']."/".$_GET['cd']."_special2.jpg")){
			print("<a href=\"detail_photo.php?maker=".$_GET['maker']."&cd=".$_GET['cd']."&special=2\" target=\"_blank\">特別写真２</a><br>\n");
		}
		//画像ファイルチェック（特殊３）
		if(file_exists(DATPATH."makers/".$_GET['maker']."/".$_GET['cd']."_special3.jpg")){
			print("<a href=\"detail_photo.php?maker=".$_GET['maker']."&cd=".$_GET['cd']."&special=3\" target=\"_blank\">特別写真３</a><br>\n");
		}
		//画像ファイルチェック（特殊４）
		if(file_exists(DATPATH."makers/".$_GET['maker']."/".$_GET['cd']."_special4.jpg")){
			print("<a href=\"detail_photo.php?maker=".$_GET['maker']."&cd=".$_GET['cd']."&special=4\" target=\"_blank\">特別写真４</a><br>\n");
		}
?>
            <br>
            他に拡大して見たい部分が<br>
            ございましたらご遠慮なく<br>
            メールでお申し付け下さい。<br>
            <br>
            <a href="mailto:hobo@guitarroom501"><font size="2">hobo@guitarroom501</font></a>
            </font></td>
          <td align="right">
            <?=$imgpath_front?>
          </td>
          <td align="right">
            <?=$imgpath_back?>
          </td>
        </tr>
        <?php
	}
?>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3"><table width="580" border="0" align="center" cellpadding="0" cellspacing="2">
<!--              <tr>
                <td width="290" align="right"><font size="3">CONDITION： </font></td>
                <td width="290"><font size="3">
                  <?=$dat[12]?>
                  </font></td>
              </tr>
-->
              <tr>
                <td width="580" colspan="2">&nbsp;</td>
              </tr>
              <?php
	if($dat[14] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">TOP：</font></td>
                <td width="290"><font size="3">
                  <?=$dat[14]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[15] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">SIDE＆BACK：</font></td>
                <td width="290"><font size="3">
                  <?=$dat[15]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[16] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">NECK：</font></td>
                <td width="290"><font size="3">
                  <?=$dat[16]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[17] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">FINGER BOAD：</font></td>
                <td width="290"><font size="3">
                  <?=$dat[17]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[18] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">BRIDGE：</font></td>
                <td width="290"><font size="3">
                  <?=$dat[18]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[19] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">TRIM：</font></td>
                <td width="290"><font size="3">
                  <?=$dat[19]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[20] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">ROSSETTE：</font></td>
                <td width="290"><font size="3">
                  <?=$dat[20]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[21] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">PICK GUARD COLOR：</font></td>
                <td width="290"><font size="3">
                  <?=$dat[21]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[29] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">POSITION MARK：</font></td>
                <td width="290"><font size="3">
                  <?=$dat[29]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[22] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">TUNER：</font></td>
                <td width="290"><font size="3">
                  <?=$dat[22]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[23] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">BRACING：</font></td>
                <td width="290"><font size="3">
                  <?=$dat[23]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[24] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">NUT WIDTH：</font></td>
                <td width="290"><font size="3">
                  <?=$dat[24]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[25] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">SCALE：</font></td>
                <td width="290"><font size="3">
                  <?=$dat[25]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[26] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">OTHERS 1：</font></td>
                <td width="290"><font size="3">
                  <?=$dat[26]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[27] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">OTHERS 2：</font></td>
                <td width="290"><font size="3">
                  <?=$dat[27]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[28] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">OTHERS 3：</font></td>
                <td width="290"><font size="3">
                  <?=$dat[28]?>
                  </font></td>
              </tr>
              <?php
	}
?>
              <tr>
                <td width="580" colspan="2">&nbsp;</td>
              </tr>
            </table>
            <font size="3">
            <?=$text?>
            </font> </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
      </table></td>
    <td width="8" align="right">&nbsp;</td>
  </tr>
      <TR>
        <TD width=8>&nbsp;</TD>
        <TD vAlign=center align=middle colSpan=2>&nbsp; </TD>
        <TD align=right width=8>&nbsp;</TD>
      </TR>
</table>
</div>
<p align="center"><font color="#000000" size="2">Copyright(C) 2004 HOBO'S All
  Rights Reserved.</font></p>
<map name="Map">
  <area shape="rect" coords="6,44,44,61" href="detail_photo.php?maker=<?=$_GET['maker']?>&cd=<?=$_GET['cd']?>&front" target="_blank">
  <area shape="rect" coords="77,44,115,61" href="detail_photo.php?maker=<?=$_GET['maker']?>&cd=<?=$_GET['cd']?>&back" target="_blank">
  <area shape="circle" coords="48,10,9" href="detail_photo.php?maker=<?=$_GET['maker']?>&cd=<?=$_GET['cd']?>&part=1" target="_blank">
  <area shape="circle" coords="48,87,9" href="detail_photo.php?maker=<?=$_GET['maker']?>&cd=<?=$_GET['cd']?>&part=3" target="_blank">
  <area shape="circle" coords="48,212,9" href="detail_photo.php?maker=<?=$_GET['maker']?>&cd=<?=$_GET['cd']?>&part=5" target="_blank">
  <area shape="circle" coords="20,194,9" href="detail_photo.php?maker=<?=$_GET['maker']?>&cd=<?=$_GET['cd']?>&part=7" target="_blank">
  <area shape="circle" coords="73,10,9" href="detail_photo.php?maker=<?=$_GET['maker']?>&cd=<?=$_GET['cd']?>&part=2" target="_blank">
  <area shape="circle" coords="73,87,9" href="detail_photo.php?maker=<?=$_GET['maker']?>&cd=<?=$_GET['cd']?>&part=4" target="_blank">
  <area shape="circle" coords="73,212,9" href="detail_photo.php?maker=<?=$_GET['maker']?>&cd=<?=$_GET['cd']?>&part=6" target="_blank">
  <area shape="circle" coords="101,194,9" href="detail_photo.php?maker=<?=$_GET['maker']?>&cd=<?=$_GET['cd']?>&part=8" target="_blank">
</map>
</BODY>
</HTML>
