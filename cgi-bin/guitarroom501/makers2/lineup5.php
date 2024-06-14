#!/usr/local/bin/php
<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');
?>
<html>
<head>
<meta http-equiv=content-type content="text/html; charset=shift_jis">
<title>HOBO'S COLLINGS-LINEUP</title>
<link href="<?=BASEPATH?>makers/stocklist2.css" rel="stylesheet" type="text/css">
</head>
<body background="<?=IMGPATH?>bg_wood.gif" link="#cc0000" vlink="#666666" style="margin:10px 0px 0px 0px;">
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
<div style="background-color:#ffecfd;">
<table width="640" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr valign="top"> 
      <td height="7" colspan="4" align="center">&nbsp;</td>
    </tr>
  <tr bgcolor="#cccccc">
    <td width="8" height="4"><font size="1"><img src="<?=IMGPATH?>clear.gif" width="7" height="7"></font></td>
    <td width="130" height="4"><font size="1"><img src="<?=IMGPATH?>clear.gif" width="7" height="7"></font></td>
    <td width="494" height="4" align="right"><font size="1"><img src="<?=IMGPATH?>clear.gif" width="7" height="7"></font></td>
    <td width="8" align="right"><font size="1"><img src="<?=IMGPATH?>clear.gif" width="7" height="7"></font></td>
  </tr>
  <tr bgcolor="#cccccc">
    <td width="8">&nbsp;</td>
      <td colspan="2" align="center" valign="middle"><br>
        <table width="610" border="0" cellpadding="0" cellspacing="8">
          <tr> 
            <td colspan="4"> <span class="title"><font size="4">SJ</font></span></td>
          </tr>
          <tr> 
            <td width="300" colspan="2" rowspan="3"><img name="GuitarImagew" src="<?=DATPATH2?>makers/<?=$_GET['maker']?>/line5_0.jpg" alt="" width="240" height="370" style="background-color: #FFFFFF"><br>
                <div align="center"><span class="model">ＳＪ</span></div></td>
            <td colspan="2" valign="top"><span class="title">SJ</span><br>
              <span class="profile">
サイド＆バックに最高級のグレード"AAA"クラスのカーリーメイプルを標準で採用したスモールジャンボモデルのＳＪ。
引き締まった非常にハギレの良いその乾いたサウンドは、フラットピッキングでその真価を最大限に発揮します。</span></td>
          </tr>
          <tr> 
            <td colspan="2" valign="top"><span class="title">LineUp</span><br>
              <li>SJ Curly Maple Side&amp;Back</li>
              </td>
          </tr>
          <tr> 
            <td colspan="2" align="left" valign="top" class="title">Dimensions<br> 
              <table width="300" border="0" cellspacing="0" cellpadding="0">
                <tr class="text"> 
                  <td align="right" width="100"> Nut Width：</td>
                  <td>1 11/16&quot;(42.9mm)</td>
                </tr>
                <tr class="text"> 
                  <td align="right">Scale Length：</td>
                  <td>25 1/2&quot;（647.7mm）</td>
                </tr>
                <tr class="text"> 
                  <td align="right">Body Width：</td>
                  <td> 16&quot;(406.4mm)</td>
                </tr>
                <tr class="text"> 
                  <td align="right">Body Length：</td>
                  <td>20 1/8&quot;(511.1mm)</td>
                </tr>
                <tr class="text"> 
                  <td align="right">Body Depth：</td>
                  <td>4 1/2&quot;(114.3mm)</td>
                </tr>
                <tr class="text"> 
                  <td align="right">Total Length：</td>
                  <td> 40 1/4&quot;(1022.3mm)</td>
                </tr>
              </table></td>
          </tr>
          <tr align="center" valign="top"> 
            <td width="150"><img src="<?=DATPATH2?>makers/<?=$_GET['maker']?>/line5_1.jpg" alt="" name="" width="120" height="160" style="border: 1px solid #999999;"><br>
              <span class="model">Maple Neck</span> </td>
            <td width="150"><br>
              <img src="<?=DATPATH2?>makers/<?=$_GET['maker']?>/line5_2.jpg" alt="" name="" width="120" height="160" style="border: 1px solid #999999;"><br>
              <span class="model">Head of SJ</span></td>
            <td width="150"><br>
              <br>
              <br>
              <img src="<?=DATPATH2?>makers/<?=$_GET['maker']?>/clear.gif" alt="" name="" width="120" height="160"><br>
            </td>
            <td width="150"><br>
              <br>
              <img src="<?=DATPATH2?>makers/<?=$_GET['maker']?>/clear.gif" alt="" name="" width="120" height="160"></td>
          </tr>
        </table>
        <br>
      </td>
    <td width="8" align="right">&nbsp;</td>
  </tr>
      <tr>
        <td width=8>&nbsp;</td>
        <td valign=center align=middle colspan=2>&nbsp; </td>
        <td align=right width=8>&nbsp;</td>
      </tr>
</table>
</div>
<p align="center"><font color="#000000" size="2">COPYRIGHT(C) 2004 HOBO'S ALL
  RIGHTS RESERVED.</font></p>
</body>
</html>
