<?php
//****-----------------------------------------------------------****//
//	関数名：make_err
//	引　数：
//		str err_title ： エラーのタイトル
//		str err_main ： エラー本文
//	戻り値：
//		str エラーメッセージ
//	説　明：
//		エラーメッセージを生成する
//	作成日：2003/12/19
//	更新日：
//	作成者：H.Yamamura
//	備　考：
//****-----------------------------------------------------------****//
function make_err($err_title,$err_main){
	return "<tr><td nowrap><font size=\"2\" color=\"#ff0000\"><strong>".$err_title."</strong>：</font></td><td><font size=\"2\" color=\"#ff0000\">".$err_main."</font></td></tr>\n";
}
//****-----------------------------------------------------------****//
//	関数名：disp_err
//	引　数：
//		str エラーメッセージ
//	戻り値：
//	説　明：
//		エラーメッセージを画面に出力する
//	作成日：2003/12/19
//	更新日：
//	作成者：H.Yamamura
//	備　考：
//****-----------------------------------------------------------****//
function disp_err($err_msg){
	if($err_msg){
		print("<br><TABLE border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n");
	}
	print($err_msg);
	if($err_msg){
		print("</TABLE>\n");
	}
}
//****-----------------------------------------------------------****//
//	関数名：make_up_bs
//	引　数：
//		item 連想配列
//		type int 0:表示用 1:ファイル用 2:表示用に変換済み→ファイル用へ
//	戻り値：
//		item 連想配列
//	説　明：
//		引数txtに含まれる２バイト文字の下位バイトがバックスラッシュ(\)の場合に、
//		バックスラッシュ(\)を補記してSQL発行時の文字化けを防止する。
//		（この問題はShift-JIS・JISの場合のみ発生します）
//		参考：２バイト文字の下位バイトがバックスラッシュ(\)の文字
//				―ソЫ噂浬欺圭構蚕十申曾箪貼能表暴予
//				禄兔喀媾彌拿杤歃濬畚秉綵臀藹觸軆鐔饅鷭
//	作成日：2003/12/19
//	更新日：
//	作成者：H.Yamamura
//	備　考：
//****-----------------------------------------------------------****//
function make_up_bs($item,$type){

	switch($type){
		case 0:			//POST・GET　→　表示
			if(is_array($item)){
				foreach($item as $key => $value){
					$item[$key] = preg_replace("/\\\\'/","'",$item[$key]);
					$item[$key] = preg_replace("/\\\\\"/","\"",$item[$key]);
					$item[$key] = preg_replace("/\\\\\\\\/","\\",$item[$key]);
				}
			}
			break;
		case 1:			//POST・GET　→　SQL
			if(is_array($item)){
				foreach($item as $key => $value){
					$item[$key] = preg_replace("/\\\\'/","'",$item[$key]);
					$item[$key] = preg_replace("/\\\\\"/","\"",$item[$key]);
					$item[$key] = preg_replace("/\\\\\\\\/","\\",$item[$key]);
				}
			}
			break;
		case 2:			//表示　→　SQL
			if(is_array($item)){
				foreach($item as $key => $value){
					$item[$key] = preg_replace("/\\\\/","\\\\",$item[$key]);
				}
			}
			break;
	}

	return $item;
}
//****-----------------------------------------------------------****//
//	関数名：debug_print
//	引　数：[item（連想配列）]
//	戻り値：
//	説　明：
//		デバッグ用に内部変数等を画面に出力する
//	作成日：2003/12/19
//	更新日：
//	作成者：H.Yamamura
//	備　考：
//		使用例）
//			//定数DEBUGがTrueなら（デバッグモード時）出力
//			if(DEBUG) debug_print();
//****-----------------------------------------------------------****//
function debug_print($item = ""){
	print("<font color=\"red\"><strong>デバッグ情報(Debug info)</strong> (Version:".VER.")</font>");
	print("<pre>");
	print('<font color="red">$_POST:</font>');
	print_r($_POST);
	print("\n");
	print('<font color="red">$_GET:</font>');
	print_r($_GET);
	print("\n");
	print('<font color="red">$_GLOBAL:</font>');
	print_r($_GLOBAL);
	print("\n");
	print('<font color="red">$_FILE:</font>');
	print_r($_FILE);
	print("\n");
	print('<font color="red">$_SESSION:</font>');
	print_r($_SESSION);
	print("\n");
	if($item != ""){
		print('<font color="red">$item:</font>');
		print_r($item);
		print("\n");
	}
	print("</pre>");

}
//****-----------------------------------------------------------****//
//	関数名：fig_form
//	引　数：
//		int fig_val（数値）
//	戻り値：
//		str 整形済み数値
//	説　明：
//		数値整形（カンマ）
//	作成日：2003/12/19
//	更新日：
//	作成者：H.Yamamura
//	備　考：小数点未満は切り捨て
//****-----------------------------------------------------------****//
function fig_form($fig_val){
	return number_format(floor($fig_val));
}
//****-----------------------------------------------------------****//
//	関数名：option_YY
//	引　数：
//		int Default（デフォルトで選択される年）
//		int Before（表示する過去の年数）
//		int After（表示する未来の年数）
//	戻り値：
//	説　明：
//		<option value="（Before～After）">（Before～After）</option>を画面に出力する。
//		表示する年がDefaultと同じ場合は<option selected>と表示する。
//	作成日：2003/08/27
//	更新日：
//	作成者：H.Yamamura
//	備　考：
//		例
//			option_YY(2004, 2, 3);
//		結果（サーバー日付が2003年の場合）
//			<option value="2001">2001</option> ←サーバー日付の2年前
//			<option value="2002">2002</option>
//			<option value="2003">2003</option> ←サーバー日付
//			<option value="2004" selected>2004</option> ←デフォルトで設定した年
//			<option value="2005">2005</option>
//			<option value="2006">2006</option> ←サーバー日付の3年後
//****-----------------------------------------------------------****//
function option_YY($Default, $Before, $After){
$NowYY = date('Y', time());

	for($i = ($NowYY - $Before); $i <= ($NowYY + $After); $i++){
		print("<option value=\"$i\"" . ($i == $Default ? " selected" : "") . ">");
		print($i);
		print("</option>\n");
	}
}
//****-----------------------------------------------------------****//
//	関数名：option_MM
//	引　数：
//		int Default（デフォルトで選択される月）
//	戻り値：
//	説　明：
//		<option value="（１～１２）">（１～１２）</option>を画面に出力する。
//		表示する月がDefaultと同じ場合は<option selected>と表示する。
//	作成日：2003/08/27
//	更新日：
//	作成者：H.Yamamura
//	備　考：
//****-----------------------------------------------------------****//
function option_MM($Default){

	for($i = 1; $i <= 12; $i++){
		print("<option value=\"$i\"" . ($i == $Default ? " selected" : "") . ">");
		print($i);
		print("</option>\n");
	}
}
//****-----------------------------------------------------------****//
//	関数名：option_DD
//	引　数：
//		int Default（デフォルトで選択される日）
//	戻り値：
//	説　明：
//		<option value="（１～３１）">（１～３１）</option>を画面に出力する。
//		表示する日がDefaultと同じ場合は<option selected>と表示する。
//	作成日：2003/08/27
//	更新日：
//	作成者：H.Yamamura
//	備　考：
//****-----------------------------------------------------------****//
function option_DD($Default){

	for($i = 1; $i <= 31; $i++){
		print("<option value=\"$i\"" . ($i == $Default ? " selected" : "") . ">");
		print($i);
		print("</option>\n");
	}
}
//****-----------------------------------------------------------****//
//	関数名：option_HH
//	引　数：
//		int Default（デフォルトで選択される時間）
//		[int Before（表示する開始時間）]
//		[int After（表示する終了時間）]
//	戻り値：
//	説　明：
//		<option value="（０～２３）">（０～２３）</option>を画面に出力する。
//		表示する時間がDefaultと同じ場合は<option selected>と表示する。
//	作成日：2004/04/10
//	更新日：
//	作成者：H.Yamamura
//	備　考：
//****-----------------------------------------------------------****//
function option_HH($Default, $Before = 0, $After = 23){

	for($i = $Before; $i <= $After; $i++){
		print("<option value=\"$i\"" . ($i == $Default ? " selected" : "") . ">");
		print($i);
		print("</option>\n");
	}
}
//****-----------------------------------------------------------****//
//	関数名：option_MI
//	引　数：
//		int Default（デフォルトで選択される分）
//		[int Step（増分）]
//	戻り値：
//	説　明：
//		<option value="（００～５５）">（００～５５）</option>を画面に出力する。
//		表示する分がDefaultと近似値の場合は<option selected>と表示する。
//	作成日：2004/04/10
//	更新日：
//	作成者：H.Yamamura
//	備　考：5分刻み
//****-----------------------------------------------------------****//
function option_MI($Default,$Step = 5){

	for($i = 0; $i <= 55; $i+=$Step){
		print("<option value=\"".sprintf('%02d',$i)."\"" . (sprintf('%02d',$i) <= $Default && sprintf('%02d',$i+$Step) > $Default ? " selected" : "") . ">");
		print(sprintf('%02d',$i));
		print("</option>\n");
	}
}
//****-----------------------------------------------------------****//
//	関数名：get_crypt
//	引　数：str UData 暗号元文字列
//	戻り値：str 暗号化した文字列
//	説　明：
//		cryptのラッパー関数
//		salt文字列をランダムで生成する
//		cryptの結果から / 及び . を削除して返す
//	作成日：2004/03/05
//	更新日：
//	作成者：H.Yamamura
//	備　考：
//****-----------------------------------------------------------****//
function get_crypt($UData){
	//乱数テーブルの初期化
	srand();
	//Salt文字列用文字テーブル
	$xx = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$xx .= "abcdefghijklmnopqrstuvwxyz";
	$xx .= "0123456789";
	//Salt文字列生成
	$salt = substr($xx, floor(rand(0,61)), 1);
	$salt .= substr($xx, floor(rand(0,61)), 1);

	//暗号元文字列からSalt文字列を用いてDES暗号化
	$tmpCrypted = crypt($UData,$salt);
	//cryptの結果から / 及び . を削除する
	$tmpCrypted = ereg_replace("/", "", $tmpCrypted);
	$tmpCrypted = ereg_replace("\.", "", $tmpCrypted);

	return $tmpCrypted;
}
//****-----------------------------------------------------------****//
//	関数名：chk_crypt
//	引　数：str UData 暗号元文字列
//			str Crypted 暗号化した文字列
//	戻り値：bool true(一致) / false(不一致)
//	説　明：
//		cryptのラッパー関数
//		cryptの結果から / 及び . を削除して暗号化文字列が等しいかチェックする
//	作成日：2004/03/05
//	更新日：
//	作成者：H.Yamamura
//	備　考：
//****-----------------------------------------------------------****//
function chk_crypt($UData,$Crypted){
	//Salt文字列取得
	$salt = substr($Crypted,0,2);

	//暗号元文字列からSalt文字列を用いてDES暗号化
	$tmpCrypted = crypt($UData,$salt);
	//cryptの結果から / 及び . を削除する
	$tmpCrypted = ereg_replace("/", "", $tmpCrypted);
	$tmpCrypted = ereg_replace("\.", "", $tmpCrypted);

	//比較する
	if($Crypted == $tmpCrypted){
		return TRUE;
	}else{
		return FALSE;
	}
}
//****-----------------------------------------------------------****//
//	関数名：download_file
//	引　数：
//		str path_file ： ダウンロードするファイルのパス
//		str mime ： MIMEタイプ
//		bool binary ： True（バイナリ）　False（テキスト）
//	戻り値：
//	説　明：
//		ファイルをダウンロードする
//	作成日：2004/01/13
//	更新日：
//	作成者：H.Yamamura
//	備　考：
//****-----------------------------------------------------------****//
function download_file($path_file,$mime,$binary){
	//ファイルの存在確認
	if (!file_exists($path_file)) {
		print("ダウンロードするファイルが見つかりません。\n");
		exit;
	}

	//オープンできるか確認
	if (!($fp = fopen($path_file, "r"))) {
		print("ダウンロードするファイルは現在使用中です。\n");
		exit;
	}
	fclose($fp);

	//ファイルサイズの確認
	if (($content_length = filesize($path_file)) == 0) {
		print("ダウンロードするファイルは空です。\n");
		exit;
	}

	//ダウンロード用のHTTPヘッダ送信
	header("Content-Disposition: inline; filename=\"".basename($path_file)."\"");
	header("Content-Length: ".$content_length);
	if($binary){
		header ("Content-Transfer-Encoding: binary");
	}
	header("Content-Type: ".$mime);

	//ファイルを読んで出力
	if (!readfile($path_file)) {
		print("ファイルのダウンロードに失敗しました。\n");
		exit;
	}
}
//****-----------------------------------------------------------****//
//	関数名：kingaku
//	引　数：
//		int fig_val（税抜金額）
//		int type(表示タイプ)　0:税抜(税込) 1:税抜\n(税込)
//	戻り値：
//		str 整形済み金額
//	説　明：
//		金額整形（円記号、カンマ、税込み等）
//	作成日：2004/06/09
//	更新日：
//	作成者：H.Yamamura
//	備　考：小数点未満は切り捨て、
//****-----------------------------------------------------------****//
function kingaku($fig_val,$type,$type2=""){

	//消費税率
	$tax_ritu = 0.1;

	//消費税額
	$tax = floor((int)$fig_val * $tax_ritu);

	//税込み金額（整形済み）
	$komi = "&yen;".number_format(floor((int)$fig_val + $tax));

	//税抜き金額（整形済み）
	$nuki = "&yen;".number_format(floor($fig_val));
	
	if($type2 == "Y"){
		$tax2 = "税込";
	}else{
		$tax2 = "";
	}

	switch($type){
		case 0:
			return $nuki." (".$tax2.$komi.")";
			break;
		case 1:
			return $nuki." (".$tax2.$komi.")";
			break;
		case 2:
			return $nuki." <small>(".$tax2.$komi.")</small>";
			break;
		case 3:
			return $komi." <small>(".$tax2.")</small>";
	}

	return $fig_val;
}
//****-----------------------------------------------------------****//
//	関数名：link_url
//	引　数：
//	戻り値：
//	説　明：配列からリンクを拾って<a>タグを付ける
//	作成日：2005.07.08
//	更新日：
//	作成者：S.Sato
//****-----------------------------------------------------------****//
function link_url($dat){
	mb_eregi("http[0-9a-z\.\/\#_:?=&-]{1,}",$dat,$link);
	$alink = "<a href=\"".$link[0]."\" target=_blank>".$link[0]."</a>";
	$dat = str_replace($link[0],$alink,$dat);
	return $dat;
}
//****-----------------------------------------------------------****//
//	関数名：link_mail
//	引　数：
//	戻り値：
//	説　明：配列からメールリンクを拾って<a>タグを付ける
//	作成日：2005.07.08
//	更新日：
//	作成者：S.Sato
//****-----------------------------------------------------------****//
function link_mail($dat){
	mb_ereg("[0-9a-z\._\-]{1,}@[0-9a-z\._\-]{1,}[.]{1}[0-9a-z\._\-]{1,}",$dat,$mail);
	$amail = "<a href=mailto:\"".$mail[0]."\">".$mail[0]."</a>";
	$dat = str_replace($mail[0],$amail,$dat);
	return $dat;
}
//****-----------------------------------------------------------****//
//	関数名：kingaku
//	引　数：
//		int fig_val（税抜金額）
//		int type(表示タイプ)　0:税抜(税込) 1:税抜\n(税込)
//	戻り値：
//		str 整形済み金額
//	説　明：
//		金額整形（円記号、カンマ、税込み等）
//	作成日：2004/06/09
//	更新日：
//	作成者：H.Yamamura
//	備　考：小数点未満は切り捨て、
//****-----------------------------------------------------------****//
function disp_menu(){
?>
<a href="<?=BASEPATH?>index.htm"><img src="<?=IMGPATH?>top.gif" alt="Guitar room 501トップ" width="64" height="64" border="0"></a>
<a href="<?=BASEPATH?>stocklist/stocklist.htm"><img src="<?=IMGPATH?>stocklist.gif" alt="在庫情報" width="64" height="64" border="0"></a>
<!--<a href="<?=BASEPATH?>makers/stocklist.htm"><img src="<?=IMGPATH?>makers.gif" alt="在庫情報" width="64" height="64" border="0"></a>-->
<a href="<?=BASEPATH?>shopguide/shopguide.htm"><img src="<?=IMGPATH?>shopguide.gif" alt="店舗情報" width="64" height="64" border="0"></a>
<a href="<?=BASEPATH?>howto/howto.htm"><img src="<?=IMGPATH?>howto.gif" alt="注文方法" width="64" height="64" border="0"></a>
<a href="<?=BASEPATH?>others/others.htm"><img src="<?=IMGPATH?>cdandothers.gif" alt="CDとその他の商品" width="64" height="64" border="0"></a>
<a href="<?=BASEPATH?>link/link.htm"><img src="<?=IMGPATH?>links.gif" alt="リンク" width="64" height="64" border="0"></a>
<?
}
?>
