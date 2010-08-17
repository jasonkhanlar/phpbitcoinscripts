<?
	header("Content-type: text/plain");
	$rpctry=true; include("rpc.php");
	$blockcount = $data->getblockcount();
	$b = $blockcount;
	if (isset($_GET["s"])) $s = $_GET["s"]; else $s = 64;
	bcscale($s);
	if ($s <= 64 && $b > 45990000) $b = 45990000;
	$c = 50; $t = 0;
	while ($b > 210000) {
		$b -= 210000;
		$t = bcadd($t,bcmul(210000,$c));
		$c = bcdiv($c,2);
	}
	if ($b > 0) $t = bcadd($t,bcmul($b,$c));
	if (strpos($t, ".") !== false) {
		while (substr($t, -1) == "0") $t = substr($t, 0, -1);
		if (substr($t, -1) == ".") $t = substr($t, 0, -1);
	}
	echo $t;
?>
