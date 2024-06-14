#!/usr/local/bin/php
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/JavaScript">
<TITLE>Guitar room 501 Loan Simulation</TITLE>
</HEAD>
<BODY vlink="#CC0000" leftmargin="30" topmargin="30">
<form action="http://guitarroom501//cgi-bin/guitarroom501/loan/loan_test.php" method="post">
<input type="text" name="gaku" value="">
<input type="submit" name="submit" value="submit">
</form>
<?php
if(isset($_POST['submit'])){
	$gaku = $_POST['gaku'];
	$tanri1 = $gaku * 4.39 ;
	$tanri2 = round($gaku * 4.39,10);
	$tanri3 = round($gaku * 4.39,9);
	$tanri4 = round($gaku * 4.39,8);
?>

1：<?=$gaku?>*4.39
<br />
<?	print("thru  ：".$tanri1."<BR />");	?>
<?	print("floor  ：".floor($tanri1)."<BR />");	?>
<br />


2：round(<?=$gaku?>*4.39,10)
<br />
<?	print("thru  ：".$tanri2."<BR />");	?>
<?	print("floor  ：".floor($tanri2)."<BR />");	?>
<br />

3：round(<?=$gaku?>*4.39,9)
<br />
<?	print("thru  ：".$tanri3."<BR />");	?>
<?	print("floor  ：".floor($tanri3)."<BR />");	?>
<br />


4：round(<?=$gaku?>*4.39,8)
<br />
<?	print("thru  ：".$tanri4."<BR />");	?>
<?	print("floor  ：".floor($tanri4)."<BR />");	?>
<br />

<?
}
?>
</BODY>
</HTML>
