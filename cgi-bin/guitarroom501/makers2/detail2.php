#!/usr/local/bin/php
<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	//文字化け対策（エスケープ処理：表示用）
	$post = make_up_bs($_POST,0);
	$get = make_up_bs($_GET,0);
	
	$i =2;

?>
<HTML>
<HEAD>
<meta http-equiv=Content-Type content="text/html; charset=Shift_JIS">
<TITLE>Guitar room 501</TITLE>
</HEAD>
<BODY bgcolor="#FFECFD" link="#CC0000" vlink="#666666" leftmargin="0" topmargin="0">
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
    <td width="8"><font size="1"><img src="<?=IMGPATH?>clear.gif" width="7" height="7"></font></td>
    <td colspan="2" align="center"><img src=<?=DATPATH2?>makers/<?=$i?>/<?=$get['num']?>b.jpg hspace="1" vspace="1" border="0"></td>
    <td width="8"><font size="1"><img src="<?=IMGPATH?>clear.gif" width="7" height="7"></font></td>
  </tr>
      <TR bgcolor="#CCCCCC">
        <TD width=8>&nbsp;</TD>
        <TD vAlign="center" align="middle" colSpan="2">&nbsp; </TD>
        <TD align=right width=8>&nbsp;</TD>
      </TR>
      <TR>
        <TD width=8>&nbsp;</TD>
        <TD vAlign="center" align="middle" colSpan="2">&nbsp; </TD>
        <TD align=right width=8>&nbsp;</TD>
      </TR>
</table>
<p align="center"><font color="#000000" size="2">Copyright(C) 2004 HOBO'S All
  Rights Reserved.</font></p>
</div>
</BODY>
</HTML>
