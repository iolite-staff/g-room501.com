#!/usr/local/bin/php
<?
	/*##################################################
		Title : 	access counter disp program
	----------------------------------------------------
		Language : 	PHP 4
	----------------------------------------------------
		Version : 		Ver.1.00
		date : 			2004/03/01
		programer : 	hiroki.yamamura
	##################################################*/

	/***************************************************
		data set/initial level
	***************************************************/
	$count = 0;		// counter
	$dir = "./data/counter.dat";

	//-----display type (text:TRUE or image:FALSE)
	$disp_text = TRUE;

	$imgpath = "http://www.craft-house.jp/top/img/counter/";

	/***************************************************
		main routine level
	***************************************************/

	if(file_exists($dir) == True){
		$count = file_read_counter($dir);	//counter file read

		if($disp_text){
			print($count);						//text output
		}else{
			img_tag_output($count,$imgpath);	//image file output
		}
	}

	/***************************************************
		function routine level
	***************************************************/
	/*==============================
		read file [counter.txt]
	--------------------------------
		input : $dir
		output:
	==============================*/
		function file_read_counter($dir)
		{
			$fp = @fopen($dir,"r");			//file open

			//-----file open check
			if(!$fp){
				return 0;
			}else{
				$count = trim(fgets($fp,64));
				fclose($fp);
				return $count;
			}
		}

	/***************************************************
		function image file output
	***************************************************/
	/*==============================
		input : $count
		output:
	==============================*/
		function img_tag_output($count,$imgpath)
		{
			if($count < 100000){
				$count = sprintf('%05d',$count);
			}
			for($i=0;$i<strlen($count);$i++){
				$num = substr($count,$i,1);
				print("<img src=\"".$imgpath.$num.".gif\" alt=\"".$num."\">");
			}
		}

?>