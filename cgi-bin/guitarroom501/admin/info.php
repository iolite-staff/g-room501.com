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

	//文字化け対策（エスケープ処理：表示用）
	$post = make_up_bs($_POST,0);
	$get = make_up_bs($_GET,0);
	//POSTされたitemをエスケープ処理
	if(isset($_POST['item'])){
		$post['item'] = make_up_bs($_POST['item'],0);
		$item = $post['item'];
	}
	if(isset($_FILES['file']['tmp_name'])){
		$file = make_up_bs($_FILES['file']['tmp_name'],0);
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
	if($post['syori_kbn'] == "Update"){
		$msg .= "更新<br>\n";
// add maruyama 160622 from
		$no = $post['no'];
// add maruyama 160622 to

		//--- テキスト更新
		//改行コードごとに配列格納
		$txt = preg_split("/[\r\n]/", trim($post['text']));
		$txt = preg_split("<br>", trim($post['text']));
		$cnt = count($txt);
		//95行目以降は切り捨て
		if($cnt > 95){
			$cnt = 95;
		}
		for($i=0;$i<$cnt;$i++){
			//item変数へテキストを格納
			$item[$i+5] = $txt[$i];
		}
		$path = DATPATH."info/".$no.".txt";
		//テキストファイルWrite
		if(!file_write($path,100,$item)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "ｔｘｔ書き換え成功しました。<BR>\n";
		if($item[1] != "left" && $item[1] != "right"){
			//画像削除
			$path = DATPATH."info/".$no.".jpg";
			@unlink($path);
		}elseif($file <> ""){
			//画像アップロード
			$path = DATPATH."info/".$no.".jpg";
			copy($file, $path);
			$msg .= $file."=> /".$path." 書き換え成功しました。<BR>\n";
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
		$nulldata[3] = "checked";
		$path = DATPATH."info/".$no.".txt";
		//テキストファイルWrite
		if(!file_write($path,100,$nulldata)){
			print("File write error!!( /".$path." )<BR>\n");
			exit;
		}
		$msg .= "ｔｘｔ削除成功しました。<BR>\n";
		//画像削除
		$path = DATPATH."info/".$no.".jpg";
		@unlink($path);
		$msg .= $no." 削除成功しました。<BR>\n";
		//更新日付の更新
		update_day();
	}

	//----- up button
	if($post['syori_kbn'] == "Up"){
		//一番上のデータの場合、UP処理は行わない
		if($no != 0){
			//交換先NO作成
			$tno = $no - 1;
			$msg .= "Up No.".$no." -> ".$tno."<br>";

			//テキスト交換
			$path = DATPATH."info/".$no.".txt";
			$tpath = DATPATH."info/".$tno.".txt";
			$tmp = DATPATH."info/tmp.txt";
			copy($path,$tmp);
			copy($tpath,$path);
			copy($tmp,$tpath);
			unlink($tmp);

			//画像交換
			$path = DATPATH."info/".$no.".jpg";
			$tpath = DATPATH."info/".$tno.".jpg";
			$tmp = DATPATH."info/tmp.jpg";
			$tmp2 = DATPATH."info/tmp2.jpg";
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
		if($no != 6){
			//交換先NO作成
			$tno = $no + 1;
			$msg .= "Down No.".$no." -> ".$tno."<br>";;

			//テキスト交換
			$path = DATPATH."info/".$no.".txt";
			$tpath = DATPATH."info/".$tno.".txt";
			$tmp = DATPATH."info/tmp.txt";
			copy($path,$tmp);
			copy($tpath,$path);
			copy($tmp,$tpath);
			unlink($tmp);

			//画像交換
			$path = DATPATH."info/".$no.".jpg";
			$tpath = DATPATH."info/".$tno.".jpg";
			$tmp = DATPATH."info/tmp.jpg";
			$tmp2 = DATPATH."info/tmp2.jpg";
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

	//--- 本文取得
	$msg .= "編集中<br>\n";
	unset($item);
	for($i=0;$i<7;$i++){
		$path = DATPATH."info/".$i.".txt";
		//テキストファイルの存在チェック
		if(file_exists($path)){
			//テキストファイルRead
			if(!file_read($path,100,$dat)){
				print("File read error!!( /".$path." )<BR>\n");
				exit;
			}
			//item変数に読んだデータを格納
			$item[0][$i] = $dat[0];
			$item[1][$i] = $dat[1];
			$item[2][$i] = $dat[2];
			$item[3][$i] = $dat[3];
			//マルチラインのテキストをtxt変数に格納
			$txt[$i] = "";
			$ln = 1;
			for($j = 5; $j < 100; $j++){
				if($dat[$j] != ""){
					$ln = $j + 1;
				}
			}
			if($ln != 1){
				for($k = 5; $k < $ln; $k++){
					$txt[$i] .= $dat[$k]."\n";
				}
			}
			//画像ファイルRead
			$path = DATPATH."info/".$i.".jpg";
			if(file_exists($path)){
				$img[$i] = DATPATH2."info/".$i.".jpg";
			}else{
				$img[$i] = IMGPATH."clear.gif";
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
<title>Infomation</title>
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
//-->
</script>
</head>
<BODY background="<?=IMGPATH?>bg_wood.gif" vlink="#CC0000" leftmargin="0" topmargin="10">
<a href="login.php">&lt;&lt; Back</a><br>
<p align="center"><strong><font color="#FF0000" size="2"><a href="<?=BASEPATH?>" target="kakunin">＜ホームページTOPへ＞</a></font></strong></p>
<p align="center"><font color="#FF0000" size="2"><a href="info.php?type=<?=$type?>&reload">並び替えをした後はここをクリックしてから「F5」キーを押してください。</a></font></p>
<p> <?=$msg?>
<?php
	//詳細データ表示
	for($lp=0;$lp<7;$lp++){
?>
<script type="text/javascript">
<!--
//更新確認後、SUBMITを行う
function upd_data<?=$lp?>(type){
	a=confirm("データを更新しホームページに反映します。よろしいですか？");
	if(a == true){
		document.Update<?=$lp?>.syori_kbn.value = type;
		document.Update<?=$lp?>.submit();
	}
}
//-->
</script>
<form name="Update<?=$lp?>" method="post" enctype="multipart/form-data" action="info.php">
  <div align="center">
    <table width="680" border="0" cellspacing="0" cellpadding="3">
      <tr bordercolor="#FFFFFF" bgcolor="#000000">
        <td width="683" align="left"><strong><font size="2" color="#FFFFFF">Infomation No.<?=$lp?> の削除</font></strong><font size="2" color="#FFFFFF">　※削除した情報は元には戻せません。</font></td>
        <td width="43">
          <div align="right"><strong><font size="2" color="#FFFFFF">
            <input type="button" name="Delete" value="削除" onClick="kill_data('<?=$lp?>')">
            </font></strong></div>
        </td>
      </tr>
      <tr bordercolor="#FFFFFF">
        <td bgcolor="#43888a" width="683" align="left"><strong><font size="2" color="#FFFFFF">Infomation No.<?=$lp?>
          の更新</font></strong><font size="2" color="#FFFFFF">　※この情報を修正します。</font></td>
        <td bgcolor="#43888a" width="43">
          <div align="right"><strong><font size="2" color="#FFFFFF">
            <input type="button" name="Update" value="更新" onClick="upd_data<?=$lp?>('Update')">
            <input type="hidden" name="no" value="<?=$lp?>">
            </font></strong></div>
        </td>
      </tr>
      <tr>
        <td rowspan="3" width="683" background="<?=IMGPATH?>bg_sand.gif">
          <table width="680" border="0" align="center" cellpadding="3" cellspacing="1" bordercolor="#FFFFFF">
            <tr>
              <td valign="top" width="219" align="left"><font size="2">
                タイトル（太字）：<input type="text" name="item[0]" size="30" maxlength="64" value="<?=$item[0][$lp]?>">
                </font></td>
              <td valign="top" width="416" align="left" rowspan="2"><font size="2">
本文（細字）：
                <textarea name="text" cols="57" rows="20">
<?=$txt[$lp]?>
</textarea>
                <br>
                ※最大 95 行</font></td>
            </tr>
            <tr>
              <td valign="top" align="left"><font size="2">
<?php
		print("          <input type=\"checkbox\" name=\"item[3]\" value=\"checked\" ".$item[3][$lp]."><strong>非表示</strong><br><br>\n");
		print("          <input type=\"checkbox\" name=\"item[2]\" value=\"checked\" ".$item[2][$lp]."><font color=\"#FF0000\"><i>New!</i></font><br><br>\n");

		if($item[1][$lp] <> "left" && $item[1][$lp] <> "right"){
			print("          <input type=\"radio\" name=\"item[1]\" value=\"\" checked>画像なし<br>\n");
		}else{
			print("          <input type=\"radio\" name=\"item[1]\" value=\"\">画像なし<br>\n");
		}
		if($item[1][$lp] == "left"){
			print("          <input type=\"radio\" name=\"item[1]\" value=\"left\" checked>画像の位置【左】<br>\n");
		}else{
			print("          <input type=\"radio\" name=\"item[1]\" value=\"left\">画像の位置【左】<br>\n");
		}
		if($item[1][$lp] == "right"){
			print("          <input type=\"radio\" name=\"item[1]\" value=\"right\" checked>画像の位置【右】<br>\n");
		}else{
			print("          <input type=\"radio\" name=\"item[1]\" value=\"right\">画像の位置【右】<br>\n");
		}
?>
                <input type="file" name="file" size="30" maxlength="255"><br>
                <br>
                <font size="2">※サイズは任意ですので、<br>　適度に縮小して下さい。<br>
                　Jpeg形式(*.jpg *.jpeg)<br>
                <img src="<?=$img[$lp]?>">
                </font></td>
            </tr>
          </table>
        </td>
        <td bgcolor="#666666" valign="top" width="43">
          <div align="center">
            <p>　</p>
            <input name="Up" type="button" value="▲" onClick="upd_data<?=$lp?>('Up')">
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
            <input name="Down" type="button" value="▼" onClick="upd_data<?=$lp?>('Down')">
            <p>　</p>
          </div>
        </td>
      </tr>
    </table>
  </div>
  <input type="hidden" name="syori_kbn" value="">
</form>
<br>
<hr>
<br>
<?php
	}
?>
<form name="Delete" method="post" action="info.php?type=<?=$type?>">
<input name="kill" type="hidden" value="">
</form>
<?php
	if(DEBUG) debug_print($item);
?>
</body>
</html>
