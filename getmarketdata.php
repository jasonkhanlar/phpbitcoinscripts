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
			// Total Highs, Lows, Volumes
			$vol = 0; $high = 0; $low = 999999999;
			while (!isset($tradelines) || $tradelines == "") { $tradelines = file("markets/bitcoinmarket/TRADE.$currency.csv", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); sleep(0.1); }
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
			
			// Total Outstanding Asks/Bids in BTC/Currency
			while (!isset($asklines) || $asklines == "") { $asklines = file("markets/bitcoinmarket/ASK.$currency.csv", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); sleep(0.1); }
			$asksTotalBTC = 0; $asksTotalCur = 0;
			foreach ($asklines as $askline) {
				$asklinedate = strtok($askline, ",");
				$asklineprice = strtok(",");
				$asklinevol = strtok(",");
				$asklinestatus = strtok(",");
				if ($asklinedate != "datetime") { if (strtotime($asklinedate) >= (time() - 60 * 60 * 24)) { $asksTotalBTC = $asklinevol; $asksTotalCur = $asklinevol * $asklineprice; } }
			}
			$exchanges["bitcoinmarket"][$currency]["AsksTotalBTC"] = number_format($asksTotalBTC, 2, ".", ",");
			$exchanges["bitcoinmarket"][$currency]["AsksTotalCur"] = number_format($asksTotalCur, 2, ".", ",");
			while (!isset($bidlines) || $bidlines == "") { $bidlines = file("markets/bitcoinmarket/BID.$currency.csv", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); sleep(0.1); }
			$bidsTotalBTC = 0; $bidsTotalCur = 0;
			foreach ($bidlines as $bidline) {
				$bidlinedate = strtok($bidline, ",");
				$bidlineprice = strtok(",");
				$bidlinevol = strtok(",");
				$bidlinestatus = strtok(",");
				if ($bidlinedate != "datetime") { if (strtotime($bidlinedate) >= (time() - 60 * 60 * 24)) { $bidsTotalBTC = $bidlinevol; $bidsTotalCur = $bidlinevol * $bidlineprice; } }
			}
			$exchanges["bitcoinmarket"][$currency]["BidsTotalBTC"] = number_format($bidsTotalBTC, 2, ".", ",");
			$exchanges["bitcoinmarket"][$currency]["BidsTotalCur"] = number_format($bidsTotalCur, 2, ".", ",");
		}
		
	// Mt. Gox
		unset($data); while (!isset($data) || $data == "") { $data = implode("", file("markets/mtgox/data.ticker")); sleep(0.1); }
		if (isset($data) && $data != "") {
			$data = json_decode($data, true);
			$exchanges["mtgox"]["USD"]["high"] = $data["ticker"]["high"];
			$exchanges["mtgox"]["USD"]["low"]  = $data["ticker"]["low"];
			$exchanges["mtgox"]["USD"]["vol"]  = $data["ticker"]["vol"];
			$exchanges["mtgox"]["USD"]["buy"] = $data["ticker"]["buy"];
			$exchanges["mtgox"]["USD"]["sell"] = $data["ticker"]["sell"];
			$exchanges["mtgox"]["USD"]["last"] = $data["ticker"]["last"];
		}
		unset($data); while (!isset($data) || $data == "") { $data = implode("", file("markets/mtgox/data.active")); sleep(0.1); }
		if (isset($data) && $data != "") {
			$data = json_decode($data, true);
			$asksTotalBTC = 0; $asksTotalUSD = 0;
			foreach ($data["asks"] as $v) { $asksTotalBTC += $v[1]; $asksTotalUSD += $v[1] * $v[0]; }
			$exchanges["mtgox"]["USD"]["AsksTotalBTC"] = number_format($asksTotalBTC, 2, ".", ",");
			$exchanges["mtgox"]["USD"]["AsksTotalUSD"] = number_format($asksTotalUSD, 2, ".", ",");
			$bidsTotalBTC = 0; $bidsTotalUSD = 0;
			foreach ($data["bids"] as $v) { $bidsTotalBTC += $v[1]; $bidsTotalUSD += $v[1] * $v[0]; }
			$exchanges["mtgox"]["USD"]["BidsTotalBTC"] = number_format($bidsTotalBTC, 2, ".", ",");
			$exchanges["mtgox"]["USD"]["BidsTotalUSD"] = number_format($bidsTotalUSD, 2, ".", ",");
		}
	// Out
	//var_dump($exchanges);
	//var_dump($exchanges["bitcoinmarket"]);
	//var_dump($exchanges["mtgox"]);
	echo json_encode($exchanges);
?>