#!/usr/local/bin/php
<?php
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');
?>
<?php

	//--- coming�t�H���_���̑S�Ẵe�L�X�g�t�@�C�����擾����
	$fp=0;
	$path = DATPATH."coming";
	if($dir = @dir($path)){
		//�t�H���_���̑S�t�@�C���擾
		while($file_nm = $dir->read()){
			if($file_nm == ""){
				break;
			}elseif($file_nm != "." && $file_nm != ".."){
				$index[$fp] = $file_nm;
				$fp++;
			}
		}
		$dir->close();
	}

	$max_fp = $fp;

	//--- �t�@�C�����̋t���ɕ��ёւ���
	if(is_array($index)){
		rsort($index);
	}
	$disp_cnt = 0;
	//--- �t�@�C����ǂݕ\������
	for($fp=0;$fp<$max_fp;$fp++){
		$datpath = DATPATH."coming/".$index[$fp];
		//�e�L�X�g�t�@�C��Read
		if(!file_read($datpath,5,$dat)){
			print("File read error!!( /".$path." )<BR>\n");
			exit;
		}
		//��\���t���O��Checked�łȂ���Ε\������
		if($dat[4] != "checked"){
			$disp_cnt++;
		}
	}
?>

<table width="250" border="0" cellpadding="0" cellspacing="0">

<?
	if($disp_cnt != 0){
?>
  <tr>
    <td width="230" height="14" align="center" colspan="3" background="img/bar_red.gif"><img src="img/comingsoon.gif" width="110" height="14"></td>
    <td width="20" height="14">&nbsp;</td>
   </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
<?
	}

	//--- �t�@�C����ǂݕ\������
	for($fp=0;$fp<$max_fp;$fp++){
		$datpath = DATPATH."coming/".$index[$fp];
		//�e�L�X�g�t�@�C��Read
		if(!file_read($datpath,5,$dat)){
			print("File read error!!( /".$path." )<BR>\n");
			exit;
		}
		//��\���t���O��Checked�łȂ���Ε\������
		if($dat[4] != "checked"){
			if($back == ""){
				$back = " background=\"img/bg_sand2.gif\"";
			}else{
				$back = "";
			}
			print("   <tr> \n");
			print("     <td".$back." height=\"15\"><font size=\"2\">".$dat[1]."</font></td>\n");
			print("     <td".$back.">&nbsp;&nbsp;<font size=\"2\">".$dat[2]."</font></td>\n");
			print("     <td".$back."><font size=\"2\">�i".$dat[3]."�j</font></td>\n");
			print("     <td".$back." width=\"20\">&nbsp;</td>\n");
			print("   </tr>\n");
		}
	}
?>
</table>
