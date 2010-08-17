<?
	$rpctry=true; include("rpc.php");
	$blockcount = $data->getblockcount();
	$donated = $data->getreceivedbylabel("nullvoid.org/bitcoin") + $data->getreceivedbylabel("Bitcoin Forum Sig");
?><!DOCTYPE html><html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <link href="main.css" media="screen" rel="stylesheet" type="text/css" /> 
  <script src="jquery-1.4.2.min.js" type="text/javascript"></script>
  <title>Bitcoin</title>
  </head>
 <body>
  <div class="container container_12 page">
   <div class="grid_12">
	<div class="grid_3 alpha var">date</div><div class="grid_4 omega val" id="getdate"><a href="getdate.php"><? echo date("r"); ?></a></div>
	<div class="grid_1 alpha var">timestamp</div><div class="grid_1 omega val" id="gettimestamp"><a href="gettimestamp.php"><? echo time(); ?></a></div>
   </div>
   <div class="grid_12">
	<div class="grid_6 alpha var">total bitcoins</div><div class="grid_6 omega val" id="gettotalbitcoins"><a href="gettotalbitcoins.php"><? include "gettotalbitcoins.php"; ?></a></div>
   </div>
   <div class="grid_4"><div class="section2">
	<div class="header" style="background-color: #000000;"><a href="getlast.php">Blocks</a></div>
	<div class="grid_1 alpha var">1min</div><div class="grid_3 omega val" id="1min">0</div>
	<div class="grid_1 alpha var">2mins</div><div class="grid_3 omega val" id="2mins">0</div>
	<div class="grid_1 alpha var">3mins</div><div class="grid_3 omega val" id="3mins">0</div>
	<div class="grid_1 alpha var">4mins</div><div class="grid_3 omega val" id="4mins">0</div>
	<div class="grid_1 alpha var">5mins</div><div class="grid_3 omega val" id="5mins">0</div>
	<div class="grid_1 alpha var">10mins</div><div class="grid_3 omega val" id="10mins">0</div>
	<div class="grid_1 alpha var">20mins</div><div class="grid_3 omega val" id="20mins">0</div>
	<div class="grid_1 alpha var">30mins</div><div class="grid_3 omega val" id="30mins">0</div>
	<div class="grid_1 alpha var">40mins</div><div class="grid_3 omega val" id="40mins">0</div>
	<div class="grid_1 alpha var">50mins</div><div class="grid_3 omega val" id="50mins">0</div>
	<div class="grid_1 alpha var">1hr</div><div class="grid_3 omega val" id="1hr">0</div>
	<div class="grid_1 alpha var">2hrs</div><div class="grid_1 omega val" id="2hrs">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="2hrsa">0</div>
	<div class="grid_1 alpha var">3hrs</div><div class="grid_1 omega val" id="3hrs">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="3hrsa">0</div>
	<div class="grid_1 alpha var">4hrs</div><div class="grid_1 omega val" id="4hrs">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="4hrsa">0</div>
	<div class="grid_1 alpha var">5hrs</div><div class="grid_1 omega val" id="5hrs">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="5hrsa">0</div>
	<div class="grid_1 alpha var">6hrs</div><div class="grid_1 omega val" id="6hrs">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="6hrsa">0</div>
	<div class="grid_1 alpha var">12hrs</div><div class="grid_1 omega val" id="12hrs">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="12hrsa">0</div>
	<div class="grid_1 alpha var">1day</div><div class="grid_1 omega val" id="1day">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="1daya">0</div>
	<div class="grid_1 alpha var">2days</div><div class="grid_1 omega val" id="2days">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="2daysa">0</div>
	<div class="grid_1 alpha var">3days</div><div class="grid_1 omega val" id="3days">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="3daysa">0</div>
	<div class="grid_1 alpha var">4days</div><div class="grid_1 omega val" id="4days">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="4daysa">0</div>
	<div class="grid_1 alpha var">5days</div><div class="grid_1 omega val" id="5days">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="5daysa">0</div>
	<div class="grid_1 alpha var">6days</div><div class="grid_1 omega val" id="6days">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="6daysa">0</div>
	<div class="grid_1 alpha var">1wk</div><div class="grid_1 omega val" id="1wk">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="1wka">0</div>
	<div class="grid_1 alpha var">2wks</div><div class="grid_1 omega val" id="2wks">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="2wksa">0</div>
	<div class="grid_1 alpha var">3wks</div><div class="grid_1 omega val" id="3wks">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="3wksa">0</div>
	<div class="grid_1 alpha var">4wks</div><div class="grid_1 omega val" id="4wks">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="4wksa">0</div>
	<div class="grid_1 alpha var">8wks</div><div class="grid_1 omega val" id="8wks">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="8wksa">0</div>
	<div class="grid_1 alpha var">16wks</div><div class="grid_1 omega val" id="16wks">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="16wksa">0</div>
	<div class="grid_1 alpha var">32wks</div><div class="grid_1 omega val" id="32wks">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="32wksa">0</div>
	<div class="grid_1 alpha var">1yr</div><div class="grid_1 omega val" id="1yr">0</div><div class="grid_1 alpha var">hr avg</div><div class="grid_1 omega val" id="1yra">0</div>
   </div></div>
   <div class="grid_8"><div class="section">
	<div class="header">Stats</div>
	<div class="grid_1 alpha var">current block</div><div class="grid_1 omega val" id="getblockcount"><br><a href="getblockcount.php"><? include "getblockcount.php"; ?></a></div>
	<div class="grid_1 alpha var">new diff. in</div><div class="grid_2 omega val" id="getdifficultyin"><br><a href="getdifficultyin.php"><? include "getdifficultyin.php"; ?> blocks</a></div>
	<div class="grid_1 alpha var">new diff. at</div><div class="grid_2 omega val" id="getdifficultyat"><br><a href="getdifficultyat.php"><? include "getdifficultyat.php"; ?> blocks</a></div>
   </div>
   <div class="grid_8"><div class="section">
	<div class="grid_2 alpha var">difficulty</div><div class="grid_6 omega val" id="getdifficulty"><a href="getdifficulty.php"><? include "getdifficulty.php"; ?></a></div>
	<div class="grid_2 alpha var">hash target</div><div class="grid_6 omega val" id="gethashtarget"><a href="gethashtarget.php"><? include "gethashtarget.php"; ?></a></div>
   </div></div>
   <div class="grid_8"><div class="section">
	<div class="header">Markets</div>
	<div class="grid_2 alpha varl">Site / Market</div>
	<div class="grid_1 alpha var">Bid</div>
	<div class="grid_1 alpha var">Ask</div>
	<div class="grid_1 alpha var">Last</div>
	<div class="grid_1 alpha var">Low</div>
	<div class="grid_1 alpha var">High</div>
	<div class="grid_1 alpha var">24hr Vol.</div>
	<div class="grid_2 alpha val">BCM / LR USD</div><div class="grid_1 alpha valr" id="getmarketbcmLibertyReserveUSDbid">0</div><div class="grid_1 alpha valr" id="getmarketbcmLibertyReserveUSDask">0</div><div class="grid_1 alpha valr" id="getmarketbcmLibertyReserveUSDlast">0</div><div class="grid_1 alpha valr" id="getmarketbcmLibertyReserveUSDlow">0</div><div class="grid_1 alpha valr" id="getmarketbcmLibertyReserveUSDhigh">0</div><div class="grid_1 alpha valr" id="getmarketbcmLibertyReserveUSDvol">0</div>
	<div class="grid_2 alpha val">BCM / MB USD</div><div class="grid_1 alpha valr" id="getmarketbcmMoneyBookersUSDbid">0</div><div class="grid_1 alpha valr" id="getmarketbcmMoneyBookersUSDask">0</div><div class="grid_1 alpha valr" id="getmarketbcmMoneyBookersUSDlast">0</div><div class="grid_1 alpha valr" id="getmarketbcmMoneyBookersUSDlow">0</div><div class="grid_1 alpha valr" id="getmarketbcmMoneyBookersUSDhigh">0</div><div class="grid_1 alpha valr" id="getmarketbcmMoneyBookersUSDvol">0</div>
	<div class="grid_2 alpha val">BCM / PayPal USD</div><div class="grid_1 alpha valr" id="getmarketbcmPayPalUSDbid">0</div><div class="grid_1 alpha valr" id="getmarketbcmPayPalUSDask">0</div><div class="grid_1 alpha valr" id="getmarketbcmPayPalUSDlast">0</div><div class="grid_1 alpha valr" id="getmarketbcmPayPalUSDlow">0</div><div class="grid_1 alpha valr" id="getmarketbcmPayPalUSDhigh">0</div><div class="grid_1 alpha valr" id="getmarketbcmPayPalUSDvol">0</div>
	<div class="grid_2 alpha val">BCM / Pecunix GAU</div><div class="grid_1 alpha valr" id="getmarketbcmPecunixGAUbid">0</div><div class="grid_1 alpha valr" id="getmarketbcmPecunixGAUask">0</div><div class="grid_1 alpha valr" id="getmarketbcmPecunixGAUlast">0</div><div class="grid_1 alpha valr" id="getmarketbcmPecunixGAUlow">0</div><div class="grid_1 alpha valr" id="getmarketbcmPecunixGAUhigh">0</div><div class="grid_1 alpha valr" id="getmarketbcmPecunixGAUvol">0</div>
	<div class="grid_2 alpha val">MtGox / PayPal USD</div><div class="grid_1 alpha valr" id="getmarketmtgoxUSDbuy">0</div><div class="grid_1 alpha valr" id="getmarketmtgoxUSDsell">0</div><div class="grid_1 alpha valr" id="getmarketmtgoxUSDlast">0</div><div class="grid_1 alpha valr" id="getmarketmtgoxUSDlow">0</div><div class="grid_1 alpha valr" id="getmarketmtgoxUSDhigh">0</div><div class="grid_1 alpha valr" id="getmarketmtgoxUSDvol">0</div>
   </div></div>
   <div class="grid_8"><div class="section">
	<div class="header">Buy / Sell</div>
	<div class="grid_8 alpha varl"><? include("bcbuy.php"); ?></div>
	<div class="grid_8 alpha varl"><? include("bcsell.php"); ?></div>
   </div></div>
   <div class="grid_2"><div class="section">
	<div class="header">Links</div>
	<a href="difficultiez.php">difficulties</a><br>
	<a href="donate.php?d">donate</a> rcvd <span class="val" id="getdonated"><? echo $donated; ?></span><br>
	flot<br>
	&nbsp;&nbsp;<a href="flot/blocks.php?l=1000">blocks</a> (<small><small><a href="flot/blocks.php?s=<? echo $blockcount - 1000; ?>">last 1000</a>, <a href="flot/blocks.php?s=<? echo $blockcount - 100; ?>">last 100</a></small></small>)<br>
	&nbsp;&nbsp;<a href="flot/mtgox.php">mt. gox</a><br>
	<a href="gnuplot/anim">gnuplot</a><br>
	<a href="statistix.php">statistix</a><br>
   </div></div>
   <script>
	function getlast() {
		$.ajax({ url: 'getlast.php', success: function(data) {
			var data = eval(data);
			$("#1min").html(data.slice(0,1)+"");
			$("#2mins").html(data.slice(1,2)+"");
			$("#3mins").html(data.slice(2,3)+"");
			$("#4mins").html(data.slice(3,4)+"");
			$("#5mins").html(data.slice(4,5)+"");
			$("#10mins").html(data.slice(5,6)+"");
			$("#20mins").html(data.slice(6,7)+"");
			$("#30mins").html(data.slice(7,8)+"");
			$("#40mins").html(data.slice(8,9)+"");
			$("#50mins").html(data.slice(9,10)+"");
			$("#1hr").html(data.slice(10,11)+"");
			$("#2hrs").html(data.slice(11,12)+"");$("#2hrsa").html(Math.floor(data.slice(11,12)/2));
			$("#3hrs").html(data.slice(12,13)+"");$("#3hrsa").html(Math.floor(data.slice(12,13)/3));
			$("#4hrs").html(data.slice(13,14)+"");$("#4hrsa").html(Math.floor(data.slice(13,14)/4));
			$("#5hrs").html(data.slice(14,15)+"");$("#5hrsa").html(Math.floor(data.slice(14,15)/5));
			$("#6hrs").html(data.slice(15,16)+"");$("#6hrsa").html(Math.floor(data.slice(15,16)/6));
			$("#12hrs").html(data.slice(16,17)+"");$("#12hrsa").html(Math.floor(data.slice(16,17)/12));
			$("#1day").html(data.slice(17,18)+"");$("#1daya").html(Math.floor(data.slice(17,18)/24));
			$("#2days").html(data.slice(18,19)+"");$("#2daysa").html(Math.floor(data.slice(18,19)/48));
			$("#3days").html(data.slice(19,20)+"");$("#3daysa").html(Math.floor(data.slice(19,20)/72));
			$("#4days").html(data.slice(20,21)+"");$("#4daysa").html(Math.floor(data.slice(20,21)/96));
			$("#5days").html(data.slice(21,22)+"");$("#5daysa").html(Math.floor(data.slice(21,22)/120));
			$("#6days").html(data.slice(22,23)+"");$("#6daysa").html(Math.floor(data.slice(22,23)/140));
			$("#1wk").html(data.slice(23,24)+"");$("#1wka").html(Math.floor(data.slice(23,24)/168));
			$("#2wks").html(data.slice(24,25)+"");$("#2wksa").html(Math.floor(data.slice(24,25)/336));
			$("#3wks").html(data.slice(25,26)+"");$("#3wksa").html(Math.floor(data.slice(25,26)/504));
			$("#4wks").html(data.slice(26,27)+"");$("#4wksa").html(Math.floor(data.slice(26,27)/672));
			$("#8wks").html(data.slice(27,28)+"");$("#8wksa").html(Math.floor(data.slice(27,28)/1344));
			$("#16wks").html(data.slice(28,29)+"");$("#16wksa").html(Math.floor(data.slice(28,29)/2688));
			$("#32wks").html(data.slice(29,30)+"");$("#32wksa").html(Math.floor(data.slice(29,30)/5376));
			$("#1yr").html(data.slice(30,31)+"");$("#1yra").html(Math.floor(data.slice(30,31)/8760));
		} });
	}
	function getmarkets() {
		$.ajax({ url: 'getmarketdata.php', success: function(data) { 
		var mdata = eval("("+data+")");
		var currencies = ["MoneyBookersUSD", "PecunixGAU", "PayPalUSD", "LibertyReserveUSD"];
		var types = ["ask", "bid", "last", "vol", "high", "low"];
		for (var i = 0; i < currencies.length; i++) {
			for (var j = 0; j < types.length; j++) {
				$("#getmarketbcm"+currencies[i]+types[j]).html(mdata.bitcoinmarket[currencies[i]][types[j]]+"");
			}
		}
		var types = ["buy", "sell", "last", "vol", "high", "low"];
		for (var j = 0; j < types.length; j++) {
				$("#getmarketmtgoxUSD"+types[j]).html(mdata.mtgox.USD[types[j]]+"");
			}		
		} });
	}
	function upd1() {
		$.ajax({ url: 'getdate.php', success: function(data) { $('#getdate').html("<a href=\"getdate.php\">"+data+"</a>"); } });
		$.ajax({ url: 'gettimestamp.php', success: function(data) { $('#gettimestamp').html("<a href=\"gettimestamp.php\">"+data+"</a>"); } });
	}
	function upd30() {
		$.ajax({ url: 'getblockcount.php', success: function(data) { $('#getblockcount').html("<br><a href=\"getblockcount.php\">"+data+"</a>"); } });
		$.ajax({ url: 'getdifficulty.php', success: function(data) { $('#getdifficulty').html("<a href=\"getdifficulty.php\">"+data+"</a>"); } });
		$.ajax({ url: 'getdifficultyat.php', success: function(data) { $('#getdifficultyat').html("<br><a href=\"getdifficultyat.php\">"+data+" blocks</a>"); } });
		$.ajax({ url: 'getdifficultyin.php', success: function(data) { $('#getdifficultyin').html("<br><a href=\"getdifficultyin.php\">"+data+((data == 1) ? " block" : " blocks")+"</a>"); } });
		$.ajax({ url: 'getdonated.php', success: function(data) { $('#getdonated').html(data+""); } });
		$.ajax({ url: 'gethashtarget.php', success: function(data) { $('#gethashtarget').html("<a href=\"gethashtarget.php\">"+data+"</a>"); } });
		$.ajax({ url: 'gettotalbitcoins.php', success: function(data) { $('#gettotalbitcoins').html("<a href=\"gettotalbitcoins.php\">"+data+"</a>"); } });
		getlast();
	}
	function upd60() {
		getmarkets();
	}
	$(window).load(function () {
		upd1(); setInterval(upd1, 1000);
		getlast(); setInterval(upd30, 30000);
		upd60(); setInterval(upd60, 60000);
	});	
   </script>
  </body>
</html>