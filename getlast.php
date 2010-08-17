<?
	//This script may need to be converted similarly to statistix.php to also meet kencausey's expectations.  Review when time.
	//error_reporting(-1); ini_set('display_errors', 1);
	header("Content-type: text/plain");
	date_default_timezone_set("America/Chicago");
	$rpctry=true; include("rpc.php");
	$blockcount = $data->getblockcount();
	$now = date("U");

	$blockfile = "blockdata";
	$data = file($blockfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); array_pop($data);
	foreach ($data as $line) {
		$blocks = strtok($line, " ");
		$date = strtok(" ");
		$avghash = strtok(" ");
	}
	$lastdate = $now - $date; $lastdate .= ($lastdate == 1) ? " sec" : " secs"; $lastdate .= str_repeat(" ", 10 - strlen($lastdate));
	$lastblocknum = trim($blocks); $lastblock = $lastblocknum . str_repeat(" ", 12 - strlen($lastblocknum));

	$block = array();
	$data = array_reverse($data);
	foreach ($data as $line) {
		$blocks = strtok($line, " ");
		$date = strtok(" ");
		if ($now < $date) $date = $now;
		$avghash = strtok(" ");
		$block[$blocks] = $date;
		if (($now - 60) <= $date) { $min01date = $date; $min01blocks = $blocks; }
		if (($now - 120) <= $date) { $min02date = $date; $min02blocks = $blocks; }
		if (($now - 180) <= $date) { $min03date = $date; $min03blocks = $blocks; }
		if (($now - 240) <= $date) { $min04date = $date; $min04blocks = $blocks; }
		if (($now - 300) <= $date) { $min05date = $date; $min05blocks = $blocks; }
		if (($now - 600) <= $date) { $min10date = $date; $min10blocks = $blocks; }
		if (($now - 1200) <= $date) { $min20date = $date; $min20blocks = $blocks; }
		if (($now - 1800) <= $date) { $min30date = $date; $min30blocks = $blocks; }
		if (($now - 2400) <= $date) { $min40date = $date; $min40blocks = $blocks; }
		if (($now - 3000) <= $date) { $min50date = $date; $min50blocks = $blocks; }
		if (($now - 3600) <= $date) { $hr01date = $date; $hr01blocks = $blocks; }
		if (($now - 7200) <= $date) { $hr02date = $date; $hr02blocks = $blocks; }
		if (($now - 10800) <= $date) { $hr03date = $date; $hr03blocks = $blocks; }
		if (($now - 14400) <= $date) { $hr04date = $date; $hr04blocks = $blocks; }
		if (($now - 18000) <= $date) { $hr05date = $date; $hr05blocks = $blocks; }
		if (($now - 21600) <= $date) { $hr06date = $date; $hr06blocks = $blocks; }
		if (($now - 43200) <= $date) { $hr12date = $date; $hr12blocks = $blocks; }
		if (($now - 86400) <= $date) { $day1date = $date; $day1blocks = $blocks; }
		if (($now - 172800) <= $date) { $day2date = $date; $day2blocks = $blocks; }
		if (($now - 259200) <= $date) { $day3date = $date; $day3blocks = $blocks; }
		if (($now - 345600) <= $date) { $day4date = $date; $day4blocks = $blocks; }
		if (($now - 432000) <= $date) { $day5date = $date; $day5blocks = $blocks; }
		if (($now - 518400) <= $date) { $day6date = $date; $day6blocks = $blocks; }
		if (($now - 604800) <= $date) { $wk01date = $date; $wk01blocks = $blocks; }
		if (($now - 1209600) <= $date) { $wk02date = $date; $wk02blocks = $blocks; }
		if (($now - 1814400) <= $date) { $wk03date = $date; $wk03blocks = $blocks; }
		if (($now - 2419200) <= $date) { $wk04date = $date; $wk04blocks = $blocks; }
		if (($now - 4838400) <= $date) { $wk08date = $date; $wk08blocks = $blocks; }
		if (($now - 9676800) <= $date) { $wk16date = $date; $wk16blocks = $blocks; }
		if (($now - 79833600) <= $date) { $wk32date = $date; $wk32blocks = $blocks; }
		if (($now - 31536000) <= $date) { $yr1date = $date; $yr1blocks = $blocks; }
	}

	$out = array();

	if (isset($min01blocks)) $min01c = ($blockcount - $min01blocks); else $min01c = 0; $out[] = $min01c;
	if (isset($min02blocks)) $min02c = ($blockcount - $min02blocks); else $min02c = 0; $out[] = $min02c;
	if (isset($min03blocks)) $min03c = ($blockcount - $min03blocks); else $min03c = 0; $out[] = $min03c;
	if (isset($min04blocks)) $min04c = ($blockcount - $min04blocks); else $min04c = 0; $out[] = $min04c;
	if (isset($min05blocks)) $min05c = ($blockcount - $min05blocks); else $min05c = 0; $out[] = $min05c;
	if (isset($min10blocks)) $min10c = ($blockcount - $min10blocks); else $min10c = 0; $out[] = $min10c;
	if (isset($min20blocks)) $min20c = ($blockcount - $min20blocks); else $min20c = 0; $out[] = $min20c;
	if (isset($min30blocks)) $min30c = ($blockcount - $min30blocks); else $min30c = 0; $out[] = $min30c;
	if (isset($min40blocks)) $min40c = ($blockcount - $min40blocks); else $min40c = 0; $out[] = $min40c;
	if (isset($min50blocks)) $min50c = ($blockcount - $min50blocks); else $min50c = 0; $out[] = $min50c;
	if (isset($hr01blocks)) $hr01c = ($blockcount - $hr01blocks); else $hr01c = 0; $out[] = $hr01c;
	if (isset($hr02blocks)) $hr02c = ($blockcount - $hr02blocks); else $hr02c = 0; $out[] = $hr02c;
	if (isset($hr03blocks)) $hr03c = ($blockcount - $hr03blocks); else $hr03c = 0; $out[] = $hr03c;
	if (isset($hr04blocks)) $hr04c = ($blockcount - $hr04blocks); else $hr04c = 0; $out[] = $hr04c;
	if (isset($hr05blocks)) $hr05c = ($blockcount - $hr05blocks); else $hr05c = 0; $out[] = $hr05c;
	if (isset($hr06blocks)) $hr06c = ($blockcount - $hr06blocks); else $hr06c = 0; $out[] = $hr06c;
	if (isset($hr12blocks)) $hr12c = ($blockcount - $hr12blocks); else $hr12c = 0; $out[] = $hr12c;
	if (isset($day1blocks)) $day1c = ($blockcount - $day1blocks); else $day1c = 0; $out[] = $day1c;
	if (isset($day2blocks)) $day2c = ($blockcount - $day2blocks); else $day2c = 0; $out[] = $day2c;
	if (isset($day3blocks)) $day3c = ($blockcount - $day3blocks); else $day3c = 0; $out[] = $day3c;
	if (isset($day4blocks)) $day4c = ($blockcount - $day4blocks); else $day4c = 0; $out[] = $day4c;
	if (isset($day5blocks)) $day5c = ($blockcount - $day5blocks); else $day5c = 0; $out[] = $day5c;
	if (isset($day6blocks)) $day6c = ($blockcount - $day6blocks); else $day6c = 0; $out[] = $day6c;
	if (isset($wk01blocks)) $wk01c = ($blockcount - $wk01blocks); else $wk01c = 0; $out[] = $wk01c;
	if (isset($wk02blocks)) $wk02c = ($blockcount - $wk02blocks); else $wk02c = 0; $out[] = $wk02c;
	if (isset($wk03blocks)) $wk03c = ($blockcount - $wk03blocks); else $wk03c = 0; $out[] = $wk03c;
	if (isset($wk04blocks)) $wk04c = ($blockcount - $wk04blocks); else $wk04c = 0; $out[] = $wk04c;
	if (isset($wk08blocks)) $wk08c = ($blockcount - $wk08blocks); else $wk08c = 0; $out[] = $wk08c;
	if (isset($wk16blocks)) $wk16c = ($blockcount - $wk16blocks); else $wk16c = 0; $out[] = $wk16c;
	if (isset($wk32blocks)) $wk32c = ($blockcount - $wk32blocks); else $wk32c = 0; $out[] = $wk32c;
	if (isset($yr1blocks)) $yr1c = ($blockcount - $yr1blocks); else $yr1c = 0; $out[] = $yr1c;
	echo json_encode($out);
?>