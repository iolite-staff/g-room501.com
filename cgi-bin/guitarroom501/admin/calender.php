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
		$no = $get['no'];
	}
	//POST��NO���i�[
	if(isset($post['no'])){
		$no = $post['no'];
	}

	//--- �t�@�C���̍폜
	if(isset($post['kill'])){
		$no = $post['kill'];
		//--- ���f�[�^�폜
		$path = DATPATH."calender/".$no.".txt";
		unlink($path);
		$msg .= "��".$no." �폜�������܂����B<br>";
		//�X�V���t�̍X�V
		update_day();
	}

	//--- �t�@�C���̍X�V
	if(isset($post['dat0yy'])){
		if($no == ""){
			//�V����No���̔�
			$no = $dat[0];
		}elseif($no != $dat[0]){
			//�L�[���ڂ̕ύX�̏ꍇ��No���X�V
			$old_no = $no;
			$no = $dat[0];
			//��No�̃t�@�C�����폜
			unlink(DATPATH."calender/".$old_no.".txt");
		}
		//--- �J�����_�[�t�@�C���X�V
		$path = DATPATH."calender/".$no.".txt";
		//�J�����_�[�t�@�C��Write
		if(!file_write($path,2,$dat)){
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
<title>�J�����_�[</title>
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
<form name="no_sel" method="get" action="calender.php">
  <div align="center">
    <select name="no">
<?php
	$ins = true;
	//�V�K�쐬���`�F�b�N
	$path = DATPATH."calender/";
	if($dir = @dir($path)){
		while($dat = $dir->read()){
			if($dat == ""){
				break;
			}elseif(preg_match("/[0-9]{8}.txt$/", $dat)){
				//Index��no������΍X�V���[�h�ɂ���
				if($no != ""
				&& $no == substr($dat,0,8)
				){
					$ins = false;
				}
			}
		}
	}
?>
      <option value="">���@�V�K</option>
<?php
	//--- Dat�t�@�C��Read
	$path = DATPATH."calender/";
	if($dir = @dir($path)){
		while($dat = $dir->read()){
			$find = false;
			if($dat == ""){
				break;
			}elseif(preg_match("/[0-9]{8}.txt$/", $dat)){
				//�L�[���[�h���w�肳��Ă���Ƃ��̓L�[���[�h���܂ލ��ڂ݂̂�\��
				if(!file_read(DATPATH."calender/".$dat,2,$cal)){
					print("File read error!!( ".DATPATH."calender/".$dat." )<BR>\n");
					exit;
				}
				//�Ώۓ��쐬
				$dat0yy = substr($cal[0],0,4);
				$dat0mm = substr($cal[0],4,2);
				$dat0dd = substr($cal[0],6,2);
				$dat0ymd = "�Ώۓ�:".$dat0yy."/".$dat0mm."/".$dat0dd;
				if($cal[1] == "N"){
					$dat1 = "�ʏ�c��";
				}elseif($cal[1] == "H"){
					$dat1 = "�x��";
				}
				//�I���ς݂̃`�F�b�N
				if($cal[0] == $no){
?>
      <option value="<?=substr($dat,0,8)?>" selected>��<?=substr($dat,0,8)?> <?=$dat0ymd?>�F<?=$dat1?></option>
<?php
				}else{
?>
      <option value="<?=substr($dat,0,8)?>">��<?=substr($dat,0,8)?> <?=$dat0ymd?>�F<?=$dat1?></option>
<?php
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
		$path = DATPATH."calender/".$no.".txt";
		//�e�L�X�g�t�@�C�����݃`�F�b�N
		if(file_exists($path)){
			//�e�L�X�g�t�@�C��Read
			if(!file_read($path,100,$dat)){
				print("File read error!!( /".$path." )<BR>\n");
				exit;
			}
		}else{
			//�V�K�̏ꍇ�X�V�������ݓ��t�ɃZ�b�g
			$dat = "";
			$dat[0] = date('Ymd');
		}
?>
<p> �ҏW��<BR>
<?=$msg?>
  <div align="center">
    <form name="Update" method="post" action="calender.php?no=<?=$no?>">
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
    <table width="680" border="0" align="center" cellpadding="2" cellspacing="1" background="<?=IMGPATH?>bg_sand.gif">
      <tr>
        <td width="90" bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font color="#FFFFFF" size="2">�Ώۓ�</font></strong></div>
        </td>
        <td width="570" align="left">
          <select name="dat0yy">
<?php
		option_YY(substr($dat[0],0,4),1,1);
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
          <div align="center"><strong><font size="2" color="#FFFFFF">�c�Ƌ敪</font></strong></div>
        </td>
        <td align="left">
    <select name="dat[1]">
      <option value="N" <?php if($dat[1] == "N"){print("selected");}?>>�ʏ�c��</option>
      <option value="H" <?php if($dat[1] == "H"){print("selected");}?>>�x��</option>
    </select>
        </td>
      </tr>
    </table>
    </form>
  </div>
<form name="Delete" method="post" action="calender.php">
<input name="kill" type="hidden" value="">
</form>
<?php
	}
	if(DEBUG) debug_print($item);
?>
</body>
</html>
