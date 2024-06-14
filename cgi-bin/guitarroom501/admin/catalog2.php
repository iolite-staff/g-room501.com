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
	if(isset($post['text'])){
		$msg .= "更新<br>\n";
		//--- テキスト更新
		//改行コードごとに配列格納
		$txt = preg_split("/[\r\n]/", trim($post['text']));
		$cnt = count($txt);
		//100行目以降は切り捨て
		if($cnt > 100){
			$cnt = 100;
		}
		for($i=0;$i<$cnt;$i++){
			//item変数へテキストを格納
			$dat[$i] = $txt[$i];
		}
		$path = DATPATH."guitar/".$get['maker']."/".$no.".txt";
		//テキストファイルWrite
		if(!file_write($path,100,$dat)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "ｔｘｔ書き換え成功しました。<BR>\n";
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
		$path = DATPATH."guitar/".$get['maker']."/".$no.".txt";
		//テキストファイルWrite
		if(!file_write($path,100,$nulldata)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "ｔｘｔ削除成功しました。<BR>\n";
		//TOP用縮小写真削除
		$path = DATPATH."guitar/".$get['maker']."/".$no."_small.jpg";
		@unlink($path);
		$msg .= $no." 用縮小写真削除成功しました。<BR>\n";
		//写真（FRONT）削除
		$path = DATPATH."guitar/".$get['maker']."/".$no."_front_s.jpg";
		@unlink($path);
		$msg .= $no." 写真（FRONT）削除成功しました。<BR>\n";
		//写真（BACK）削除
		$path = DATPATH."guitar/".$get['maker']."/".$no."_back_s.jpg";
		@unlink($path);
		$msg .= $no." 写真（BACK）削除成功しました。<BR>\n";
		//拡大 写真（FRONT）削除
		$path = DATPATH."guitar/".$get['maker']."/".$no."_front.jpg";
		@unlink($path);
		$msg .= $no." 拡大 写真（FRONT）削除成功しました。<BR>\n";
		//拡大 写真（BACK）削除
		$path = DATPATH."guitar/".$get['maker']."/".$no."_back.jpg";
		@unlink($path);
		$msg .= $no." 拡大 写真（BACK）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ヘッド表）削除
		$path = DATPATH."guitar/".$get['maker']."/".$no."_part1.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ヘッド表）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ヘッド裏）削除
		$path = DATPATH."guitar/".$get['maker']."/".$no."_part2.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ヘッド裏）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ネック表）削除
		$path = DATPATH."guitar/".$get['maker']."/".$no."_part3.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ネック表）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ネック裏）削除
		$path = DATPATH."guitar/".$get['maker']."/".$no."_part4.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ネック裏）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ボディー表）削除
		$path = DATPATH."guitar/".$get['maker']."/".$no."_part5.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ボディー表）削除成功しました。<BR>\n";
		//拡大 パーツ写真（ボディー裏）削除
		$path = DATPATH."guitar/".$get['maker']."/".$no."_part6.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（ボディー裏）削除成功しました。<BR>\n";
		//拡大 パーツ写真（右側面）削除
		$path = DATPATH."guitar/".$get['maker']."/".$no."_part7.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（右側面）削除成功しました。<BR>\n";
		//拡大 パーツ写真（左側面）削除
		$path = DATPATH."guitar/".$get['maker']."/".$no."_part8.jpg";
		@unlink($path);
		$msg .= $no." 拡大 パーツ写真（左側面）削除成功しました。<BR>\n";
		//拡大 特殊１削除
		$path = DATPATH."guitar/".$get['maker']."/".$no."_special1.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊１削除成功しました。<BR>\n";
		//拡大 特殊２削除
		$path = DATPATH."guitar/".$get['maker']."/".$no."_special2.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊２削除成功しました。<BR>\n";
		//拡大 特殊３削除
		$path = DATPATH."guitar/".$get['maker']."/".$no."_special3.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊３削除成功しました。<BR>\n";
		//拡大 特殊４削除
		$path = DATPATH."guitar/".$get['maker']."/".$no."_special4.jpg";
		@unlink($path);
		$msg .= $no." 拡大 特殊４削除成功しました。<BR>\n";
		//拡大 ギターケース削除
		$path = DATPATH."guitar/".$get['maker']."/".$no."_case.jpg";
		@unlink($path);
		$msg .= $no." 拡大 ギターケース削除成功しました。<BR>\n";
		//更新日付の更新
		update_day();
	}

	//INDEX更新
	if(isset($post['text'])
	|| isset($post['kill'])
	){
		$spacer = "                                                                ";
		for($type=1;$type<=4;$type++){
			for($i=0;$i<200;$i++){
				$upd_i = $i + ($type-1)*200;

				//--- テキストファイルRead
				$path = DATPATH."guitar/".$type."/".sprintf('%04d',$i).".txt";
				if(!file_read($path,100,$item)){
					print("File read error!!( /".$path." )<BR>\n");
					exit;
				}
				//商品INDEX（メーカー別ABC順用）
				$name_index[$i] = substr(($item[1].$spacer),0,61);
				$name_index[$i] .= substr(($item[2].$spacer),0,64);
				$name_index[$i] .= sprintf('%04d',$i);
				//商品INDEX（更新日付順用）
				$upd_index[$upd_i] = substr(($item[0].$spacer),0,14);
				$upd_index[$upd_i] .= $type;
				$upd_index[$upd_i] .= sprintf('%04d',$i);
			}

			$idxpath = DATPATH."guitar/".$type."/name_index.txt";

			//商品INDEX（メーカー別ABC順用）Write
			if(!file_write($idxpath,200,$name_index)){
				print("File read error!!( ".$idxpath." )<BR>\n");
				exit;
			}
		}

		//商品INDEX（更新日付順用）Write
		$idxpath = DATPATH."guitar/upd_index.txt";

		//INDEXファイルWrite
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
}
//更新確認後、SUBMITを行う
function upd_data(){
	a=confirm("データを更新しホームページに反映します。よろしいですか？");
	if(a == true){
		document.Update.submit();
	}
}
//-->
</script>
</head>
<BODY background="<?=IMGPATH?>bg_wood.gif" vlink="#CC0000" leftmargin="0" topmargin="10">
<a href="login.php">&lt;&lt; Back</a><br>
<p align="center"><strong><font color="#FF0000" size="2"><a href="<?=BASEPATH?>" target="kakunin">＜ホームページTOPへ＞</a></font></strong></p>
<form name="no_sel" method="get" action="catalog2.php">
  <div align="center">
<?php
	if($get['maker'] == 1){
		print("MARTIN");
	}elseif($get['maker'] == 2){
		print("GIBSON");
	}elseif($get['maker'] == 3){
		print("その他");
	}
?>
    <select name="no">
<?php
	//----- 最新の10件目の更新日付を取得する
	$idxpath = DATPATH."guitar/upd_index.txt";

	//INDEXファイルRead
	if(!file_read($idxpath,800,$upd_index)){
		print("File read error!!( ".$idxpath." )<BR>\n");
		exit;
	}

	rsort($upd_index);

	$disp_cnt = 0;

	for($i=0;$i<800;$i++){
		//INDEXファイルの内容が空の場合、ループ脱出
		if($upd_index[$i] == ""){
			break;
		//表示した件数が10件を超えた場合、ループ脱出
		}elseif($disp_cnt >= 10){
			break;
		}else{
			$path = DATPATH."guitar/".substr($upd_index[$i],14,1)."/".substr($upd_index[$i],15,4).".txt";
			//データファイルRead
			if(!file_read($path,100,$item)){
				print("File read error!!( ".$path." )<BR>\n");
				exit;
			}
			$new_time = $item[0] - 1;
			//カウント インクリメント
			$disp_cnt++;
		}
	}

	for($i=0;$i<200;$i++){
		$path = DATPATH."guitar/".$_GET['maker']."/".sprintf('%04d',$i).".txt";
		//データファイルRead
		if(!file_read($path,100,$item)){
			print("File read error!!( ".$path." )<BR>\n");
			exit;
		}
		//更新日作成
		$item0yy = substr($item[0],0,4);
		$item0mm = substr($item[0],4,2);
		$item0dd = substr($item[0],6,2);
		$item0ymd = "更新日:".$item0yy."/".$item0mm."/".$item0dd;
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
		//選択済みのチェック
		if(sprintf('%04d',$i) == $no){
?>
  <option value="<?=sprintf('%04d',$i)?>" selected>＃<?=sprintf('%04d',$i)?> <?=$item0ymd?>　|　<?=$item[1]?>　<?=$item[13]?>　<?=$item[2]?>(<?=$item[3]?>) <?=$jyotai?></option>
<?php
		}else{
?>
  <option value="<?=sprintf('%04d',$i)?>">＃<?=sprintf('%04d',$i)?> <?=$item0ymd?>　|　<?=$item[1]?>　<?=$item[13]?>　<?=$item[2]?>(<?=$item[3]?>) <?=$jyotai?></option>
<?php
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
			$path = DATPATH."guitar/".$get['maker']."/".$no.".txt";
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
<p align="center"><strong><font color="#FF0000" size="2"><a href="<?=PHPPATH?>catalog/detail.php?maker=<?=$get['maker']?>&cd=<?=$no?>" target="kakunin">＜この商品の詳細画面へ＞</a></font></strong></p>
<p><?=$msg?>
  <div align="center">
    <form name="Update" method="post" enctype="multipart/form-data" action="catalog2.php?maker=<?=$get['maker']?>&no=<?=$no?>">
    <table width="680" border="0" cellspacing="0" cellpadding="3">
      <tr bordercolor="#FFFFFF" bgcolor="#000000">
        <td width="615" align="left"><strong><font size="2" color="#FFFFFF">＃<?=$no?> の削除</font></strong><font size="2" color="#FFFFFF">　※削除した情報は元には戻せません。</font></td>
        <td width="53">
          <div align="right"><strong><font size="2" color="#FFFFFF">
            <input type="button" name="Delete" value="削除" onClick="kill_data('<?=$no?>')">
            </font></strong></div>
        </td>
      </tr>
      <tr bordercolor="#FFFFFF" bgcolor="<?=$bgcolor?>">
        <td width="615" align="left"><strong><font size="2" color="#FFFFFF">＃<?=$no?>
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
          <div align="center"><strong><font size="2" color="#FFFFFF">ファイルの内容</font></strong></div>
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
