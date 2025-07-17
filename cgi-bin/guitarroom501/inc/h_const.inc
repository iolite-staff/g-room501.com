<?php
//===================//
// 2?o?C?g???????
//===================//

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

mb_internal_encoding("SJIS");

//===================//
// ?t?@?C???p?X??A
//===================//

//--- BASE?p?X?i??I?y?[?W???????N?j
//define("BASEPATH","http://demo.iolite.co.jp/guitarroom501/");
define("BASEPATH","https://www.g-room501.com/");
//define("BASEPATH","https://g-room501.com/");

//--- resource?t?H???_
//define("IMGPATH","http://119.245.145.48/img/");
//define("IMGPATH","http://demo.iolite.co.jp/guitarroom501/img/");
define("IMGPATH","https://www.g-room501.com/img/");
//define("IMGPATH","https://g-room501.com/img/");

//--- detail?presource?t?H???_
//define("DETAILIMGPATH","http://119.245.145.48/detail/img/");
define("DETAILIMGPATH","https://www.g-room501.com/detail/img/");
//define("DETAILIMGPATH","https://g-room501.com/detail/img/");

//--- howto?presource?t?H???_
//define("HOWTOIMGPATH","http://119.245.145.48/howto/img/");
define("HOWTOIMGPATH","https://www.g-room501.com/howto/img/");
//define("HOWTOIMGPATH","https://g-room501.com/howto/img/");

//--- ???s?T?[?o?[?t?H???_
//define("PHPPATH","http://demo.iolite.co.jp/guitarroom501/cgi-bin/guitarroom501/");
define("PHPPATH","https://www.g-room501.com/cgi-bin/guitarroom501/");

//--- ?t?@?C???f?[?^?t?H???_
//define("DATPATH","../../data/");
define("DATPATH","../../../data/");

//--- ?t?@?C???f?[?^?t?H???_(???\???p?j
//define("DATPATH2","../../guitarroom501/data/");
define("DATPATH2","../../../data/");

//--- ?t?@?C???f?[?^?t?H???_(inventory???\???p?j
//define("DATPATH3","../../../guitarroom501/data/");
define("DATPATH3","../../../../data/");

//--- ?B??t?@?C???f?[?^?t?H???_
//define("SDATPATH","../../cgi-bin/data/");
define("SDATPATH","../data/");

//===================//
// ???[?????
//===================//

//???{??G???R?[?h???
mb_language("Japanese");

//===================//
// ?f?o?b?N?p
//===================//

//--- ?f?o?b?O???[?h
//define("DEBUG",true);
define("DEBUG",false);

//--- Version???
define("VER","1.9 Build 050615");

//?J?^???O?^?C?v??o?^??\????
define("CATALOG_TYPE_1", 800);
define("CATALOG_TYPE_2", 300);
define("CATALOG_TYPE_3", 1300);
define("CATALOG_TYPE_4", 300);
define("CATALOG_TYPE_5", 300);
?>
