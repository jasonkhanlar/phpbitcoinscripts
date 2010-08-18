<?
	error_reporting(-1); ini_set('display_errors', 1);
	date_default_timezone_set("America/Chicago");
	header("Content-type: text/plain");
	ini_set('default_socket_timeout', 29);
	// BitcoinMarket.com
		exec("wget --directory-prefix=markets/bitcoinmarket --no-check-certificate --output-document=markets/bitcoinmarket/fxchange.quote.json.alt https://bitcoinmarket.com/bitcoin/fxchange.quote.json.alt");
		$current = implode("", file("markets/bitcoinmarket/fxchange.quote.json.alt")); $last = implode("", file("markets/bitcoinmarket/data.fxchange.quote.json.alt"));
		$current = preg_replace("/[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9] [0-9][0-9]:[0-9][0-9]:[0-9][0-9]/", "", $current);
		$last = preg_replace("/[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9] [0-9][0-9]:[0-9][0-9]:[0-9][0-9]/", "", $current);
		if ($current != $last) {
			copy("markets/bitcoinmarket/fxchange.quote.json.alt", "markets/bitcoinmarket/data.fxchange.quote.json.alt");
			copy("markets/bitcoinmarket/fxchange.quote.json.alt", "markets/bitcoinmarket/".time().".fxchange.quote.json.alt");
		}

		// Asks
		exec("wget --directory-prefix=markets/bitcoinmarket --no-check-certificate --output-document=markets/bitcoinmarket/ASK.LibertyReserveUSD.csv https://www.bitcoinmarket.com/quotes/offers/asks/LibertyReserveUSD.csv");
		$current = implode("", file("markets/bitcoinmarket/ASK.LibertyReserveUSD.csv")); $last = implode("", file("markets/bitcoinmarket/data.ASK.LibertyReserveUSD.csv"));
		if ($current != $last) {
			copy("markets/bitcoinmarket/ASK.LibertyReserveUSD.csv", "markets/bitcoinmarket/data.ASK.LibertyReserveUSD.csv");
			copy("markets/bitcoinmarket/ASK.LibertyReserveUSD.csv", "markets/bitcoinmarket/".date("Y.m").".ASK.LibertyReserveUSD.csv");
		}

		exec("wget --directory-prefix=markets/bitcoinmarket --no-check-certificate --output-document=markets/bitcoinmarket/ASK.MoneyBookersUSD.csv https://www.bitcoinmarket.com/quotes/offers/asks/MoneyBookersUSD.csv");
		$current = implode("", file("markets/bitcoinmarket/ASK.MoneyBookersUSD.csv")); $last = implode("", file("markets/bitcoinmarket/data.ASK.MoneyBookersUSD.csv"));
		if ($current != $last) {
			copy("markets/bitcoinmarket/ASK.MoneyBookersUSD.csv", "markets/bitcoinmarket/data.ASK.MoneyBookersUSD.csv");
			copy("markets/bitcoinmarket/ASK.MoneyBookersUSD.csv", "markets/bitcoinmarket/".date("Y.m").".ASK.MoneyBookersUSD.csv");
		}

		exec("wget --directory-prefix=markets/bitcoinmarket --no-check-certificate --output-document=markets/bitcoinmarket/ASK.PayPalUSD.csv https://www.bitcoinmarket.com/quotes/offers/asks/PayPalUSD.csv");
		$current = implode("", file("markets/bitcoinmarket/ASK.PayPalUSD.csv")); $last = implode("", file("markets/bitcoinmarket/data.ASK.PayPalUSD.csv"));
		if ($current != $last) {
			copy("markets/bitcoinmarket/ASK.PayPalUSD.csv", "markets/bitcoinmarket/data.ASK.PayPalUSD.csv");
			copy("markets/bitcoinmarket/ASK.PayPalUSD.csv", "markets/bitcoinmarket/".date("Y.m").".ASK.PayPalUSD.csv");
		}

		exec("wget --directory-prefix=markets/bitcoinmarket --no-check-certificate --output-document=markets/bitcoinmarket/ASK.PecunixGAU.csv https://www.bitcoinmarket.com/quotes/offers/asks/PecunixGAU.csv");
		$current = implode("", file("markets/bitcoinmarket/ASK.PecunixGAU.csv")); $last = implode("", file("markets/bitcoinmarket/data.ASK.PecunixGAU.csv"));
		if ($current != $last) {
			copy("markets/bitcoinmarket/ASK.PecunixGAU.csv", "markets/bitcoinmarket/data.ASK.PecunixGAU.csv");
			copy("markets/bitcoinmarket/ASK.PecunixGAU.csv", "markets/bitcoinmarket/".date("Y.m").".ASK.PecunixGAU.csv");
		}

		// Bids
		exec("wget --directory-prefix=markets/bitcoinmarket --no-check-certificate --output-document=markets/bitcoinmarket/BID.LibertyReserveUSD.csv https://www.bitcoinmarket.com/quotes/offers/bids/LibertyReserveUSD.csv");
		$current = implode("", file("markets/bitcoinmarket/BID.LibertyReserveUSD.csv")); $last = implode("", file("markets/bitcoinmarket/data.BID.LibertyReserveUSD.csv"));
		if ($current != $last) {
			copy("markets/bitcoinmarket/BID.LibertyReserveUSD.csv", "markets/bitcoinmarket/data.BID.LibertyReserveUSD.csv");
			copy("markets/bitcoinmarket/BID.LibertyReserveUSD.csv", "markets/bitcoinmarket/".date("Y.m").".BID.LibertyReserveUSD.csv");
		}

		exec("wget --directory-prefix=markets/bitcoinmarket --no-check-certificate --output-document=markets/bitcoinmarket/BID.MoneyBookersUSD.csv https://www.bitcoinmarket.com/quotes/offers/bids/MoneyBookersUSD.csv");
		$current = implode("", file("markets/bitcoinmarket/BID.MoneyBookersUSD.csv")); $last = implode("", file("markets/bitcoinmarket/data.BID.MoneyBookersUSD.csv"));
		if ($current != $last) {
			copy("markets/bitcoinmarket/BID.MoneyBookersUSD.csv", "markets/bitcoinmarket/data.BID.MoneyBookersUSD.csv");
			copy("markets/bitcoinmarket/BID.MoneyBookersUSD.csv", "markets/bitcoinmarket/".date("Y.m").".BID.MoneyBookersUSD.csv");
		}

		exec("wget --directory-prefix=markets/bitcoinmarket --no-check-certificate --output-document=markets/bitcoinmarket/BID.PayPalUSD.csv https://www.bitcoinmarket.com/quotes/offers/bids/PayPalUSD.csv");
		$current = implode("", file("markets/bitcoinmarket/BID.PayPalUSD.csv")); $last = implode("", file("markets/bitcoinmarket/data.BID.PayPalUSD.csv"));
		if ($current != $last) {
			copy("markets/bitcoinmarket/BID.PayPalUSD.csv", "markets/bitcoinmarket/data.BID.PayPalUSD.csv");
			copy("markets/bitcoinmarket/BID.PayPalUSD.csv", "markets/bitcoinmarket/".date("Y.m").".BID.PayPalUSD.csv");
		}

		exec("wget --directory-prefix=markets/bitcoinmarket --no-check-certificate --output-document=markets/bitcoinmarket/BID.PecunixGAU.csv https://www.bitcoinmarket.com/quotes/offers/bids/PecunixGAU.csv");
		$current = implode("", file("markets/bitcoinmarket/BID.PecunixGAU.csv")); $last = implode("", file("markets/bitcoinmarket/data.BID.PecunixGAU.csv"));
		if ($current != $last) {
			copy("markets/bitcoinmarket/BID.PecunixGAU.csv", "markets/bitcoinmarket/data.BID.PecunixGAU.csv");
			copy("markets/bitcoinmarket/BID.PecunixGAU.csv", "markets/bitcoinmarket/".date("Y.m").".BID.PecunixGAU.csv");
		}

		// Trades
		exec("wget --directory-prefix=markets/bitcoinmarket --no-check-certificate --output-document=markets/bitcoinmarket/TRADE.LibertyReserveUSD.csv https://www.bitcoinmarket.com/quotes/trades/LibertyReserveUSD.csv");
		$current = implode("", file("markets/bitcoinmarket/TRADE.LibertyReserveUSD.csv")); $last = implode("", file("markets/bitcoinmarket/data.TRADE.LibertyReserveUSD.csv"));
		if ($current != $last) {
			copy("markets/bitcoinmarket/TRADE.LibertyReserveUSD.csv", "markets/bitcoinmarket/data.TRADE.LibertyReserveUSD.csv");
			copy("markets/bitcoinmarket/TRADE.LibertyReserveUSD.csv", "markets/bitcoinmarket/".date("Y.m").".TRADE.LibertyReserveUSD.csv");
		}

		exec("wget --directory-prefix=markets/bitcoinmarket --no-check-certificate --output-document=markets/bitcoinmarket/TRADE.MoneyBookersUSD.csv https://www.bitcoinmarket.com/quotes/trades/MoneyBookersUSD.csv");
		$current = implode("", file("markets/bitcoinmarket/TRADE.MoneyBookersUSD.csv")); $last = implode("", file("markets/bitcoinmarket/data.TRADE.MoneyBookersUSD.csv"));
		if ($current != $last) {
			copy("markets/bitcoinmarket/TRADE.MoneyBookersUSD.csv", "markets/bitcoinmarket/data.TRADE.MoneyBookersUSD.csv");
			copy("markets/bitcoinmarket/TRADE.MoneyBookersUSD.csv", "markets/bitcoinmarket/".date("Y.m").".TRADE.MoneyBookersUSD.csv");
		}

		exec("wget --directory-prefix=markets/bitcoinmarket --no-check-certificate --output-document=markets/bitcoinmarket/TRADE.PayPalUSD.csv https://www.bitcoinmarket.com/quotes/trades/PayPalUSD.csv");
		$current = implode("", file("markets/bitcoinmarket/TRADE.PayPalUSD.csv")); $last = implode("", file("markets/bitcoinmarket/data.TRADE.PayPalUSD.csv"));
		if ($current != $last) {
			copy("markets/bitcoinmarket/TRADE.PayPalUSD.csv", "markets/bitcoinmarket/data.TRADE.PayPalUSD.csv");
			copy("markets/bitcoinmarket/TRADE.PayPalUSD.csv", "markets/bitcoinmarket/".date("Y.m").".TRADE.PayPalUSD.csv");
		}

		exec("wget --directory-prefix=markets/bitcoinmarket --no-check-certificate --output-document=markets/bitcoinmarket/TRADE.PecunixGAU.csv https://www.bitcoinmarket.com/quotes/trades/PecunixGAU.csv");
		$current = implode("", file("markets/bitcoinmarket/TRADE.PecunixGAU.csv")); $last = implode("", file("markets/bitcoinmarket/data.TRADE.PecunixGAU.csv"));
		if ($current != $last) {
			copy("markets/bitcoinmarket/TRADE.PecunixGAU.csv", "markets/bitcoinmarket/data.TRADE.PecunixGAU.csv");
			copy("markets/bitcoinmarket/TRADE.PecunixGAU.csv", "markets/bitcoinmarket/".date("Y.m").".TRADE.PecunixGAU.csv");
		}

	// Mt. Gox
		exec("wget --directory-prefix=markets/mtgox --no-check-certificate --output-document=markets/mtgox/ticker https://mtgox.com/code/ticker.php");
		$current = implode("", file("markets/mtgox/ticker")); $last = implode("", file("markets/mtgox/data.ticker"));
		if ($current != $last) {
			copy("markets/mtgox/ticker", "markets/mtgox/ticker.".time());
			copy("markets/mtgox/ticker", "markets/mtgox/data.ticker");
		}

		exec("wget --directory-prefix=markets/mtgox --no-check-certificate --output-document=markets/mtgox/active http://mtgox.com/code/getDepth.php");
		$current = implode("", file("markets/mtgox/active")); $last = implode("", file("markets/mtgox/data.active"));
		if ($current != $last) {
			copy("markets/mtgox/active", "markets/mtgox/active.".time());
			copy("markets/mtgox/active", "markets/mtgox/data.active");
		}
?>