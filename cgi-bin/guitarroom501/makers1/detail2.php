#!/usr/local/bin/php
<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	//�o�[�Q���������f
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

	//���������΍�i�G�X�P�[�v�����F�\���p�j
	$post = make_up_bs($_POST,0);
	$get = make_up_bs($_GET,0);

	//GET�l�̃`�F�b�N
	if($get['maker'] == ""
	|| $get['cd'] == ""
	){
		disp_err(make_err("�G���[","�y�[�W�̌Ăяo�����s���ł��B"));
		exit;
	}

	//�f�[�^�t�@�C���p�X�̃Z�b�g
	$path = DATPATH."makers/".$_GET['maker']."/".$_GET['cd'].".txt";

	//�f�[�^�t�@�C�����݃`�F�b�N
	if(!file_exists($path)){
		disp_err(make_err("�G���[","�y�[�W�̌Ăяo�����s���ł��B"));
		exit;
	}

	//�f�[�^�t�@�C��READ
	if(!file_read($path,100,$dat)){
		print("File read error!!( ".$path." )<BR>\n");
		exit;
	}

	//����؂� or ��\���̏ꍇ�A�\�����Ȃ�
	if($dat[8] == "checked"
	|| $dat[49] == "checked"
	){
		disp_err(make_err("�G���[","���̏��i�͊��ɔ���؂�Ă���܂��B"));
		exit;
	}


	//--- �{���e�L�X�g
	//�ő�s�������߂�
	$gyosuu = 0;
	for($i=50;$i<100;$i++){
		if($dat[$i] != ""){
			$gyosuu = $i;
		}
	}
	//�}���`���C���e�L�X�g�̐���
	$text = "";
	for($i=50;$i<$gyosuu+1;$i++){
		$text .= $dat[$i]."<br>\n";
	}

	//�摜�t�@�C���`�F�b�N�iFRONT�j
	if(file_exists(DATPATH."makers/".$_GET['maker']."/".$_GET['cd']."_detail1.jpg")){
		$imgpath_front = "<img src=\"".DATPATH2."makers/".$_GET['maker']."/".$_GET['cd']."_detail1.jpg\">";
	}else{
		$imgpath_front = "";
	}

	//�摜�t�@�C���`�F�b�N�iBACK�j
	/*if(file_exists(DATPATH."makers/".$_GET['maker']."/".$_GET['cd']."_detail2.jpg")){
		$imgpath_back = "<img src=\"".DATPATH2."makers/".$_GET['maker']."/".$_GET['cd']."_detail2.jpg\">";
	}else{
		$imgpath_back = "";
	}*/

?>
<HTML>
<HEAD>
<meta http-equiv=Content-Type content="text/html; charset=Shift_JIS">
<TITLE>Guitar room 501 Stock List</TITLE>
</HEAD>
<BODY background="<?=IMGPATH?>bg_wood.gif" link="#CC0000" vlink="#666666" leftmargin="0" topmargin="10">
<div align="center">
	<?php disp_menu(); ?>
</div>
<p>&nbsp;</p>
<div style="background-color:#FFCC66;">
<table width="640" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" align="center" valign="top">&nbsp;</td>
  </tr>
  <tr bgcolor="#FFFFCC">
    <td height="30" colspan="4" align="center">&nbsp;</td>
  </tr>
  <tr bgcolor="#FFFFCC">
    <td width="8" height="4"><font size="1"><img src="<?=IMGPATH?>clear.gif" width="7" height="7"></font></td>
    <td width="130" height="4"><font size="1"><img src="<?=IMGPATH?>clear.gif" width="7" height="7"></font></td>
    <td width="494" height="4" align="right"><font size="1"><img src="<?=IMGPATH?>clear.gif" width="7" height="7"></font></td>
    <td width="8" align="right"><font size="1"><img src="<?=IMGPATH?>clear.gif" width="7" height="7"></font></td>
  </tr>
  <tr bgcolor="#FFFFCC">
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
		//�����i����
		print("<strong>".kingaku($dat[6],0)."</strong>");
		print("��<font color=\"#CC0000\"><strong>".kingaku($dat[5],0)."</strong></font>");
	}else{
		//�����i�Ȃ�
		print("<strong>".kingaku($dat[5],0)."</strong>");
	}
	if($bar_flg
	&& $dat[7] != ""
	){
		print("<font color=\"#FF6600\"><strong>��".kingaku($dat[7],0)."</strong></font>");
	}
?>
            </font></strong></td>
        </tr>
        <?php
	//����؂�̏ꍇ�A�\�����Ȃ�
	if($dat[8] != "checked"){
?>
        <tr>
          <td colspan="3" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td width="160">
            <br>
            <?php
		//�摜�t�@�C���`�F�b�N�i����P�j
		if(file_exists(DATPATH."makers/".$_GET['maker']."/".$_GET['cd']."_special1.jpg")){
			print("<a href=\"detail_photo.php?maker=".$_GET['maker']."&cd=".$_GET['cd']."&special=1\" target=\"_blank\">���ʎʐ^�P</a><br>\n");
		}
		//�摜�t�@�C���`�F�b�N�i����Q�j
		if(file_exists(DATPATH."makers/".$_GET['maker']."/".$_GET['cd']."_special2.jpg")){
			print("<a href=\"detail_photo.php?maker=".$_GET['maker']."&cd=".$_GET['cd']."&special=2\" target=\"_blank\">���ʎʐ^�Q</a><br>\n");
		}
		//�摜�t�@�C���`�F�b�N�i����R�j
		if(file_exists(DATPATH."makers/".$_GET['maker']."/".$_GET['cd']."_special3.jpg")){
			print("<a href=\"detail_photo.php?maker=".$_GET['maker']."&cd=".$_GET['cd']."&special=3\" target=\"_blank\">���ʎʐ^�R</a><br>\n");
		}
		//�摜�t�@�C���`�F�b�N�i����S�j
		if(file_exists(DATPATH."makers/".$_GET['maker']."/".$_GET['cd']."_special4.jpg")){
			print("<a href=\"detail_photo.php?maker=".$_GET['maker']."&cd=".$_GET['cd']."&special=4\" target=\"_blank\">���ʎʐ^�S</a><br>\n");
		}
?>
            </td>
          <td align="center">
            <?=$imgpath_front?>
          </td>
          <td align="right">&nbsp;
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
                <td width="290" align="right"><font size="3">CONDITION�F </font></td>
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
                <td width="290" align="right"><font size="3">TOP�F</font></td>
                <td width="290"><font size="3">
                  <?=$dat[14]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[15] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">Side&Back�F</font></td>
                <td width="290"><font size="3">
                  <?=$dat[15]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[16] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">NECK�F</font></td>
                <td width="290"><font size="3">
                  <?=$dat[16]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[17] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">FINGER BOAD�F</font></td>
                <td width="290"><font size="3">
                  <?=$dat[17]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[18] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">BRIDGE�F</font></td>
                <td width="290"><font size="3">
                  <?=$dat[18]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[19] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">TRIM�F</font></td>
                <td width="290"><font size="3">
                  <?=$dat[19]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[20] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">ROSSETTE�F</font></td>
                <td width="290"><font size="3">
                  <?=$dat[20]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[21] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">PICK GUARD COLOR�F</font></td>
                <td width="290"><font size="3">
                  <?=$dat[21]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[29] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">POSITION MARK�F</font></td>
                <td width="290"><font size="3">
                  <?=$dat[29]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[22] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">TUNER�F</font></td>
                <td width="290"><font size="3">
                  <?=$dat[22]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[23] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">BRACING�F</font></td>
                <td width="290"><font size="3">
                  <?=$dat[23]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[24] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">NUT WIDTH�F</font></td>
                <td width="290"><font size="3">
                  <?=$dat[24]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[25] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">SCALE�F</font></td>
                <td width="290"><font size="3">
                  <?=$dat[25]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[26] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">Other features�F</font></td>
                <td width="290"><font size="3">
                  <?=$dat[26]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[27] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">Other features2�F</font></td>
                <td width="290"><font size="3">
                  <?=$dat[27]?>
                  </font></td>
              </tr>
              <?php
	}
	if($dat[28] != ""){
?>
              <tr>
                <td width="290" align="right"><font size="3">Other features3�F</font></td>
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
  <tr>
    <td width="7">&nbsp;</td>
    <td colspan="2" align="center" valign="middle">&nbsp;</td>
    <td width="8" align="right">&nbsp;</td>
  </tr>
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
