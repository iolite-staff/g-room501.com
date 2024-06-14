#!/usr/local/bin/php
<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

	//バーゲン中か判断
	$path = DATPATH."bargain.txt";
	if(!file_read($path,2,$bargain)){
		print("File read error!!( ".$path." )<BR>\n");
		exit;
	}
	if($bargain[0] <= date('Ymd')
	&& $bargain[1] >= date('Ymd')
	){
		$bar_flg = TRUE;
	}else{
		$bar_flg = FALSE;
	}

	$idxpath1 = DATPATH."weekly/1.txt";

	//INDEXファイルRead
	if(!file_read($idxpath1,50,$index1)){
		print("File read error!!( ".$idxpath1." )<BR>\n");
		exit;
	}

	$datpath1 = DATPATH."guitar/".substr($index1[0],0,1)."/".substr($index1[0],1,3).".txt";

	//データファイルRead
	if(!file_read($datpath1,100,$dat1)){
		print("File read error!!( ".$datpath1." )<BR>\n");
		exit;
	}

	//画像ファイルチェック
	if(file_exists(DATPATH."guitar/".substr($index1[0],0,1)."/".substr($index1[0],1,3)."_small.jpg")){
		if($dat1[8] != "checked"){
			$imgpath1 = "<a href=\"".PHPPATH."catalog/detail.php?maker=".substr($index1[0],0,1)."&cd=".substr($index1[0],1,3)."\"><img src=\"".DATPATH2."guitar/".substr($index1[0],0,1)."/".substr($index1[0],1,3)."_small.jpg\" align=\"left\" width=\"56\" height=\"100\" border=\"0\"></a>";
		}else{
			$imgpath1 = "<img src=\"".DATPATH2."guitar/".substr($index1[0],0,1)."/".substr($index1[0],1,3)."_small.jpg\" align=\"left\" width=\"56\" height=\"100\" border=\"0\">";
		}
	}else{
		$imgpath1 = "<img src=\"img/clear.gif\" width=\"56\" height=\"100\" border=\"0\">";
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
			$txt1 .= $index1[$i]."<br>\n";
		}
	}
	//SOLD/HOLD画像セット
	if($dat1[8] == "checked"){
		$background_image = "img/sold_b.gif";
	}elseif($dat1[9] == "checked"){
		$background_image = "img/hold_b.gif";
	}else{
		$background_image = "";
	}

	//表示
	print("<table width=\"500\" border=\"0\" cellspacing=\"0\">\n");
	print("  <tr> \n");
	print("    <td colspan=\"4\" align=\"center\" valign=\"top\"><img src=\"img/spotlight.gif\" width=\"168\" height=\"74\"></td>\n");
	print("  </tr>\n");
	print("  <tr> \n");
	print("    <td colspan=\"4\" valign=\"top\">&nbsp;</td>\n");
	print("  </tr>\n");
	print("  <tr> \n");
	print("  <td width=\"70\" align=\"right\" valign=\"top\">".$imgpath1."<font size=\"2\">\n");
	print("  </td> \n");
	print("    <td width=\"430\" valign=\"top\" style=\"background-image:url(".$background_image.");background-position:top left;background-repeat:no-repeat;\"><font size=\"2\">\n");
	if(mb_strlen($dat1[1]) > 10){
		$dat1txt = mb_substr($dat1[1],0,10)."<font size=\"2\">...</font>";
	}else{
		$dat1txt = $dat1[1];
	}
	if($dat1[8] != "checked"){
		print("      <strong>".$dat1txt." <a href=\"".PHPPATH."catalog/detail.php?maker=".substr($index1[0],0,1)."&cd=".substr($index1[0],1,3)."\">".$dat1[2]."</a> </strong>(".$dat1[3].")<br>\n");
	}else{
		print("      <strong>".$dat1txt." ".$dat1[2]." </strong>(".$dat1[3].")<br>\n");
	}
	if($dat1[5] != ""
	&& $dat1[5] != 0
	&& $dat1[6] != ""
	&& $dat1[6] != 0
	&& $dat1[5] < $dat1[6]
	){
		//旧価格あり
		print(" <strong>".kingaku($dat1[6],1)."</strong><br>\n");
		print("  　→　<strong><font color=\"#CC0000\">".kingaku($dat1[5],1)."</font></strong><br>\n");
	}else{
		//旧価格なし
		print(" <strong>".kingaku($dat1[5],1)."</strong><br>\n");
	}

	if($bar_flg
	&& $dat1[7] != ""
	){
		//バーゲン中でバーゲン価格あり
		print("　→　<font color=\"#FF6600\"><strong>".kingaku($dat1[7],1)."</strong></font><br>\n");
	}
    print("  </tr>\n");
	print("  <tr> \n");
	print("  <td style=\"line-height:120%;\" width=\"500\" colspan=\"2\" vAlign=\"top\"><font size=\"2\">".$txt1."\n");
	print("      </font></td>\n");
	print("  </tr>\n");
	print("</table>\n");

?>
