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
            <td colspan="4"> <span class="title">OM</span></td>
          </tr>
          <tr> 
            <td width="300" colspan="2" rowspan="3"><img src="<?=DATPATH2?>makers/<?=$_GET['maker']?>/line3_0.jpg" alt="" name="GuitarImagew" width="240" height="381" style="background-color: #FFFFFF"><br>
                <div align="center"><span class="model">OM-2H</span> </div></td>
            <td colspan="2" valign="top"><span class="title">OM</span><br>
              <span class="profile">
1929�`33�N�Ƃ����͂��Ȋ��Ԃ�������Ȃ�����14�t���b�g�W���C���g��OOO�T�C�Y�̃{�f�B�����I�[�P�X�g�����f���������ɂ܂ōČ����܂����B
�v���E�H�[OM�ɋ��߂���}�e���A���𒉎��ɖ���������ŁA�V�i�ł���Ȃ���͂ꂽ�I�[���h�t���[�o�[����T�E���h�́A�܂��ɃR�����O�X���\���郂�f���ł��B</span></td>
          </tr>
          <tr> 
            <td colspan="2" valign="top"><span class="title">LineUp</span><br>
              <li>OM-1 Mahogany Side&amp;Back</li>
              <li>OM-2H Indian Rosewood Side&amp;Back</li>
              <li>OM-3 Abalone Rosette</li></td>
          </tr>
          <tr> 
            <td colspan="2" align="left" valign="top" class="title">Dimensions<br> 
              <table width="300" border="0" cellspacing="0" cellpadding="0">
                <tr class="text"> 
                  <td align="right" width="100"> Nut Width�F</td>
                  <td>1 11/16&quot;(42.9mm)</td>
                </tr>
                <tr class="text"> 
                  <td align="right">Scale Length�F</td>
                  <td>25 1/2&quot;�i647.7mm�j</td>
                </tr>
                <tr class="text"> 
                  <td align="right">Body Width�F</td>
                  <td>15&quot;(381mm)</td>
                </tr>
                <tr class="text"> 
                  <td align="right">Body Length�F</td>
                  <td>19 1/4&quot;(489mm)</td>
                </tr>
                <tr class="text"> 
                  <td align="right">Body Depth�F</td>
                  <td>4 1/8&quot;(104.8mm)</td>
                </tr>
                <tr class="text"> 
                  <td align="right">Total Length�F</td>
                  <td>39 1/2&quot;&quot;(1003.3mm)</td>
                </tr>
              </table></td>
          </tr>
          <tr align="center" valign="top"> 
            <td width="150"><br>
              <img src="<?=DATPATH2?>makers/<?=$_GET['maker']?>/line3_1.jpg" alt="" name="GuitarImagew" width="120" height="160" style="background-color: #FFFFFF"><br>
              <span class="model">OM-1</span> <br>
            </td>
            <td width="150"> <img src="<?=DATPATH2?>makers/<?=$_GET['maker']?>/line3_2.jpg" alt="" name="GuitarImagew" width="120" height="120" style="background-color: #FFFFFF"><br>
              <span class="model">OM-3 Abalone Rosette</span> </td>
            <td width="150"><br>
              <br>
              <br>
              <img src="<?=DATPATH2?>makers/<?=$_GET['maker']?>/line3_3.jpg" alt="" name="GuitarImagew" width="120" height="160" style="background-color: #FFFFFF"><br>
              <span class="model">OM-2H Herringbone</span><br>
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
