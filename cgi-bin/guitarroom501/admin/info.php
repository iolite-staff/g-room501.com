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

	//���������΍�i�G�X�P�[�v�����F�\���p�j
	$post = make_up_bs($_POST,0);
	$get = make_up_bs($_GET,0);
	//POST���ꂽitem���G�X�P�[�v����
	if(isset($_POST['item'])){
		$post['item'] = make_up_bs($_POST['item'],0);
		$item = $post['item'];
	}
	if(isset($_FILES['file']['tmp_name'])){
		$file = make_up_bs($_FILES['file']['tmp_name'],0);
	}

	//GET��NO���i�[
	if(isset($get['no'])){
		$no = $get['no'];
	}
	//POST��NO���i�[
	if(isset($post['no'])){
		$no = $post['no'];
	}

	//--- �f�[�^�X�V
	if($post['syori_kbn'] == "Update"){
		$msg .= "�X�V<br>\n";
// add maruyama 160622 from
		$no = $post['no'];
// add maruyama 160622 to

		//--- �e�L�X�g�X�V
		//���s�R�[�h���Ƃɔz��i�[
		$txt = preg_split("/[\r\n]/", trim($post['text']));
		$txt = preg_split("<br>", trim($post['text']));
		$cnt = count($txt);
		//95�s�ڈȍ~�͐؂�̂�
		if($cnt > 95){
			$cnt = 95;
		}
		for($i=0;$i<$cnt;$i++){
			//item�ϐ��փe�L�X�g���i�[
			$item[$i+5] = $txt[$i];
		}
		$path = DATPATH."info/".$no.".txt";
		//�e�L�X�g�t�@�C��Write
		if(!file_write($path,100,$item)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "���������������������܂����B<BR>\n";
		if($item[1] != "left" && $item[1] != "right"){
			//�摜�폜
			$path = DATPATH."info/".$no.".jpg";
			@unlink($path);
		}elseif($file <> ""){
			//�摜�A�b�v���[�h
			$path = DATPATH."info/".$no.".jpg";
			copy($file, $path);
			$msg .= $file."=> /".$path." ���������������܂����B<BR>\n";
		}
		//�X�V���t�̍X�V
		update_day();
	}

	//--- �f�[�^�폜
	if(isset($post['kill'])){
		$msg .= "�폜<br>\n";
		$no = $post['kill'];
		//--- �e�L�X�g�폜
		//��\���t���O�������l�Ƃ���
		$nulldata = "";
		$nulldata[3] = "checked";
		$path = DATPATH."info/".$no.".txt";
		//�e�L�X�g�t�@�C��Write
		if(!file_write($path,100,$nulldata)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "�������폜�������܂����B<BR>\n";
		//�摜�폜
		$path = DATPATH."info/".$no.".jpg";
		@unlink($path);
		$msg .= $no." �폜�������܂����B<BR>\n";
		//�X�V���t�̍X�V
		update_day();
	}

	//----- up button
	if($post['syori_kbn'] == "Up"){
		//��ԏ�̃f�[�^�̏ꍇ�AUP�����͍s��Ȃ�
		if($no != 0){
			//������NO�쐬
			$tno = $no - 1;
			$msg .= "Up No.".$no." -> ".$tno."<br>";

			//�e�L�X�g����
			$path = DATPATH."info/".$no.".txt";
			$tpath = DATPATH."info/".$tno.".txt";
			$tmp = DATPATH."info/tmp.txt";
			copy($path,$tmp);
			copy($tpath,$path);
			copy($tmp,$tpath);
			unlink($tmp);

			//�摜����
			$path = DATPATH."info/".$no.".jpg";
			$tpath = DATPATH."info/".$tno.".jpg";
			$tmp = DATPATH."info/tmp.jpg";
			$tmp2 = DATPATH."info/tmp2.jpg";
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
		if($no != 6){
			//������NO�쐬
			$tno = $no + 1;
			$msg .= "Down No.".$no." -> ".$tno."<br>";;

			//�e�L�X�g����
			$path = DATPATH."info/".$no.".txt";
			$tpath = DATPATH."info/".$tno.".txt";
			$tmp = DATPATH."info/tmp.txt";
			copy($path,$tmp);
			copy($tpath,$path);
			copy($tmp,$tpath);
			unlink($tmp);

			//�摜����
			$path = DATPATH."info/".$no.".jpg";
			$tpath = DATPATH."info/".$tno.".jpg";
			$tmp = DATPATH."info/tmp.jpg";
			$tmp2 = DATPATH."info/tmp2.jpg";
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

	//--- �{���擾
	$msg .= "�ҏW��<br>\n";
	unset($item);
	for($i=0;$i<7;$i++){
		$path = DATPATH."info/".$i.".txt";
		//�e�L�X�g�t�@�C���̑��݃`�F�b�N
		if(file_exists($path)){
			//�e�L�X�g�t�@�C��Read
			if(!file_read($path,100,$dat)){
				print("File read error!!( /".$path." )<BR>\n");
				exit;
			}
			//item�ϐ��ɓǂ񂾃f�[�^���i�[
			$item[0][$i] = $dat[0];
			$item[1][$i] = $dat[1];
			$item[2][$i] = $dat[2];
			$item[3][$i] = $dat[3];
			//�}���`���C���̃e�L�X�g��txt�ϐ��Ɋi�[
			$txt[$i] = "";
			$ln = 1;
			for($j = 5; $j < 100; $j++){
				if($dat[$j] != ""){
					$ln = $j + 1;
				}
			}
			if($ln != 1){
				for($k = 5; $k < $ln; $k++){
					$txt[$i] .= $dat[$k]."\n";
				}
			}
			//�摜�t�@�C��Read
			$path = DATPATH."info/".$i.".jpg";
			if(file_exists($path)){
				$img[$i] = DATPATH2."info/".$i.".jpg";
			}else{
				$img[$i] = IMGPATH."clear.gif";
			}
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
<title>Infomation</title>
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
//-->
</script>
</head>
<BODY background="<?=IMGPATH?>bg_wood.gif" vlink="#CC0000" leftmargin="0" topmargin="10">
<a href="login.php">&lt;&lt; Back</a><br>
<p align="center"><strong><font color="#FF0000" size="2"><a href="<?=BASEPATH?>" target="kakunin">���z�[���y�[�WTOP�ց�</a></font></strong></p>
<p align="center"><font color="#FF0000" size="2"><a href="info.php?type=<?=$type?>&reload">���ёւ���������͂������N���b�N���Ă���uF5�v�L�[�������Ă��������B</a></font></p>
<p> <?=$msg?>
<?php
	//�ڍ׃f�[�^�\��
	for($lp=0;$lp<7;$lp++){
?>
<script type="text/javascript">
<!--
//�X�V�m�F��ASUBMIT���s��
function upd_data<?=$lp?>(type){
	a=confirm("�f�[�^���X�V���z�[���y�[�W�ɔ��f���܂��B��낵���ł����H");
	if(a == true){
		document.Update<?=$lp?>.syori_kbn.value = type;
		document.Update<?=$lp?>.submit();
	}
}
//-->
</script>
<form name="Update<?=$lp?>" method="post" enctype="multipart/form-data" action="info.php">
  <div align="center">
    <table width="680" border="0" cellspacing="0" cellpadding="3">
      <tr bordercolor="#FFFFFF" bgcolor="#000000">
        <td width="683" align="left"><strong><font size="2" color="#FFFFFF">Infomation No.<?=$lp?> �̍폜</font></strong><font size="2" color="#FFFFFF">�@���폜�������͌��ɂ͖߂��܂���B</font></td>
        <td width="43">
          <div align="right"><strong><font size="2" color="#FFFFFF">
            <input type="button" name="Delete" value="�폜" onClick="kill_data('<?=$lp?>')">
            </font></strong></div>
        </td>
      </tr>
      <tr bordercolor="#FFFFFF">
        <td bgcolor="#43888a" width="683" align="left"><strong><font size="2" color="#FFFFFF">Infomation No.<?=$lp?>
          �̍X�V</font></strong><font size="2" color="#FFFFFF">�@�����̏����C�����܂��B</font></td>
        <td bgcolor="#43888a" width="43">
          <div align="right"><strong><font size="2" color="#FFFFFF">
            <input type="button" name="Update" value="�X�V" onClick="upd_data<?=$lp?>('Update')">
            <input type="hidden" name="no" value="<?=$lp?>">
            </font></strong></div>
        </td>
      </tr>
      <tr>
        <td rowspan="3" width="683" background="<?=IMGPATH?>bg_sand.gif">
          <table width="680" border="0" align="center" cellpadding="3" cellspacing="1" bordercolor="#FFFFFF">
            <tr>
              <td valign="top" width="219" align="left"><font size="2">
                �^�C�g���i�����j�F<input type="text" name="item[0]" size="30" maxlength="64" value="<?=$item[0][$lp]?>">
                </font></td>
              <td valign="top" width="416" align="left" rowspan="2"><font size="2">
�{���i�׎��j�F
                <textarea name="text" cols="57" rows="20">
<?=$txt[$lp]?>
</textarea>
                <br>
                ���ő� 95 �s</font></td>
            </tr>
            <tr>
              <td valign="top" align="left"><font size="2">
<?php
		print("          <input type=\"checkbox\" name=\"item[3]\" value=\"checked\" ".$item[3][$lp]."><strong>��\��</strong><br><br>\n");
		print("          <input type=\"checkbox\" name=\"item[2]\" value=\"checked\" ".$item[2][$lp]."><font color=\"#FF0000\"><i>New!</i></font><br><br>\n");

		if($item[1][$lp] <> "left" && $item[1][$lp] <> "right"){
			print("          <input type=\"radio\" name=\"item[1]\" value=\"\" checked>�摜�Ȃ�<br>\n");
		}else{
			print("          <input type=\"radio\" name=\"item[1]\" value=\"\">�摜�Ȃ�<br>\n");
		}
		if($item[1][$lp] == "left"){
			print("          <input type=\"radio\" name=\"item[1]\" value=\"left\" checked>�摜�̈ʒu�y���z<br>\n");
		}else{
			print("          <input type=\"radio\" name=\"item[1]\" value=\"left\">�摜�̈ʒu�y���z<br>\n");
		}
		if($item[1][$lp] == "right"){
			print("          <input type=\"radio\" name=\"item[1]\" value=\"right\" checked>�摜�̈ʒu�y�E�z<br>\n");
		}else{
			print("          <input type=\"radio\" name=\"item[1]\" value=\"right\">�摜�̈ʒu�y�E�z<br>\n");
		}
?>
                <input type="file" name="file" size="30" maxlength="255"><br>
                <br>
                <font size="2">���T�C�Y�͔C�ӂł��̂ŁA<br>�@�K�x�ɏk�����ĉ������B<br>
                �@Jpeg�`��(*.jpg *.jpeg)<br>
                <img src="<?=$img[$lp]?>">
                </font></td>
            </tr>
          </table>
        </td>
        <td bgcolor="#666666" valign="top" width="43">
          <div align="center">
            <p>�@</p>
            <input name="Up" type="button" value="��" onClick="upd_data<?=$lp?>('Up')">
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
            <input name="Down" type="button" value="��" onClick="upd_data<?=$lp?>('Down')">
            <p>�@</p>
          </div>
        </td>
      </tr>
    </table>
  </div>
  <input type="hidden" name="syori_kbn" value="">
</form>
<br>
<hr>
<br>
<?php
	}
?>
<form name="Delete" method="post" action="info.php?type=<?=$type?>">
<input name="kill" type="hidden" value="">
</form>
<?php
	if(DEBUG) debug_print($item);
?>
</body>
</html>
