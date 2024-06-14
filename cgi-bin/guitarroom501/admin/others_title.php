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

	$no = $post['no'];

	//----- change item data
	if($post['syori_kbn'] == "Update"){
		$idxpath = DATPATH."others/index.txt";
		//INDEXファイルRead
		if(!file_read($idxpath,10,$dat)){
			print("File read error!!( ".$idxpath." )<BR>\n");
			exit;
		}else{
			$dat[$no] = $post['txt'];
			//INDEXファイルWrite
			if(!file_write($idxpath,10,$dat)){
				print("File write error!!( ".$idxpath." )<BR>\n");
				exit;
			}else{
				$msg .= "大ブロックNo.".($no+1)."の書き換えに成功しました。<BR>\n";
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
<title>Case & Accessories　タイトル設定</title>
</head>
<BODY background="<?=IMGPATH?>bg_wood.gif" vlink="#CC0000" leftmargin="0" topmargin="10">
<a href="login.php">&lt;&lt; Back</a><br>
<p align="center"><strong><font color="#FF0000" size="2"><a href="<?=BASEPATH?>ca/index.html" target="kakunin">＜ホームページ Case & Accessories へ＞</a></font></strong></p>
<p><?=$msg?>
  <div align="center">
<?php

	$idxpath = DATPATH."others/index.txt";
	//INDEXファイルRead
	if(!file_read($idxpath,10,$dat)){
		print("File read error!!( ".$idxpath." )<BR>\n");
		exit;
	}

	print("<table width=\"400\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\" bordercolor=\"#FFFFFF\">\n");
	print("  <tr> \n");
	print("    <td align=\"center\"><font size=\"2\" color=\"#990000\">※項目を空にすると非表示になります。</font></td>\n");
	print("  </tr>\n");
	print("</table>\n");
	for($no = 0; $no < 10; $no++){
		print("<script type=\"text/javascript\">\n");
		print("<!--\n");
		print("//更新確認後、SUBMITを行う\n");
		print("function upd_data".$no."(type){\n");
		print("	a=confirm(\"データを更新しホームページに反映します。よろしいですか？\");\n");
		print("	if(a == true){\n");
		print("		document.Update".$no.".syori_kbn.value = type;\n");
		print("		document.Update".$no.".submit();\n");
		print("	}\n");
		print("}\n");
		print("//-->\n");
		print("</script>\n");
		print("<form name=\"Update".$no."\" method=\"post\" enctype=\"multipart/form-data\" action=\"others_title.php\" style=\"margin:0px;\">\n");
		print("  <table width=\"400\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\" background=\"".IMGPATH."bg_sand.gif\">\n");
		print("    <tr> \n");
		print("      <td>　</td>\n");
		print("      <td bgcolor=\"#336633\" width=\"50\"> \n");
		print("        <div align=\"center\"><b><font size=\"2\" color=\"#FFFFFF\">". ($no + 1) ."</font></b></div>\n");
		print("      </td>\n");
		print("      <td width=\"300\"> \n");
		print("        <input type=\"text\" name=\"txt\" size=\"40\" value=\"".$dat[$no]."\" maxlength=\"40\">\n");
		print("      </td>\n");
		print("      <td bgcolor=\"#336633\" align=\"center\" width=\"50\">\n");
		print("<input name=\"Update\" type=\"button\" value=\"更新\" onClick=\"upd_data".$no."('Update')\">\n");
		print("      </td>\n");
		print("    </tr>\n");
		print("  </table>\n");
		print("  <input type=\"hidden\" name=\"no\" value=\"".$no."\">\n");
		print("  <input type=\"hidden\" name=\"syori_kbn\" value=\"\">\n");
		print("</form>\n");
	}

	if(DEBUG) debug_print($item);
?>
</body>
</html>
