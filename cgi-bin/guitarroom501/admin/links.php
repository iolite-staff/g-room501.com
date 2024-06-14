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

// maru
	if(isset($_FILES['file']['tmp_name'])){
		$file = make_up_bs($_FILES['file']['tmp_name'],0);
	}
// maru

	//文字化け対策（エスケープ処理：表示用）
	$post = make_up_bs($_POST,0);
	$get = make_up_bs($_GET,0);

	//GETのNOを格納
	if(isset($get['no'])){
		$no = sprintf('%03d',$get['no']);
	}
	//POSTのNOを格納
	if(isset($post['no'])){
		$no = sprintf('%03d',$post['no']);
	}

	//GETのページを格納
	if(isset($get['page'])){
		$page = $get['page'];
	}else{
		$page = 1;
	}

	//--- データ更新
	if($post['syori_kbn'] == "Update"){
		$msg .= "更新<br>\n";

		$path = DATPATH."links/".$no.".txt";
		//テキストファイルWrite
		if(!file_write($path,100,$dat)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "ｔｘｔ書き換え成功しました。<BR>\n";
		if($file != ""){
			//写真アップロード
			$path = DATPATH."links/".$no.".jpg";
			copy($file, $path);
			$msg .= $file."=> /".$path." 書き換え成功しました。<BR>\n";
		}
		//更新日付の更新
		update_day();

	}

	//----- up button
	if($post['syori_kbn'] == "Up"){
		//一番上のデータの場合、UP処理は行わない
		if($no != 0){
			//交換先NO作成
			$tno = sprintf('%03d',$no - 1);
			$msg .= "Up No.".$no." -> ".$tno."<br>";

			//テキスト交換
			$path = DATPATH."links/".$no.".txt";
			$tpath = DATPATH."links/".$tno.".txt";
			$tmp = DATPATH."links/tmp.txt";
			copy($path,$tmp);
			copy($tpath,$path);
			copy($tmp,$tpath);
			unlink($tmp);

			//画像交換
			$path = DATPATH."links/".$no.".jpg";
			$tpath = DATPATH."links/".$tno.".jpg";
			$tmp = DATPATH."links/tmp.jpg";
			$tmp2 = DATPATH."links/tmp2.jpg";
			@copy($path,$tmp);
			@copy($tpath,$tmp2);
			@unlink($path);
			@unlink($tpath);
			@copy($tmp,$tpath);
			@copy($tmp2,$path);
			@unlink($tmp);
			@unlink($tmp2);
			//更新日付の更新
			update_day();
		}
	}

	//----- down button
	if($post['syori_kbn'] == "Down"){
		//一番下のデータの場合、DOWN処理は行わない
		if($no != 99){
			//交換先NO作成
			$tno = sprintf('%03d',$no + 1);
			$msg .= "Down No.".$no." -> ".$tno."<br>";;

			//テキスト交換
			$path = DATPATH."links/".$no.".txt";
			$tpath = DATPATH."links/".$tno.".txt";
			$tmp = DATPATH."links/tmp.txt";
			copy($path,$tmp);
			copy($tpath,$path);
			copy($tmp,$tpath);
			unlink($tmp);

			//画像交換
			$path = DATPATH."links/".$no.".jpg";
			$tpath = DATPATH."links/".$tno.".jpg";
			$tmp = DATPATH."links/tmp.jpg";
			$tmp2 = DATPATH."links/tmp2.jpg";
			@copy($path,$tmp);
			@copy($tpath,$tmp2);
			@unlink($path);
			@unlink($tpath);
			@copy($tmp,$tpath);
			@copy($tmp2,$path);
			@unlink($tmp);
			@unlink($tmp2);
			//更新日付の更新
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
<title>Links</title>
</head>
<BODY background="<?=IMGPATH?>bg_wood.gif" vlink="#CC0000" leftmargin="0" topmargin="10">
<a href="login.php">&lt;&lt; Back</a><br>
<p align="center"><strong><font color="#FF0000" size="2"><a href="<?=BASEPATH?>links/index.html" target="kakunin">＜ホームページ Links へ＞</a></font></strong></p>
<p><?=$msg?>
  <div align="center">
<?php
	//詳細データ表示
	for($lp=0;$lp<10;$lp++){
		$no = sprintf('%03d',$lp);

		//--- テキストファイルRead
		$path = DATPATH."links/".$no.".txt";
		if(!file_exists($path)){
			file_put_contents($path, "");
			chmod ($path, 0755);
		}
		//テキストファイルRead
		if(!file_read($path,100,$dat)){
			print("File read error!!( /".$path." )<BR>\n");
			exit;
		}

		//--- 本文取得
		//マルチラインのテキストをtxt変数に格納
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
//更新確認後、SUBMITを行う
function upd_data<?=$no?>(type){
	a=confirm("データを更新しホームページに反映します。よろしいですか？");
	if(a == true){
		document.Update<?=$no?>.syori_kbn.value = type;
		document.Update<?=$no?>.submit();
	}
}
//-->
</script>
    <form name="Update<?=$no?>" method="post" enctype="multipart/form-data" action="links.php?page=<?=$page?>&no=<?=$no?>">
    <table width="680" border="0" cellspacing="0" cellpadding="3">
      <tr bordercolor="#FFFFFF" bgcolor="#43888a">
        <td width="615" align="left"><strong><font size="2" color="#FFFFFF">＃<?=$no?>
          の更新</font></strong><font size="2" color="#FFFFFF">　※この情報を修正します。</font></td>
        <td width="53">
          <div align="right"><strong><font size="2" color="#FFFFFF">
            <input type="button" name="Update" value="更新" onClick="upd_data<?=$no?>('Update')">
            </font></strong></div>
        </td>
      </tr>
      <tr>
        <td rowspan="3" width="683" background="<?=IMGPATH?>bg_sand.gif">
    <table width="680" border="0" align="center" cellpadding="2" cellspacing="1">
      <tr>
        <td bgcolor="#43888a">
          <div align="center"><strong><font size="2" color="#FFFFFF">非表示</font></strong></div>
        </td>
        <td align="left"><font size="2">
<input type="checkbox" name="dat[0]" value="checked" <?=$dat[0]?>>
        </font></td>
      </tr>
      <tr>
        <td bgcolor="#43888a">
          <div align="center"><strong><font size="2" color="#FFFFFF">サイト名</font></strong></div>
        </td>
        <td align="left">
          <input type="text" name="dat[1]" size="80" maxlength="60" value="<?=$dat[1]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="#43888a">
          <div align="center"><strong><font size="2" color="#FFFFFF">URL</font></strong></div>
        </td>
        <td align="left">
          <input type="text" name="dat[2]" size="80" maxlength="60" value="<?=$dat[2]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="#43888a">
          <div align="center"><strong><font size="2" color="#FFFFFF">写真</font></strong></div>
        </td>
        <td align="left">
          <input type="file" name="file" size="40" maxlength="255" value="">
        </td>
      </tr>
    </table>
        </td>
        <td bgcolor="#666666" valign="top" width="43">
          <div align="center">
            <p>　</p>
            <input name="Up" type="button" value="▲" onClick="upd_data<?=$no?>('Up')">
          </div>
        </td>
      </tr>
      <tr>
        <td bgcolor="#666666" align="center" valign="middle" width="43"><font size="2" color="#FFFFFF"><strong>並<br>
          替<br>
          え</strong></font></td>
      </tr>
      <tr>
        <td bgcolor="#666666" valign="bottom" width="43">
          <div align="center">
            <input name="Down" type="button" value="▼" onClick="upd_data<?=$no?>('Down')">
            <p>　</p>
          </div>
        </td>
      </tr>
    </table>
    <input type="hidden" name="syori_kbn" value="">
    </form>
<?php
	}
?>
  </div>
<?php
	if(DEBUG) debug_print($item);
?>
</body>
</html>
