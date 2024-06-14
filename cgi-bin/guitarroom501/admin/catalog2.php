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

	//GET�l�̃`�F�b�N
	if($get['maker'] == ""){
		disp_err(make_err("�G���[","�y�[�W�̌Ăяo�����s���ł��B"));
		exit;
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
	if(isset($post['text'])){
		$msg .= "�X�V<br>\n";
		//--- �e�L�X�g�X�V
		//���s�R�[�h���Ƃɔz��i�[
		$txt = preg_split("/[\r\n]/", trim($post['text']));
		$cnt = count($txt);
		//100�s�ڈȍ~�͐؂�̂�
		if($cnt > 100){
			$cnt = 100;
		}
		for($i=0;$i<$cnt;$i++){
			//item�ϐ��փe�L�X�g���i�[
			$dat[$i] = $txt[$i];
		}
		$path = DATPATH."guitar/".$get['maker']."/".$no.".txt";
		//�e�L�X�g�t�@�C��Write
		if(!file_write($path,100,$dat)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "���������������������܂����B<BR>\n";
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
		$nulldata[0] = "19000101000000";
		if($get['maker'] == 1){
			$nulldata[1] = "MARTIN";
		}elseif($get['maker'] == 2){
			$nulldata[1] = "GIBSON";
		}elseif($get['maker'] == 3){
			$nulldata[1] = "";
		}
		$nulldata[8] = "checked";
		$nulldata[10] = "checked";
		$nulldata[11] = "19000101";
		$nulldata[12] = "1";
		$path = DATPATH."guitar/".$get['maker']."/".$no.".txt";
		//�e�L�X�g�t�@�C��Write
		if(!file_write($path,100,$nulldata)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "�������폜�������܂����B<BR>\n";
		//TOP�p�k���ʐ^�폜
		$path = DATPATH."guitar/".$get['maker']."/".$no."_small.jpg";
		@unlink($path);
		$msg .= $no." �p�k���ʐ^�폜�������܂����B<BR>\n";
		//�ʐ^�iFRONT�j�폜
		$path = DATPATH."guitar/".$get['maker']."/".$no."_front_s.jpg";
		@unlink($path);
		$msg .= $no." �ʐ^�iFRONT�j�폜�������܂����B<BR>\n";
		//�ʐ^�iBACK�j�폜
		$path = DATPATH."guitar/".$get['maker']."/".$no."_back_s.jpg";
		@unlink($path);
		$msg .= $no." �ʐ^�iBACK�j�폜�������܂����B<BR>\n";
		//�g�� �ʐ^�iFRONT�j�폜
		$path = DATPATH."guitar/".$get['maker']."/".$no."_front.jpg";
		@unlink($path);
		$msg .= $no." �g�� �ʐ^�iFRONT�j�폜�������܂����B<BR>\n";
		//�g�� �ʐ^�iBACK�j�폜
		$path = DATPATH."guitar/".$get['maker']."/".$no."_back.jpg";
		@unlink($path);
		$msg .= $no." �g�� �ʐ^�iBACK�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�w�b�h�\�j�폜
		$path = DATPATH."guitar/".$get['maker']."/".$no."_part1.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�w�b�h�\�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�w�b�h���j�폜
		$path = DATPATH."guitar/".$get['maker']."/".$no."_part2.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�w�b�h���j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�l�b�N�\�j�폜
		$path = DATPATH."guitar/".$get['maker']."/".$no."_part3.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�l�b�N�\�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�l�b�N���j�폜
		$path = DATPATH."guitar/".$get['maker']."/".$no."_part4.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�l�b�N���j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�{�f�B�[�\�j�폜
		$path = DATPATH."guitar/".$get['maker']."/".$no."_part5.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�{�f�B�[�\�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�{�f�B�[���j�폜
		$path = DATPATH."guitar/".$get['maker']."/".$no."_part6.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�{�f�B�[���j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�E���ʁj�폜
		$path = DATPATH."guitar/".$get['maker']."/".$no."_part7.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�E���ʁj�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�����ʁj�폜
		$path = DATPATH."guitar/".$get['maker']."/".$no."_part8.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�����ʁj�폜�������܂����B<BR>\n";
		//�g�� ����P�폜
		$path = DATPATH."guitar/".$get['maker']."/".$no."_special1.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����P�폜�������܂����B<BR>\n";
		//�g�� ����Q�폜
		$path = DATPATH."guitar/".$get['maker']."/".$no."_special2.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����Q�폜�������܂����B<BR>\n";
		//�g�� ����R�폜
		$path = DATPATH."guitar/".$get['maker']."/".$no."_special3.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����R�폜�������܂����B<BR>\n";
		//�g�� ����S�폜
		$path = DATPATH."guitar/".$get['maker']."/".$no."_special4.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����S�폜�������܂����B<BR>\n";
		//�g�� �M�^�[�P�[�X�폜
		$path = DATPATH."guitar/".$get['maker']."/".$no."_case.jpg";
		@unlink($path);
		$msg .= $no." �g�� �M�^�[�P�[�X�폜�������܂����B<BR>\n";
		//�X�V���t�̍X�V
		update_day();
	}

	//INDEX�X�V
	if(isset($post['text'])
	|| isset($post['kill'])
	){
		$spacer = "                                                                ";
		for($type=1;$type<=4;$type++){
			for($i=0;$i<200;$i++){
				$upd_i = $i + ($type-1)*200;

				//--- �e�L�X�g�t�@�C��Read
				$path = DATPATH."guitar/".$type."/".sprintf('%04d',$i).".txt";
				if(!file_read($path,100,$item)){
					print("File read error!!( /".$path." )<BR>\n");
					exit;
				}
				//���iINDEX�i���[�J�[��ABC���p�j
				$name_index[$i] = substr(($item[1].$spacer),0,61);
				$name_index[$i] .= substr(($item[2].$spacer),0,64);
				$name_index[$i] .= sprintf('%04d',$i);
				//���iINDEX�i�X�V���t���p�j
				$upd_index[$upd_i] = substr(($item[0].$spacer),0,14);
				$upd_index[$upd_i] .= $type;
				$upd_index[$upd_i] .= sprintf('%04d',$i);
			}

			$idxpath = DATPATH."guitar/".$type."/name_index.txt";

			//���iINDEX�i���[�J�[��ABC���p�jWrite
			if(!file_write($idxpath,200,$name_index)){
				print("File read error!!( ".$idxpath." )<BR>\n");
				exit;
			}
		}

		//���iINDEX�i�X�V���t���p�jWrite
		$idxpath = DATPATH."guitar/upd_index.txt";

		//INDEX�t�@�C��Write
		if(!file_write($idxpath,800,$upd_index)){
			print("File read error!!( ".$idxpath." )<BR>\n");
			exit;
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
<title>���i�����e�i���X</title>
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
<form name="no_sel" method="get" action="catalog2.php">
  <div align="center">
<?php
	if($get['maker'] == 1){
		print("MARTIN");
	}elseif($get['maker'] == 2){
		print("GIBSON");
	}elseif($get['maker'] == 3){
		print("���̑�");
	}
?>
    <select name="no">
<?php
	//----- �ŐV��10���ڂ̍X�V���t���擾����
	$idxpath = DATPATH."guitar/upd_index.txt";

	//INDEX�t�@�C��Read
	if(!file_read($idxpath,800,$upd_index)){
		print("File read error!!( ".$idxpath." )<BR>\n");
		exit;
	}

	rsort($upd_index);

	$disp_cnt = 0;

	for($i=0;$i<800;$i++){
		//INDEX�t�@�C���̓��e����̏ꍇ�A���[�v�E�o
		if($upd_index[$i] == ""){
			break;
		//�\������������10���𒴂����ꍇ�A���[�v�E�o
		}elseif($disp_cnt >= 10){
			break;
		}else{
			$path = DATPATH."guitar/".substr($upd_index[$i],14,1)."/".substr($upd_index[$i],15,4).".txt";
			//�f�[�^�t�@�C��Read
			if(!file_read($path,100,$item)){
				print("File read error!!( ".$path." )<BR>\n");
				exit;
			}
			$new_time = $item[0] - 1;
			//�J�E���g �C���N�������g
			$disp_cnt++;
		}
	}

	for($i=0;$i<200;$i++){
		$path = DATPATH."guitar/".$_GET['maker']."/".sprintf('%04d',$i).".txt";
		//�f�[�^�t�@�C��Read
		if(!file_read($path,100,$item)){
			print("File read error!!( ".$path." )<BR>\n");
			exit;
		}
		//�X�V���쐬
		$item0yy = substr($item[0],0,4);
		$item0mm = substr($item[0],4,2);
		$item0dd = substr($item[0],6,2);
		$item0ymd = "�X�V��:".$item0yy."/".$item0mm."/".$item0dd;
		if($item[8] == "checked"){
			$jyotai = " SOLD";
		}elseif($item[9] == "checked"){
			$jyotai = " HOLD";
		}elseif($item[0] > $new_time){
			$jyotai = " NEW";
		}elseif($item[5] != ""
		&& $item[5] != 0
		&& $item[6] != ""
		&& $item[6] != 0
		&& $item[5] < $item[6]
		){
			$jyotai = " PRICEDOWN";
		}else{
			$jyotai = "";
		}
		//�I���ς݂̃`�F�b�N
		if(sprintf('%04d',$i) == $no){
?>
  <option value="<?=sprintf('%04d',$i)?>" selected>��<?=sprintf('%04d',$i)?> <?=$item0ymd?>�@|�@<?=$item[1]?>�@<?=$item[13]?>�@<?=$item[2]?>(<?=$item[3]?>) <?=$jyotai?></option>
<?php
		}else{
?>
  <option value="<?=sprintf('%04d',$i)?>">��<?=sprintf('%04d',$i)?> <?=$item0ymd?>�@|�@<?=$item[1]?>�@<?=$item[13]?>�@<?=$item[2]?>(<?=$item[3]?>) <?=$jyotai?></option>
<?php
		}
	}
?>
    </select>
    <input name="maker" type="hidden" value="<?=$get['maker']?>">
    <input name="no_sel" type="submit" value="�I��">
  </div>
</form>
<hr>
<?php
	if(isset($no)){

		$bgcolor = "#43888a";

		if(!isset($dat)){
			//--- �e�L�X�g�t�@�C��Read
			$path = DATPATH."guitar/".$get['maker']."/".$no.".txt";
			//�e�L�X�g�t�@�C��Read
			if(!file_read($path,100,$dat)){
				print("File read error!!( /".$path." )<BR>\n");
				exit;
			}
		}

		//--- �{���擾
		$msg .= "�ҏW��<br>\n";
		//�}���`���C���̃e�L�X�g��txt�ϐ��Ɋi�[
		$txt = "";
		$ln = 1;
		for($i = 0; $i < 100; $i++){
			if($dat[$i] != ""){
				$ln = $i + 1;
			}
		}
		if($ln != 1){
			for($i = 0; $i < $ln; $i++){
				$txt .= $dat[$i]."\n";
			}
		}
?>
<p align="center"><strong><font color="#FF0000" size="2"><a href="<?=PHPPATH?>catalog/detail.php?maker=<?=$get['maker']?>&cd=<?=$no?>" target="kakunin">�����̏��i�̏ڍ׉�ʂց�</a></font></strong></p>
<p><?=$msg?>
  <div align="center">
    <form name="Update" method="post" enctype="multipart/form-data" action="catalog2.php?maker=<?=$get['maker']?>&no=<?=$no?>">
    <table width="680" border="0" cellspacing="0" cellpadding="3">
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
    </table>
    <br>
    <table width="680" border="0" align="center" cellpadding="2" cellspacing="1" background="<?=IMGPATH?>bg_sand.gif">
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�t�@�C���̓��e</font></strong></div>
        </td>
        <td align="left">
                <textarea name="text" cols="80" rows="100">
<?=$txt?>
</textarea>
        </td>
      </tr>
    </table>
    </form>
  </div>
<form name="Delete" method="post" action="catalog2.php?maker=<?=$get['maker']?>&">
<input name="kill" type="hidden" value="">
</form>
<?php
	}
	if(DEBUG) debug_print($item);
?>
</body>
</html>
