<?
	error_reporting(-1); ini_set('display_errors', 1);
	date_default_timezone_set("America/Chicago");
	ini_set('default_socket_timeout', 29);
	$i = (isset($_GET["i"])) ? $_GET["i"] : "";
	$q = (isset($_GET["q"])) ? $_GET["q"] : false;
	$qu = strtoupper($q);
	if ($q !== false) {
		function shortnum($n) { if (strpos($n, ".") !== false) { while (substr($n, -1) == "0") $n = substr($n, 0, strlen($n) - 1); } if (substr($n, -1) == ".") $n = substr($n, 0, strlen($n) - 1); return $n; }
		$asks = array(); $bids = array();

		// BitcoinMarket.com
			$data = file("markets/bitcoinmarket/data.ASK.PayPalUSD.csv", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
			foreach ($data as $key => $value) {
				$date = strtok($value, ",");
				$price = strtok(",");
				$quantity = strtok(",");
				if ($date != "datetime") {
					//echo "$date,        $price,           $quantity\n";
					$asks["market"][] = "bcm";
					$asks["price"][] = $price;
					$asks["quantity"][] = $quantity;
				}
			}
			
		// Mt. Gox
			$data = json_decode(implode("", file("markets/mtgox/data.active", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)), true);
			foreach ($data["asks"] as $key => $value) {
				$price = $value[0];
				$quantity = $value[1];
				//echo "$price,           $quantity\n";
				$asks["market"][] = "mtgox";
				$asks["price"][] = $price;
				$asks["quantity"][] = $quantity;
			}

		array_multisort($asks["price"], $asks["quantity"], $asks["market"]);
		header("Content-type: text/plain");
		if (preg_match("/^(\\$|US\\$|USD|USD\\$)([0-9.]*)$/i", $qu, $matches)) {
			$amount = $matches[2];
			if (is_numeric($amount)) {
				$bitcoins = 0; $money = $amount; $out = "";
				foreach ($asks["market"] as $key => $value) {
					//echo "money($money) bitcoins($bitcoins) out($out) spent(".($amount-$money).")\n";
					if ($asks["quantity"][$key] * $asks["price"][$key] <= $money) {
						$bitcoins += $asks["quantity"][$key];
						$out .= "\$".shortnum($asks["price"][$key])." each for BTC".$asks["quantity"][$key]." (\$".($asks["price"][$key] * $asks["quantity"][$key]).") at ".$asks["market"][$key];
						if ($i == "irc") $out .= ".  "; else $out .= ".\n";
						$money -= $asks["quantity"][$key] * $asks["price"][$key];
					}
					else if ($asks["quantity"][$key] * $asks["price"][$key] > $money) {
						$count = 0;
						while ($money > 0) {
							$count++;
							$money -= $asks["price"][$key];
				//echo "2 money($money) bitcoins($bitcoins) out(\$".shortnum($asks["price"][$key])." each for BTC$count (\$".($asks["price"][$key] * $count).") at ".$asks["market"][$key].".  ) spent(".($amount-$money).")\n";
						}
						$bitcoins += --$count; $money += $asks["price"][$key];
						$out .= "\$".shortnum($asks["price"][$key])." each for BTC$count (\$".($asks["price"][$key] * $count).") at ".$asks["market"][$key];
						if ($i == "irc") $out .= ".  "; else $out .= ".\n";
						break;
					}
					//if (isset($_GET["d"])) {
					//echo $asks["market"][$key]." ";
					//echo $asks["price"][$key]." ";
					//echo $asks["quantity"][$key]."\n";
					//}
					if ($money <= 0) break;
				}
				echo $out."Total cost for \$".($amount - $money)." is BTC$bitcoins";
			}
			else if ($i == "irc") echo "I do not understand \"$q.\"";
		}
		else if (preg_match("/^(BC|BT|BTC) *([0-9.]*)$/i", $qu, $matches)) {
			$amount = $matches[2];
			if (is_numeric($amount)) {
				$out = ""; $price = 0; $rem = $amount; $total = 0;
				foreach ($asks["market"] as $key => $value) {
					if ($asks["quantity"][$key] < $rem) {
						$price += $asks["price"][$key] * $asks["quantity"][$key]; $total += $asks["quantity"][$key];
						$out .= "\$".shortnum($asks["price"][$key])." each for BTC".$asks["quantity"][$key]." (\$".($asks["price"][$key] * $asks["quantity"][$key]).") at ".$asks["market"][$key];
						if ($i == "irc") $out .= ".  "; else $out .= ".\n";
						$rem -= $asks["quantity"][$key];
					}
					else if ($asks["quantity"][$key] >= $rem) {
						$price += $asks["price"][$key] * $rem; $total += $rem;
						$out .= "\$".shortnum($asks["price"][$key])." each for BTC$rem (\$".($asks["price"][$key] * $rem).") at ".$asks["market"][$key];
						if ($i == "irc") $out .= ".  "; else $out .= ".\n";
						$rem = 0;
					}
					if ($rem == 0) break;
				}
				echo $out."Total cost for BTC$total is \$$price";
			}
			else if ($i == "irc") echo "I do not understand \"$q.\"";
		}
		else if (preg_match("/^([0-9.]*) *(BC|BCT|BCTS|BITCOIN|BITCOINS|BT|BTC|BTCS)$/i", $qu, $matches)) {
			$amount = $matches[1];
			if (is_numeric($amount)) {
				$out = ""; $price = 0; $rem = $amount; $total = 0;
				foreach ($asks["market"] as $key => $value) {
					if ($asks["quantity"][$key] < $rem) {
						$price += $asks["price"][$key] * $asks["quantity"][$key]; $total += $asks["quantity"][$key];
						$out .= "\$".shortnum($asks["price"][$key])." each for BTC".$asks["quantity"][$key]." (\$".($asks["price"][$key] * $asks["quantity"][$key]).") at ".$asks["market"][$key];
						if ($i == "irc") $out .= ".  "; else $out .= ".\n";
						$rem -= $asks["quantity"][$key];
					}
					else if ($asks["quantity"][$key] >= $rem) {
						$price += $asks["price"][$key] * $rem; $total += $rem;
						$out .= "\$".shortnum($asks["price"][$key])." each for BTC$rem (\$".($asks["price"][$key] * $rem).") at ".$asks["market"][$key];
						if ($i == "irc") $out .= ".  "; else $out .= ".\n";
						$rem = 0;
					}
					if ($rem == 0) break;
				}
				echo $out."Total cost for BTC$total is \$$price";
			}
			else if ($i == "irc") echo "I do not understand \"$q.\"";
		}
		else if ($i == "irc") echo "I do not understand \"$q.\"";
	} else {
?>Buy: <input id="inputbuy" type="text"> (Input in USD, $, BTC or Bitcoins)
  <pre id="outputbuy" style="max-height: 200px; overflow: auto;"></pre>
  <script type="text/javascript">
	$("#inputbuy").focus();
	$("#inputbuy").keyup(function() {
		var url = "bcbuy.php?q="+encodeURIComponent($("#inputbuy").val());
		$.get(url, function(data) {
			if (data.length > 0) $('#outputbuy').html(data);
			else $('#outputbuy').html("");
		});
	});
  </script>
<?
	}
?>