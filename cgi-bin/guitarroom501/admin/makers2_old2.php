#!/usr/local/bin/php
<?php
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');
require_once('../inc/h_admin.inc');
?>
<?php
print('aaaaaa1');
?>
<?php
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

// add maruyama 160622 from
print('marumaru');
//print_r($_FILES);
//	$get['maker'] = '1';

//	if(isset($_FILES['maker_file']['tmp_name'])){
//		$maker_file = make_up_bs($_FILES['maker_file']['tmp_name'],0);
//	}
// add maruyama 160622 to

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

	//--- ���[�J�[�f�[�^�X�V
	if(isset($maker_dat[0])){
		$msg .= "�X�V<br>\n";
		//--- �e�L�X�g�X�V
		//���s�R�[�h���Ƃɔz��i�[
		$txt1 = preg_split("/[\r\n]/", trim($post['maker_text1']));
		$cnt1 = count($txt1);
		//�s�ڈȍ~�͐؂�̂�
		if($cnt1 > 90){
			$cnt1 = 90;
		}
		for($i=0;$i<$cnt1;$i++){
			//item�ϐ��փe�L�X�g���i�[
			$maker_dat[$i+10] = $txt1[$i];
		}
		//--- �e�L�X�g�X�V
		//���s�R�[�h���Ƃɔz��i�[
		$txt2 = preg_split("/[\r\n]/", trim($post['maker_text2']));
		$cnt2 = count($txt2);
		//�s�ڈȍ~�͐؂�̂�
		if($cnt2 > 100){
			$cnt2 = 100;
		}
		for($i=0;$i<$cnt2;$i++){
			//item�ϐ��փe�L�X�g���i�[
			$maker_dat[$i+100] = $txt2[$i];
		}
		//--- �e�L�X�g�X�V
		//���s�R�[�h���Ƃɔz��i�[
		$txt3 = preg_split("/[\r\n]/", trim($post['maker_text3']));
		$cnt3 = count($txt3);
		//�s�ڈȍ~�͐؂�̂�
		if($cnt3 > 100){
			$cnt3 = 100;
		}
		for($i=0;$i<$cnt3;$i++){
			//item�ϐ��փe�L�X�g���i�[
			$maker_dat[$i+200] = $txt3[$i];
		}
		//--- �e�L�X�g�X�V
		//���s�R�[�h���Ƃɔz��i�[
		$txt4 = preg_split("/[\r\n]/", trim($post['maker_text4']));
		$cnt4 = count($txt4);
		//�s�ڈȍ~�͐؂�̂�
		if($cnt4 > 100){
			$cnt4 = 100;
		}
		for($i=0;$i<$cnt4;$i++){
			//item�ϐ��փe�L�X�g���i�[
			$maker_dat[$i+300] = $txt4[$i];
		}
		//--- �e�L�X�g�X�V
		//���s�R�[�h���Ƃɔz��i�[
		$txt5 = preg_split("/[\r\n]/", trim($post['maker_text5']));
		$cnt5 = count($txt5);
		//�s�ڈȍ~�͐؂�̂�
		if($cnt5 > 100){
			$cnt5 = 100;
		}
		for($i=0;$i<$cnt5;$i++){
			//item�ϐ��փe�L�X�g���i�[
			$maker_dat[$i+400] = $txt5[$i];
		}/*
		//--- �e�L�X�g�X�V
		//���s�R�[�h���Ƃɔz��i�[
		$txt6 = preg_split("/[\r\n]/", trim($post['maker_text6']));
		$cnt6 = count($txt6);
		//�s�ڈȍ~�͐؂�̂�
		if($cnt6 > 100){
			$cnt6 = 100;
		}
		for($i=0;$i<$cnt6;$i++){
			//item�ϐ��փe�L�X�g���i�[
			$maker_dat[$i+500] = $txt6[$i];
		}
		//--- �e�L�X�g�X�V
		//���s�R�[�h���Ƃɔz��i�[
		$txt7 = preg_split("/[\r\n]/", trim($post['maker_text7']));
		$cnt7 = count($txt7);
		//�s�ڈȍ~�͐؂�̂�
		if($cnt7 > 100){
			$cnt7 = 100;
		}
		for($i=0;$i<$cnt7;$i++){
			//item�ϐ��փe�L�X�g���i�[
			$maker_dat[$i+600] = $txt7[$i];
		}
		//--- �e�L�X�g�X�V
		//���s�R�[�h���Ƃɔz��i�[
		$txt8 = preg_split("/[\r\n]/", trim($post['maker_text8']));
		$cnt8 = count($txt8);
		//�s�ڈȍ~�͐؂�̂�
		if($cnt8 > 100){
			$cnt8 = 100;
		}
		for($i=0;$i<$cnt8;$i++){
			//item�ϐ��փe�L�X�g���i�[
			$maker_dat[$i+700] = $txt8[$i];
		}
		//--- �e�L�X�g�X�V
		//���s�R�[�h���Ƃɔz��i�[
		$txt9 = preg_split("/[\r\n]/", trim($post['maker_text9']));
		$cnt9 = count($txt9);
		//�s�ڈȍ~�͐؂�̂�
		if($cnt9 > 100){
			$cnt9 = 100;
		}
		for($i=0;$i<$cnt9;$i++){
			//item�ϐ��փe�L�X�g���i�[
			$maker_dat[$i+800] = $txt9[$i];
		}
		//--- �e�L�X�g�X�V
		//���s�R�[�h���Ƃɔz��i�[
		$txt10 = preg_split("/[\r\n]/", trim($post['maker_text10']));
		$cnt10 = count($txt10);
		//�s�ڈȍ~�͐؂�̂�
		if($cnt10 > 100){
			$cnt10 = 100;
		}
		for($i=0;$i<$cnt10;$i++){
			//item�ϐ��փe�L�X�g���i�[
			$maker_dat[$i+900] = $txt10[$i];
		}*/
		$mkrpath = DATPATH."makers/makers".$get['maker'].".txt";
		//�e�L�X�g�t�@�C��Write
		if(!file_write($mkrpath,1000,$maker_dat)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "���������������������܂����B<BR>\n";
		if($maker_file[1] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_1.jpg";
			copy($maker_file[1], $mkrpath);
			$msg .= $maker_file[1]."=> ".$mkrpath." ���������������܂����B<BR>\n";
		}
		if($maker_file[2] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_2.jpg";
			copy($maker_file[2], $mkrpath);
			$msg .= $maker_file[2]."=> ".$mkrpath." ���������������܂����B<BR>\n";
		}
		if($maker_file[3] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_3.jpg";
			copy($maker_file[3], $mkrpath);
			$msg .= $maker_file[3]."=> ".$mkrpath." ���������������܂����B<BR>\n";
		}
		if($maker_file[4] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_4.jpg";
			copy($maker_file[4], $mkrpath);
			$msg .= $maker_file[4]."=> ".$mkrpath." ���������������܂����B<BR>\n";
		}
		if($maker_file[5] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_5.jpg";
			copy($maker_file[5], $mkrpath);
			$msg .= $maker_file[5]."=> ".$mkrpath." ���������������܂����B<BR>\n";
		}/*
		if($maker_file[6] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_6.jpg";
			copy($maker_file[6], $mkrpath);
			$msg .= $maker_file[6]."=> ".$mkrpath." ���������������܂����B<BR>\n";
		}
		if($maker_file[7] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_7.jpg";
			copy($maker_file[7], $mkrpath);
			$msg .= $maker_file[7]."=> ".$mkrpath." ���������������܂����B<BR>\n";
		}
		if($maker_file[8] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_8.jpg";
			copy($maker_file[8], $mkrpath);
			$msg .= $maker_file[8]."=> ".$mkrpath." ���������������܂����B<BR>\n";
		}
		if($maker_file[9] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_9.jpg";
			copy($maker_file[9], $mkrpath);
			$msg .= $maker_file[9]."=> ".$mkrpath." ���������������܂����B<BR>\n";
		}
		if($maker_file[10] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_10.jpg";
			copy($maker_file[10], $mkrpath);
			$msg .= $maker_file[10]."=> ".$mkrpath." ���������������܂����B<BR>\n";
		}*/
		//�X�V���t�̍X�V
		update_day();
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
		$path = DATPATH."makers/".$get['maker']."/".$no.".txt";
		//�e�L�X�g�t�@�C��Write
		if(!file_write($path,100,$dat)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "���������������������܂����B<BR>\n";
		if($file[30] != ""){
			//TOP�p�k���ʐ^�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/".$no."_small.jpg";
			copy($file[30], $path);
			$msg .= $file[30]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[31] != ""){
			//�ʐ^�iFRONT�j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/".$no."_front_s.jpg";
			copy($file[31], $path);
			$msg .= $file[31]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[32] != ""){
			//�ʐ^�iBACK�j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/".$no."_back_s.jpg";
			copy($file[32], $path);
			$msg .= $file[32]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[33] != ""){
			//�g�� �ʐ^�iFRONT�j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/".$no."_front.jpg";
			copy($file[33], $path);
			$msg .= $file[33]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[34] != ""){
			//�g�� �ʐ^�iBACK�j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/".$no."_back.jpg";
			copy($file[34], $path);
			$msg .= $file[34]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[35] != ""){
			//�g�� �p�[�c�ʐ^�i�w�b�h�\�j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/".$no."_part1.jpg";
			copy($file[35], $path);
			$msg .= $file[35]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[36] != ""){
			//�g�� �p�[�c�ʐ^�i�w�b�h���j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/".$no."_part2.jpg";
			copy($file[36], $path);
			$msg .= $file[36]."=> ".$path." ���������������܂����B<BR>\n";
		}

		if($file[37] != ""){
			//�g�� �p�[�c�ʐ^�i�l�b�N�\�j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/".$no."_part3.jpg";
			copy($file[37], $path);
			$msg .= $file[37]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[38] != ""){
			//�g�� �p�[�c�ʐ^�i�l�b�N���j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/".$no."_part4.jpg";
			copy($file[38], $path);
			$msg .= $file[38]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[39] != ""){
			//�g�� �p�[�c�ʐ^�i�{�f�B�[�\�j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/".$no."_part5.jpg";
			copy($file[39], $path);
			$msg .= $file[39]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[40] != ""){
			//�g�� �p�[�c�ʐ^�i�{�f�B�[���j�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/".$no."_part6.jpg";
			copy($file[40], $path);
			$msg .= $file[40]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[41] != ""){
			//�g�� �p�[�c�ʐ^�i�E���ʁj�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/".$no."_part7.jpg";
			copy($file[41], $path);
			$msg .= $file[41]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[42] != ""){
			//�g�� �p�[�c�ʐ^�i�����ʁj�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/".$no."_part8.jpg";
			copy($file[42], $path);
			$msg .= $file[42]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[43] != ""){
			//�g�� ����P�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/".$no."_special1.jpg";
			copy($file[43], $path);
			$msg .= $file[43]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[44] != ""){
			//�g�� ����Q�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/".$no."_special2.jpg";
			copy($file[44], $path);
			$msg .= $file[44]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[45] != ""){
			//�g�� ����R�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/".$no."_special3.jpg";
			copy($file[45], $path);
			$msg .= $file[45]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[46] != ""){
			//�g�� ����S�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/".$no."_special4.jpg";
			copy($file[46], $path);
			$msg .= $file[46]."=> ".$path." ���������������܂����B<BR>\n";
		}
		if($file[47] != ""){
			//�g�� �M�^�[�P�[�X�A�b�v���[�h
			$path = DATPATH."makers/".$get['maker']."/".$no."_case.jpg";
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
		$path = DATPATH."makers/".$get['maker']."/".$no.".txt";
		//�e�L�X�g�t�@�C��Write
		if(!file_write($path,100,$nulldata)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "�������폜�������܂����B<BR>\n";
		//TOP�p�k���ʐ^�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_small.jpg";
		@unlink($path);
		$msg .= $no." �p�k���ʐ^�폜�������܂����B<BR>\n";
		//�ʐ^�iFRONT�j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_front_s.jpg";
		@unlink($path);
		$msg .= $no." �ʐ^�iFRONT�j�폜�������܂����B<BR>\n";
		//�ʐ^�iBACK�j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_back_s.jpg";
		@unlink($path);
		$msg .= $no." �ʐ^�iBACK�j�폜�������܂����B<BR>\n";
		//�g�� �ʐ^�iFRONT�j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_front.jpg";
		@unlink($path);
		$msg .= $no." �g�� �ʐ^�iFRONT�j�폜�������܂����B<BR>\n";
		//�g�� �ʐ^�iBACK�j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_back.jpg";
		@unlink($path);
		$msg .= $no." �g�� �ʐ^�iBACK�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�w�b�h�\�j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_part1.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�w�b�h�\�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�w�b�h���j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_part2.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�w�b�h���j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�l�b�N�\�j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_part3.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�l�b�N�\�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�l�b�N���j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_part4.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�l�b�N���j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�{�f�B�[�\�j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_part5.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�{�f�B�[�\�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�{�f�B�[���j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_part6.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�{�f�B�[���j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�E���ʁj�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_part7.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�E���ʁj�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�����ʁj�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_part8.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�����ʁj�폜�������܂����B<BR>\n";
		//�g�� ����P�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_special1.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����P�폜�������܂����B<BR>\n";
		//�g�� ����Q�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_special2.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����Q�폜�������܂����B<BR>\n";
		//�g�� ����R�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_special3.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����R�폜�������܂����B<BR>\n";
		//�g�� ����S�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_special4.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����S�폜�������܂����B<BR>\n";
		//�g�� �M�^�[�P�[�X�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_case.jpg";
		@unlink($path);
		$msg .= $no." �g�� �M�^�[�P�[�X�폜�������܂����B<BR>\n";
		//�X�V���t�̍X�V
		update_day();
	}



	//--- ���[�J�[�f�[�^�폜
	if(isset($post['kill2'])){
		$msg .= "�폜<br>\n";
		//--- �e�L�X�g�폜
		//��\���t���O�������l�Ƃ���
		$nulldata = array();
		$mkrpath = DATPATH."makers/makers".$get['maker'].".txt";
		//�e�L�X�g�t�@�C��Write
		if(!file_write($mkrpath,1000,$nulldata)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "�������폜�������܂����B<BR>\n";
		$mkrpath = DATPATH."makers/makers".$get['maker']."_1.jpg";
		@unlink($mkrpath);
		$msg .= $no." �摜�P�폜�������܂����B<BR>\n";
		$mkrpath = DATPATH."makers/makers".$get['maker']."_2.jpg";
		@unlink($mkrpath);
		$msg .= $no." �摜�Q�폜�������܂����B<BR>\n";
		$mkrpath = DATPATH."makers/makers".$get['maker']."_3.jpg";
		@unlink($mkrpath);
		$msg .= $no." �摜�R�폜�������܂����B<BR>\n";
		$mkrpath = DATPATH."makers/makers".$get['maker']."_4.jpg";
		@unlink($mkrpath);
		$msg .= $no." �摜�S�폜�������܂����B<BR>\n";
		$mkrpath = DATPATH."makers/makers".$get['maker']."_5.jpg";
		@unlink($mkrpath);
		$msg .= $no." �摜�T�폜�������܂����B<BR>\n";/*
		$mkrpath = DATPATH."makers/makers".$get['maker']."_6.jpg";
		@unlink($mkrpath);
		$msg .= $no." �摜�U�폜�������܂����B<BR>\n";
		$mkrpath = DATPATH."makers/makers".$get['maker']."_7.jpg";
		@unlink($mkrpath);
		$msg .= $no." �摜�V�폜�������܂����B<BR>\n";
		$mkrpath = DATPATH."makers/makers".$get['maker']."_8.jpg";
		@unlink($mkrpath);
		$msg .= $no." �摜�W�폜�������܂����B<BR>\n";
		$mkrpath = DATPATH."makers/makers".$get['maker']."_9.jpg";
		@unlink($mkrpath);
		$msg .= $no." �摜�X�폜�������܂����B<BR>\n";
		$mkrpath = DATPATH."makers/makers".$get['maker']."_10.jpg";
		@unlink($mkrpath);
		$msg .= $no." �摜�P�O�폜�������܂����B<BR>\n";*/
		//�X�V���t�̍X�V
		update_day();
	}


	//--- �f�[�^�X�V���摜�폜
	if(isset($post['photokill'])){
		$msg .= "�摜�폜<br>\n";
		$no = $post['photokill'];
		//�ʐ^�iFRONT�j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_front_s.jpg";
		@unlink($path);
		$msg .= $no." �ʐ^�iFRONT�j�폜�������܂����B<BR>\n";
		//�ʐ^�iBACK�j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_back_s.jpg";
		@unlink($path);
		$msg .= $no." �ʐ^�iBACK�j�폜�������܂����B<BR>\n";
		//�g�� �ʐ^�iFRONT�j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_front.jpg";
		@unlink($path);
		$msg .= $no." �g�� �ʐ^�iFRONT�j�폜�������܂����B<BR>\n";
		//�g�� �ʐ^�iBACK�j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_back.jpg";
		@unlink($path);
		$msg .= $no." �g�� �ʐ^�iBACK�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�w�b�h�\�j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_part1.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�w�b�h�\�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�w�b�h���j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_part2.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�w�b�h���j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�l�b�N�\�j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_part3.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�l�b�N�\�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�l�b�N���j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_part4.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�l�b�N���j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�{�f�B�[�\�j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_part5.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�{�f�B�[�\�j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�{�f�B�[���j�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_part6.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�{�f�B�[���j�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�E���ʁj�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_part7.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�E���ʁj�폜�������܂����B<BR>\n";
		//�g�� �p�[�c�ʐ^�i�����ʁj�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_part8.jpg";
		@unlink($path);
		$msg .= $no." �g�� �p�[�c�ʐ^�i�����ʁj�폜�������܂����B<BR>\n";
		//�g�� ����P�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_special1.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����P�폜�������܂����B<BR>\n";
		//�g�� ����Q�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_special2.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����Q�폜�������܂����B<BR>\n";
		//�g�� ����R�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_special3.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����R�폜�������܂����B<BR>\n";
		//�g�� ����S�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_special4.jpg";
		@unlink($path);
		$msg .= $no." �g�� ����S�폜�������܂����B<BR>\n";
		//�g�� �M�^�[�P�[�X�폜
		$path = DATPATH."makers/".$get['maker']."/".$no."_case.jpg";
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

	$mkrpath = DATPATH."makers/makers".$get['maker'].".txt";
	if(!file_read($mkrpath,1000,$makerdat)){
		print("File read error!!( ".$path." )<BR>\n");
		exit;
	}
//���[�J�[��
	$maker_name = $makerdat[0];
//�^�C�g���P
	$maker_title[1] = $makerdat[0];
	//�{���P
	//�ő�s�������߂�
	$gyosuu = 0;
	for($j=10;$j<99;$j++){
		if($makerdat[$j] != ""){
			$gyosuu = $j;
		}
	}
	//�}���`���C���e�L�X�g�̐���
	$text = "";
	for($j=10;$j<$gyosuu+1;$j++){
		$maker_text[1] .= $makerdat[$j]."\n";
	}

	for($bl=1;$bl<10;$bl++){
	//�^�C�g��
		$maker_title[$bl+1] = $makerdat[$bl];
	//�{��
		//�ő�s�������߂�
		$gyosuu = 0;
		for($j=($bl*100);$j<(($bl*100)+99);$j++){
			if($makerdat[$j] != ""){
				$gyosuu = $j;
			}
		}
		//�}���`���C���e�L�X�g�̐���
		$text = "";
		for($j=($bl*100);$j<$gyosuu+1;$j++){
			$maker_text[$bl+1] .= $makerdat[$j]."\n";
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
<?php
	if(DEBUG) debug_print($item);
?>
</body>
</html>
