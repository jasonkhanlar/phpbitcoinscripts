<?
	require_once 'jsonRPCClient.php';
	$data=new jsonRPCClient('http://user:pass@127.0.0.1:8332');
	if ($rpctry) { try { $data->getblockcount(); } catch (Exception $e) { echo "Sorry!  Bitcoin server is down."; exit; } }
?>
