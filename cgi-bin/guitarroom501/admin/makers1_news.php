#!/usr/local/bin/php
<?php
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');
require_once('../inc/h_admin.inc');

	if(!isset($_SESSION['HBSLOGIN'])){
		//�����O�C�����A���O�C����ʂ֑J��
		header("Location: login.php");
		exit;
	}

	$msg = "";

	//�f�[�^�̊i�[
	if(isset($_POST['dat'])){
		$dat = make_up_bs($_POST['dat'],0);
	}

	//���������΍�i�G�X�P�[�v�����F�\���p�j
	$post = make_up_bs($_POST,0);
	$get = make_up_bs($_GET,0);

	//�X�V���̊i�[
	$dat[0] = sprintf('%04d',$post['dat0yy'])
	. sprintf('%02d',$post['dat0mm'])
	. sprintf('%02d',$post['dat0dd']);

	//GET��NO���i�[
	if(isset($get['no'])){
		$no =$get['no'];
	}
	//POST��NO���i�[
	if(isset($post['no'])){
		$no = $post['no'];
	}

	//--- �t�@�C���̍폜
	if(isset($post['kill'])){
		$no = $post['kill'];
		//--- ���f�[�^�폜
		$path = DATPATH."makers/".$_GET['maker']."/news/".$no.".txt";
		unlink($path);
		$msg .= "��".$no." �폜�������܂����B<br>";
	}

	//--- �t�@�C���̍X�V
	if(isset($post['dat0yy'])){
		//�V����No���̔�
		if($no == ""){
			$no = $dat[0];
		}elseif($no != $dat[0]){
			//�L�[���ڂ̕ύX�̏ꍇ��No���X�V
			$old_no = $no;
			$no = $dat[0];
			//��No�̃t�@�C�����폜
			unlink(DATPATH."makers/".$_GET['maker']."/news/".$old_no.".txt");
		}
		//--- Guitar room 501 Diary�t�@�C���X�V
		if($post['text'] != ""){
			//���s�R�[�h���Ɣz��Ɋi�[
			$txt = preg_split("/[\r\n]/", trim($post['text']));
			$cnt = count($txt);
			//95�s�ȏ�͐؂�̂�
			if($cnt > 95){
				$cnt = 95;
			}
			for($i=0;$i<$cnt;$i++){
				$dat[$i+5] = $txt[$i];
			}
		}
		$path = DATPATH."makers/".$_GET['maker']."/news/".$no.".txt";
		//Guitar room 501 Diary�t�@�C��Write
		if(!file_write($path,100,$dat)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "��".$no." ���������������������܂����B<BR>\n";
		//�X�V���t�̍X�V
		update_day();
	}

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/JavaScript">
<title>Sumi�H�[ News</title>
<script type="text/javascript">
<!--
//�폜�m�F��ASUBMIT���s��
function kill_data(no){
	a=confirm("�폜�����f�[�^�͌��ɖ߂����Ƃ͂ł��܂���B�폜���Ă���낵���ł����H");
	if(a == true){
		document.Delete.kill.value = no;
		document.Delete.submit();
	}
}
//�X�V�m�F��ASUBMIT���s��
function upd_data(){
	a=confirm("�f�[�^���X�V���z�[���y�[�W�ɔ��f���܂��B��낵���ł����H");
	if(a == true){
		document.Update.submit();
	}
}
//-->
</script>
</head>
<BODY background="<?=IMGPATH?>bg_wood.gif" vlink="#CC0000" leftmargin="0" topmargin="10">
<a href="login.php">&lt;&lt; Back</a><br>
<p align="center"><strong><font color="#FF0000" size="2"><a href="<?=BASEPATH?>" target="kakunin">���z�[���y�[�WTOP�ց�</a></font></strong></p>
<p align="center"><strong><font color="#FF0000" size="2"><a href="makers<?=$get['maker']?>.php?maker=<?=$get['maker']?>">��Sumi�H�[�ҏW�ց�</a></font></strong></p>
<p align="center"><strong><font color="#FF0000" size="2">��Sumi�H�[News�ҏW�ց�</font></strong></p>
<p align="center"><strong><font color="#FF0000" size="2"><a href="makers<?=$get['maker']?>_coming.php?maker=<?=$get['maker']?>">��StockList�ҏW�ց�</a></font></strong></p>
<form name="no_sel" method="post" action="<?=$_SERVER['PHP_SELF']?>?maker=<?=$get['maker']?>">
  <div align="center">
    <select name="no">
<?php

	//--- diary�t�H���_���̑S�Ẵe�L�X�g�t�@�C�����擾����
	$ins = TRUE;
	$fp=0;
	$path = DATPATH."makers/".$_GET['maker']."/news";
	if($dir = @dir($path)){
		//�t�H���_���̑S�t�@�C���擾
		while($file_nm = $dir->read()){
			if($file_nm == ""){
				break;
			}elseif($file_nm != "." && $file_nm != ".."){
				$index[$fp] = substr($file_nm, 0, strlen($file_nm)-4);
				//Index��no������΍X�V���[�h�ɂ���
				if($no != ""
				&& $no == $index[$fp]
				){
					$ins = FALSE;
				}
				$fp++;
			}
		}
		$dir->close();
	}

	$max_fp = $fp;

	//--- �t���ɕ��ёւ���
	rsort($index);
?>
      <option value="">���@�V�K</option>
<?php
	//--- Dat�t�@�C��Read
	for($fp=0;$fp<$max_fp;$fp++){
		//Index����łȂ����Dat�t�@�C��Read
		if($index[$fp] != ""){
			$datpath = DATPATH."makers/".$_GET['maker']."/news/".$index[$fp].".txt";
			//Dat�t�@�C�����݃`�F�b�N
			if(file_exists($datpath)){
				//--- 7���ȏ�Â��f�[�^�͍폜����
				if($fp >= 7){
					unlink($datpath);
				}else{
					//Dat�t�@�C��Read
					if(!file_read($datpath,100,$dat)){
						print("File read error!!( /".$datpath." )<BR>\n");
						exit;
					}
					//�X�V���쐬
					$dat0yy = substr($dat[0],0,4);
					$dat0mm = substr($dat[0],4,2);
					$dat0dd = substr($dat[0],6,2);
					$dat0ymd = "�X�V��:".$dat0yy."/".$dat0mm."/".$dat0dd;
					//�I���ς݂̃`�F�b�N
					if($index[$fp] == $no){
?>
      <option value="<?=$index[$fp]?>" selected>��<?=$index[$fp]?> <?=$dat0ymd?></option>
<?php
					}else{
?>
      <option value="<?=$index[$fp]?>">��<?=$index[$fp]?> <?=$dat0ymd?></option>
<?php
					}
				}
			}
		}
	}
?>
    </select>
    <input name="no_sel" type="submit" value="�I��">
  </div>
</form>
<hr>
<?php
	if(isset($no)){
		//�V�K�쐬�E�X�V
		if($ins){
			//�V�K�쐬���[�h�Ȃ�w�i�F���
			$bgcolor = "#003366";
		}else{
			//�X�V���[�h�Ȃ�w�i�F��΂�
			$bgcolor = "#43888a";
		}

		//--- �e�L�X�g�t�@�C��Read
		$path = DATPATH."makers/".$_GET['maker']."/news/".$no.".txt";
		//�e�L�X�g�t�@�C�����݃`�F�b�N
		if(file_exists($path)){
			//�e�L�X�g�t�@�C��Read
			if(!file_read($path,100,$dat)){
				print("File read error!!( /".$path." )<BR>\n");
				exit;
			}
			//�}���`���C���e�L�X�g�̃Z�b�g
			$text = "";
			$ln = 0;
			for($j = 5; $j < 100; $j++){
				if($dat[$j] != ""){
					$ln = $j + 1;
				}
			}
			if($ln != 0){
				for($k = 5; $k < ($ln + 1); $k++){
					$text .= $dat[$k]."\n";
				}
			}
		}else{
			//�V�K�̏ꍇ�X�V�������ݓ��t�ɃZ�b�g
			$dat = "";
			$dat[0] = date('Ymd');
			$text = "";
		}
?>
<p> �ҏW��<BR>
<?=$msg?>
  <div align="center">
    <form name="Update" method="post" action="<?=$_SERVER['PHP_SELF']?>?maker=<?=$get['maker']?>&no=<?=$no?>">
    <table width="680" border="0" cellspacing="0" cellpadding="3">
<?php
		if(!$ins){
			//�X�V���[�h�̏ꍇ�A�폜�o�[�ƍX�V�o�[��\��
?>
      <tr bordercolor="#FFFFFF" bgcolor="#000000">
        <td width="615" align="left"><strong><font size="2" color="#FFFFFF">��<?=$no?> �̍폜</font></strong><font size="2" color="#FFFFFF">�@���폜�������͌��ɂ͖߂��܂���B</font></td>
        <td width="53">
          <div align="right"><strong><font size="2" color="#FFFFFF">
            <input type="button" name="Delete" value="�폜" onClick="kill_data('<?=$no?>')">
            </font></strong></div>
        </td>
      </tr>
      <tr bordercolor="#FFFFFF" bgcolor="<?=$bgcolor?>">
        <td width="615" align="left"><strong><font size="2" color="#FFFFFF">��<?=$no?>
          �̍X�V</font></strong><font size="2" color="#FFFFFF">�@�����̏����C�����܂��B</font></td>
        <td width="53">
          <div align="right"><strong><font size="2" color="#FFFFFF">
            <input type="button" name="Update" value="�X�V" onClick="upd_data()">
            </font></strong></div>
        </td>
      </tr>
<?php
		}else{
			//�V�K���[�h�̏ꍇ�͐V�K�o�[��\��
?>
      <tr bordercolor="#FFFFFF" bgcolor="<?=$bgcolor?>">
        <td width="615" align="left"><strong><font size="2" color="#FFFFFF">�V�K�o�^</font></strong><font size="2" color="#FFFFFF">�@�����̏���V�K�ɓo�^���܂��B</font></td>
        <td width="53">
          <div align="right"><strong><font size="2" color="#FFFFFF">
            <input type="button" name="Update" value="�o�^" onClick="upd_data()">
            </font></strong></div>
        </td>
      </tr>
<?php
		}
?>
    </table>
    <br>
    <table width="680" border="0" align="center" cellpadding="2" cellspacing="1" bordercolor="#FFFFFF" background="<?=IMGPATH?>bg_sand.gif">
      <tr>
        <td width="680" colspan="2" align="left">
          �@<font color="#ff0000" size="2">��\���ɂ���</font><input type="checkbox" name="dat[1]" value="checked" <?=$dat[1]?>>
        </td>
      </tr>
      <tr>
        <td width="90" bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font color="#FFFFFF" size="2">�X�V��</font></strong></div>
        </td>
        <td width="570" align="left">
          <select name="dat0yy">
<?php
		option_YY(substr($dat[0],0,4),5,0);
?>
          </select>
          �N
          <select name="dat0mm">
<?php
		option_MM(substr($dat[0],4,2));
?>
          </select>
          ��
          <select name="dat0dd">
<?php
		option_DD(substr($dat[0],6,2));
?>
          </select>
          ��
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�{��</font></strong></div>
        </td>
        <td>
          <textarea name="text" cols="80" rows="20">
<?=$text?>
</textarea>
        <div align="center"><font size="2">���ő� 95 �s</font></div>
        </td>
      </tr>
    </table>
    </form>
  </div>
<form name="Delete" method="post" action="<?=$_SERVER['PHP_SELF']?>?maker=<?=$get['maker']?>&no=<?=$no?>">
<input name="kill" type="hidden" value="">
</form>
<?php
	}
	if(DEBUG) debug_print($item);
?>
</body>
</html>
