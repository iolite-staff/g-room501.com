#!/usr/local/bin/php
<?
require_once('../inc/h_const.inc');
require_once('../inc/h_file.inc');
require_once('../inc/h_common.inc');

/*	for($i=0;$i<10;$i++){
		$mkrpath = DATPATH."makers/makers".$i.".txt";
		if(!file_read($mkrpath,500,$makerdat)){
			print("File read error!!( ".$path." )<BR>\n");
			exit;
		}
	//メーカー名
		if($i==0){
			$maker_name[$i] = $makerdat[0];
		}
	}*/
/*	$l=0;
			print("<div align=left>");
	for($k=0;$k<10;$k++){
		if($maker_name[$k] != ""){
			print("<a href=\"".BASEPATH."makers/stocklist".$k.".htm\"><font size=2>".$maker_name[$k]."</font></a>&nbsp;");
			$l++;
		}
		if($l == 5){
			print("<br>");
		}
		
	}
			print("</div>");*/
?>
<style type="text/css">
<!--
.mName{
	color:#333333;
	font-size:12px;
	text-decoration:none;
}
-->
</style>
<br>
<span style="font-size:12px;color:#333300;font-weight:bold;">NEWギターのストックはこちらからご覧下さい</span><br>
<table cellspacing="5" cellpadding="0">
 <tr>
  <td align="center">
	<a href="<?=BASEPATH?>makers/stocklist2.htm">
	<img src="<?=IMGPATH?>icon_2.jpg" border="0" style="border:1px solid #666666;"><br>
	<span class="mName">Collings</span>
	</a>
  </td>
  <td align="center">
	<a href="<?=BASEPATH?>makers/stocklist1.htm">
	<img src="<?=IMGPATH?>icon_1.jpg" border="0" style="border:1px solid #666666;"><br>
	<span class="mName">SUMI工房</span>
	</a>
  </td>
  <td align="center">
	<a href="<?=BASEPATH?>makers/stocklist0.htm">
	<img src="<?=IMGPATH?>icon_0.jpg" border="0" style="border:1px solid #666666;"><br>
	<span class="mName">FurchGuitar</span>
	</a>
  </td>
  <td align="center">
	<a href="<?=BASEPATH?>tsk/tsk.htm">
	<img src="<?=BASEPATH?>tsk/img/s-tsk-logos.jpg" border="0" style="border:1px solid #666666;"><br>
	<span class="mName">TSK</span>
	</a>
  </td>
 </tr>
</table>
