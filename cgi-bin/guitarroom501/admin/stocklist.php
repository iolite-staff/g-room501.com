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

/*
	//----- �ŐV��10���ڂ̍X�V���t���擾����
	$idxpath = DATPATH."guitar/upd_index.txt";

	//INDEX�t�@�C��Read
	if(!file_read($idxpath,600,$upd_index)){
		print("File read error!!( ".$idxpath." )<BR>\n");
		exit;
	}

	rsort($upd_index);

	$disp_cnt = 0;

	for($i=0;$i<600;$i++){
		//INDEX�t�@�C���̓��e����̏ꍇ�A���[�v�E�o
		if($upd_index[$i] == ""){
			break;
		//�\������������10���𒴂����ꍇ�A���[�v�E�o
		}elseif($disp_cnt >= 10){
			break;
		}else{
			$path = DATPATH."guitar/".substr($upd_index[$i],14,1)."/".substr($upd_index[$i],15,4).".txt";
			//�f�[�^�t�@�C��Read
			if(!file_read($path,100,$dat)){
				print("File read error!!( ".$path." )<BR>\n");
				exit;
			}
			$new_time = $dat[0] - 1;
			//�J�E���g �C���N�������g
			$disp_cnt++;
		}
	}
*/
?>
<table width="700" border="0" align="center" cellspacing="0">
  <tr>
    <td width="103" nowrap><strong><font size="2">�X�e�[�^�X</font></strong></td>
    <td width="103" nowrap><strong><font size="2">���[�J�[</font></strong></td>
    <td width="139" nowrap><strong><font size="2">���f����</font></strong></td>
    <td width="41" nowrap><strong><font size="2">�N��</font></strong></td>
    <td width="61" nowrap><strong><font size="2">CONDITION</font></strong></td>
    <td align="center" nowrap><font color="#000000" size="1"><strong><font size="2">���i</font></strong>�i�J�b�R���͐ō����i�ł��j</font></td>
    <td width="68" nowrap>
<?php
	if($bar_flg){
		print("<strong><font color=\"#FF6600\" size=\"2\">�o�[�Q��</font></strong>");
	}
?>
    </td>
    <td width="31" nowrap>&nbsp;</td>
  </tr>
  <tr>
    <td nowrap>&nbsp;</td>
    <td nowrap>&nbsp;</td>
    <td nowrap>&nbsp;</td>
    <td nowrap></td>
    <td nowrap>&nbsp;</td>
    <td nowrap>&nbsp;</td>
    <td nowrap>&nbsp;</td>
    <td nowrap>&nbsp;</td>
  </tr>
<?php

	$idxpath = DATPATH."guitar/".$_GET['type']."/name_index.txt";

	//INDEX�t�@�C��Read
	if(!file_read($idxpath,200,$name_index)){
		print("File read error!!( ".$idxpath." )<BR>\n");
		exit;
	}

	sort($name_index);

	$old_day = date('Ymd',time()-5184000)+0;

	for($i=0;$i<200;$i++){
		//INDEX�t�@�C���̓��e����̏ꍇ�A�Ȃɂ����Ȃ�
		if($name_index[$i] != ""){
			$path = DATPATH."guitar/".$_GET['type']."/".substr($name_index[$i],125,4).".txt";
			//�f�[�^�t�@�C��Read
			if(!file_read($path,100,$dat)){
				print("File read error!!( ".$path." )<BR>\n");
				exit;
			}
			//����؂�ŁA���e���񃖌����Â��ꍇ or ��\���̏ꍇ�A�\�����Ȃ�
			if((($dat[11]+0) < $old_day
			 && trim($dat[8]) == "checked"
			 )
			|| $dat[49] == "checked"
			){

			//�o�[�Q���̏ꍇ�A�o�[�Q�����i�̂�
			}elseif(isset($_GET['bargain'])
			&& (!$bar_flg
			 || $dat[7] == ""
			 )
			){

			}else{
				if($back == ""){
					$back = " background=\"../img/bg_sand2.gif\"";
				}else{
					$back = "";
				}

				print("  <tr> \n");
				print("    <td height=\"25\"".$back." nowrap>\n");
				if($dat[8] == "checked"){
					print("<span class=\"red\">SOLD OUT</span>\n");
				}elseif($dat[9] == "checked"){
					print("<span class=\"red\">ON HOLD</span>\n");
//				}elseif($dat[0] > $new_time){
//					print("<img src=\"img/new.gif\">\n");
				}elseif($dat[5] != ""
				&& $dat[5] != 0
				&& $dat[6] != ""
				&& $dat[6] != 0
				&& $dat[5] < $dat[6]
				){
					print("<span class=\"purple\">MARK DOWN</span>\n");
				}
				print("    </td>\n");
				print("    <td".$back." nowrap><font size=\"2\"><strong>".$dat[1]."</strong></font></td>\n");
				print("    <td".$back." nowrap><font size=\"2\"><strong>".$dat[2]."</strong></font></td>\n");
				print("    <td".$back." nowrap><font size=\"2\"><strong>".$dat[3]."</strong></font></td>\n");
				print("    <td".$back." nowrap><font size=\"2\"><strong>".$dat[12]."</strong></font></td>\n");
				$pd_color = "";
				if($dat[5] != ""
				&& $dat[5] != 0
				&& $dat[6] != ""
				&& $dat[6] != 0
				&& $dat[5] < $dat[6]
				){
					$pd_color = " color=\"#CC0000\"";
				}
				print("    <td".$back." align=\"right\" nowrap><font size=\"2\"".$pd_color."><strong>".kingaku($dat[5],3,"Y")."</strong></font></td>\n");
				print("    <td".$back." align=\"right\" nowrap>");
				if($bar_flg
				&& $dat[7] != ""
				){
					print("<font color=\"#FF6600\" size=\"2\"><strong>��".kingaku($dat[7],3,"Y")."</strong></font>");
				}
				print("</td>\n");
				print("    <td".$back." align=\"right\" nowrap>");
				if($dat[8] != "checked"){
					print("    <font size=\"1\"><a href=\"".PHPPATH."catalog/detail.php?maker=".$_GET['type']."&cd=".substr($name_index[$i],125,4)."\">�ڍ�</a></font>");
				}
				print("    </td>\n");
				print("  </tr>\n");
			}
		}
	}

?>
</table>
