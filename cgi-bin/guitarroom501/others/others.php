#!/usr/local/bin/php
<?php
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	//���������΍�i�G�X�P�[�v�����F�\���p�j
	$post = make_up_bs($_POST,0);
	$get = make_up_bs($_GET,0);

	//GET�̃y�[�W���i�[
	if(isset($get['page'])){
		if($get['page'] > 0
		&& $get['page'] < 11
		){
			$page = $get['page'];
		}else{
			$page = 1;
		}
	}else{
		$page = 1;
	}

	//--- �y�[�W�^�C�g���̎擾
	$idxpath = DATPATH."others/index.txt";
	//INDEX�t�@�C��Read
	if(!file_read($idxpath,10,$title)){
		print("File read error!!( ".$idxpath." )<BR>\n");
		exit;
	}

	//�y�[�W�ꗗ
	for($i=1;$i<11;$i++){
		if($i != $page){
			if($i == 1){
				print("<a href=\"others.htm\">".$title[$i-1]."</a>&nbsp;\n");
			}else{
				print("<a href=\"others".$i.".htm\">".$title[$i-1]."</a>&nbsp;\n");
			}
		}else{
			print("<strong>".$title[$i-1]."</strong>&nbsp;\n");
		}
	}
?>
<table width="600" border="0" cellpadding="0" cellspacing="0">
<?php

	for($lp=(0 + ($page-1)*10);$lp<(10 + ($page-1)*10);$lp++){
		$path = DATPATH."others/".sprintf('%03d',$lp).".txt";
		//�f�[�^�t�@�C��Read
		if(!file_read($path,100,$dat)){
			print("File read error!!( ".$path." )<BR>\n");
			exit;
		}
		//��\���t���O��checked�Ȃ�\�����Ȃ�
		if($dat[0] == "checked"
		){

		}else{
			//�^�C�g���s��
			if($dat[2] == "T"){
				print("  <tr>\n");
				print("    <td colspan=\"3\" background=\"".IMGPATH."bg_sand2.gif\"><strong>".$dat[1]."</strong></td>\n");
				print("  </tr>\n");

			//�ʏ�s
			}else{
				//�摜�t�@�C���`�F�b�N
				if(file_exists(DATPATH."others/".sprintf('%03d',$lp).".jpg")){
					$imgpath = "<img src=\"".DATPATH2."others/".sprintf('%03d',$lp).".jpg\">";
				}else{
					$imgpath = "";
				}

				//--- �{���e�L�X�g
				//�ő�s�������߂�
				$gyosuu = 0;
				for($i=10;$i<100;$i++){
					if($dat[$i] != ""){
						$gyosuu = $i;
					}
				}
				//�}���`���C���e�L�X�g�̐���
				$text = "";
				for($i=10;$i<$gyosuu+1;$i++){
					$text .= $dat[$i]."<br>\n";
				}

				print("  <tr>\n");
				print("    <td width=\"100\" height=\"25\" rowspan=\"4\" valign=\"top\"><font size=\"2\">".$imgpath."</font></td>\n");
				print("    <td width=\"10\" rowspan=\"4\" valign=\"top\">&nbsp;</td>\n");
				print("    <td width=\"489\" height=\"13\" valign=\"top\"> <p><font size=\"2\"><strong>".$dat[3]."</strong></font></p></td>\n");
				print("  </tr>\n");
				print("  <tr valign=\"top\">\n");
				print("    <td height=\"13\" valign=\"top\"><font color=\"#CC0000\" size=\"2\"><strong>".$dat[4]."</strong></font></td>\n");
				print("  </tr>\n");
				print("  <tr valign=\"top\">\n");
				print("    <td height=\"13\" valign=\"top\"><font size=\"2\"><strong>\\".fig_form($dat[5])."�i�ō��j</strong></font></td>\n");
				print("  </tr>\n");
				print("  </tr>\n");
				print("  <tr valign=\"top\">\n");
				print("    <td height=\"13\" valign=\"top\"><font size=\"2\">".$text."</font></td>\n");
				print("  </tr>\n");
				print("  <tr>\n");
				print("    <td height=\"12\" colspan=\"3\" valign=\"top\"><hr></td>\n");
				print("  </tr>\n");
			}
		}
	}
?>
</table>
<?php
	//�y�[�W�ꗗ
	for($i=1;$i<11;$i++){
		if($i != $page){
			if($i == 1){
				print("<a href=\"others.htm\">".$title[$i-1]."</a>&nbsp;\n");
			}else{
				print("<a href=\"others".$i.".htm\">".$title[$i-1]."</a>&nbsp;\n");
			}
		}else{
			print("<strong>".$title[$i-1]."</strong>&nbsp;\n");
		}
	}
?>
