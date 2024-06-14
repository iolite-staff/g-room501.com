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
		//未ログイン時、ログイン画面へ遷移
		header("Location: login.php");
		exit;
	}

	$msg = "";

	//データの格納
	if(isset($_POST['maker_dat'])){
		$maker_dat = make_up_bs($_POST['maker_dat'],0);
	}
	if(isset($_POST['dat'])){
		$dat = make_up_bs($_POST['dat'],0);
	}

	//文字化け対策（エスケープ処理：表示用）
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

	//GET値のチェック
	if($get['maker'] == ""){
		disp_err(make_err("エラー","ページの呼び出しが不正です。"));
		exit;
	}

	//GETのNOを格納
	if(isset($get['no'])){
		$no = $get['no'];
	}
	//POSTのNOを格納
	if(isset($post['no'])){
		$no = $post['no'];
	}

	//--- メーカーデータ更新
	if(isset($maker_dat[0])){
		$msg .= "更新<br>\n";
		//--- テキスト更新
		//改行コードごとに配列格納
		$txt1 = preg_split("/[\r\n]/", trim($post['maker_text1']));
		$cnt1 = count($txt1);
		//行目以降は切り捨て
		if($cnt1 > 90){
			$cnt1 = 90;
		}
		for($i=0;$i<$cnt1;$i++){
			//item変数へテキストを格納
			$maker_dat[$i+10] = $txt1[$i];
		}
		//--- テキスト更新
		//改行コードごとに配列格納
		$txt2 = preg_split("/[\r\n]/", trim($post['maker_text2']));
		$cnt2 = count($txt2);
		//行目以降は切り捨て
		if($cnt2 > 100){
			$cnt2 = 100;
		}
		for($i=0;$i<$cnt2;$i++){
			//item変数へテキストを格納
			$maker_dat[$i+100] = $txt2[$i];
		}
		//--- テキスト更新
		//改行コードごとに配列格納
		$txt3 = preg_split("/[\r\n]/", trim($post['maker_text3']));
		$cnt3 = count($txt3);
		//行目以降は切り捨て
		if($cnt3 > 100){
			$cnt3 = 100;
		}
		for($i=0;$i<$cnt3;$i++){
			//item変数へテキストを格納
			$maker_dat[$i+200] = $txt3[$i];
		}
		//--- テキスト更新
		//改行コードごとに配列格納
		$txt4 = preg_split("/[\r\n]/", trim($post['maker_text4']));
		$cnt4 = count($txt4);
		//行目以降は切り捨て
		if($cnt4 > 100){
			$cnt4 = 100;
		}
		for($i=0;$i<$cnt4;$i++){
			//item変数へテキストを格納
			$maker_dat[$i+300] = $txt4[$i];
		}
		//--- テキスト更新
		//改行コードごとに配列格納
		$txt5 = preg_split("/[\r\n]/", trim($post['maker_text5']));
		$cnt5 = count($txt5);
		//行目以降は切り捨て
		if($cnt5 > 100){
			$cnt5 = 100;
		}
		for($i=0;$i<$cnt5;$i++){
			//item変数へテキストを格納
			$maker_dat[$i+400] = $txt5[$i];
		}/*
		//--- テキスト更新
		//改行コードごとに配列格納
		$txt6 = preg_split("/[\r\n]/", trim($post['maker_text6']));
		$cnt6 = count($txt6);
		//行目以降は切り捨て
		if($cnt6 > 100){
			$cnt6 = 100;
		}
		for($i=0;$i<$cnt6;$i++){
			//item変数へテキストを格納
			$maker_dat[$i+500] = $txt6[$i];
		}
		//--- テキスト更新
		//改行コードごとに配列格納
		$txt7 = preg_split("/[\r\n]/", trim($post['maker_text7']));
		$cnt7 = count($txt7);
		//行目以降は切り捨て
		if($cnt7 > 100){
			$cnt7 = 100;
		}
		for($i=0;$i<$cnt7;$i++){
			//item変数へテキストを格納
			$maker_dat[$i+600] = $txt7[$i];
		}
		//--- テキスト更新
		//改行コードごとに配列格納
		$txt8 = preg_split("/[\r\n]/", trim($post['maker_text8']));
		$cnt8 = count($txt8);
		//行目以降は切り捨て
		if($cnt8 > 100){
			$cnt8 = 100;
		}
		for($i=0;$i<$cnt8;$i++){
			//item変数へテキストを格納
			$maker_dat[$i+700] = $txt8[$i];
		}
		//--- テキスト更新
		//改行コードごとに配列格納
		$txt9 = preg_split("/[\r\n]/", trim($post['maker_text9']));
		$cnt9 = count($txt9);
		//行目以降は切り捨て
		if($cnt9 > 100){
			$cnt9 = 100;
		}
		for($i=0;$i<$cnt9;$i++){
			//item変数へテキストを格納
			$maker_dat[$i+800] = $txt9[$i];
		}
		//--- テキスト更新
		//改行コードごとに配列格納
		$txt10 = preg_split("/[\r\n]/", trim($post['maker_text10']));
		$cnt10 = count($txt10);
		//行目以降は切り捨て
		if($cnt10 > 100){
			$cnt10 = 100;
		}
		for($i=0;$i<$cnt10;$i++){
			//item変数へテキストを格納
			$maker_dat[$i+900] = $txt10[$i];
		}*/
		$mkrpath = DATPATH."makers/makers".$get['maker'].".txt";
		//テキストファイルWrite
		if(!file_write($mkrpath,1000,$maker_dat)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "ｔｘｔ書き換え成功しました。<BR>\n";
		if($maker_file[1] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_1.jpg";
			copy($maker_file[1], $mkrpath);
			$msg .= $maker_file[1]."=> ".$mkrpath." 書き換え成功しました。<BR>\n";
		}
		if($maker_file[2] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_2.jpg";
			copy($maker_file[2], $mkrpath);
			$msg .= $maker_file[2]."=> ".$mkrpath." 書き換え成功しました。<BR>\n";
		}
		if($maker_file[3] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_3.jpg";
			copy($maker_file[3], $mkrpath);
			$msg .= $maker_file[3]."=> ".$mkrpath." 書き換え成功しました。<BR>\n";
		}
		if($maker_file[4] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_4.jpg";
			copy($maker_file[4], $mkrpath);
			$msg .= $maker_file[4]."=> ".$mkrpath." 書き換え成功しました。<BR>\n";
		}
		if($maker_file[5] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_5.jpg";
			copy($maker_file[5], $mkrpath);
			$msg .= $maker_file[5]."=> ".$mkrpath." 書き換え成功しました。<BR>\n";
		}/*
		if($maker_file[6] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_6.jpg";
			copy($maker_file[6], $mkrpath);
			$msg .= $maker_file[6]."=> ".$mkrpath." 書き換え成功しました。<BR>\n";
		}
		if($maker_file[7] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_7.jpg";
			copy($maker_file[7], $mkrpath);
			$msg .= $maker_file[7]."=> ".$mkrpath." 書き換え成功しました。<BR>\n";
		}
		if($maker_file[8] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_8.jpg";
			copy($maker_file[8], $mkrpath);
			$msg .= $maker_file[8]."=> ".$mkrpath." 書き換え成功しました。<BR>\n";
		}
		if($maker_file[9] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_9.jpg";
			copy($maker_file[9], $mkrpath);
			$msg .= $maker_file[9]."=> ".$mkrpath." 書き換え成功しました。<BR>\n";
		}
		if($maker_file[10] != ""){
			$mkrpath = DATPATH."makers/makers".$get['maker']."_10.jpg";
			copy($maker_file[10], $mkrpath);
			$msg .= $maker_file[10]."=> ".$mkrpath." 書き換え成功しました。<BR>\n";
		}*/
		//更新日付の更新
		update_day();
	}

	//--- データ更新
	if(isset($dat[1])){
		$msg .= "更新<br>\n";
		//--- 商品登録日を更新するか
		if($dat[0] == ""
		|| $dat[0] == 0
		|| $post['dat0upd'] == "checked"
		){
			$dat[0] = date('YmdHis');
		}
		//--- 売り切れフラグがセットされているか
		if($dat[8] == "checked"
		&& $dat[11] == ""
		){
			$dat[11] = date('Ymd');
		}elseif($dat[8] == ""){
			$dat[11] = "";
		}
		//--- Marks Down欄表示フラグがセットされているか
		if($dat[10] == "checked"
		&& $dat[48] == ""
		){
			$dat[48] = date('Ymd');
		}elseif($dat[10] == ""){
			$dat[48] = "";
		}
		//--- テキスト更新
		//改行コードごとに配列格納
		$txt = preg_split("/[\r\n]/", trim($post['text']));
		$cnt = count($txt);
		//行目以降は切り捨て
		if($cnt > 50){
			$cnt = 50;
		}
		for($i=0;$i<$cnt;$i++){
			//item変数へテキストを格納
			$dat[$i+50] = $txt[$i];
		}
		$path = DATPATH."makers/".$get['maker']."/".$no.".txt";
		//テキストファイルWrite
		if(!file_write($path,100,$dat)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "ｔｘｔ書き換え成功しました。<BR>\n";
		if($file[30] != ""){
			//TOP用縮小写真アップロード
			$path = DATPATH."makers/".$get['maker']."/".$no."_small.jpg";
			copy($file[30], $path);
			$msg .= $file[30]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[31] != ""){
			//写真（FRONT）アップロード
			$path = DATPATH."makers/".$get['maker']."/".$no."_front_s.jpg";
			copy($file[31], $path);
			$msg .= $file[31]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[32] != ""){
			//写真（BACK）アップロード
			$path = DATPATH."makers/".$get['maker']."/".$no."_back_s.jpg";
			copy($file[32], $path);
			$msg .= $file[32]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[33] != ""){
			//拡大 写真（FRONT）アップロード
			$path = DATPATH."makers/".$get['maker']."/".$no."_front.jpg";
			copy($file[33], $path);
			$msg .= $file[33]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[34] != ""){
			//拡大 写真（BACK）アップロード
			$path = DATPATH."makers/".$get['maker']."/".$no."_back.jpg";
			copy($file[34], $path);
			$msg .= $file[34]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[35] != ""){
			//拡大 パーツ写真（ヘッド表）アップロード
			$path = DATPATH."makers/".$get['maker']."/".$no."_part1.jpg";
			copy($file[35], $path);
			$msg .= $file[35]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[36] != ""){
			//拡大 パーツ写真（ヘッド裏）アップロード
			$path = DATPATH."makers/".$get['maker']."/".$no."_part2.jpg";
			copy($file[36], $path);
			$msg .= $file[36]."=> ".$path." 書き換え成功しました。<BR>\n";
		}

		if($file[37] != ""){
			//拡大 パーツ写真（ネック表）アップロード
			$path = DATPATH."makers/".$get['maker']."/".$no."_part3.jpg";
			copy($file[37], $path);
			$msg .= $file[37]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[38] != ""){
			//拡大 パーツ写真（ネック裏）アップロード
			$path = DATPATH."makers/".$get['maker']."/".$no."_part4.jpg";
			copy($file[38], $path);
			$msg .= $file[38]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[39] != ""){
			//拡大 パーツ写真（ボディー表）アップロード
			$path = DATPATH."makers/".$get['maker']."/".$no."_part5.jpg";
			copy($file[39], $path);
			$msg .= $file[39]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[40] != ""){
			//拡大 パーツ写真（ボディー裏）アップロード
			$path = DATPATH."makers/".$get['maker']."/".$no."_part6.jpg";
			copy($file[40], $path);
			$msg .= $file[40]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[41] != ""){
			//拡大 パーツ写真（右側面）アップロード
			$path = DATPATH."makers/".$get['maker']."/".$no."_part7.jpg";
			copy($file[41], $path);
			$msg .= $file[41]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[42] != ""){
			//拡大 パーツ写真（左側面）アップロード
			$path = DATPATH."makers/".$get['maker']."/".$no."_part8.jpg";
			copy($file[42], $path);
			$msg .= $file[42]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[43] != ""){
			//拡大 特殊１アップロード
			$path = DATPATH."makers/".$get['maker']."/".$no."_special1.jpg";
			copy($file[43], $path);
			$msg .= $file[43]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[44] != ""){
			//拡大 特殊２アップロード
			$path = DATPATH."makers/".$get['maker']."/".$no."_special2.jpg";
			copy($file[44], $path);
			$msg .= $file[44]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[45] != ""){
			//拡大 特殊３アップロード
			$path = DATPATH."makers/".$get['maker']."/".$no."_special3.jpg";
			copy($file[45], $path);
			$msg .= $file[45]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[46] != ""){
			//拡大 特殊４アップロード
			$path = DATPATH."makers/".$get['maker']."/".$no."_special4.jpg";
			copy($file[46], $path);
			$msg .= $file[46]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[47] != ""){
			//拡大 ギターケースアップロード
			$path = DATPATH."makers/".$get['maker']."/".$no."_case.jpg";
			copy($file[47], $path);
			$msg .= $file[47]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		//更新日付の更新
		update_day();
	}

	//--- データ削除
	if(isset($post['kill'])){
		$msg .= "削除<br>\n";
		$no = $post['kill'];
		//--- テキスト削除
		//非表示フラグを初期値とする
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
		//テキストファイルWrite
		if(!file_write($path,100,$nulldata)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "ｔｘｔ削除成功しました。<BR>\n";
		//TOP用縮小写真削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_small.jpg";
		@unlink($path);
		$msg .= $no." 用縮小写真削除成功しました。<BR>\n";
		//写真（FRONT）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_front_s.jpg";
		@unlink($path);
		$msg .= $no." 写真（FRONT）削除成功しました。<BR>\n";
		//写真（BACK）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_back_s.jpg";
		@unlink($path);
		$msg .= $no." 写真（BACK）削除成功しました。<BR>\n";
		//拡大 写真（FRONT）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_front.jpg";
		@unlink($path);
		$msg .= $no." 拡大 写真（FRONT）削除成功しました。<BR>\n";
		//拡大 写真（BACK）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_back.jpg";
		@unlink($path);
		$msg .= $no." 拡大 写真（BACK）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ヘッド表）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_part1.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ヘッド表）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ヘッド裏）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_part2.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ヘッド裏）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ネック表）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_part3.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ネック表）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ネック裏）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_part4.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ネック裏）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ボディー表）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_part5.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ボディー表）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ボディー裏）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_part6.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ボディー裏）削除成功しました。<BR>\n";
		//拡大 パーツ写真（右側面）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_part7.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（右側面）削除成功しました。<BR>\n";
		//拡大 パーツ写真（左側面）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_part8.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（左側面）削除成功しました。<BR>\n";
		//拡大 特殊１削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_special1.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊１削除成功しました。<BR>\n";
		//拡大 特殊２削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_special2.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊２削除成功しました。<BR>\n";
		//拡大 特殊３削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_special3.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊３削除成功しました。<BR>\n";
		//拡大 特殊４削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_special4.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊４削除成功しました。<BR>\n";
		//拡大 ギターケース削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_case.jpg";
		@unlink($path);
		$msg .= $no." 拡大 ギターケース削除成功しました。<BR>\n";
		//更新日付の更新
		update_day();
	}



	//--- メーカーデータ削除
	if(isset($post['kill2'])){
		$msg .= "削除<br>\n";
		//--- テキスト削除
		//非表示フラグを初期値とする
		$nulldata = array();
		$mkrpath = DATPATH."makers/makers".$get['maker'].".txt";
		//テキストファイルWrite
		if(!file_write($mkrpath,1000,$nulldata)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "ｔｘｔ削除成功しました。<BR>\n";
		$mkrpath = DATPATH."makers/makers".$get['maker']."_1.jpg";
		@unlink($mkrpath);
		$msg .= $no." 画像１削除成功しました。<BR>\n";
		$mkrpath = DATPATH."makers/makers".$get['maker']."_2.jpg";
		@unlink($mkrpath);
		$msg .= $no." 画像２削除成功しました。<BR>\n";
		$mkrpath = DATPATH."makers/makers".$get['maker']."_3.jpg";
		@unlink($mkrpath);
		$msg .= $no." 画像３削除成功しました。<BR>\n";
		$mkrpath = DATPATH."makers/makers".$get['maker']."_4.jpg";
		@unlink($mkrpath);
		$msg .= $no." 画像４削除成功しました。<BR>\n";
		$mkrpath = DATPATH."makers/makers".$get['maker']."_5.jpg";
		@unlink($mkrpath);
		$msg .= $no." 画像５削除成功しました。<BR>\n";/*
		$mkrpath = DATPATH."makers/makers".$get['maker']."_6.jpg";
		@unlink($mkrpath);
		$msg .= $no." 画像６削除成功しました。<BR>\n";
		$mkrpath = DATPATH."makers/makers".$get['maker']."_7.jpg";
		@unlink($mkrpath);
		$msg .= $no." 画像７削除成功しました。<BR>\n";
		$mkrpath = DATPATH."makers/makers".$get['maker']."_8.jpg";
		@unlink($mkrpath);
		$msg .= $no." 画像８削除成功しました。<BR>\n";
		$mkrpath = DATPATH."makers/makers".$get['maker']."_9.jpg";
		@unlink($mkrpath);
		$msg .= $no." 画像９削除成功しました。<BR>\n";
		$mkrpath = DATPATH."makers/makers".$get['maker']."_10.jpg";
		@unlink($mkrpath);
		$msg .= $no." 画像１０削除成功しました。<BR>\n";*/
		//更新日付の更新
		update_day();
	}


	//--- データ更新＆画像削除
	if(isset($post['photokill'])){
		$msg .= "画像削除<br>\n";
		$no = $post['photokill'];
		//写真（FRONT）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_front_s.jpg";
		@unlink($path);
		$msg .= $no." 写真（FRONT）削除成功しました。<BR>\n";
		//写真（BACK）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_back_s.jpg";
		@unlink($path);
		$msg .= $no." 写真（BACK）削除成功しました。<BR>\n";
		//拡大 写真（FRONT）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_front.jpg";
		@unlink($path);
		$msg .= $no." 拡大 写真（FRONT）削除成功しました。<BR>\n";
		//拡大 写真（BACK）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_back.jpg";
		@unlink($path);
		$msg .= $no." 拡大 写真（BACK）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ヘッド表）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_part1.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ヘッド表）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ヘッド裏）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_part2.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ヘッド裏）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ネック表）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_part3.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ネック表）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ネック裏）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_part4.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ネック裏）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ボディー表）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_part5.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ボディー表）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ボディー裏）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_part6.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ボディー裏）削除成功しました。<BR>\n";
		//拡大 パーツ写真（右側面）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_part7.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（右側面）削除成功しました。<BR>\n";
		//拡大 パーツ写真（左側面）削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_part8.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（左側面）削除成功しました。<BR>\n";
		//拡大 特殊１削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_special1.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊１削除成功しました。<BR>\n";
		//拡大 特殊２削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_special2.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊２削除成功しました。<BR>\n";
		//拡大 特殊３削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_special3.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊３削除成功しました。<BR>\n";
		//拡大 特殊４削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_special4.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊４削除成功しました。<BR>\n";
		//拡大 ギターケース削除
		$path = DATPATH."makers/".$get['maker']."/".$no."_case.jpg";
		@unlink($path);
		$msg .= $no." 拡大 ギターケース削除成功しました。<BR>\n";
		//更新日付の更新
		update_day();
	}

	//INDEX更新
	if(isset($dat[1])
	|| isset($post['kill'])
	){
		$spacer = "                                                                ";
		for($type=1;$type<4;$type++){
			for($i=0;$i<50;$i++){

				//--- テキストファイルRead
				$path = DATPATH."makers/".$type."/".sprintf('%04d',$i).".txt";
				if(!file_read($path,100,$item)){
					print("File read error!!( /".$path." )<BR>\n");
					exit;
				}
				//商品INDEX（メーカー別ABC順用）
				$name_index[$i] = substr(($item[1].$spacer),0,61);
				$name_index[$i] .= substr(($item[2].$spacer),0,64);
				$name_index[$i] .= sprintf('%04d',$i);
			}

			$idxpath = DATPATH."makers/".$type."/name_index.txt";

			//商品INDEX（メーカー別ABC順用）Write
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
//メーカー名
	$maker_name = $makerdat[0];
//タイトル１
	$maker_title[1] = $makerdat[0];
	//本文１
	//最大行数を求める
	$gyosuu = 0;
	for($j=10;$j<99;$j++){
		if($makerdat[$j] != ""){
			$gyosuu = $j;
		}
	}
	//マルチラインテキストの生成
	$text = "";
	for($j=10;$j<$gyosuu+1;$j++){
		$maker_text[1] .= $makerdat[$j]."\n";
	}

	for($bl=1;$bl<10;$bl++){
	//タイトル
		$maker_title[$bl+1] = $makerdat[$bl];
	//本文
		//最大行数を求める
		$gyosuu = 0;
		for($j=($bl*100);$j<(($bl*100)+99);$j++){
			if($makerdat[$j] != ""){
				$gyosuu = $j;
			}
		}
		//マルチラインテキストの生成
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
<title>商品メンテナンス</title>
<script type="text/javascript">
<!--
//削除確認後、SUBMITを行う
function kill_data(no){
	a=confirm("削除したデータは元に戻すことはできません。削除してもよろしいですか？");
	if(a == true){
		document.Delete.kill.value = no;
		document.Delete.submit();
	}
}//削除確認後、SUBMITを行う
function kill_data2(){
	a=confirm("削除したデータは元に戻すことはできません。削除してもよろしいですか？");
	if(a == true){
		document.Delete2.submit();
	}
}
//削除確認後、SUBMITを行う
function photokill_data(no){
	a=confirm("削除したデータは元に戻すことはできません。削除してもよろしいですか？");
	if(a == true){
		document.photoDelete.photokill.value = no;
		document.photoDelete.submit();
	}
}
//更新確認後、SUBMITを行う
function upd_data(){
	a=confirm("データを更新しホームページに反映します。よろしいですか？");
	if(a == true){
		document.Update.submit();
	}
}
//更新確認後、SUBMITを行う
function upd_data2(){
	a=confirm("データを更新しホームページに反映します。よろしいですか？");
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
