<?
	header("Content-type: text/plain");
	$rpctry=true; include("rpc.php");
	$blockcount = intval($data->getblockcount());
	echo $blockcount;
?>
