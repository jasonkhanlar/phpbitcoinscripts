<?
	//error_reporting(-1); ini_set('display_errors', 1);
	header("Content-type: text/html");
	date_default_timezone_set("America/Chicago");
	$rpctry=true; include("rpc.php");
	$blockcount = $data->getblockcount();
	$donated = $data->getreceivedbylabel("nullvoid.org/bitcoin") + $data->getreceivedbylabel("Bitcoin Forum Sig");
	$now = date("U");

	$blockfile = "blockdata";
	$data = file($blockfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); array_pop($data);
	foreach ($data as $line) {
		$blocks = strtok($line, " ");
		$date = strtok(" ");
		$avghash = strtok(" ");
	}
?><html>
 <head>
  <meta http-equiv="refresh" content="100000">
  <style>
	body {
		background-color: #222222;
		color: #aaaaaa;
	}
	.gnuplot {
		float: right;
	}
  </style>
 </head>
 <body>
  <span class="gnuplot">
   <img src="graphs/gnuplot/10.png"/><br/>
   <img src="graphs/gnuplot/100.png"/><br/>
   <img src="graphs/gnuplot/1000.png"/><br/>
   <img src="graphs/gnuplot/all.png"/><br/>
  </span>
  <pre>
<?
	//echo microtime()."\n";
	//$data = array_reverse($data);
	echo " /------------- Statistix -------------\\\n";
	echo "|            <a href=\"http://www.bitcoin.org/smf/index.php?topic=402.msg3395#msg3395\">PHP Source Code</a>            |\n";
	echo "|---------------------------------------|\n";
	echo "|  If you would like please donate to   |\n";
	echo "|  1PJdvcTFS1GfeXukJ1mr8yFi1xop8sC7z8   |\n";
	echo "| ".str_repeat(" ", floor((26 - strlen($donated))/2)).$donated."BTC donated".str_repeat(" ", ceil((26 - strlen($donated))/2))." |\n";

	echo "|---------------------------------------|\n";
	echo "|     Last block that existed x ago     |\n";
	echo "|   and timestamp when block was found  |\n";
	echo "|---------------------------------------|\n";
	echo "|          Now  $now              |\n";
	$lastdate = $now - $date; $lastdate .= ($lastdate == 1) ? " sec" : " secs"; $lastdate .= str_repeat(" ", 10 - strlen($lastdate));
	$lastblocknum = trim($blocks); $lastblock = $lastblocknum . str_repeat(" ", 12 - strlen($lastblocknum));
	echo "|   Last Block  $lastdate:$lastblock |\n";
	$block = array();
	foreach ($data as $line) {
		$blocks = strtok($line, " ");
		$date = strtok(" ");
		if ($now < $date) $date = $now;
		$avghash = strtok(" ");
		$block[$blocks] = $date;
		if (($now - 60) >= $date) { $min01date = $date; $min01blocks = $blocks; }
		if (($now - 120) >= $date) { $min02date = $date; $min02blocks = $blocks; }
		if (($now - 180) >= $date) { $min03date = $date; $min03blocks = $blocks; }
		if (($now - 240) >= $date) { $min04date = $date; $min04blocks = $blocks; }
		if (($now - 300) >= $date) { $min05date = $date; $min05blocks = $blocks; }
		if (($now - 600) >= $date) { $min10date = $date; $min10blocks = $blocks; }
		if (($now - 1200) >= $date) { $min20date = $date; $min20blocks = $blocks; }
		if (($now - 1800) >= $date) { $min30date = $date; $min30blocks = $blocks; }
		if (($now - 2400) >= $date) { $min40date = $date; $min40blocks = $blocks; }
		if (($now - 3000) >= $date) { $min50date = $date; $min50blocks = $blocks; }
		if (($now - 3600) >= $date) { $hr01date = $date; $hr01blocks = $blocks; }
		if (($now - 7200) >= $date) { $hr02date = $date; $hr02blocks = $blocks; }
		if (($now - 10800) >= $date) { $hr03date = $date; $hr03blocks = $blocks; }
		if (($now - 14400) >= $date) { $hr04date = $date; $hr04blocks = $blocks; }
		if (($now - 18000) >= $date) { $hr05date = $date; $hr05blocks = $blocks; }
		if (($now - 21600) >= $date) { $hr06date = $date; $hr06blocks = $blocks; }
		if (($now - 43200) >= $date) { $hr12date = $date; $hr12blocks = $blocks; }
		if (($now - 86400) >= $date) { $day1date = $date; $day1blocks = $blocks; }
		if (($now - 172800) >= $date) { $day2date = $date; $day2blocks = $blocks; }
		if (($now - 259200) >= $date) { $day3date = $date; $day3blocks = $blocks; }
		if (($now - 345600) >= $date) { $day4date = $date; $day4blocks = $blocks; }
		if (($now - 432000) >= $date) { $day5date = $date; $day5blocks = $blocks; }
		if (($now - 518400) >= $date) { $day6date = $date; $day6blocks = $blocks; }
		if (($now - 604800) >= $date) { $wk01date = $date; $wk01blocks = $blocks; }
		if (($now - 1209600) >= $date) { $wk02date = $date; $wk02blocks = $blocks; }
		if (($now - 1814400) >= $date) { $wk03date = $date; $wk03blocks = $blocks; }
		if (($now - 2419200) >= $date) { $wk04date = $date; $wk04blocks = $blocks; }
		if (($now - 4838400) >= $date) { $wk08date = $date; $wk08blocks = $blocks; }
		if (($now - 9676800) >= $date) { $wk16date = $date; $wk16blocks = $blocks; }
		if (($now - 79833600) >= $date) { $wk32date = $date; $wk32blocks = $blocks; }
		if (($now - 31536000) >= $date) { $yr1date = $date; $yr1blocks = $blocks; }
	}

	if (!isset($min01blocks)) $min01 = ""; else $min01 = "$min01date:$min01blocks";
	if (!isset($min02blocks)) $min02 = ""; else $min02 = "$min02date:$min02blocks";
	if (!isset($min03blocks)) $min03 = ""; else $min03 = "$min03date:$min03blocks";
	if (!isset($min04blocks)) $min04 = ""; else $min04 = "$min04date:$min04blocks";
	if (!isset($min05blocks)) $min05 = ""; else $min05 = "$min05date:$min05blocks";
	if (!isset($min10blocks)) $min10 = ""; else $min10 = "$min10date:$min10blocks";
	if (!isset($min20blocks)) $min20 = ""; else $min20 = "$min20date:$min20blocks";
	if (!isset($min30blocks)) $min30 = ""; else $min30 = "$min30date:$min30blocks";
	if (!isset($min40blocks)) $min40 = ""; else $min40 = "$min40date:$min40blocks";
	if (!isset($min50blocks)) $min50 = ""; else $min50 = "$min50date:$min50blocks";
	if (!isset($hr01blocks)) $hr01 = ""; else $hr01 = "$hr01date:$hr01blocks";
	if (!isset($hr02blocks)) $hr02 = ""; else $hr02 = "$hr02date:$hr02blocks";
	if (!isset($hr03blocks)) $hr03 = ""; else $hr03 = "$hr03date:$hr03blocks";
	if (!isset($hr04blocks)) $hr04 = ""; else $hr04 = "$hr04date:$hr04blocks";
	if (!isset($hr05blocks)) $hr05 = ""; else $hr05 = "$hr05date:$hr05blocks";
	if (!isset($hr06blocks)) $hr06 = ""; else $hr06 = "$hr06date:$hr06blocks";
	if (!isset($hr12blocks)) $hr12 = ""; else $hr12 = "$hr12date:$hr12blocks";
	if (!isset($day1blocks)) $day1 = ""; else $day1 = "$day1date:$day1blocks";
	if (!isset($day2blocks)) $day2 = ""; else $day2 = "$day2date:$day2blocks";
	if (!isset($day3blocks)) $day3 = ""; else $day3 = "$day3date:$day3blocks";
	if (!isset($day4blocks)) $day4 = ""; else $day4 = "$day4date:$day4blocks";
	if (!isset($day5blocks)) $day5 = ""; else $day5 = "$day5date:$day5blocks";
	if (!isset($day6blocks)) $day6 = ""; else $day6 = "$day6date:$day6blocks";
	if (!isset($wk01blocks)) $wk01 = ""; else $wk01 = "$wk01date:$wk01blocks";
	if (!isset($wk02blocks)) $wk02 = ""; else $wk02 = "$wk02date:$wk02blocks";
	if (!isset($wk03blocks)) $wk03 = ""; else $wk03 = "$wk03date:$wk03blocks";
	if (!isset($wk04blocks)) $wk04 = ""; else $wk04 = "$wk04date:$wk04blocks";
	if (!isset($wk08blocks)) $wk08 = ""; else $wk08 = "$wk08date:$wk08blocks";
	if (!isset($wk16blocks)) $wk16 = ""; else $wk16 = "$wk16date:$wk16blocks";
	if (!isset($wk32blocks)) $wk32 = ""; else $wk32 = "$wk32date:$wk32blocks";
	if (!isset($yr1blocks)) $yr1 = ""; else $yr1 = "$yr1date:$yr1blocks";

	echo "|    1min  ago  ".$min01.str_repeat(" ", 24 - strlen($min01))."|\n";
	echo "|    2min  ago  ".$min02.str_repeat(" ", 24 - strlen($min02))."|\n";
	echo "|    3min  ago  ".$min03.str_repeat(" ", 24 - strlen($min03))."|\n";
	echo "|    4min  ago  ".$min04.str_repeat(" ", 24 - strlen($min04))."|\n";
	echo "|    5min  ago  ".$min05.str_repeat(" ", 24 - strlen($min05))."|\n";
	echo "|   10min  ago  ".$min10.str_repeat(" ", 24 - strlen($min10))."|\n";
	echo "|   20min  ago  ".$min20.str_repeat(" ", 24 - strlen($min20))."|\n";
	echo "|   30min  ago  ".$min30.str_repeat(" ", 24 - strlen($min30))."|\n";
	echo "|   40min  ago  ".$min40.str_repeat(" ", 24 - strlen($min40))."|\n";
	echo "|   50min  ago  ".$min50.str_repeat(" ", 24 - strlen($min50))."|\n";
	echo "|    1hr   ago  ".$hr01.str_repeat(" ", 24 - strlen($hr01))."|\n";
	echo "|    2hrs  ago  ".$hr02.str_repeat(" ", 24 - strlen($hr02))."|\n";
	echo "|    3hrs  ago  ".$hr03.str_repeat(" ", 24 - strlen($hr03))."|\n";
	echo "|    4hrs  ago  ".$hr04.str_repeat(" ", 24 - strlen($hr04))."|\n";
	echo "|    5hrs  ago  ".$hr05.str_repeat(" ", 24 - strlen($hr05))."|\n";
	echo "|    6hrs  ago  ".$hr06.str_repeat(" ", 24 - strlen($hr06))."|\n";
	echo "|   12hrs  ago  ".$hr12.str_repeat(" ", 24 - strlen($hr12))."|\n";
	echo "|    1day  ago  ".$day1.str_repeat(" ", 24 - strlen($day1))."|\n";
	echo "|    2days ago  ".$day2.str_repeat(" ", 24 - strlen($day2))."|\n";
	echo "|    3days ago  ".$day3.str_repeat(" ", 24 - strlen($day3))."|\n";
	echo "|    4days ago  ".$day4.str_repeat(" ", 24 - strlen($day4))."|\n";
	echo "|    5days ago  ".$day5.str_repeat(" ", 24 - strlen($day5))."|\n";
	echo "|    6days ago  ".$day6.str_repeat(" ", 24 - strlen($day6))."|\n";
	echo "|    1wk   ago  ".$wk01.str_repeat(" ", 24 - strlen($wk01))."|\n";
	echo "|    2wks  ago  ".$wk02.str_repeat(" ", 24 - strlen($wk02))."|\n";
	echo "|    3wks  ago  ".$wk03.str_repeat(" ", 24 - strlen($wk03))."|\n";
	echo "|    4wks  ago  ".$wk04.str_repeat(" ", 24 - strlen($wk04))."|\n";
	echo "|    8wks  ago  ".$wk08.str_repeat(" ", 24 - strlen($wk08))."|\n";
	echo "|   16wks  ago  ".$wk16.str_repeat(" ", 24 - strlen($wk16))."|\n";
	echo "|   32wks  ago  ".$wk32.str_repeat(" ", 24 - strlen($wk32))."|\n";
	echo "|    1yr   ago  ".$yr1.str_repeat(" ", 24 - strlen($yr1))."|\n";
	echo "|---------------------------------------/\n";
	if (isset($min01blocks)) $min01c = ($blockcount - $min01blocks - 1); else $min01c = 0; echo "| ".fill(number_format($min01c, 0, ".", ","),9)." blocks found in last minute\n";
	if (isset($min02blocks)) $min02c = ($blockcount - $min02blocks - 1); else $min02c = 0; echo "| ".fill(number_format($min02c, 0, ".", ","),9)." blocks found in last 2 mins\n";
	if (isset($min03blocks)) $min03c = ($blockcount - $min03blocks - 1); else $min03c = 0; echo "| ".fill(number_format($min03c, 0, ".", ","),9)." blocks found in last 3 mins\n";
	if (isset($min04blocks)) $min04c = ($blockcount - $min04blocks - 1); else $min04c = 0; echo "| ".fill(number_format($min04c, 0, ".", ","),9)." blocks found in last 4 mins\n";
	if (isset($min05blocks)) $min05c = ($blockcount - $min05blocks - 1); else $min05c = 0; echo "| ".fill(number_format($min05c, 0, ".", ","),9)." blocks found in last 5 mins\n";
	if (isset($min10blocks)) $min10c = ($blockcount - $min10blocks - 1); else $min10c = 0; echo "| ".fill(number_format($min10c, 0, ".", ","),9)." blocks found in last 10 mins\n";
	if (isset($min20blocks)) $min20c = ($blockcount - $min20blocks - 1); else $min20c = 0; echo "| ".fill(number_format($min20c, 0, ".", ","),9)." blocks found in last 20 mins\n";
	if (isset($min30blocks)) $min30c = ($blockcount - $min30blocks - 1); else $min30c = 0; echo "| ".fill(number_format($min30c, 0, ".", ","),9)." blocks found in last 30 mins\n";
	if (isset($min40blocks)) $min40c = ($blockcount - $min40blocks - 1); else $min40c = 0; echo "| ".fill(number_format($min40c, 0, ".", ","),9)." blocks found in last 40 mins\n";
	if (isset($min50blocks)) $min50c = ($blockcount - $min50blocks - 1); else $min50c = 0; echo "| ".fill(number_format($min50c, 0, ".", ","),9)." blocks found in last 50 mins\n";
	if (isset($hr01blocks)) $hr01c = ($blockcount - $hr01blocks - 1); else $hr01c = 0; echo "| ".fill(number_format($hr01c, 0, ".", ","),9)." blocks found in last hour\n";
	if (isset($hr02blocks)) $hr02c = ($blockcount - $hr02blocks - 1); else $hr02c = 0; echo "| ".fill(number_format($hr02c, 0, ".", ","),9)." blocks found in last 2 hrs";echo "    blocks/hr avg: ".($hr02c / 2)."\n";
	if (isset($hr03blocks)) $hr03c = ($blockcount - $hr03blocks - 1); else $hr03c = 0; echo "| ".fill(number_format($hr03c, 0, ".", ","),9)." blocks found in last 3 hrs";echo "    blocks/hr avg: ".($hr03c / 3)."\n";
	if (isset($hr04blocks)) $hr04c = ($blockcount - $hr04blocks - 1); else $hr04c = 0; echo "| ".fill(number_format($hr04c, 0, ".", ","),9)." blocks found in last 4 hrs";echo "    blocks/hr avg: ".($hr04c / 4)."\n";
	if (isset($hr05blocks)) $hr05c = ($blockcount - $hr05blocks - 1); else $hr05c = 0; echo "| ".fill(number_format($hr05c, 0, ".", ","),9)." blocks found in last 5 hrs";echo "    blocks/hr avg: ".($hr05c / 5)."\n";
	if (isset($hr06blocks)) $hr06c = ($blockcount - $hr06blocks - 1); else $hr06c = 0; echo "| ".fill(number_format($hr06c, 0, ".", ","),9)." blocks found in last 6 hrs";echo "    blocks/hr avg: ".($hr06c / 6)."\n";
	if (isset($hr12blocks)) $hr12c = ($blockcount - $hr12blocks - 1); else $hr12c = 0; echo "| ".fill(number_format($hr12c, 0, ".", ","),9)." blocks found in last 12 hrs";echo "   blocks/hr avg: ".($hr12c / 12)."\n";
	if (isset($day1blocks)) $day1c = ($blockcount - $day1blocks - 1); else $day1c = 0; echo "| ".fill(number_format($day1c, 0, ".", ","),9)." blocks found in last day";echo "      blocks/hr avg: ".($day1c / 24)."\n";
	if (isset($day2blocks)) $day2c = ($blockcount - $day2blocks - 1); else $day2c = 0; echo "| ".fill(number_format($day2c, 0, ".", ","),9)." blocks found in last 2 days";echo "   blocks/hr avg: ".($day2c / 48)."\n";
	if (isset($day3blocks)) $day3c = ($blockcount - $day3blocks - 1); else $day3c = 0; echo "| ".fill(number_format($day3c, 0, ".", ","),9)." blocks found in last 3 days";echo "   blocks/hr avg: ".($day3c / 72)."\n";
	if (isset($day4blocks)) $day4c = ($blockcount - $day4blocks - 1); else $day4c = 0; echo "| ".fill(number_format($day4c, 0, ".", ","),9)." blocks found in last 4 days";echo "   blocks/hr avg: ".($day4c / 96)."\n";
	if (isset($day5blocks)) $day5c = ($blockcount - $day5blocks - 1); else $day5c = 0; echo "| ".fill(number_format($day5c, 0, ".", ","),9)." blocks found in last 5 days";echo "   blocks/hr avg: ".($day5c / 120)."\n";
	if (isset($day6blocks)) $day6c = ($blockcount - $day6blocks - 1); else $day6c = 0; echo "| ".fill(number_format($day6c, 0, ".", ","),9)." blocks found in last 6 days";echo "   blocks/hr avg: ".($day6c / 144)."\n";
	if (isset($wk01blocks)) $wk01c = ($blockcount - $wk01blocks - 1); else $wk01c = 0; echo "| ".fill(number_format($wk01c, 0, ".", ","),9)." blocks found in last week";echo "     blocks/hr avg: ".($wk01c / 168)."\n";
	if (isset($wk02blocks)) $wk02c = ($blockcount - $wk02blocks - 1); else $wk02c = 0; echo "| ".fill(number_format($wk02c, 0, ".", ","),9)." blocks found in last 2 wks";echo "    blocks/hr avg: ".($wk02c / 336)."\n";
	if (isset($wk03blocks)) $wk03c = ($blockcount - $wk03blocks - 1); else $wk03c = 0; echo "| ".fill(number_format($wk03c, 0, ".", ","),9)." blocks found in last 3 wks";echo "    blocks/hr avg: ".($wk03c / 504)."\n";
	if (isset($wk04blocks)) $wk04c = ($blockcount - $wk04blocks - 1); else $wk04c = 0; echo "| ".fill(number_format($wk04c, 0, ".", ","),9)." blocks found in last 4 wks";echo "    blocks/hr avg: ".($wk04c / 672)."\n";
	if (isset($wk08blocks)) $wk08c = ($blockcount - $wk08blocks - 1); else $wk08c = 0; echo "| ".fill(number_format($wk08c, 0, ".", ","),9)." blocks found in last 8 wks";echo "    blocks/hr avg: ".($wk08c / 1344)."\n";
	if (isset($wk16blocks)) $wk16c = ($blockcount - $wk16blocks - 1); else $wk16c = 0; echo "| ".fill(number_format($wk16c, 0, ".", ","),9)." blocks found in last 16 wks";echo "   blocks/hr avg: ".($wk16c / 2688)."\n";
	if (isset($wk32blocks)) $wk32c = ($blockcount - $wk32blocks - 1); else $wk32c = 0; echo "| ".fill(number_format($wk32c, 0, ".", ","),9)." blocks found in last 32 wks";echo "   blocks/hr avg: ".($wk32c / 5376)."\n";
	if (isset($yr1blocks)) $yr1c = ($blockcount - $yr1blocks - 1); else $yr1c = 0; echo "| ".fill(number_format($yr1c, 0, ".", ","),9)." blocks found in last year";echo "     blocks/hr avg: ".($yr1c / 8760)."\n";
	echo "\----------------------------------------";
	//echo microtime()."\n";
	if (!isset($_GET["showallblocks"])) {
		echo "\\\n   <a href=\"".$_SERVER["PHP_SELF"]."?showallblocks\">Timestamp data for all ".number_format($blockcount)." blocks</a>  |\n";
		echo "                 ~".number_format((3065 + 36 * $blockcount) / 1024 / 1024, 2)."Mb                 |\n";
		echo "-----------------------------------------/";
	} else {
		echo "\n\n";
		$block = array_reverse($block, true);
		foreach ($block as $key => $num) {
			$secsn = $block[$key] - ((isset($block[$key-1])) ? $block[$key-1] : 0);
			$secs = ($secsn == 1) ? "$secsn second " : "$secsn seconds";
			$secs = str_repeat(" ", 15 - strlen($secs)).$secs;
			if (isset($block[$key-1])) echo "$secs to find block $key\n";
			ob_flush(); flush();
		}
	}
	function fill($str, $len) { return str_repeat(" ", $len - strlen($str)).$str; }
?>
  </pre>
 </body>
</html>