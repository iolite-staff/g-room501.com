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

	//バーゲン期間From
	$dat[0] = sprintf('%04d',$post['dat0yy'])
	. sprintf('%02d',$post['dat0mm'])
	. sprintf('%02d',$post['dat0dd']);

	//バーゲン期間To
	$dat[1] = sprintf('%04d',$post['dat1yy'])
	. sprintf('%02d',$post['dat1mm'])
	. sprintf('%02d',$post['dat1dd']);

	//--- ファイルの更新
	if(isset($post['dat0yy'])){
		//--- バーゲンファイル更新
		$path = DATPATH."bargain.txt";
		if(!file_write($path,2,$dat)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "＃bargain ｔｘｔ書き換え成功しました。<BR>\n";
		//更新日付の更新
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
<title>バーゲン期間設定</title>
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
<?php
	$bgcolor = "#43888a";

	//--- テキストファイルRead
	$path = DATPATH."bargain.txt";
	//テキストファイルRead
	if(!file_read($path,2,$dat)){
		print("File read error!!( /".$path." )<BR>\n");
		exit;
	}
?>
<p> 編集中<BR>
<?=$msg?>
  <div align="center">
    <form name="Update" method="post" action="bargain.php">
    <table width="680" border="0" cellspacing="0" cellpadding="3">
      <tr bordercolor="#FFFFFF" bgcolor="<?=$bgcolor?>">
        <td width="615" align="left"><strong><font size="2" color="#FFFFFF">＃bargain
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
        <td width="90" bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font color="#FFFFFF" size="2">バーゲン期間</font></strong></div>
        </td>
        <td width="570" align="left">
          <select name="dat0yy">
<?php
		option_YY(substr($dat[0],0,4),0,5);
?>
          </select>
          年
          <select name="dat0mm">
<?php
		option_MM(substr($dat[0],4,2));
?>
          </select>
          月
          <select name="dat0dd">
<?php
		option_DD(substr($dat[0],6,2));
?>
          </select>
          日
          ～
          <select name="dat1yy">
<?php
		option_YY(substr($dat[1],0,4),0,5);
?>
          </select>
          年
          <select name="dat1mm">
<?php
		option_MM(substr($dat[1],4,2));
?>
          </select>
          月
          <select name="dat1dd">
<?php
		option_DD(substr($dat[1],6,2));
?>
          </select>
          日

        </td>
      </tr>
    </table>
    </form>
  </div>
<form name="Delete" method="post" action="bargain.php">
<input name="kill" type="hidden" value="">
</form>
<?php
	if(DEBUG) debug_print($item);
?>
</body>
</html>
