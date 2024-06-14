#!/usr/local/bin/php
<?
	/*##################################################
		Title : 	access counter program
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
	$yyyymm = date('Ym');
	$dd = date('d') - 1;
	$dir_log = "./data/log".$yyyymm.".dat";

	/***************************************************
		main routine level
	***************************************************/

	if(file_exists($dir) == True){
		$count = file_read_counter($dir);	//counter file read
	}

	$count++;						//count up

	if(ereg("^[0-9]+$",$count) == True){
		$result = file_make_counter($dir,$count);		//counter file make
		if($result == 1){
			log_file_make_counter($dir_log,$count,$dd);		//counter log file make
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

	/*==============================
		make file [counter.txt]
	--------------------------------
		input : $dir $count
		output:
	==============================*/
		function file_make_counter($dir,$count)
		{
			$fp = @fopen($dir,"r+");	//file open

			//-----file open check
			if($fp == False){
				return 0;
			}else{
				rewind($fp);					//pointer first
				set_file_buffer($fp,0);			//buffer lock
				flock($fp, LOCK_EX);			//file lock
				//-----file write
				fputs($fp, $count);

				flock($fp, LOCK_UN);			//file unlock
				fclose($fp);					//file close
//				chmod("date.php",0600);			//file mode chenge
				return 1;
			}
		}

	/*==============================
		log make file [log(yyyymmdd).txt]
	--------------------------------
		input : $dir_log $count $dd
		output:
	==============================*/
		function log_file_make_counter($dir_log,$count,$dd)
		{
			//-----init table
			for($lp=0;$lp<31;$lp++){
				$day[$lp] = "";
			}

			//-----file read
			if(file_exists($dir_log) == True){
				$fp = @fopen($dir_log,"r");
				if(!$fp){
					return 0;
				}else{
					for($lp=0;$lp<31;$lp++){
						$day[$lp] = trim(fgets($fp,16));
					}
					fclose($fp);
				}
			}

			//-----new count set
			$day[$dd] = $count;


			//-----file write
			$fp = @fopen($dir_log,"w");		//file open

			//-----file open check
			if($fp == False){
				return 0;
			}else{
				set_file_buffer($fp,0);			//buffer lock
				flock($fp, LOCK_EX);			//file lock
				for($lp=0;$lp<31;$lp++){
					fwrite($fp,$day[$lp]."\n");
				}
				flock($fp, LOCK_UN);			//file unlock
				fclose($fp);
				return 1;
			}
		}
?>