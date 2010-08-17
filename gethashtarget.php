<?
	header("Content-type: text/plain");
//	$rpctry=true; include("rpc.php");
//	$difficulty = floatval($data->getdifficulty());

	//     $a      /         $b
	// (2^256 - 1) / (2^32 * difficulty)

//	bcscale(256);

//	$a = bcsub(bcpow(2,256),1);
	//$a = gmp_strval(gmp_sub(gmp_pow(2,256),1));

//	$b = bcmul(bcpow(2,32),$difficulty);
	//$b = pow(2,32) * $difficulty;

//	bcscale(0);

//	$target = bcdiv($a,$b);
	//$target = gmp_strval(gmp_div($a,$b));
	//$target = bcdiv($a,$b);
	//$target = "148504231478890412392775945444335243545681910455595839046778120430";
	//$target = "148504231478000000000000000000000000000000000000000000000000000000";
	//$target = "148501965484000000000000000000000000000000000000000000000000000000";

	//000000000168fd00000000000000000000000000000000000000000000000000
	//         168fcfffffee48119ddbfdc811138960d70605cc300000000000000

//	$targethex = gmp_strval(gmp_sub($target,0),16);

//	echo $targethex;
	function bcdechex($dec, $digits = false) {
		$hex = '';
		$positive = $dec < 0 ? false : true;

		while ($dec) {
			$hex .= dechex(abs(bcmod($dec, '16')));
			$dec = bcdiv($dec, '16', 0);
		}
		if ($digits) {
			while(strlen($hex) < $digits)
			$hex .= '0';
		}

		if ($positive)
		return strrev($hex);

		for ($i = 0; $isset($hex[$i]); $i++) $hex[$i] = dechex(15 - hexdec($hex[$i]));
		for ($i = 0; isset($hex[$i]) && $hex[$i] == 'f'; $i++) $hex[$i] = '0';
		if (isset($hex[$i])) $hex[$i] = dechex(hexdec($hex[$i]) + 1);
		return strrev($hex);
	}
	function uint256_from_compact($c) {
		$nbytes = ($c >> 24) & 0xFF;
		return bcmul($c & 0xFFFFFF,bcpow(2,8 * ($nbytes - 3)));
	}
	unset($data);while (!isset($data) || $data == "") { $data = file("blockdata", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); sleep(0.1); }
	array_pop($data);
	$last = array_pop($data);
	strtok($last, " ");
	strtok(" ");
	strtok(" ");
	$data = strtok(" ");
	echo "0x".bcdechex(uint256_from_compact($data));
?>