<?
	error_reporting(-1); ini_set('display_errors', 1);
	date_default_timezone_set("America/Chicago");
	header("Content-type: text/plain");
	ini_set('default_socket_timeout', 29);
	// BitcoinMarket.com
		$data = json_decode(implode("", file("markets/bitcoinmarket/fxchange.quote.json.alt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));
		$exchanges = array();
		// MoneyBookersUSD, PecunixGAU, PayPalUSD, LibertyReserveUSD
		foreach ($data as $key => $value) {
			$exchanges["bitcoinmarket"][$data[$key]->currency]["ask"] = $data[$key]->ask;
			$exchanges["bitcoinmarket"][$data[$key]->currency]["bid"] = $data[$key]->bid;
			$exchanges["bitcoinmarket"][$data[$key]->currency]["datetime[CST]"] = $data[$key]->{'datetime[CST]'};
			//$exchanges["bitcoinmarket"][$data[$key]->currency]["lastTradedPrice"] = $data[$key]->lastTradedPrice;
			$exchanges["bitcoinmarket"][$data[$key]->currency]["last"] = $data[$key]->lastTradedPrice;
			//$exchanges["bitcoinmarket"][$data[$key]->currency]["lastTradedQuantity"] = $data[$key]->lastTradedQuantity;
			$exchanges["bitcoinmarket"][$data[$key]->currency]["vol"] = $data[$key]->lastTradedQuantity;
		}
		
		$currencies = array("MoneyBookersUSD", "PecunixGAU", "PayPalUSD", "LibertyReserveUSD");
		foreach ($currencies as $currency) {
			$tradelines = file("markets/bitcoinmarket/TRADE.$currency.csv", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
			$vol = 0; $high = 0; $low = 999999999;
			foreach ($tradelines as $tradeline) {
				$tradelinedate = strtok($tradeline, ",");
				$tradelineprice = strtok(",");
				$tradelinevol = strtok(",");
				$tradelinestatus = strtok(",");
				if ($tradelinedate != "datetime") {
					if (strtotime($tradelinedate) >= (time() - 60 * 60 * 24)) {
						$vol += $tradelinevol;
						if ($tradelineprice > $high) $high = $tradelineprice;
						if ($tradelineprice < $low) $low = $tradelineprice;
					}
				}
			}			
			$exchanges["bitcoinmarket"][$currency]["high"] = $high;
			$exchanges["bitcoinmarket"][$currency]["low"] = $low;
			$exchanges["bitcoinmarket"][$currency]["vol"] = $vol;
		}
		
	// Mt. Gox
		$data = implode("", file("markets/mtgox/data.ticker"));
		if (isset($data) && $data != "") {
			$data = json_decode($data, true);
			$exchanges["mtgox"]["USD"]["high"] = $data["ticker"]["high"];
			$exchanges["mtgox"]["USD"]["low"]  = $data["ticker"]["low"];
			$exchanges["mtgox"]["USD"]["vol"]  = $data["ticker"]["vol"];
			$exchanges["mtgox"]["USD"]["buy"] = $data["ticker"]["buy"];
			$exchanges["mtgox"]["USD"]["sell"] = $data["ticker"]["sell"];
			$exchanges["mtgox"]["USD"]["last"] = $data["ticker"]["last"];
		}
	// Out
	//var_dump($exchanges);
	//var_dump($exchanges["bitcoinmarket"]);
	//var_dump($exchanges["mtgox"]);
	echo json_encode($exchanges);
?>