<?php
//****-----------------------------------------------------------****//
//	関数名：file_write
//	引　数：
//		str ファイルパス
//		int 保存行数
//		連想配列 str 保存元アイテム
//	戻り値：
//		保存成功:True 保存失敗:False
//	説　明：
//		連想配列内の文章をファイルへ保存する
//	作成日：2003/12/19
//	更新日：
//	作成者：H.Yamamura
//	備　考：
//****-----------------------------------------------------------****//
function file_write($filename,$itemct,$item){
	$fp = fopen($filename,"w");
	if(!$fp){
		return False;
	}else{
		for($lp=0;$lp<$itemct;$lp++){
			fwrite($fp,$item[$lp]."\n");
		}
		fclose($fp);
		return True;
	}
}
//****-----------------------------------------------------------****//
//	関数名：file_read
//	引　数：
//		str ファイルパス
//		int 取得行数
//		連想配列 str 保存先アイテム
//	戻り値：
//		取得成功:True 取得失敗:False
//	説　明：
//		ファイル内の文章を連想配列へ取得する
//	作成日：2003/12/19
//	更新日：
//	作成者：H.Yamamura
//	備　考：
//****-----------------------------------------------------------****//
function file_read($filename,$itemct,&$item){
	for($lp=0;$lp<$itemct;$lp++){
		$item[$lp] = "";
	}
	$fp = fopen($filename,"r");
	if(!$fp){
		return False;
	}else{
		for($lp=0;$lp<$itemct;$lp++){
			$item[$lp] = trim(fgets($fp,5120),"\n");
		}
		fclose($fp);
		return True;
	}
}
//****-----------------------------------------------------------****//
//	関数名：disk_usage
//	引　数：
//		str d: フォルダパス
//	戻り値：
//		int usage: 使用容量（byte）
//	説　明：
//		指定したフォルダ以下の全てのファイルの容量を返す
//	作成日：2004/09/08
//	更新日：
//	作成者：H.Yamamura
//	備　考：
//		フォルダのパーミッションに注意
//		（サーバーによってはルートを指定するとエラーが出る場合あり）
//		例）cgi-binとhomeの容量の合計を取得する
//			$usage = disk_usage("../../cgi-bin/");
//			$usage += disk_usage("../../");
//****-----------------------------------------------------------****//
function disk_usage($d) {
	if(is_file($d)){
		return filesize($d);
	}

	if($d[strlen($d)-1] != '/'){
		$d .= '/';
	}

	$dh=@opendir($d);
	if(!$dh){
		return 0;
	}

	while($e = readdir($dh)){
		if($e != "." && $e != ".."){
			$usage += disk_usage($d.$e);
		}
	}

	closedir($dh);

	return $usage;
}
?>