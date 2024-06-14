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

	//--- データ更新
	if($post['syori_kbn'] == "Update"){
		$msg .= "更新<br>\n";

		$idxpath1 = DATPATH."weekly/1.txt";

		$itemnum = $post['itemnum'];
		$index1[0] = $itemnum;

		$txt = preg_split("/\r\n/", trim($post['txt1']));
		$cnt = count($txt);
		//45行目以降は切り捨て
		if($cnt > 45){
			$cnt = 45;
		}
		for($i=0;$i<$cnt;$i++){
			//item変数へテキストを格納
			$index1[$i+5] = $txt[$i];
		}

		//INDEXファイルWrite
		if(!file_write($idxpath1,50,$index1)){
			print("File write error!!( ".$idxpath1." )<BR>\n");
			exit;
		}

		$msg .= "ｔｘｔ書き換え成功しました。<BR>\n";
		//更新日付の更新
		update_day();
	}

	//--- 本文取得
	$msg .= "編集中<br>\n";

	$idxpath1 = DATPATH."weekly/1.txt";

	//INDEXファイルRead
	if(!file_read($idxpath1,50,$index1)){
		print("File read error!!( ".$idxpath1." )<BR>\n");
		exit;
	}

	$datpath1 = DATPATH."guitar/".substr($index1[0],0,1)."/".substr($index1[0],1,4).".txt";

	//データファイルRead
	if(!file_read($datpath1,100,$dat1)){
		print("File read error!!( ".$datpath1." )<BR>\n");
		exit;
	}

	//画像ファイルチェック
	if(file_exists(DATPATH."guitar/".substr($index1[0],0,1)."/".substr($index1[0],1,4)."_small.jpg")){
		$imgpath1 = "<img src=\"".DATPATH2."guitar/".substr($index1[0],0,1)."/".substr($index1[0],1,4)."_small.jpg\" align=\"left\">";
	}else{
		$imgpath1 = "";
	}

	//マルチラインのテキストをtxt変数に格納
	$txt1 = "";
	$ln = 0;
	for($i=5;$i<50;$i++){
		if($index1[$i] != ""){
			$ln = $i;
		}
	}
	if($ln != 0){
		for($i=5;$i<($ln+1);$i++){
			$txt1 .= $index1[$i]."\n";
		}
	}

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
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/JavaScript">
<title>Spot Light</title>
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
function upd_data(type){
	a=confirm("データを更新しホームページに反映します。よろしいですか？");
	if(a == true){
		document.Update<?=$lp?>.syori_kbn.value = type;
		document.Update<?=$lp?>.submit();
	}
}
//-->
</script>
</head>
<BODY background="<?=IMGPATH?>bg_wood.gif" vlink="#CC0000" leftmargin="0" topmargin="10">
<a href="login.php">&lt;&lt; Back</a><br>
<p align="center"><strong><font color="#FF0000" size="2"><a href="<?=BASEPATH?>" target="kakunin">＜ホームページTOPへ＞</a></font></strong></p>
<p> <?=$msg?>
<form name="Update" method="post" enctype="multipart/form-data" action="weekly.php">
  <div align="center">
    <table width="680" border="0" cellspacing="0" cellpadding="3">
      <tr bordercolor="#FFFFFF">
        <td bgcolor="#43888a" width="683" align="left"><strong><font size="2" color="#FFFFFF">Spot Light
          の更新</font></strong><font size="2" color="#FFFFFF">　※この情報を修正します。</font></td>
        <td bgcolor="#43888a" width="43">
          <div align="right"><strong><font size="2" color="#FFFFFF">
            <input type="button" name="Update" value="更新" onClick="upd_data('Update')">
            <input type="hidden" name="no" value="">
            </font></strong></div>
        </td>
      </tr>
    </table>
    <table width="680" border="0" align="center" cellpadding="3" cellspacing="1" bordercolor="#FFFFFF" background="<?=IMGPATH?>bg_sand.gif">
      <tr>
        <td bgcolor="#43888a">
          <div align="center"><strong><font size="2" color="#FFFFFF">商品</font></strong></div>
        </td>
        <td align="left">
    <select name="itemnum">
<?php
	for($type=1;$type<=5;$type++){

		$idxpath = DATPATH."guitar/".$type."/name_index.txt";

		//INDEXファイルRead
		if(!file_read($idxpath,200,$name_index)){
			print("File read error!!( ".$idxpath." )<BR>\n");
			exit;
		}

		sort($name_index);

		$old_day = date('Ymd',time()-5184000)+0;

		for($i=0;$i<200;$i++){
//			$path = DATPATH."guitar/".$type."/".sprintf('%04d',$i).".txt";
			//INDEXファイルの内容が空の場合、なにもしない
			if($name_index[$i] != ""){
				$path = DATPATH."guitar/".$type."/".substr($name_index[$i],125,4).".txt";
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
					if(sprintf('%01d%04d',$type,substr($name_index[$i],125,4)) == $index1[0]){
?>
  <option value="<?=sprintf('%01d%04d',$type,substr($name_index[$i],125,4))?>" selected><?=$item[1]?>　<?=$item[2]?>　<?=$item[13]?>(<?=$item[3]?>) <?=$jyotai?></option>
<?php
					}else{
?>
  <option value="<?=sprintf('%01d%04d',$type,substr($name_index[$i],125,4))?>"><?=$item[1]?>　<?=$item[2]?>　<?=$item[13]?>(<?=$item[3]?>) <?=$jyotai?></option>
<?php
					}
				}
			}
		}
	}
?>
    </select>
        </td>
      </tr>
      <tr>
        <td bgcolor="#43888a">
          <div align="center"><strong><font size="2" color="#FFFFFF">説明文</font></strong></div>
        </td>
        <td align="left">
                <textarea name="txt1" cols="80" rows="20">
<?=$txt1?>
</textarea>
        </td>
      </tr>
    </table>
  </div>
  <input type="hidden" name="syori_kbn" value="">
</form>
<form name="Delete" method="post" action="weekly.php">
<input name="kill" type="hidden" value="">
</form>
<?php
	if(DEBUG) debug_print($item);
?>
</body>
</html>
