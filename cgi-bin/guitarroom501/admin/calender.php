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

	//更新日の格納
	$dat[0] = sprintf('%04d',$post['dat0yy'])
	. sprintf('%02d',$post['dat0mm'])
	. sprintf('%02d',$post['dat0dd']);

	//GETのNOを格納
	if(isset($get['no'])){
		$no = $get['no'];
	}
	//POSTのNOを格納
	if(isset($post['no'])){
		$no = $post['no'];
	}

	//--- ファイルの削除
	if(isset($post['kill'])){
		$no = $post['kill'];
		//--- 実データ削除
		$path = DATPATH."calender/".$no.".txt";
		unlink($path);
		$msg .= "＃".$no." 削除成功しました。<br>";
		//更新日付の更新
		update_day();
	}

	//--- ファイルの更新
	if(isset($post['dat0yy'])){
		if($no == ""){
			//新しいNoを採番
			$no = $dat[0];
		}elseif($no != $dat[0]){
			//キー項目の変更の場合はNoも更新
			$old_no = $no;
			$no = $dat[0];
			//旧Noのファイルを削除
			unlink(DATPATH."calender/".$old_no.".txt");
		}
		//--- カレンダーファイル更新
		$path = DATPATH."calender/".$no.".txt";
		//カレンダーファイルWrite
		if(!file_write($path,2,$dat)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "＃".$no." ｔｘｔ書き換え成功しました。<BR>\n";
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
<title>カレンダー</title>
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
<form name="no_sel" method="get" action="calender.php">
  <div align="center">
    <select name="no">
<?php
	$ins = true;
	//新規作成かチェック
	$path = DATPATH."calender/";
	if($dir = @dir($path)){
		while($dat = $dir->read()){
			if($dat == ""){
				break;
			}elseif(preg_match("/[0-9]{8}.txt$/", $dat)){
				//Indexにnoがあれば更新モードにする
				if($no != ""
				&& $no == substr($dat,0,8)
				){
					$ins = false;
				}
			}
		}
	}
?>
      <option value="">※　新規</option>
<?php
	//--- DatファイルRead
	$path = DATPATH."calender/";
	if($dir = @dir($path)){
		while($dat = $dir->read()){
			$find = false;
			if($dat == ""){
				break;
			}elseif(preg_match("/[0-9]{8}.txt$/", $dat)){
				//キーワードが指定されているときはキーワードを含む項目のみを表示
				if(!file_read(DATPATH."calender/".$dat,2,$cal)){
					print("File read error!!( ".DATPATH."calender/".$dat." )<BR>\n");
					exit;
				}
				//対象日作成
				$dat0yy = substr($cal[0],0,4);
				$dat0mm = substr($cal[0],4,2);
				$dat0dd = substr($cal[0],6,2);
				$dat0ymd = "対象日:".$dat0yy."/".$dat0mm."/".$dat0dd;
				if($cal[1] == "N"){
					$dat1 = "通常営業";
				}elseif($cal[1] == "H"){
					$dat1 = "休日";
				}
				//選択済みのチェック
				if($cal[0] == $no){
?>
      <option value="<?=substr($dat,0,8)?>" selected>＃<?=substr($dat,0,8)?> <?=$dat0ymd?>：<?=$dat1?></option>
<?php
				}else{
?>
      <option value="<?=substr($dat,0,8)?>">＃<?=substr($dat,0,8)?> <?=$dat0ymd?>：<?=$dat1?></option>
<?php
				}
			}
		}
	}
?>
    </select>
    <input name="no_sel" type="submit" value="選択">
  </div>
</form>
<hr>
<?php
	if(isset($no)){
		//新規作成・更新
		if($ins){
			//新規作成モードなら背景色を青へ
			$bgcolor = "#003366";
		}else{
			//更新モードなら背景色を緑へ
			$bgcolor = "#43888a";
		}

		//--- テキストファイルRead
		$path = DATPATH."calender/".$no.".txt";
		//テキストファイル存在チェック
		if(file_exists($path)){
			//テキストファイルRead
			if(!file_read($path,100,$dat)){
				print("File read error!!( /".$path." )<BR>\n");
				exit;
			}
		}else{
			//新規の場合更新日を現在日付にセット
			$dat = "";
			$dat[0] = date('Ymd');
		}
?>
<p> 編集中<BR>
<?=$msg?>
  <div align="center">
    <form name="Update" method="post" action="calender.php?no=<?=$no?>">
    <table width="680" border="0" cellspacing="0" cellpadding="3">
<?php
		if(!$ins){
			//更新モードの場合、削除バーと更新バーを表示
?>
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
<?php
		}else{
			//新規モードの場合は新規バーを表示
?>
      <tr bordercolor="#FFFFFF" bgcolor="<?=$bgcolor?>">
        <td width="615" align="left"><strong><font size="2" color="#FFFFFF">新規登録</font></strong><font size="2" color="#FFFFFF">　※この情報を新規に登録します。</font></td>
        <td width="53">
          <div align="right"><strong><font size="2" color="#FFFFFF">
            <input type="button" name="Update" value="登録" onClick="upd_data()">
            </font></strong></div>
        </td>
      </tr>
<?php
		}
?>
    </table>
    <br>
    <table width="680" border="0" align="center" cellpadding="2" cellspacing="1" background="<?=IMGPATH?>bg_sand.gif">
      <tr>
        <td width="90" bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font color="#FFFFFF" size="2">対象日</font></strong></div>
        </td>
        <td width="570" align="left">
          <select name="dat0yy">
<?php
		option_YY(substr($dat[0],0,4),1,1);
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
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">営業区分</font></strong></div>
        </td>
        <td align="left">
    <select name="dat[1]">
      <option value="N" <?php if($dat[1] == "N"){print("selected");}?>>通常営業</option>
      <option value="H" <?php if($dat[1] == "H"){print("selected");}?>>休日</option>
    </select>
        </td>
      </tr>
    </table>
    </form>
  </div>
<form name="Delete" method="post" action="calender.php">
<input name="kill" type="hidden" value="">
</form>
<?php
	}
	if(DEBUG) debug_print($item);
?>
</body>
</html>
