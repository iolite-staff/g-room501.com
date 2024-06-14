#!/usr/local/bin/php
<?php
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');
require_once('../inc/h_admin.inc');

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
		$path = DATPATH."makers/".$get['maker']."/coming/".$no.".txt";
		//テキストファイルWrite
		if(!file_write($path,100,$dat)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "ｔｘｔ書き換え成功しました。<BR>\n";
		if($file[30] != ""){
			//TOP用縮小写真アップロード
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_small.jpg";
			copy($file[30], $path);
			$msg .= $file[30]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[31] != ""){
			//写真（FRONT）アップロード
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_front_s.jpg";
			copy($file[31], $path);
			$msg .= $file[31]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[32] != ""){
			//写真（BACK）アップロード
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_back_s.jpg";
			copy($file[32], $path);
			$msg .= $file[32]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[33] != ""){
			//拡大 写真（FRONT）アップロード
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_front.jpg";
			copy($file[33], $path);
			$msg .= $file[33]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[34] != ""){
			//拡大 写真（BACK）アップロード
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_back.jpg";
			copy($file[34], $path);
			$msg .= $file[34]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[35] != ""){
			//拡大 パーツ写真（ヘッド表）アップロード
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part1.jpg";
			copy($file[35], $path);
			$msg .= $file[35]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[36] != ""){
			//拡大 パーツ写真（ヘッド裏）アップロード
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part2.jpg";
			copy($file[36], $path);
			$msg .= $file[36]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[37] != ""){
			//拡大 パーツ写真（ネック表）アップロード
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part3.jpg";
			copy($file[37], $path);
			$msg .= $file[37]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[38] != ""){
			//拡大 パーツ写真（ネック裏）アップロード
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part4.jpg";
			copy($file[38], $path);
			$msg .= $file[38]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[39] != ""){
			//拡大 パーツ写真（ボディー表）アップロード
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part5.jpg";
			copy($file[39], $path);
			$msg .= $file[39]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[40] != ""){
			//拡大 パーツ写真（ボディー裏）アップロード
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part6.jpg";
			copy($file[40], $path);
			$msg .= $file[40]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[41] != ""){
			//拡大 パーツ写真（右側面）アップロード
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part7.jpg";
			copy($file[41], $path);
			$msg .= $file[41]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[42] != ""){
			//拡大 パーツ写真（左側面）アップロード
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part8.jpg";
			copy($file[42], $path);
			$msg .= $file[42]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[43] != ""){
			//拡大 特殊１アップロード
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special1.jpg";
			copy($file[43], $path);
			$msg .= $file[43]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[44] != ""){
			//拡大 特殊２アップロード
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special2.jpg";
			copy($file[44], $path);
			$msg .= $file[44]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[45] != ""){
			//拡大 特殊３アップロード
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special3.jpg";
			copy($file[45], $path);
			$msg .= $file[45]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[46] != ""){
			//拡大 特殊４アップロード
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special4.jpg";
			copy($file[46], $path);
			$msg .= $file[46]."=> ".$path." 書き換え成功しました。<BR>\n";
		}
		if($file[47] != ""){
			//拡大 ギターケースアップロード
			$path = DATPATH."makers/".$get['maker']."/coming/".$no."_case.jpg";
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
		$path = DATPATH."makers/".$get['maker']."/coming/".$no.".txt";
		//テキストファイルWrite
		if(!file_write($path,100,$nulldata)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "ｔｘｔ削除成功しました。<BR>\n";
		//TOP用縮小写真削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_small.jpg";
		@unlink($path);
		$msg .= $no." 用縮小写真削除成功しました。<BR>\n";
		//写真（FRONT）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_front_s.jpg";
		@unlink($path);
		$msg .= $no." 写真（FRONT）削除成功しました。<BR>\n";
		//写真（BACK）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_back_s.jpg";
		@unlink($path);
		$msg .= $no." 写真（BACK）削除成功しました。<BR>\n";
		//拡大 写真（FRONT）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_front.jpg";
		@unlink($path);
		$msg .= $no." 拡大 写真（FRONT）削除成功しました。<BR>\n";
		//拡大 写真（BACK）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_back.jpg";
		@unlink($path);
		$msg .= $no." 拡大 写真（BACK）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ヘッド表）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part1.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ヘッド表）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ヘッド裏）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part2.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ヘッド裏）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ネック表）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part3.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ネック表）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ネック裏）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part4.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ネック裏）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ボディー表）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part5.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ボディー表）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ボディー裏）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part6.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ボディー裏）削除成功しました。<BR>\n";
		//拡大 パーツ写真（右側面）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part7.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（右側面）削除成功しました。<BR>\n";
		//拡大 パーツ写真（左側面）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part8.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（左側面）削除成功しました。<BR>\n";
		//拡大 特殊１削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special1.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊１削除成功しました。<BR>\n";
		//拡大 特殊２削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special2.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊２削除成功しました。<BR>\n";
		//拡大 特殊３削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special3.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊３削除成功しました。<BR>\n";
		//拡大 特殊４削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special4.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊４削除成功しました。<BR>\n";
		//拡大 ギターケース削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_case.jpg";
		@unlink($path);
		$msg .= $no." 拡大 ギターケース削除成功しました。<BR>\n";
		//更新日付の更新
		update_day();
	}


	//--- データ更新＆画像削除
	if(isset($post['photokill'])){
		$msg .= "画像削除<br>\n";
		$no = $post['photokill'];
		//写真（FRONT）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_front_s.jpg";
		@unlink($path);
		$msg .= $no." 写真（FRONT）削除成功しました。<BR>\n";
		//写真（BACK）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_back_s.jpg";
		@unlink($path);
		$msg .= $no." 写真（BACK）削除成功しました。<BR>\n";
		//拡大 写真（FRONT）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_front.jpg";
		@unlink($path);
		$msg .= $no." 拡大 写真（FRONT）削除成功しました。<BR>\n";
		//拡大 写真（BACK）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_back.jpg";
		@unlink($path);
		$msg .= $no." 拡大 写真（BACK）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ヘッド表）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part1.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ヘッド表）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ヘッド裏）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part2.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ヘッド裏）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ネック表）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part3.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ネック表）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ネック裏）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part4.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ネック裏）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ボディー表）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part5.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ボディー表）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ボディー裏）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part6.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ボディー裏）削除成功しました。<BR>\n";
		//拡大 パーツ写真（右側面）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part7.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（右側面）削除成功しました。<BR>\n";
		//拡大 パーツ写真（左側面）削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_part8.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（左側面）削除成功しました。<BR>\n";
		//拡大 特殊１削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special1.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊１削除成功しました。<BR>\n";
		//拡大 特殊２削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special2.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊２削除成功しました。<BR>\n";
		//拡大 特殊３削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special3.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊３削除成功しました。<BR>\n";
		//拡大 特殊４削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_special4.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊４削除成功しました。<BR>\n";
		//拡大 ギターケース削除
		$path = DATPATH."makers/".$get['maker']."/coming/".$no."_case.jpg";
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
<a href="login.php">&lt;&lt; Back</a><br>
<p align="center"><strong><font color="#FF0000" size="2"><a href="<?=BASEPATH?>" target="kakunin">＜ホームページTOPへ＞</a></font></strong></p>
<p align="center"><strong><font color="#FF0000" size="2"><a href="makers<?=$get['maker']?>.php?maker=<?=$get['maker']?>">＜Sumi工房編集へ＞</a></font></strong></p>
<p align="center"><strong><font color="#FF0000" size="2"><a href="makers<?=$get['maker']?>_news.php?maker=<?=$get['maker']?>">＜Sumi工房News編集へ＞</a></font></strong></p>
<p align="center"><strong><font color="#FF0000" size="2">＜StockList編集中＞</font></strong></p>
<?=$msg?>

<form name="no_sel" method="get" action="<?=$_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
  <div align="center">
    <select name="no">
<?php

	$idxpath = DATPATH."makers/".$_GET['maker']."/coming/name_index.txt";

	//INDEXファイルRead
	if(!file_read($idxpath,50,$name_index)){
		print("File read error!!( ".$idxpath." )<BR>\n");
		exit;
	}

	sort($name_index);

	$old_day = date('Ymd',time()-5184000)+0;

	for($i=0;$i<50;$i++){
		//INDEXファイルの内容が空の場合、なにもしない
		if($name_index[$i] != ""){
			$path = DATPATH."makers/".$_GET['maker']."/coming/".substr($name_index[$i],125,4).".txt";
			//データファイルRead
			if(!file_read($path,100,$item)){
				print("File read error!!( ".$path." )<BR>\n");
				exit;
			}
			if($item[2] != ""){
				//更新日作成
				$item0yy = substr($item[0],0,4);
				$item0mm = substr($item[0],4,2);
				$item0dd = substr($item[0],6,2);
				$item0ymd = "更新日:".$item0yy."/".$item0mm."/".$item0dd;
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
				//選択済みのチェック
				if(substr($name_index[$i],125,4) == $no){
?>
  <option value="<?=substr($name_index[$i],125,4)?>" selected><?=$item[1]?>　<?=$item[2]?>　<?=$item[13]?>(<?=$item[3]?>) <?=$jyotai?>
<?php
					if($item[9]=="checked"){
						print("在庫無し");
					}else{
						print("在庫有り");
					}
?>
</option>
<?php
				}else{
?>
  <option value="<?=substr($name_index[$i],125,4)?>"><?=$item[1]?>　<?=$item[2]?>　<?=$item[13]?>(<?=$item[3]?>) <?=$jyotai?>
<?php
					if($item[9]=="checked"){
						print("在庫無し");
					}else{
						print("在庫有り");
					}
?>
</option>
<?php
				}
			}
		}
	}
	for($i=0;$i<50;$i++){
		//INDEXファイルの内容が空の場合、なにもしない
		if($name_index[$i] != ""){
			$path = DATPATH."makers/".$_GET['maker']."/coming/".substr($name_index[$i],125,4).".txt";
			//データファイルRead
			if(!file_read($path,100,$item)){
				print("File read error!!( ".$path." )<BR>\n");
				exit;
			}
			if($item[2] == ""){
				//更新日作成
				$item0yy = substr($item[0],0,4);
				$item0mm = substr($item[0],4,2);
				$item0dd = substr($item[0],6,2);
				$item0ymd = "更新日:".$item0yy."/".$item0mm."/".$item0dd;
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
				//選択済みのチェック
				if(substr($name_index[$i],125,4) == $no){
?>
  <option value="<?=substr($name_index[$i],125,4)?>" selected><?=$item[1]?>　<?=$item[2]?>　<?=$item[13]?>(<?=$item[3]?>) <?=$jyotai?></option>
<?php
				}else{
?>
  <option value="<?=substr($name_index[$i],125,4)?>"><?=$item[1]?>　<?=$item[2]?>　<?=$item[13]?>(<?=$item[3]?>) <?=$jyotai?></option>
<?php
				}
			}
		}
	}

?>
    </select>
    <input name="maker" type="hidden" value="<?=$get['maker']?>">
    <input name="no_sel" type="submit" value="選択">
  </div>
</form>
<hr>
<?php
	if(isset($no)){

		$bgcolor = "#43888a";

		if(!isset($dat)){
			//--- テキストファイルRead
			$path = DATPATH."makers/".$get['maker']."/coming/".$no.".txt";
			//テキストファイルRead
			if(!file_read($path,100,$dat)){
				print("File read error!!( /".$path." )<BR>\n");
				exit;
			}
		}

		//--- 本文取得
		$msg .= "編集中<br>\n";
		//マルチラインのテキストをtxt変数に格納
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
<p align="center"><strong><font color="#FF0000" size="2"><a href="<?=PHPPATH?>makers/detail.php?maker=<?=$get['maker']?>&cd=<?=$no?>" target="kakunin">＜この商品の詳細画面へ＞</a></font></strong></p>
<p>
  <div align="center">
    <form name="Update" method="post" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>?maker=<?=$get['maker']?>&no=<?=$no?>">
    <table width="680" border="0" cellspacing="0" cellpadding="3">
      <tr bordercolor="#FFFFFF" bgcolor="#000000">
        <td width="515" align="left"><strong><font size="2" color="#FFFFFF">＃<?=$no?> の削除</font></strong><font size="2" color="#FFFFFF">　※削除した情報は元には戻せません。
        </font></td>
        <td width="100">
          <div align="right"><strong><font size="2" color="#FFFFFF">
            <input type="button" name="photoDelete" value="画像のみ削除" onClick="photokill_data('<?=$no?>')">
            </font></strong></div>
        </td>
        <td width="53">
          <div align="right"><strong><font size="2" color="#FFFFFF">
            <input type="button" name="Delete" value="削除" onClick="kill_data('<?=$no?>')">
            </font></strong></div>
        </td>
      </tr>
      <tr bordercolor="#FFFFFF" bgcolor="<?=$bgcolor?>">
        <td width="615" align="left" colspan="2"><strong><font size="2" color="#FFFFFF">＃<?=$no?>
          の更新</font></strong><font size="2" color="#FFFFFF">　※この情報を修正します。</font></td>
        <td width="53">
          <div align="right"><strong><font size="2" color="#FFFFFF">
            <input type="button" name="Update" value="更新" onClick="upd_data()">
            </font></strong></div>
        </td>
      </tr>
    </table>
    <br>
    <table width="680" border="0" align="center" cellpadding="2" cellspacing="1" background="<?=IMGPATH?>bg_sand.gif">
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">非表示</font></strong></div>
        </td>
        <td align="left"><font size="2">
<input type="checkbox" name="dat[49]" value="checked" <?=$dat[49]?>><font color="#CC0000"><strong>画面に表示しない</strong></font><br>
　　※チェックを入れた場合、トップページにもストックリストにも表示されなくなります。</font>
        </td>
      </tr>
      <tr>
        <td width="150" bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font color="#FFFFFF" size="2">商品登録日</font></strong></div>
        </td>
        <td width="530" align="left"><font size="2">
          <?=substr($dat[0],0,4)?>年
          <?=substr($dat[0],4,2)?>月
          <?=substr($dat[0],6,2)?>日
          <?=substr($dat[0],8,2)?>時
          <?=substr($dat[0],10,2)?>分
          <?=substr($dat[0],12,2)?>秒
<?php
		print("<input type=\"hidden\" name=\"dat[0]\" value=\"".trim($dat[0])."\">\n");
?>
          　　<input type="checkbox" name="dat0upd" value="checked">更新する（新商品の場合等）
        </font></td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">メーカー名</font></strong></div>
        </td>
        <td align="left">
<?php
	print("<input type=\"text\" name=\"dat[1]\" size=\"60\" maxlength=\"50\" value=\"".$dat[1]."\">\n");
?>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">商品管理番号</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[13]" size="16" maxlength="12" value="<?=$dat[13]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">モデル名</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[2]" size="60" maxlength="50" value="<?=$dat[2]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">年式（未使用）</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[3]" size="6" maxlength="7" value="<?=$dat[3]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">入荷日</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[4]" size="12" maxlength="16" value="<?=$dat[4]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">現在価格</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[5]" size="12" maxlength="8" value="<?=$dat[5]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">旧価格</font></strong></div>
        </td>
        <td align="left"><font size="2">
<input type="text" name="dat[6]" size="12" maxlength="8" value="<?=$dat[6]?>">
<input type="checkbox" name="dat[10]" value="checked" <?=$dat[10]?>>
          Mark Down欄に表示する
          <?php
	print("<input type=\"hidden\" name=\"dat[48]\" value=\"".$dat[48]."\">\n");
	if($dat[10] == "checked"){
		print("<br>\n");
		print("<font size=\"2\">Marks Down欄表示設定日： ".substr($dat[48],0,4)."年 ".substr($dat[48],4,2)."月 ".substr($dat[48],6,2)."日</font>");
	}
?>
          </font></td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">バーゲン時の価格</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[7]" size="12" maxlength="8" value="<?=$dat[7]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">SOLD / 在庫</font></strong></div>
        </td>
        <td align="left"><font size="2">
<input type="checkbox" name="dat[8]" value="checked" <?=$dat[8]?>><font color="#CC0000"><strong>SOLD</strong></font>
　<font color="#336633"><strong>在庫切れ：</strong></font>
<input type="checkbox" name="dat[9]" value="checked" <?=$dat[9]?>></font>
<?php
	print("<input type=\"hidden\" name=\"dat[11]\" value=\"".$dat[11]."\">\n");
	if($dat[8] == "checked"){
		print("<br>\n");
		print("<font size=\"2\">SOLD設定日： ".substr($dat[11],0,4)."年 ".substr($dat[11],4,2)."月 ".substr($dat[11],6,2)."日</font>");
	}
?>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font color="#FFFFFF" size="2">CONDITON（未使用）</font></strong></div>
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
          <div align="center"><strong><font size="2" color="#FFFFFF">SIDE＆BACK</font></strong></div>
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
          <div align="center"><strong><font size="2" color="#FFFFFF">説明文</font></strong></div>
        </td>
        <td align="left">
                <textarea name="text" cols="57" rows="20">
<?=$txt?>
</textarea>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">TOP用縮小写真</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[30]" size="30" maxlength="255"><font size="2"> ※横90 × 縦160</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">写真（FRONT）</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[31]" size="30" maxlength="255"><font size="2"> ※横255 × 縦400</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">写真（BACK）</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[32]" size="30" maxlength="255"><font size="2"> ※横255 × 縦400</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">拡大 写真（FRONT）</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[33]" size="30" maxlength="255">
          <font size="2"> ※横450 × 縦800</font> </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">拡大 写真（BACK）</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[34]" size="30" maxlength="255">
          <font size="2"> ※横450 × 縦800</font> </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">拡大 パーツ写真<br>（ヘッド表）</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[35]" size="30" maxlength="255">
          <font size="2"> ※横600 × 縦800</font> </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">拡大 パーツ写真<br>（ヘッド裏）</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[36]" size="30" maxlength="255"><font size="2"> ※横600 × 縦800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">拡大 パーツ写真<br>（ネック表）</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[37]" size="30" maxlength="255"><font size="2"> ※横600 × 縦800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">拡大 パーツ写真<br>（ネック裏）</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[38]" size="30" maxlength="255"><font size="2"> ※横600 × 縦800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">拡大 パーツ写真<br>（ボディー表）</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[39]" size="30" maxlength="255"><font size="2"> ※横600 × 縦800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">拡大 パーツ写真<br>（ボディー裏）</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[40]" size="30" maxlength="255"><font size="2"> ※横600 × 縦800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">拡大 パーツ写真<br>（右側面）</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[41]" size="30" maxlength="255"><font size="2"> ※横600 × 縦800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">拡大 パーツ写真<br>（左側面）</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[42]" size="30" maxlength="255"><font size="2"> ※横600 × 縦800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">拡大 特殊１</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[43]" size="30" maxlength="255"><font size="2"> ※横600 × 縦800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">拡大 特殊２</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[44]" size="30" maxlength="255"><font size="2"> ※横600 × 縦800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">拡大 特殊３</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[45]" size="30" maxlength="255"><font size="2"> ※横600 × 縦800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">拡大 特殊４</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[46]" size="30" maxlength="255"><font size="2"> ※横600 × 縦800</font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">拡大 ギターケース</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file[47]" size="30" maxlength="255"><font size="2"> ※横600 × 縦800</font>
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
