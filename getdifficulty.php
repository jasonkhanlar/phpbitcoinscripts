<?
	header("Content-type: text/plain");
	$rpctry=true; include("rpc.php");
	$difficulty = floatval($data->getdifficulty());
	echo number_format($difficulty, 48);
?>
