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
	$post = make_up_bs($_POST,0);
	$get = make_up_bs($_GET,0);
// maru
//print_r($post);
//print('p_text1:'.$post['p_text1']."<br>\n");
//print_r(mb_detect_order());
//print("<br>\n");
//mb_detect_order("SJIS");
//print(mb_detect_encoding($post['p_text1']));
//echo ini_get('post_max_size');
// maru

	//--- �t�@�C���̍X�V
	if(isset($post['p_disp'])){
		//--- �ً}�R�����g�t�@�C���X�V
		
		//�\��
		$dat[0] = $post['p_disp'];
		//�f�[�^
		$dat[1] = $post['p_color1'];
		$dat[2] = $post['p_color2'];
		$dat[3] = $post['p_color3'];
		$dat[4] = $post['p_color4'];
		$dat[5] = $post['p_color5'];
		$dat[6] = $post['p_size1'];
		$dat[7] = $post['p_size2'];
		$dat[8] = $post['p_size3'];
		$dat[9] = $post['p_size4'];
		$dat[10] = $post['p_size5'];
		//�e�L�X�g
		for($i=1;$i<=5;$i++){
			$txt = "";
			$txt = preg_split("/[\r\n]/", $post['p_text'.$i]);
			$cnt = count($txt);
			if($cnt > 50){
				$cnt = 50;
			}
			$k = $i * 50;
			for($j=0;$j<$cnt;$j++){
				//item�ϐ��փe�L�X�g���i�[
// maru
//				$dat[$j+$k] = $txt[$j];
				$dat[$j+$k] = mb_convert_encoding($txt[$j], 'SJIS', 'UTF-8');
// maru
			}
		}

		$path = DATPATH."comment2.txt";
		if(!file_write($path,300,$dat)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "��comment ���������������������܂����B<BR>\n";
		//�X�V8���t�̍X�V
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
<title>�ً}�R�����g</title>
<script type="text/javascript">
<!--
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
<?php
	//--- �e�L�X�g�t�@�C��Read
	$path = DATPATH."comment2.txt";
	//�e�L�X�g�t�@�C��Read
	if(!file_read($path,300,$dat)){
		print("File read error!!( /".$path." )<BR>\n");
		//exit;
	}
// maru
//print_r($dat);
// maru


	//�{���𐮌`���āy$txt�z�Ɋi�[
	for($i=1;$i<=5;$i++){
		$txt[$i] = "\n";
		$ln = 0;
		$k = $i * 50;
		for($j = 0; $j < 50; $j++){
			if($dat[$j+$k] != ""){
				$ln = $j + 1;
			}
		}
		if($ln != 0){
			for($j = 0; $j < $ln; $j++){
				$txt[$i] .= $dat[$j+$k]."\n";
			}
		}
	}
	$bgcolor = "#43888a";
?>
<p> �ҏW��<BR>
<?=$msg?>
  <div align="center">
    <form name="Update" method="post" action="<?=$_SERVER['PHP_SELF']?>">
<?php
// maru
?>
    <INPUT type="hidden" name="encode_hint" value="��">
<?php
// maru
?>
    <table width="680" border="0" cellspacing="0" cellpadding="3">
      <tr bordercolor="#FFFFFF" bgcolor="<?=$bgcolor?>">
        <td width="615" align="left"><strong><font size="2" color="#FFFFFF">��comment
          �̍X�V</font></strong><font size="2" color="#FFFFFF">�@�����̏����C�����܂��B</font></td>
        <td width="53">
          <div align="right"><strong><font size="2" color="#FFFFFF">
            <input type="button" name="Update" value="�X�V" onClick="upd_data()">
            </font></strong></div>
        </td>
      </tr>
    </table>
    <br>

    <table width="680" border="0" align="center" cellpadding="2" cellspacing="1" background="<?=IMGPATH?>bg_sand.gif">
      <tr> 
        <td width="90" bgcolor="<?=$bgcolor?>"> <div align="center"><strong><font color="#FFFFFF" size="2">�ً}�R�����g</font></strong></div></td>
        <td width="570" align="left">
		  <input type="radio" name="p_disp" value="Y" <?=$dat[0] == "Y" ?"checked":""?>>
          <font size="2" color="black">�\�� </font>
          <input type="radio" name="p_disp" value="N" <?=$dat[0] == "N" ?"checked":""?>>
		  <font color="#ff0000" size="2">��\��</font> 
		</td>
      </tr>
	  
	  
<?PHP
	for($i=1;$i<=5;$i++){
		if($i % 2 == 1){
			$bgcolor = "#43888a";
		}else{
			$bgcolor = "#C36633";
	}
?>
      <tr> 
        <td bgcolor="<?=$bgcolor?>"> <div align="center"><strong><font color="#FFFFFF" size="2">�F<?=$i?></font></strong></div></td>
        <td align="left">
		  <input type="radio" name="p_color<?=$i?>" value="black" <?=$dat[$i] == "black" ?"checked":""?>>
          <font size="2" color="black">�� </font>
          <input type="radio" name="p_color<?=$i?>" value="blue" <?=$dat[$i] == "blue" ?"checked":""?>>
          <font size="2" color="blue">�� </font>
          <input type="radio" name="p_color<?=$i?>" value="red" <?=$dat[$i] == "red" ?"checked":""?>>
          <font size="2" color="red">�� </font>
          <input type="radio" name="p_color<?=$i?>" value="green" <?=$dat[$i] == "green" ?"checked":""?>>
          <font size="2" color="green">�� </font>
          <input type="radio" name="p_color<?=$i?>" value="brawn" <?=$dat[$i] == "brawn" ?"checked":""?>>
          <font size="2" color="brawn">�� </font>
		 </td>
      </tr>
      <tr> 
        <td bgcolor="<?=$bgcolor?>"> <div align="center"><strong><font color="#FFFFFF" size="2">�T�C�Y<?=$i?></font></strong></div></td>
        <td align="left">
		  <input type="radio" name="p_size<?=$i?>" value="5" <?=$dat[$i+5] == 5 ?"checked":""?>>
          <font size="4" color="black">�� </font>
          <input type="radio" name="p_size<?=$i?>" value="3" <?=$dat[$i+5] == 3 ?"checked":""?>>
          <font size="3" color="black">�� </font>
          <input type="radio" name="p_size<?=$i?>" value="2" <?=$dat[$i+5] == 2 ?"checked":""?>>
          <font size="2" color="black">�� </font>
      </tr>
      <tr> 
        <td bgcolor="<?=$bgcolor?>"> <div align="center"><strong><font color="#FFFFFF" size="2">�R�����g<?=$i?><br>(50�s�܂�)</font></strong></div></td>
        <td align="left"><textarea name="p_text<?=$i?>" cols="50" rows="3"><?=$txt[$i]?></textarea> </td>
      </tr>
<?	}	?>
	  
	  
    </table>
	
	
	
	
	
	
	
	
	
	
	
	
	<!--
    <table width="680" border="0" align="center" cellpadding="2" cellspacing="1" background="<?=IMGPATH?>bg_sand.gif">
      <tr>
        <td width="90" bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font color="#FFFFFF" size="2">�ً}�R�����g</font></strong></div>
        </td>
        <td width="570" align="left">
          <font color="#ff0000" size="2">��\���ɂ���</font><input type="checkbox" name="dat[0]" value="checked" <?=$dat[0]?>>
�@<input type="text" name="dat[1]" size="80" maxlength="255" value="<?=$dat[1]?>">
        </td>
      </tr>
    </table>
	-->
    </form>
  </div>
<?php
	if(DEBUG) debug_print($item);
?>
</body>
</html>
