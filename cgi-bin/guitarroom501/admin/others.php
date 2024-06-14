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

// maru
	if(isset($_FILES['file']['tmp_name'])){
		$file = make_up_bs($_FILES['file']['tmp_name'],0);
	}
// maru

	//���������΍�i�G�X�P�[�v�����F�\���p�j
	$post = make_up_bs($_POST,0);
	$get = make_up_bs($_GET,0);

	//GET��NO���i�[
	if(isset($get['no'])){
		$no = sprintf('%03d',$get['no']);
	}
	//POST��NO���i�[
	if(isset($post['no'])){
		$no = sprintf('%03d',$post['no']);
	}

	//GET�̃y�[�W���i�[
	if(isset($get['page'])){
		$page = $get['page'];
	}else{
		$page = 1;
	}

	//--- �f�[�^�X�V
	if($post['syori_kbn'] == "Update"){
		$msg .= "�X�V<br>\n";

		if($post['text'] != ""){
			//���s�R�[�h���Ɣz��Ɋi�[
			$text = preg_split("/[\r\n]/", trim($post['text']));
			$cnt = count($text);
			//90�s�ȏ�͐؂�̂�
			if($cnt > 90){
				$cnt = 90;
			}
			for($i=0;$i<$cnt;$i++){
				$dat[$i+10] = $text[$i];
			}
		}

		$path = DATPATH."others/".$no.".txt";
		//�e�L�X�g�t�@�C��Write
		if(!file_write($path,100,$dat)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "���������������������܂����B<BR>\n";
		if($file != ""){
			//�ʐ^�A�b�v���[�h
			$path = DATPATH."others/".$no.".jpg";
			copy($file, $path);
			$msg .= $file."=> /".$path." ���������������܂����B<BR>\n";
		}
		//�X�V���t�̍X�V
		update_day();

	}

	//----- up button
	if($post['syori_kbn'] == "Up"){
		//��ԏ�̃f�[�^�̏ꍇ�AUP�����͍s��Ȃ�
		if($no != 0){
			//������NO�쐬
			$tno = sprintf('%03d',$no - 1);
			$msg .= "Up No.".$no." -> ".$tno."<br>";

			//�e�L�X�g����
			$path = DATPATH."others/".$no.".txt";
			$tpath = DATPATH."others/".$tno.".txt";
			$tmp = DATPATH."others/tmp.txt";
			copy($path,$tmp);
			copy($tpath,$path);
			copy($tmp,$tpath);
			unlink($tmp);

			//�摜����
			$path = DATPATH."others/".$no.".jpg";
			$tpath = DATPATH."others/".$tno.".jpg";
			$tmp = DATPATH."others/tmp.jpg";
			$tmp2 = DATPATH."others/tmp2.jpg";
			@copy($path,$tmp);
			@copy($tpath,$tmp2);
			@unlink($path);
			@unlink($tpath);
			@copy($tmp,$tpath);
			@copy($tmp2,$path);
			@unlink($tmp);
			@unlink($tmp2);
			//�X�V���t�̍X�V
			update_day();
		}
	}

	//----- down button
	if($post['syori_kbn'] == "Down"){
		//��ԉ��̃f�[�^�̏ꍇ�ADOWN�����͍s��Ȃ�
		if($no != 99){
			//������NO�쐬
			$tno = sprintf('%03d',$no + 1);
			$msg .= "Down No.".$no." -> ".$tno."<br>";;

			//�e�L�X�g����
			$path = DATPATH."others/".$no.".txt";
			$tpath = DATPATH."others/".$tno.".txt";
			$tmp = DATPATH."others/tmp.txt";
			copy($path,$tmp);
			copy($tpath,$path);
			copy($tmp,$tpath);
			unlink($tmp);

			//�摜����
			$path = DATPATH."others/".$no.".jpg";
			$tpath = DATPATH."others/".$tno.".jpg";
			$tmp = DATPATH."others/tmp.jpg";
			$tmp2 = DATPATH."others/tmp2.jpg";
			@copy($path,$tmp);
			@copy($tpath,$tmp2);
			@unlink($path);
			@unlink($tpath);
			@copy($tmp,$tpath);
			@copy($tmp2,$path);
			@unlink($tmp);
			@unlink($tmp2);
			//�X�V���t�̍X�V
			update_day();
		}
	}
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/JavaScript">
<title>Case & Accessories (<?=$page?>�y�[�W��)</title>
</head>
<BODY background="<?=IMGPATH?>bg_wood.gif" vlink="#CC0000" leftmargin="0" topmargin="10">
<a href="login.php">&lt;&lt; Back</a><br>
<p align="center"><strong><font color="#FF0000" size="2"><a href="<?=BASEPATH?>ca/index.html" target="kakunin">���z�[���y�[�W Case & Accessories �ց�</a></font></strong></p>
<p><?=$msg?>
  <div align="center">
<?php
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
			print("<a href=\"others.php?page=".$i."\">".$title[$i-1]."</a>&nbsp;\n");
		}else{
			print("<strong>".$title[$i-1]."</strong>&nbsp;\n");
		}
	}

	//�ڍ׃f�[�^�\��
	for($lp=(0 + ($page-1)*10);$lp<(10 + ($page-1)*10);$lp++){
		$no = sprintf('%03d',$lp);

		//--- �e�L�X�g�t�@�C��Read
		$path = DATPATH."others/".$no.".txt";
		//�e�L�X�g�t�@�C��Read
		if(!file_read($path,100,$dat)){
			print("File read error!!( /".$path." )<BR>\n");
			exit;
		}

		//--- �{���擾
		//�}���`���C���̃e�L�X�g��txt�ϐ��Ɋi�[
		$text = "";
		$ln = 1;
		for($i = 10; $i < 100; $i++){
			if($dat[$i] != ""){
				$ln = $i + 1;
			}
		}
		if($ln != 1){
			for($i = 10; $i < $ln; $i++){
				$text .= $dat[$i]."\n";
			}
		}
?>
<script type="text/javascript">
<!--
//�X�V�m�F��ASUBMIT���s��
function upd_data<?=$no?>(type){
	a=confirm("�f�[�^���X�V���z�[���y�[�W�ɔ��f���܂��B��낵���ł����H");
	if(a == true){
		document.Update<?=$no?>.syori_kbn.value = type;
		document.Update<?=$no?>.submit();
	}
}
//-->
</script>
    <form name="Update<?=$no?>" method="post" enctype="multipart/form-data" action="others.php?page=<?=$page?>&no=<?=$no?>">
    <table width="680" border="0" cellspacing="0" cellpadding="3">
      <tr bordercolor="#FFFFFF" bgcolor="#43888a">
        <td width="615" align="left"><strong><font size="2" color="#FFFFFF">��<?=$no?>
          �̍X�V</font></strong><font size="2" color="#FFFFFF">�@�����̏����C�����܂��B</font></td>
        <td width="53">
          <div align="right"><strong><font size="2" color="#FFFFFF">
            <input type="button" name="Update" value="�X�V" onClick="upd_data<?=$no?>('Update')">
            </font></strong></div>
        </td>
      </tr>
      <tr>
        <td rowspan="3" width="683" background="<?=IMGPATH?>bg_sand.gif">
    <table width="680" border="0" align="center" cellpadding="2" cellspacing="1">
      <tr>
        <td bgcolor="#43888a">
          <div align="center"><strong><font size="2" color="#FFFFFF">��\��</font></strong></div>
        </td>
        <td align="left"><font size="2">
<input type="checkbox" name="dat[0]" value="checked" <?=$dat[0]?>>
        </font></td>
      </tr>
      <tr>
        <td bgcolor="#43888a">
          <div align="center"><strong><font size="2" color="#FFFFFF">�^�C�g���s</font></strong></div>
        </td>
        <td align="left">
          <input type="text" name="dat[1]" size="80" maxlength="60" value="<?=$dat[1]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="#43888a">
          <div align="center"><strong><font size="2" color="#FFFFFF">�\���`��</font></strong></div>
        </td>
        <td align="left">
<select name="dat[2]">
<option value="" <?php if($dat[2]==""){ print("selected"); }?>>�ʏ�</option>
<option value="T" <?php if($dat[2]=="T"){ print("selected"); }?>>�^�C�g���s</option>
</select>
        </td>
      </tr>
      <tr>
        <td bgcolor="#43888a">
          <div align="center"><strong><font size="2" color="#FFFFFF">���i��</font></strong></div>
        </td>
        <td align="left">
          <input type="text" name="dat[3]" size="80" maxlength="60" value="<?=$dat[3]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="#43888a">
          <div align="center"><strong><font size="2" color="#FFFFFF">���l�i�Ԏ��j</font></strong></div>
        </td>
        <td align="left">
          <input type="text" name="dat[4]" size="80" maxlength="60" value="<?=$dat[4]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="#43888a">
          <div align="center"><strong><font size="2" color="#FFFFFF">���i</font></strong></div>
        </td>
        <td align="left">
          <input type="text" name="dat[5]" size="12" maxlength="8" value="<?=$dat[5]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="#43888a">
          <div align="center"><strong><font size="2" color="#FFFFFF">�ʐ^</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file" size="40" maxlength="255" value="">
        </td>
      </tr>
      <tr>
        <td bgcolor="#43888a">
          <div align="center"><strong><font size="2" color="#FFFFFF">�{��</font></strong></div>
        </td>
        <td>
          <textarea name="text" cols="80" rows="10">
<?=$text?>
</textarea>
        <div align="center"><font size="2">���ő� 90 �s</font></div>
        </td>
      </tr>
    </table>
        </td>
        <td bgcolor="#666666" valign="top" width="43">
          <div align="center">
            <p>�@</p>
            <input name="Up" type="button" value="��" onClick="upd_data<?=$no?>('Up')">
          </div>
        </td>
      </tr>
      <tr>
        <td bgcolor="#666666" align="center" valign="middle" width="43"><font size="2" color="#FFFFFF"><strong>��<br>
          ��<br>
          ��</strong></font></td>
      </tr>
      <tr>
        <td bgcolor="#666666" valign="bottom" width="43">
          <div align="center">
            <input name="Down" type="button" value="��" onClick="upd_data<?=$no?>('Down')">
            <p>�@</p>
          </div>
        </td>
      </tr>
    </table>
    <input type="hidden" name="syori_kbn" value="">
    </form>
<?php
	}

	//�y�[�W�ꗗ
	for($i=1;$i<11;$i++){
		if($i != $page){
			print("<a href=\"others.php?page=".$i."\">".$title[$i-1]."</a>&nbsp;\n");
		}else{
			print("<strong>".$title[$i-1]."</strong>&nbsp;\n");
		}
	}
?>
  </div>
<?php
	if(DEBUG) debug_print($item);
?>
</body>
</html>
