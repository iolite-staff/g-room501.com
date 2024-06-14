<?php
//===================//
// 2バイト文字設定
//===================//

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

mb_internal_encoding("SJIS");

//===================//
// ファイルパス関連
//===================//

//--- BASEパス（静的ページへのリンク）
//define("BASEPATH","http://demo.iolite.co.jp/guitarroom501/");
define("BASEPATH","https://www.g-room501.com/");
//define("BASEPATH","https://g-room501.com/");

//--- resourceフォルダ
//define("IMGPATH","http://119.245.145.48/img/");
//define("IMGPATH","http://demo.iolite.co.jp/guitarroom501/img/");
define("IMGPATH","https://www.g-room501.com/img/");
//define("IMGPATH","https://g-room501.com/img/");

//--- detail用resourceフォルダ
//define("DETAILIMGPATH","http://119.245.145.48/detail/img/");
define("DETAILIMGPATH","https://www.g-room501.com/detail/img/");
//define("DETAILIMGPATH","https://g-room501.com/detail/img/");

//--- howto用resourceフォルダ
//define("HOWTOIMGPATH","http://119.245.145.48/howto/img/");
define("HOWTOIMGPATH","https://www.g-room501.com/howto/img/");
//define("HOWTOIMGPATH","https://g-room501.com/howto/img/");

//--- 実行サーバーフォルダ
//define("PHPPATH","http://demo.iolite.co.jp/guitarroom501/cgi-bin/guitarroom501/");
define("PHPPATH","https://www.g-room501.com/cgi-bin/guitarroom501/");

//--- ファイルデータフォルダ
//define("DATPATH","../../data/");
define("DATPATH","../../../data/");

//--- ファイルデータフォルダ(画像表示用）
//define("DATPATH2","../../guitarroom501/data/");
define("DATPATH2","../../../data/");

//--- ファイルデータフォルダ(inventory画像表示用）
//define("DATPATH3","../../../guitarroom501/data/");
define("DATPATH3","../../../../data/");

//--- 隠れファイルデータフォルダ
//define("SDATPATH","../../cgi-bin/data/");
define("SDATPATH","../data/");

//===================//
// メール設定
//===================//

//日本語エンコード設定
mb_language("Japanese");

//===================//
// デバック用
//===================//

//--- デバッグモード
//define("DEBUG",true);
define("DEBUG",false);

//--- Version番号
define("VER","1.9 Build 050615");

//カタログタイプ別登録可能件数
define("CATALOG_TYPE_1", 800);
define("CATALOG_TYPE_2", 300);
define("CATALOG_TYPE_3", 1300);
define("CATALOG_TYPE_4", 300);
?>
