<?
	header("Content-type: text/plain");
	$rpctry=true; include("rpc.php");
	$blockcount = intval($data->getblockcount());
	echo $blockcount + 2016 - $blockcount % 2016;
?>
