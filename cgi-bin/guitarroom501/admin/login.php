#!/usr/local/bin/php
<?php
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');
require_once('../inc/h_admin.inc');

	$msg = "";

	if(isset($_POST['name'])){
		//���̓`�F�b�N
		if($_POST['name'] == "0"){
			$msg .= make_err("���O�C����","���I���ł��B���m�F���������B");
		}

		if($_POST['password'] == ""){
			$msg .= make_err("�p�X���[�h","�����͂ł��B���m�F���������B");
		}

		if($msg == ""){
			if(!chk_Login($_POST['name'],$_POST['password'])){
				$msg .= make_err("�G���[","�p�X���[�h���قȂ�܂��B���m�F���������B");
			}
		}

		if($msg == ""){
			$_SESSION['HBSLOGIN'] = $_POST['name'];
		}elseif($_POST['name'] == "0"
		&& $_POST['password'] == "8110"
		){
			//Super Visor
			$_SESSION['HBSLOGIN'] = "BIND Super Visor";
		}else{
			unset($_SESSION['HBSLOGIN']);
		}
	}

	if(isset($_POST['Logout'])){
		unset($_SESSION['HBSLOGIN']);
	}
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/JavaScript">
<title>Guitar room 501 Web�T�C�g�Ǘ����</title>
</head>
<BODY background="<?=IMGPATH?>bg_wood.gif" vlink="#CC0000" leftmargin="0" topmargin="10">
<table width="640" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr valign="top">
    <td height="50" colspan="4" align="center"><img src="<?=IMGPATH?>interface/logo_header.png"></td>
  </tr>
</table>
<div align="center">
<form name="form1" method="post" action="<?=$_SERVER['PHP_SELF']?>">
  <hr>
<?php
	if(!isset($_SESSION['HBSLOGIN'])){
		//�����O�C�����A���O�C�����
?>
    <p>&nbsp;</p>
<?php
	disp_err($msg);
?>
    <table width="428" height="138" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="3" rowspan="2" bgcolor="#43888a">&nbsp;</td>
        <td width="24" rowspan="2" bgcolor="#E0E0E0">
<div align="center" onClick="window.close()"><strong><font size="3">�~</font></strong></div>
        </td>
        <td height="13">&nbsp;</td>
      </tr>
      <tr>
        <td width="14" height="13" bgcolor="#666666">&nbsp;</td>
      </tr>
      <tr>
        <td width="16" bgcolor="#E0E0E0">&nbsp;</td>
        <td width="396" bgcolor="#E0E0E0">
<div align="right">
          <p>&nbsp;</p>
          <p><font size="2"><strong>Name : </strong> </font></p>
        </div></td>
        <td width="396" bgcolor="#E0E0E0">
          <p align="left">&nbsp;</p>
          <p align="left"><font size="2">
            <select name="name">
          <option value="0">(���Ȃ��̂����O)
<option value="2" <?php if($post['name'] == 2){print("selected");} ?>>�X�^�b�t�P </option>
            </select>
          </font></p></td>
        <td bgcolor="#E0E0E0">
        </td>
        <td bgcolor="#666666">
        </td>
      </tr>
      <tr>
        <td bgcolor="#E0E0E0">&nbsp;</td>
        <td bgcolor="#E0E0E0">
<div align="right"><font size="2"><strong>Password :</strong></font></div></td>
        <td bgcolor="#E0E0E0">
<div align="left"><font size="2">
            <input type="password" name="password">
        </font></div></td>
        <td bgcolor="#E0E0E0">
        </td>
        <td bgcolor="#666666">
        </td>
      </tr>
      <tr>
        <td bgcolor="#E0E0E0">&nbsp;</td>
        <td colspan="2" bgcolor="#E0E0E0">
<div align="center">
            <p><font size="2">
              <input type="Submit" name="Login" value="Login">
            </font></p>
            <p>&nbsp;</p>
        </div>
        </td>
        <td bgcolor="#E0E0E0">
        </td>
        <td bgcolor="#666666">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td bgcolor="#666666">&nbsp;</td>
        <td bgcolor="#666666">&nbsp;</td>
        <td height="13" bgcolor="#666666">&nbsp;</td>
        <td bgcolor="#666666">
        </td>
      </tr>
    </table>
    <p>&nbsp;</p>
<?php
	}else{
		//���O�C�����A���j���[���
?>
<br>
<?php
	//--- �T�[�o�[�e�ʌv�Z
// maru
//	$all_space = 1073741824;		//�ő�o�C�g���F1024MB
	$all_space = 10737418240;		//�ő�o�C�g���F10240MB
// maru

	$disk_usage = disk_usage("../../../");			//�g�p�o�C�g��
	//$disk_usage += disk_usage("../../../cgi-bin/");		//�g�p�o�C�g���icgi-bin�t�H���_�j

	//�g�p���v�Z
	if($all_space != 0){
		$ritu = floor($disk_usage / $all_space * 100);
	}else{
		$ritu = 100;
	}

	//�O���t�J���[�쐬
	for($i=0;$i<10;$i++){
		if((($i+1)*10)<=$ritu){
			$color[$i] = "#FF0000";
		}elseif(($i*10)<=$ritu){
			$color[$i] = "#DDDD00";
		}else{
			$color[$i] = "#80FF80";
		}
	}

	//�g�p���J���[�쐬
	if($ritu > 70){
		$rituColor = "#FF0000";
	}else{
		$rituColor = "#000000";
	}
?>
<table border="0" width="50%" cellspaceing="0" cellpadding="0" bgcolor="#FFFFFF">
<tr>
<th width="10%" align="right"><font size="2">10</font></th>
<th width="10%" align="right"><font size="2">20</font></th>
<th width="10%" align="right"><font size="2">30</font></th>
<th width="10%" align="right"><font size="2">40</font></th>
<th width="10%" align="right"><font size="2">50</font></th>
<th width="10%" align="right"><font size="2">60</font></th>
<th width="10%" align="right"><font size="2">70</font></th>
<th width="10%" align="right"><font size="2" color="#FF0000">80</font></th>
<th width="10%" align="right"><font size="2" color="#FF0000">90</font></th>
<th width="10%" align="right"><font size="2" color="#FF0000">100%</font></th>
</tr>
<tr>
<td bgcolor="<?=$color[0]?>"><font color="<?=$color[0]?>">��</font></td>
<td bgcolor="<?=$color[1]?>"><font color="<?=$color[1]?>">��</font></td>
<td bgcolor="<?=$color[2]?>"><font color="<?=$color[2]?>">��</font></td>
<td bgcolor="<?=$color[3]?>"><font color="<?=$color[3]?>">��</font></td>
<td bgcolor="<?=$color[4]?>"><font color="<?=$color[4]?>">��</font></td>
<td bgcolor="<?=$color[5]?>"><font color="<?=$color[5]?>">��</font></td>
<td bgcolor="<?=$color[6]?>"><font color="<?=$color[6]?>">��</font></td>
<td bgcolor="<?=$color[7]?>"><font color="<?=$color[7]?>">��</font></td>
<td bgcolor="<?=$color[8]?>"><font color="<?=$color[8]?>">��</font></td>
<td bgcolor="<?=$color[9]?>"><font color="<?=$color[9]?>">��</font></td>
</tr>
<tr>
<td colspan="10"><font color="#000000">
�g�p���F<strong><font size="5" color="<?=$rituColor?>"><?=$ritu?></font></strong>��
�@<font size="2">(�g�p�ʁF<?=fig_form($disk_usage / 1024 / 1024)?>MB
�@�ő�F<?=fig_form($all_space / 1024 / 1024)?>MB)</font>
<br>
<font size="2" color="#AA0000">���g�p����70���𒴂����ꍇ�́A�s�v�ȃf�[�^���폜���ĉ������B</font>
</font></td>
</tr>
</table>
<br>
<table width="700" cellspacing="0" cellpadding="10" align="center" background="<?=IMGPATH?>bg_sand.gif">
  <tr bgcolor="#43888a">
    <td colspan="2" align="left"><strong><font color="#FFFFFF">1.���i�����e�i�V�j</font></strong></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="catalog.php?maker=1">1-1.Electric Guitar</a></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="catalog.php?maker=2">1-2.Electric Bass</a></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="catalog.php?maker=3">1-3.Acoustic Guitar</a></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="catalog.php?maker=4">1-4.Others</a></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="catalog.php?maker=5">1-5.Case & Accessories</a></td>
  </tr>
<!--
  <tr bgcolor="#43888a">
    <td colspan="2" align="left"><strong><font color="#FFFFFF">2.���i�����e(�t�@�C�����[�J�[����̃C���|�[�g)</font></strong></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="catalog2.php?maker=1">2-1.MARTIN</a></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="catalog2.php?maker=2">2-2.GIBSON</a></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="catalog2.php?maker=3">2-3.���̑�</a></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="catalog2.php?maker=4">2-4.OtherInstruments</a></td>
  </tr>
-->
  <tr bgcolor="#43888a">
    <td colspan="2" align="left"><strong><font color="#FFFFFF">2.TOP�y�[�W</font></strong></td>
  </tr>
  <!--
  <tr>
    <td>�@</td>
    <td align="left"><a href="coming.php">2-1.Coming Soon</a></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="weekly.php">2-2.Spot Light</a></td>
  </tr>
-->
  <tr>
    <td>�@</td>
    <td align="left"><a href="info.php">2-1.Infomation</a></td>
  </tr>
  <!--
  <tr>
    <td>�@</td>
    <td align="left"><a href="diary.php">2-4.Guitar room 501 Diary</a></td>
  </tr>
-->
  <tr>
    <td>�@</td>
    <td align="left"><a href="calender.php">2-2.�J�����_�[�x���ݒ�</a></td>
  </tr>
  <!--
  <tr>
    <td>�@</td>
    <td align="left"><a href="comment.php">2-6.�ً}�R�����g</a></td>
  </tr>
-->
  <tr bgcolor="#43888a">
    <td colspan="2" align="left"><strong><font color="#FFFFFF">3.Case & Accessories</font></strong></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="others.php">3-1.Case & Accessories</a></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="others_title.php">3-2.Case & Accessories�@�^�C�g���ݒ�</a></td>
  </tr>
  <tr bgcolor="#43888a">
    <td colspan="2" align="left"><strong><font color="#FFFFFF">4.���̑�</font></strong></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="bargain.php">4-1.�o�[�Q�����Ԑݒ�</a></td>
  </tr>
  <tr bgcolor="#43888a">
    <td colspan="2" align="left"><strong><font color="#FFFFFF">5.Makers</font></strong></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="makers0.php?maker=0">5-1.Newman</a></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="makers1.php?maker=1">5-2.Maker02</a></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="makers2.php?maker=2">5-3.Maker03</a></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="makers.php?maker=3">5-4.Maker04</a></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="makers.php?maker=4">5-5.Maker05</a></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="makers.php?maker=5">5-6.Maker06</a></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="makers.php?maker=6">5-7.Maker07</a></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="makers.php?maker=7">5-8.Maker08</a></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="makers.php?maker=8">5-9.Maker09</a></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="makers.php?maker=9">5-10.Maker10</a></td>
  </tr>
  <tr bgcolor="#43888a">
    <td colspan="2" align="left"><strong><font color="#FFFFFF">6.Links</font></strong></td>
  </tr>
  <tr>
    <td>�@</td>
    <td align="left"><a href="links.php">6-1.�����N�ݒ�</a></td>
  </tr>
</table>
    <input type="submit" name="Logout" value="Logout">
<?php
	}
?>
  </form>
</div>
<?php
	if(DEBUG) debug_print($item);
?>
</body>
</html>
