<?php
//=====================================================================
//【top用関数】
//	説　明：top用の関数
//	作成日：2004/03/16
//	更新日：
//	作成者：H.Yamamura
//	備　考：
//=====================================================================

/* 関数定義 */

//****-----------------------------------------------------------****//
//	関数名：dispCalender
//	引　数：
//		str Ym ： 出力する年月
//	戻り値：
//	説　明：
//		カレンダーを生成して表示する
//	作成日：2004/01/08
//	更新日：
//	作成者：H.Yamamura
//	備　考：
//****-----------------------------------------------------------****//
function dispCalender($Ym){
	$search_yy = substr($Ym,0,4);
	$search_mm = substr($Ym,4,2);
	$month_days = array( 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );
	$month_name[1] = "JANUARY";
	$month_name[2] = "FEBRUARY";
	$month_name[3] = "MARCH";
	$month_name[4] = "APRIL";
	$month_name[5] = "MAY";
	$month_name[6] = "JUNE";
	$month_name[7] = "JULY";
	$month_name[8] = "AUGUST";
	$month_name[9] = "SEPTEMBER";
	$month_name[10] = "OCTOBER";
	$month_name[11] = "NOVEMBER";
	$month_name[12] = "DECEMBER";

	//うるう年チェック
	if(!checkdate($search_mm,$month_days[1],$search_yy)){
		$month_days[1] = 28;
	}

	//指定した年月の1日の曜日を求める
	$first_week = date('w',mktime(0,0,0,$search_mm,1,$search_yy));
	$week = $first_week;
	//１日～月末までの曜日を配列にセットする
	for($i=0;$i<$month_days[$search_mm - 1];$i++){
		if($week == 1){
			//月曜（定休日）
			$kbn[$i+1] = "H";
		}else{
			//通常
			$kbn[$i+1] = "N";
		}
		if($week == 6){
			$week = 0;
		}else{
			$week++;
		}
	}

	//--- カレンダーファイルをReadして明示的に変更した予定をセットする
	$path = DATPATH."calender/";
	if($dir = @dir($path)){
		while($dat = $dir->read()){
			$find = false;
			if($dat == ""){
				break;
			}elseif(preg_match('/'.$Ym."[0-9]{2}\.txt$/", $dat)){
				//キーワードが指定されているときはキーワードを含む項目のみを表示
				if(!file_read(DATPATH."calender/".$dat,2,$cal)){
					print("File read error!!( ".DATPATH."calender/".$dat." )<BR>\n");
					exit;
				}
				$day = substr($cal[0],6,2) + 0;
				$kbn[$day] = $cal[1];
			}
		}
	}
?>
			<div>
				<p><?=$search_mm+0?></p>
				<table class="calendar">
					<thead>
						<tr>
							<td>SUN</td>
							<td>MON</td>
							<td>TUE</td>
							<td>WED</td>
							<td>THU</td>
							<td>FRI</td>
							<td>SAT</td>
						</tr>
					</thead>
<?php
	//--- カレンダーの詳細部分
	$week = 0;
	print("<tr align=\"center\">\n");
	//１日の曜日まで空セルを出力する
	for($i=0;$i<7;$i++){
		//カレンダーの１行目を表示
		if($week != $first_week){
			print("<td>&nbsp;</td>");
		}else{
			break;
		}

		if($week == 6){
			$week = 0;
		}else{
			$week++;
		}
	}
	for($i=0;$i<$month_days[$search_mm - 1];$i++){
		//データを表示する
		if($kbn[$i+1] == "H"){
			//休日
			print("<td class=\"off\">" . ($i+1) . "</td>\n");
		}else{
			//通常
			print("<td>" . ($i+1) . "</td>\n");
		}

		if($week == 6){
			$week = 0;
			print("</tr>");
			print("<tr>");
		}else{
			$week++;
		}
	}
	print("</tr>");
 ?>
				</table>
			</div>
<?php
}
?>