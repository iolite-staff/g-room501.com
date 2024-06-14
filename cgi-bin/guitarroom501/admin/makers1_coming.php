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
	if(isset($_POST['maker_dat'])){
		$maker_dat = make_up_bs($_POST['maker_dat'],0);
	}
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
	if(isset($dat[1])){
		$msg .= "�X�V<br>\n";
		//--- ���i�o�^�����X�V���邩
		if($dat[0] == ""
		|| $dat[0] == 0
		|| $post['dat0upd'] == "checked"
		){
			$dat[0] = date('YmdHis');
		}
		//--- ����؂�t���O���Z�b�g����Ă��邩
		if($dat[8] == "checked"
		&& $dat[11] == ""
		){
			$dat[11] = date('Ymd');
		}elseif($dat[8] == ""){
			$dat[11] = "";
		}
		//--- Marks Down���\���t���O���Z�b�g����Ă��邩
		if($dat[10] == "checked"
		&& $dat[48] == ""
		){
			$dat[48] = date('Ymd');
		}elseif($dat[10] == ""){
			$dat[48] = "";
		}
		//--- �e�L�X�g�X�V
		//���s�R�[�h���Ƃɔz��i�[
		$txt = preg_split("/[\r\n]/", trim($post['text']));
		$cnt = count($txt);
		//�s�ڈȍ~�͐؂�̂�
		if($cnt > 50){
			$cnt = 50;
		}
		for($i=0;$i<$cnt;$i++){
			//item�ϐ��փe�L�X�g���i�[
			$dat[$i+50] = $txt[$i];
		}
		$path = DATPATH."makers/".$get['maker']."/coming/".$no.".txt";
		//�e�L�X�g�t�@�C��Write
		if(!file_write($path,100,$dat)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "���������������������܂����B<BR>\n";
		if($file[30] != ""){
			//TOP�p�k���ʐ^�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_small.jpg";
			copy($file[30], $path);
			$msg .= $file[30]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[31] != ""){
			//�ʐ^�iFRONT�j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_front_s.jpg";
			copy($file[31], $path);
			$msg .= $file[31]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[32] != ""){
			//�ʐ^�iBACK�j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_back_s.jpg";
			copy($file[32], $path);
			$msg .= $file[32]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[33] != ""){
			//�g�� �ʐ^�iFRONT�j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_front.jpg";
			copy($file[33], $path);
			$msg .= $file[33]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[34] != ""){
			//�g�� �ʐ^�iBACK�j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_back.jpg";
			copy($file[34], $path);
			$msg .= $file[34]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[35] != ""){
			//�g�� �p�[�c�ʐ^�i�w�b�h�\�j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part1.jpg";
			copy($file[35], $path);
			$msg .= $file[35]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[36] != ""){
			//�g�� �p�[�c�ʐ^�i�w�b�h���j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part2.jpg";
			copy($file[36], $path);
			$msg .= $file[36]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[37] != ""){
			//�g�� �p�[�c�ʐ^�i�l�b�N�\�j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part3.jpg";
			copy($file[37], $path);
			$msg .= $file[37]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[38] != ""){
			//�g�� �p�[�c�ʐ^�i�l�b�N���j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part4.jpg";
			copy($file[38], $path);
			$msg .= $file[38]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[39] != ""){
			//�g�� �p�[�c�ʐ^�i�{�f�B�[�\�j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part5.jpg";
			copy($file[39], $path);
			$msg .= $file[39]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[40] != ""){
			//�g�� �p�[�c�ʐ^�i�{�f�B�[���j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part6.jpg";
			copy($file[40], $path);
			$msg .= $file[40]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[41] != ""){
			//�g�� �p�[�c�ʐ^�i�E���ʁj�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part7.jpg";
			copy($file[41], $path);
			$msg .= $file[41]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[42] != ""){
			//�g�� �p�[�c�ʐ^�i�����ʁj�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part8.jpg";
			copy($file[42], $path);
			$msg .= $file[42]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[43] != ""){
			//�g�� ����P�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special1.jpg";
			copy($file[43], $path);
			$msg .= $file[43]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[44] != ""){
			//�g�� ����Q�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special2.jpg";
			copy($file[44], $path);
			$msg .= $file[44]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[45] != ""){
			//�g�� ����R�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special3.jpg";
			copy($file[45], $path);
			$msg .= $file[45]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[46] != ""){
			//�g�� ����S�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special4.jpg";
			copy($file[46], $path);
			$msg .= $file[46]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[47] != ""){
			//�g�� �M�^�[�P�[�X�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_case.jpg";
			copy($file[47], $path);
			$msg .= $file[47]."=> ".$path." ���������������܂����B<BR>\n";
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
		$path = DATPATH."makers/".$get['maker']."/coming/".$no.".txt";
		//�e�L�X�g�t�@�C��Write
		if(!file_write($path,100,$nulldata)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "�������폜�������܂����B<BR>\n";
		//TOP�p�k���ʐ^�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_small.jpg";
		@unlink($path);
		$msg .= $no." �p�k���ʐ^�폜�������܂����B<BR>\n";
		//�ʐ^�iFRONT�j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_front_s.jpg";
		@unlink($path);
		$msg .= $no." �ʐ^�iFRONT�j�폜�������܂����B<BR>\n";
		//�ʐ^�iBACK�j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_back_s.jpg";
		@unlink($path);
		$msg .= $no." �ʐ^�iBACK�j�폜�������܂����B<BR>\n";
		//�g�� �ʐ^�iFRONT�j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_front.jpg";
		@unlink($path);
		$msg .= $no." �g�� �ʐ^�iFRONT�j�폜�������܂����B<BR>\n";
		//�g�� �ʐ^�iBACK�j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_back.jpg";
		@unlink($path);
		$msg .= $no." �g�� �ʐ^�iBACK�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�w�b�h�\�j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part1.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�w�b�h�\�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�w�b�h���j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part2.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�w�b�h���j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�l�b�N�\�j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part3.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�l�b�N�\�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�l�b�N���j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part4.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�l�b�N���j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�{�f�B�[�\�j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part5.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�{�f�B�[�\�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�{�f�B�[���j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part6.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�{�f�B�[���j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�E���ʁj�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part7.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�E���ʁj�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�����ʁj�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part8.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�����ʁj�폜�������܂����B<BR>\n";
		//�g�� ����P�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special1.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����P�폜�������܂����B<BR>\n";
		//�g�� ����Q�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special2.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����Q�폜�������܂����B<BR>\n";
		//�g�� ����R�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special3.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����R�폜�������܂����B<BR>\n";
		//�g�� ����S�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special4.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����S�폜�������܂����B<BR>\n";
		//�g�� �M�^�[�P�[�X�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_case.jpg";
		@unlink($path);
		$msg .= $no." �g�� �M�^�[�P�[�X�폜�������܂����B<BR>\n";
		//�X�V���t�̍X�V
		update_day();
	}


	//--- �f�[�^�X�V���摜�폜
	if(isset($post['photokill'])){
		$msg .= "�摜�폜<br>\n";
		$no = $post['photokill'];
		//�ʐ^�iFRONT�j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_front_s.jpg";
		@unlink($path);
		$msg .= $no." �ʐ^�iFRONT�j�폜�������܂����B<BR>\n";
		//�ʐ^�iBACK�j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_back_s.jpg";
		@unlink($path);
		$msg .= $no." �ʐ^�iBACK�j�폜�������܂����B<BR>\n";
		//�g�� �ʐ^�iFRONT�j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_front.jpg";
		@unlink($path);
		$msg .= $no." �g�� �ʐ^�iFRONT�j�폜�������܂����B<BR>\n";
		//�g�� �ʐ^�iBACK�j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_back.jpg";
		@unlink($path);
		$msg .= $no." �g�� �ʐ^�iBACK�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�w�b�h�\�j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part1.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�w�b�h�\�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�w�b�h���j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part2.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�w�b�h���j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�l�b�N�\�j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part3.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�l�b�N�\�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�l�b�N���j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part4.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�l�b�N���j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�{�f�B�[�\�j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part5.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�{�f�B�[�\�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�{�f�B�[���j�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part6.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�{�f�B�[���j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�E���ʁj�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part7.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�E���ʁj�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�����ʁj�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part8.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�����ʁj�폜�������܂����B<BR>\n";
		//�g�� ����P�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special1.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����P�폜�������܂����B<BR>\n";
		//�g�� ����Q�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special2.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����Q�폜�������܂����B<BR>\n";
		//�g�� ����R�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special3.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����R�폜�������܂����B<BR>\n";
		//�g�� ����S�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special4.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����S�폜�������܂����B<BR>\n";
		//�g�� �M�^�[�P�[�X�폜
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_case.jpg";
		@unlink($path);
		$msg .= $no." �g�� �M�^�[�P�[�X�폜�������܂����B<BR>\n";
		//�X�V���t�̍X�V
		update_day();
	}

	//INDEX�X�V
	if(isset($dat[1])
	|| isset($post['kill'])
	){
		$spacer = "                                                                ";
		for($type=1;$type<4;$type++){
			for($i=0;$i<50;$i++){

				//--- �e�L�X�g�t�@�C��Read
				$path = DATPATH."makers/".$type."/".sprintf('%04d',$i).".txt";
				if(!file_read($path,100,$item)){
					print("File read error!!( /".$path." )<BR>\n");
					exit;
				}
				//���iINDEX�i���[�J�[��ABC���p�j
				$name_index[$i] = substr(($item[1].$spacer),0,61);
				$name_index[$i] .= substr(($item[2].$spacer),0,64);
				$name_index[$i] .= sprintf('%04d',$i);
			}

			$idxpath = DATPATH."makers/".$type."/name_index.txt";

			//���iINDEX�i���[�J�[��ABC���p�jWrite
			if(!file_write($idxpath,50,$name_index)){
				print("File read error!!( ".$idxpath." )<BR>\n");
				exit;
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
}//�폜�m�F��ASUBMIT���s��
function kill_data2(){
	a=confirm("�폜�����f�[�^�͌��ɖ߂����Ƃ͂ł��܂���B�폜���Ă���낵���ł����H");
	if(a == true){
		document.Delete2.submit();
	}
}
//�폜�m�F��ASUBMIT���s��
function photokill_data(no){
	a=confirm("�폜�����f�[�^�͌��ɖ߂����Ƃ͂ł��܂���B�폜���Ă���낵���ł����H");
	if(a == true){
		document.photoDelete.photokill.value = no;
		document.photoDelete.submit();
	}
}
//�X�V�m�F��ASUBMIT���s��
function upd_data(){
	a=confirm("�f�[�^���X�V���z�[���y�[�W�ɔ��f���܂��B��낵���ł����H");
	if(a == true){
		document.Update.submit();
	}
}
//�X�V�m�F��ASUBMIT���s��
function upd_data2(){
	a=confirm("�f�[�^���X�V���z�[���y�[�W�ɔ��f���܂��B��낵���ł����H");
	if(a == true){
		document.frmMakers.submit();
	}
}
//-->
</script>
</head>
<BODY background="<?=IMGPATH?>bg_wood.gif" vlink="#CC0000" leftmargin="0" topmargin="10">
<a href="login.php">&lt;&lt; Back</a><br>
<p align="center"><strong><font color="#FF0000" size="2"><a href="<?=BASEPATH?>" target="kakunin">���z�[���y�[�WTOP�ց�</a></font></strong></p>
<p align="center"><strong><font color="#FF0000" size="2"><a href="makers<?=$get['maker']?>.php?maker=<?=$get['maker']?>">��Sumi�H�[�ҏW�ց�</a></font></strong></p>
<p align="center"><strong><font color="#FF0000" size="2"><a href="makers<?=$get['maker']?>_news.php?maker=<?=$get['maker']?>">��Sumi�H�[News�ҏW�ց�</a></font></strong></p>
<p align="center"><strong><font color="#FF0000" size="2">��StockList�ҏW����</font></strong></p>
<?=$msg?>

<form name="no_sel" method="get" action="<?=$_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
  <div align="center">
    <select name="no">
<?php

	$idxpath = DATPATH."makers/".$_GET['maker']."/coming/name_index.txt";

	//INDEX�t�@�C��Read
	if(!file_read($idxpath,50,$name_index)){
		print("File read error!!( ".$idxpath." )<BR>\n");
		exit;
	}

	sort($name_index);

	$old_day = date('Ymd',time()-5184000)+0;

	for($i=0;$i<50;$i++){
		//INDEX�t�@�C���̓��e����̏ꍇ�A�Ȃɂ����Ȃ�
		if($name_index[$i] != ""){
			$path = DATPATH."makers/".$_GET['maker']."/coming/".substr($name_index[$i],125,4).".txt";
			//�f�[�^�t�@�C��Read
			if(!file_read($path,100,$item)){
				print("File read error!!( ".$path." )<BR>\n");
				exit;
			}
			if($item[2] != ""){
				//�X�V���쐬
				$item0yy = substr($item[0],0,4);
				$item0mm = substr($item[0],4,2);
				$item0dd = substr($item[0],6,2);
				$item0ymd = "�X�V��:".$item0yy."/".$item0mm."/".$item0dd;
				if($item[8] == "checked"){
					$jyotai = " SOLD";
//				}elseif($item[9] == "checked"){
//					$jyotai = " HOLD";
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
				if(substr($name_index[$i],125,4) == $no){
?>
  <option value="<?=substr($name_index[$i],125,4)?>" selected><?=$item[1]?>�@<?=$item[2]?>�@<?=$item[13]?>(<?=$item[3]?>) <?=$jyotai?>
<?php
					if($item[9]=="checked"){
						print("�݌ɖ���");
					}else{
						print("�݌ɗL��");
					}
?>
</option>
<?php
				}else{
?>
  <option value="<?=substr($name_index[$i],125,4)?>"><?=$item[1]?>�@<?=$item[2]?>�@<?=$item[13]?>(<?=$item[3]?>) <?=$jyotai?>
<?php
					if($item[9]=="checked"){
						print("�݌ɖ���");
					}else{
						print("�݌ɗL��");
					}
?>
</option>
<?php
				}
			}
		}
	}
	for($i=0;$i<50;$i++){
		//INDEX�t�@�C���̓��e����̏ꍇ�A�Ȃɂ����Ȃ�
		if($name_index[$i] != ""){
			$path = DATPATH."makers/".$_GET['maker']."/coming/".substr($name_index[$i],125,4).".txt";
			//�f�[�^�t�@�C��Read
			if(!file_read($path,100,$item)){
				print("File read error!!( ".$path." )<BR>\n");
				exit;
			}
			if($item[2] == ""){
				//�X�V���쐬
				$item0yy = substr($item[0],0,4);
				$item0mm = substr($item[0],4,2);
				$item0dd = substr($item[0],6,2);
				$item0ymd = "�X�V��:".$item0yy."/".$item0mm."/".$item0dd;
				if($item[8] == "checked"){
					$jyotai = " SOLD";
//				}elseif($item[9] == "checked"){
//					$jyotai = " HOLD";
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
				if(substr($name_index[$i],125,4) == $no){
?>
  <option value="<?=substr($name_index[$i],125,4)?>" selected><?=$item[1]?>�@<?=$item[2]?>�@<?=$item[13]?>(<?=$item[3]?>) <?=$jyotai?></option>
<?php
				}else{
?>
  <option value="<?=substr($name_index[$i],125,4)?>"><?=$item[1]?>�@<?=$item[2]?>�@<?=$item[13]?>(<?=$item[3]?>) <?=$jyotai?></option>
<?php
				}
			}
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
			$path = DATPATH."makers/".$get['maker']."/coming/".$no.".txt";
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
		for($i = 50; $i < 100; $i++){
			if($dat[$i] != ""){
				$ln = $i + 1;
			}
		}
		if($ln != 1){
			for($i = 50; $i < $ln; $i++){
				$txt .= $dat[$i]."\n";
			}
		}
?>
<p align="center"><strong><font color="#FF0000" size="2"><a href="<?=PHPPATH?>makers/detail.php?maker=<?=$get['maker']?>&cd=<?=$no?>" target="kakunin">�����̏��i�̏ڍ׉�ʂց�</a></font></strong></p>
<p>
  <div align="center">
    <form name="Update" method="post" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>?maker=<?=$get['maker']?>&no=<?=$no?>">
    <table width="680" border="0" cellspacing="0" cellpadding="3">
      <tr bordercolor="#FFFFFF" bgcolor="#000000">
        <td width="515" align="left"><strong><font size="2" color="#FFFFFF">��<?=$no?> �̍폜</font></strong><font size="2" color="#FFFFFF">�@���폜�������͌��ɂ͖߂��܂���B
        </font></td>
        <td width="100">
          <div align="right"><strong><font size="2" color="#FFFFFF">
            <input type="button" name="photoDelete" value="�摜�̂ݍ폜" onClick="photokill_data('<?=$no?>')">
            </font></strong></div>
        </td>
        <td width="53">
          <div align="right"><strong><font size="2" color="#FFFFFF">
            <input type="button" name="Delete" value="�폜" onClick="kill_data('<?=$no?>')">
            </font></strong></div>
        </td>
      </tr>
      <tr bordercolor="#FFFFFF" bgcolor="<?=$bgcolor?>">
        <td width="615" align="left" colspan="2"><strong><font size="2" color="#FFFFFF">��<?=$no?>
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
          <div align="center"><strong><font size="2" color="#FFFFFF">��\��</font></strong></div>
        </td>
        <td align="left"><font size="2">
<input type="checkbox" name="dat[49]" value="checked" <?=$dat[49]?>><font color="#CC0000"><strong>��ʂɕ\�����Ȃ�</strong></font><br>
�@�@���`�F�b�N����ꂽ�ꍇ�A�g�b�v�y�[�W�ɂ��X�g�b�N���X�g�ɂ��\������Ȃ��Ȃ�܂��B</font>
        </td>
      </tr>
      <tr>
        <td width="150" bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font color="#FFFFFF" size="2">���i�o�^��</font></strong></div>
        </td>
        <td width="530" align="left"><font size="2">
          <?=substr($dat[0],0,4)?>�N
          <?=substr($dat[0],4,2)?>��
          <?=substr($dat[0],6,2)?>��
          <?=substr($dat[0],8,2)?>��
          <?=substr($dat[0],10,2)?>��
          <?=substr($dat[0],12,2)?>�b
<?php
		print("<input type=\"hidden\" name=\"dat[0]\" value=\"".trim($dat[0])."\">\n");
?>
          �@�@<input type="checkbox" name="dat0upd" value="checked">�X�V����i�V���i�̏ꍇ���j
        </font></td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">���[�J�[��</font></strong></div>
        </td>
        <td align="left">
<?php
	print("<input type=\"text\" name=\"dat[1]\" size=\"60\" maxlength=\"50\" value=\"".$dat[1]."\">\n");
?>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">���i�Ǘ��ԍ�</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[13]" size="16" maxlength="12" value="<?=$dat[13]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">���f����</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[2]" size="60" maxlength="50" value="<?=$dat[2]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�N���i���g�p�j</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[3]" size="6" maxlength="7" value="<?=$dat[3]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">���ד�</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[4]" size="12" maxlength="16" value="<?=$dat[4]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">���݉��i</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[5]" size="12" maxlength="8" value="<?=$dat[5]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�����i</font></strong></div>
        </td>
        <td align="left"><font size="2">
<input type="text" name="dat[6]" size="12" maxlength="8" value="<?=$dat[6]?>">
<input type="checkbox" name="dat[10]" value="checked" <?=$dat[10]?>>
          Mark Down���ɕ\������
          <?php
	print("<input type=\"hidden\" name=\"dat[48]\" value=\"".$dat[48]."\">\n");
	if($dat[10] == "checked"){
		print("<br>\n");
		print("<font size=\"2\">Marks Down���\���ݒ���F ".substr($dat[48],0,4)."�N ".substr($dat[48],4,2)."�� ".substr($dat[48],6,2)."��</font>");
	}
?>
          </font></td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�o�[�Q�����̉��i</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[7]" size="12" maxlength="8" value="<?=$dat[7]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">SOLD / �݌�</font></strong></div>
        </td>
        <td align="left"><font size="2">
<input type="checkbox" name="dat[8]" value="checked" <?=$dat[8]?>><font color="#CC0000"><strong>SOLD</strong></font>
�@<font color="#336633"><strong>�݌ɐ؂�F</strong></font>
<input type="checkbox" name="dat[9]" value="checked" <?=$dat[9]?>></font>
<?php
	print("<input type=\"hidden\" name=\"dat[11]\" value=\"".$dat[11]."\">\n");
	if($dat[8] == "checked"){
		print("<br>\n");
		print("<font size=\"2\">SOLD�ݒ���F ".substr($dat[11],0,4)."�N ".substr($dat[11],4,2)."�� ".substr($dat[11],6,2)."��</font>");
	}
?>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font color="#FFFFFF" size="2">CONDITON�i���g�p�j</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[12]" size="16" maxlength="12" value="<?=$dat[12]?>">
        </td>
      </tr>
     <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">TOP</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[14]" size="60" maxlength="50" value="<?=$dat[14]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">SIDE��BACK</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[15]" size="60" maxlength="50" value="<?=$dat[15]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">NECK</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[16]" size="60" maxlength="50" value="<?=$dat[16]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">FINGER BOAD</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[17]" size="60" maxlength="50" value="<?=$dat[17]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">BRIDGE</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[18]" size="60" maxlength="50" value="<?=$dat[18]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">TRIM</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[19]" size="60" maxlength="50" value="<?=$dat[19]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">ROSSETTE</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[20]" size="60" maxlength="50" value="<?=$dat[20]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">PICK GUARD COLOR</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[21]" size="60" maxlength="50" value="<?=$dat[21]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">POSITION MARK</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[29]" size="60" maxlength="50" value="<?=$dat[29]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">TUNER</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[22]" size="60" maxlength="50" value="<?=$dat[22]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">BRACING</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[23]" size="60" maxlength="50" value="<?=$dat[23]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">NUT WIDTH</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[24]" size="60" maxlength="50" value="<?=$dat[24]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">SCALE</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[25]" size="60" maxlength="50" value="<?=$dat[25]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">OTHERS 1</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[26]" size="60" maxlength="50" value="<?=$dat[26]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">OTHERS 2</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[27]" size="60" maxlength="50" value="<?=$dat[27]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">OTHERS 3</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[28]" size="60" maxlength="50" value="<?=$dat[28]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">������</font></strong></div>
        </td>
        <td align="left">
                <textarea name="text" cols="57" rows="20">
<?=$txt?>
</textarea>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">TOP�p�k���ʐ^</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[30]" size="30" maxlength="255"><font size="2"> ����90 �~ �c160</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�ʐ^�iFRONT�j</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[31]" size="30" maxlength="255"><font size="2"> ����255 �~ �c400</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�ʐ^�iBACK�j</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[32]" size="30" maxlength="255"><font size="2"> ����255 �~ �c400</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�g�� �ʐ^�iFRONT�j</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[33]" size="30" maxlength="255">
          <font size="2"> ����450 �~ �c800</font> </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�g�� �ʐ^�iBACK�j</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[34]" size="30" maxlength="255">
          <font size="2"> ����450 �~ �c800</font> </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�g�� �p�[�c�ʐ^<br>�i�w�b�h�\�j</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[35]" size="30" maxlength="255">
          <font size="2"> ����600 �~ �c800</font> </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�g�� �p�[�c�ʐ^<br>�i�w�b�h���j</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[36]" size="30" maxlength="255"><font size="2"> ����600 �~ �c800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�g�� �p�[�c�ʐ^<br>�i�l�b�N�\�j</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[37]" size="30" maxlength="255"><font size="2"> ����600 �~ �c800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�g�� �p�[�c�ʐ^<br>�i�l�b�N���j</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[38]" size="30" maxlength="255"><font size="2"> ����600 �~ �c800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�g�� �p�[�c�ʐ^<br>�i�{�f�B�[�\�j</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[39]" size="30" maxlength="255"><font size="2"> ����600 �~ �c800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�g�� �p�[�c�ʐ^<br>�i�{�f�B�[���j</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[40]" size="30" maxlength="255"><font size="2"> ����600 �~ �c800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�g�� �p�[�c�ʐ^<br>�i�E���ʁj</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[41]" size="30" maxlength="255"><font size="2"> ����600 �~ �c800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�g�� �p�[�c�ʐ^<br>�i�����ʁj</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[42]" size="30" maxlength="255"><font size="2"> ����600 �~ �c800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�g�� ����P</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[43]" size="30" maxlength="255"><font size="2"> ����600 �~ �c800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�g�� ����Q</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[44]" size="30" maxlength="255"><font size="2"> ����600 �~ �c800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�g�� ����R</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[45]" size="30" maxlength="255"><font size="2"> ����600 �~ �c800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�g�� ����S</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[46]" size="30" maxlength="255"><font size="2"> ����600 �~ �c800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">�g�� �M�^�[�P�[�X</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[47]" size="30" maxlength="255"><font size="2"> ����600 �~ �c800</font>
        </td>
      </tr>
    </table>
    </form>
  </div>
<form name="Delete" method="post" action="<?=$_SERVER['PHP_SELF']?>?maker=<?=$get['maker']?>&">
<input name="kill" type="hidden" value="">
</form>
<form name="photoDelete" method="post" action="<?=$_SERVER['PHP_SELF']?>?maker=<?=$get['maker']?>&">
<input name="photokill" type="hidden" value="">
</form>
<?php
	}
	if(DEBUG) debug_print($item);
?>
</body>
</html>
