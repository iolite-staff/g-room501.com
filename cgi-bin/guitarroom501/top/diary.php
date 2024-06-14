#!/usr/local/bin/php
<?php
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	//--- diary�t�H���_���̑S�Ẵe�L�X�g�t�@�C�����擾����
	$fp=0;
	$path = DATPATH."diary";
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

	//--- 0���łȂ���Ε\��
	if($max_fp == 0){
		exit;
	}
?>
      <table width="500" height="81" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="14" align="center" background="img/bar_brown.gif"><img src="img/diary.gif" width="105" height="14"></td>
        </tr>
        <tr>
          <td height="67">
<?php
	//--- �t�@�C�����̋t���ɕ��ёւ���
	rsort($index);

	//--- �t�@�C����ǂݕ\������
	for($fp=0;$fp<$max_fp;$fp++){
		$datpath = DATPATH."diary/".$index[$fp];
		//�e�L�X�g�t�@�C��Read
		if(!file_read($datpath,100,$dat)){
			print("File read error!!( /".$path." )<BR>\n");
			exit;
		}
		//��\���t���O��Checked�łȂ���Ε\������
		if($dat[1] != "checked"){
			//--- �o�^��
			$ymd = substr($dat[0],0,4)."/".substr($dat[0],4,2)."/".substr($dat[0],6,2);

			//--- �{���e�L�X�g
			//�ő�s�������߂�
			$gyosuu = 0;
			for($i=5;$i<100;$i++){
				if($dat[$i] != ""){
					$gyosuu = $i;
				}
			}
			//�}���`���C���e�L�X�g�̐���
			$text = "";
			for($i=5;$i<$gyosuu+1;$i++){
				$text .= $dat[$i]."<br>\n";
			}
?>
<p><font size="2"><strong><?=$ymd?></strong><br>
<?=$text?></font></p>
<?php
		}
	}
?>
</td>
        </tr>
      </table>
