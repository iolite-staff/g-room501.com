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
	. sprintf('%02d',$post['dat0dd'])
	. sprintf('%02d',$post['dat0hh'])
	. sprintf('%02d',$post['dat0mi'])
	;

	//GETのNOを格納
	if(isset($post['no'])){
		$no =$get['no'];
	}
	//POSTのNOを格納
	if(isset($post['no'])){
		$no = $post['no'];
	}

	//--- ファイルの削除
	if(isset($post['kill'])){
		$no = $post['kill'];
		//--- 実データ削除
		$path = DATPATH."makers/".$_GET['maker']."/coming/".$no.".txt";
		unlink($path);
		$msg .= "＃".$no." 削除成功しました。<br>";
	}
	
	//--- ファイルの更新
	if(isset($post['dat0yy'])){
		//新しいNoを採番
		if($no == ""){
			$no = $dat[0];
		}elseif($no != $dat[0]){
			//キー項目の変更の場合はNoも更新
			$old_no = $no;
			$no = $dat[0];
			//旧Noのファイルを削除
			unlink(DATPATH."makers/".$_GET['maker']."/coming/".$old_no.".txt");
		}
		//--- Coming Soonファイル更新
		$path =DATPATH."makers/".$_GET['maker']."/coming/".$no.".txt";
		//Coming SoonファイルWrite
		if(!file_write($path,5,$dat)){
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
<title>StockList</title>
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
<p align="center"><strong><font color="#FF0000" size="2"><a href="makers<?=$get['maker']?>.php?maker=<?=$get['maker']?>">＜FurchGuitar編集へ＞</a></font></strong></p>
<p align="center"><strong><font color="#FF0000" size="2">＜StockList編集中＞</font></strong></p>
<form name="no_sel" method="post" action="<?=$_SERVER['PHP_SELF']?>?maker=<?=$get['maker']?>">
  <div align="center">
    <select name="no">
<?php

	//--- comingフォルダ内の全てのテキストファイルを取得する
	$ins = TRUE;
	$fp=0;
	$path = DATPATH."makers/".$_GET['maker']."/coming";
	if($dir = @dir($path)){
		//フォルダ内の全ファイル取得
		while($file_nm = $dir->read()){
			if($file_nm == ""){
				break;
			}elseif($file_nm != "." && $file_nm != ".."){
				$index[$fp] = substr($file_nm, 0, strlen($file_nm)-4);
				//Indexにnoがあれば更新モードにする
				if($no != ""
				&& $no == $index[$fp]
				){
					$ins = FALSE;
				}
				$fp++;
			}
		}
		$dir->close();
	}

	$max_fp = $fp;

	//--- 逆順に並び替える
	rsort($index);
?>
      <option value="">※　新規</option>
<?php
	//--- DatファイルRead
	for($fp=0;$fp<$max_fp;$fp++){
		//Indexか空でなければDatファイルRead
		if($index[$fp] != ""){
			$datpath = DATPATH."makers/".$_GET['maker']."/coming/".$index[$fp].".txt";
			//Datファイル存在チェック
			if(file_exists($datpath)){
				//--- 20件以上古いデータは削除する
				if($fp >= 20){
					unlink($datpath);
				}else{
					//DatファイルRead
					if(!file_read($datpath,100,$dat)){
						print("File read error!!( /".$datpath." )<BR>\n");
						exit;
					}
					//更新日作成
					$dat0yy = substr($dat[0],0,4);
					$dat0mm = substr($dat[0],4,2);
					$dat0dd = substr($dat[0],6,2);
					$dat0hh = substr($dat[0],8,2);
					$dat0mi = substr($dat[0],10,2);
					$dat0ymd = "更新日:".$dat0yy."/".$dat0mm."/".$dat0dd." ".$dat0hh.":".$dat0mi;
					//選択済みのチェック
					if($index[$fp] == $no){
?>
      <option value="<?=$index[$fp]?>" selected><?=$dat0ymd?> <?=$dat[1]?> <?=$dat[2]?></option>
<?php
					}else{
?>
      <option value="<?=$index[$fp]?>"><?=$dat0ymd?> <?=$dat[1]?> <?=$dat[2]?></option>
<?php
					}
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
		$path = DATPATH."makers/".$_GET['maker']."/coming/".$no.".txt";
		//テキストファイル存在チェック
		if(file_exists($path)){
			//テキストファイルRead
			if(!file_read($path,5,$dat)){
				print("File read error!!( /".$path." )<BR>\n");
				exit;
			}
		}else{
			//新規の場合更新日を現在日付にセット
			$dat = "";
			$dat[0] = date('YmdHi');
			$text = "";
		}
?>
<p> 編集中<BR>
<?=$msg?>
  <div align="center">
    <form name="Update" method="post" action="<?=$_SERVER['PHP_SELF']?>?maker=<?=$get['maker']?>&no=<?=$no?>">
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
    <table width="680" border="0" align="center" cellpadding="2" cellspacing="1" bordercolor="#FFFFFF" background="<?=IMGPATH?>bg_sand.gif">
      <tr>
        <td width="90" bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font color="#FFFFFF" size="2">更新日</font></strong></div>
        </td>
        <td width="570" align="left">
          <select name="dat0yy">
<?php
		option_YY(substr($dat[0],0,4),5,0);
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
          <select name="dat0hh">
<?php
		option_HH(substr($dat[0],8,2));
?>
          </select>
          時
          <select name="dat0mi">
<?php
		option_MI(substr($dat[0],10,2));
?>
          </select>
          分
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">モデル名</font></strong></div>
        </td>
        <td align="left">
<input type="text" name="dat[2]" size="45" maxlength="30" value="<?=$dat[2]?>">
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">状態</font></strong></div>
        </td>
        <td align="left">
<input type="radio" name="dat[3]" value="S" checked><font color="#CC0000"><B>Sold</B></font>
<input type="radio" name="dat[3]" value="H" <?=$dat[3]=="H"?" checked":""?>><font color="#336633"><B>Hold</B></font>
<input type="radio" name="dat[3]" value="A" <?=$dat[3]=="A"?" checked":""?>><font color="#3333CC"><B>Abailable</B></font>
        </td>
      </tr>
      <tr>
        <td bgcolor="<?=$bgcolor?>">
          <div align="center"><strong><font size="2" color="#FFFFFF">非表示</font></strong></div>
        </td>
        <td align="left">
<input type="checkbox" name="dat[4]"  value="checked" <?=$dat[4]?>>
        </td>
      </tr>
    </table>
    </form>
  </div>
<form name="Delete" method="post" action="<?=$_SERVER['PHP_SELF']?>?maker=<?=$get['maker']?>">
<input name="kill" type="hidden" value="">
</form>
<?php
	}
	if(DEBUG) debug_print($item);
?>
</body>
</html>
