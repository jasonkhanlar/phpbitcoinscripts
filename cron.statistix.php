<?
	error_reporting(-1); ini_set('display_errors', 1);
	date_default_timezone_set("America/Chicago");
	$rpctry=true; include("rpc.php");
	$blockcount = $data->getblockcount();
	$now = date("U");

	$blockfile = "blockdata";
	$data = file($blockfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); array_pop($data);
	$gpdata = file("gnuplot.data", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	//echo strtok($data[count($data) - 1], " ")." == ".strtok($gpdata[count($gpdata) - 1], " ");exit;
	if (isset($gpdata[0]) && strtok($data[count($data) - 1], " ") != strtok($gpdata[count($gpdata) - 1], " ") || isset($_GET["d"])) {
		foreach ($data as $line) {
			$blocks = strtok($line, " ");
			$date = strtok(" ");
		}
		$data = array_reverse($data);
		$lastblocknum = trim($blocks); $lastblock = $lastblocknum . str_repeat(" ", 12 - strlen($lastblocknum));
		$block = array();
		foreach ($data as $line) {
			$blocks = strtok($line, " ");
			$date = strtok(" ");
			if ($now < $date) $date = $now;
			$block[$blocks] = $date;
		}

		$block = array_reverse($block);
		$acc10 = 0;$acc100 = 0;$acc1000 = 0;$acc10000 = 0;$highAll = 0;$high1000 = 0;$high100 = 0;$high10 = 0;
		$handle = fopen("gnuplot.data.new", "w");
		foreach ($block as $key => $num) {
			if (isset($block[$key-1])) {
				$secsn = $block[$key] - $block[$key-1];
				if ($secsn <= 0) $secsn = 1;
				// Thanks to ArtForz for faster algorithm than lazy painter method
				if ($key >= 1) {
					if ($key > 10) { $secsl = $block[$key - 10] - $block[$key-10-1]; if ($secsl <= 0) $secsl = 1; $acc10 = $acc10 - $secsl; }
					$acc10 = $acc10 + $secsn; if($key > 10) $avg10 = $acc10 / 10; else $avg10 = $acc10 / $key;

					if ($key > 100) { $secsl = $block[$key - 100] - $block[$key-100-1]; if ($secsl <= 0) $secsl = 1; $acc100 = $acc100 - $secsl; }
					$acc100 = $acc100 + $secsn; if($key > 100) $avg100 = $acc100 / 100; else $avg100 = $acc100 / $key;

					if ($key > 1000) { $secsl = $block[$key - 1000] - $block[$key-1000-1]; if ($secsl <= 0) $secsl = 1; $acc1000 = $acc1000 - $secsl; }
					$acc1000 = $acc1000 + $secsn; if($key > 1000) $avg1000 = $acc1000 / 1000; else $avg1000 = $acc1000 / $key;

					if ($key > 10000) { $secsl = $block[$key - 10000] - $block[$key-10000-1]; if ($secsl <= 0) $secsl = 1; $acc10000 = $acc10000 - $secsl; }
					$acc10000 = $acc10000 + $secsn; if($key > 10000) $avg10000 = $acc10000 / 10000; else $avg10000 = $acc10000 / $key;

					fwrite($handle, "$key $secsn ".($avg10)." ".($avg100)." ".($avg1000)." ".($avg10000)."\n");
				}
				else fwrite($handle, "$key $secsn\n");
				if ($secsn >= $highAll && $key != 1) $highAll = $secsn;
				if ($key >= $lastblock - 999 && $secsn >= $high1000) $high1000 = $secsn;
				if ($key >= $lastblock - 99 && $secsn >= $high100) $high100 = $secsn;
				if ($key >= $lastblock - 9 && $secsn >= $high10) $high10 = $secsn;
			}
		}
		fclose($handle);
		copy("gnuplot.data.new", "gnuplot.data");
		function gnuplot() {
			global $blockcount, $high10, $high100, $high1000, $highAll, $lastblocknum;

			$i = 10; $y = 0; $yrange = 0;
			while ($yrange == 0) {
				if ($high10 > $y) {
					$y += $i;
					if ($y == 100) $i = 25;
					else if ($y == 1000) $i = 100;
					else if ($y == 10000) $i = 1000;
					else if ($y == 100000) $i = 10000;
					else if ($y == 1000000) $i = 100000;
					else if ($y == 10000000) $i = 1000000;
					else if ($y == 100000000) $i = 10000000;
					else if ($y == 1000000000) $i = 100000000;
				}
				else $yrange = $y;
			}
			if (!isset($_GET["d"])) {
				$handle = fopen("gnuplot.10.txt", "w");
				//													bg           fg           grid      points
				//fwrite($handle, "set terminal png font mikachan 8 size 640,480 small x222222 xaaaaaa x04040 xaa0000 xffa500 x66cdaa xcdb5cd xadd8e6 x0000ff xdda0dd x9500d3\n");
				fwrite($handle, "set terminal png size 640,480 small x222222 xaaaaaa x04040 xaa1234 xffa500 x66cdaa xc366aa x0d68a9 x0000ff xdda0dd x9500d3\n");
				fwrite($handle, "set title \"        Durations for generating last 10 blocks\"\n");
				fwrite($handle, "set ylabel \"seconds\"\n");
				fwrite($handle, "set xlabel \"blocks\"\n");
				fwrite($handle, "set yrange [0:$yrange]\n");
				//fwrite($handle, "set logscale y\n");
				//http://gnuplot.sourceforge.net/demo_4.2/key.html
				//fwrite($handle, "set key off\n");
				fwrite($handle, "set key box horizon center tmargin\n");
				fwrite($handle, "set term png\n");
				fwrite($handle, "set grid\n");	
				fwrite($handle, "set tmargin 5.5\n");	
				fwrite($handle, "set output 'gnuplot.10.png'\n");
				//fwrite($handle, "plot [$lastblocknum:".($lastblocknum - 10)."] 'gnuplot.data' with dots, 'gnuplot.data' smooth bezier, ''gnuplot.data' smooth csplines\n");
				// Add expected average
				$data = "plot [".($lastblocknum - 9).":$lastblocknum] 'gnuplot.data' title \"block duration\" with points pointtype 7 pointsize 1, ";
				$data .= "'gnuplot.data' using 1:3 title \"10 block moving average\" with lines, ";
				$data .= "'gnuplot.data' using 1:4 title \"100 block moving average\" with lines, ";
				$data .= "'gnuplot.data' using 1:5 title \"1000 block moving average\" with lines, ";
				$data .= "'gnuplot.data' using 1:6 title \"10000 block moving average\" with lines\n";
				fwrite($handle, $data);
				fclose($handle);
			}

			$i = 10; $y = 0; $yrange = 0;
			while ($yrange == 0) {
				if ($high100 > $y) {
					$y += $i;
					if ($y == 100) $i = 25;
					else if ($y == 1000) $i = 100;
					else if ($y == 10000) $i = 1000;
					else if ($y == 100000) $i = 10000;
					else if ($y == 1000000) $i = 100000;
					else if ($y == 10000000) $i = 1000000;
					else if ($y == 100000000) $i = 10000000;
					else if ($y == 1000000000) $i = 100000000;
				}
				else $yrange = $y;
			}
			if (!isset($_GET["d"])) {
				$handle = fopen("gnuplot.100.txt", "w");
				//fwrite($handle, "set terminal png x222222 xaaaaaa\n");
				//													bg           fg           grid      points
				//fwrite($handle, "set terminal png font mikachan 8 size 640,480 small x222222 xaaaaaa x04040 xaa0000 xffa500 x66cdaa xcdb5cd xadd8e6 x0000ff xdda0dd x9500d3\n");
				fwrite($handle, "set terminal png size 640,480 small x222222 xaaaaaa x04040 xaa1234 xffa500 x66cdaa xc366aa x0d68a9 x0000ff xdda0dd x9500d3\n");
				fwrite($handle, "set title \"        Durations for generating last 100 blocks\"\n");
				fwrite($handle, "set ylabel \"seconds\"\n");
				fwrite($handle, "set xlabel \"blocks\"\n");
				fwrite($handle, "set yrange [0:$yrange]\n");
				//fwrite($handle, "set logscale y\n");
				//fwrite($handle, "set key off\n");
				fwrite($handle, "set key box horizon center tmargin\n");
				fwrite($handle, "set term png\n");
				fwrite($handle, "set grid\n");	
				fwrite($handle, "set tmargin 4.5\n");	
				fwrite($handle, "set output 'gnuplot.100.png'\n");
				$data = "plot [".($lastblocknum - 99).":$lastblocknum] 'gnuplot.data' title \"block duration\" with points pointtype 7 pointsize 0.5, ";
				$data .= "'gnuplot.data' using 1:4 title \"100 block moving average\" with lines, ";
				$data .= "'gnuplot.data' using 1:5 title \"1000 block moving average\" with lines, ";
				$data .= "'gnuplot.data' using 1:6 title \"10000 block moving average\" with lines\n";
				fwrite($handle, $data);
				fclose($handle);
			}

			$i = 10; $y = 0; $yrange = 0;
			while ($yrange == 0) {
				if ($high1000 > $y) {
					$y += $i;
					if ($y == 100) $i = 25;
					else if ($y == 1000) $i = 100;
					else if ($y == 10000) $i = 1000;
					else if ($y == 100000) $i = 10000;
					else if ($y == 1000000) $i = 100000;
					else if ($y == 10000000) $i = 1000000;
					else if ($y == 100000000) $i = 10000000;
					else if ($y == 1000000000) $i = 100000000;
				}
				else $yrange = $y;
			}
			if (!isset($_GET["d"])) {
				$handle = fopen("gnuplot.1000.txt", "w");
				//													bg           fg           grid      points
				//fwrite($handle, "set terminal png font mikachan 8 size 640,480 small x222222 xaaaaaa x04040 xaa0000 xffa500 x66cdaa xcdb5cd xadd8e6 x0000ff xdda0dd x9500d3\n");
				fwrite($handle, "set terminal png size 640,480 small x222222 xaaaaaa x04040 xaa1234 xffa500 x66cdaa xc366aa x0d68a9 x0000ff xdda0dd x9500d3\n");
				fwrite($handle, "set title \"        Durations for generating last 1,000 blocks\"\n");
				fwrite($handle, "set ylabel \"seconds\"\n");
				fwrite($handle, "set xlabel \"blocks\"\n");
				fwrite($handle, "set yrange [0:$yrange]\n");
				//fwrite($handle, "set logscale y\n");
				//fwrite($handle, "set key off\n");
				fwrite($handle, "set key box horizon center tmargin\n");
				fwrite($handle, "set term png\n");
				fwrite($handle, "set grid\n");	
				fwrite($handle, "set tmargin 3.5\n");	
				fwrite($handle, "set output 'gnuplot.1000.png'\n");
				$data = "plot [".($lastblocknum - 999).":$lastblocknum] 'gnuplot.data' title \"block duration\" with points pointtype 7 pointsize 0.25, ";
				$data .= "'gnuplot.data' using 1:5 title \"1,000 block moving average\" with lines\n";
				$data .= "'gnuplot.data' using 1:6 title \"10000 block moving average\" with lines\n";
				fwrite($handle, $data);
				fclose($handle);
			}

			$i = 10; $y = 0; $yrange = 0;
			while ($yrange == 0) {
				if ($highAll > $y) {
					$y += $i;
					if ($y == 100) $i = 25;
					else if ($y == 1000) $i = 100;
					else if ($y == 10000) $i = 1000;
					else if ($y == 100000) $i = 10000;
					else if ($y == 1000000) $i = 100000;
					else if ($y == 10000000) $i = 1000000;
					else if ($y == 100000000) $i = 10000000;
					else if ($y == 1000000000) $i = 100000000;
				}
				else $yrange = $y;
			}
			if (!isset($_GET["d"])) {
				$handle = fopen("gnuplot.all.txt", "w");
				//													bg           fg           grid      points
				//fwrite($handle, "set terminal png font mikachan 8 size 640,480 small x222222 xaaaaaa x04040 xaa0000 xffa500 x66cdaa xcdb5cd xadd8e6 x0000ff xdda0dd x9500d3\n");
				fwrite($handle, "set terminal png size 640,480 small x222222 xaaaaaa x04040 xaa1234 xffa500 x66cdaa xc366aa x0d68a9 x0000ff xdda0dd x9500d3\n");
				fwrite($handle, "set title \"        Durations for generating last ".number_format($blockcount)." blocks\"\n");
				fwrite($handle, "set ylabel \"seconds\"\n");
				fwrite($handle, "set xlabel \"blocks\"\n");
				fwrite($handle, "set yrange [0:$yrange]\n");
				//fwrite($handle, "set logscale y\n");
				//fwrite($handle, "set key off\n");
				fwrite($handle, "set key box horizon center tmargin\n");
				fwrite($handle, "set term png\n");
				fwrite($handle, "set grid\n");	
				fwrite($handle, "set tmargin 3.5\n");	
				fwrite($handle, "set output 'gnuplot.all.png'\n");
				//fwrite($handle, "plot [$lastblocknum:0] 'gnuplot.data' smooth csplines\n");
				$data = "plot [0:$lastblocknum] 'gnuplot.data' title \"block duration\" with dots, ";
				$data .= "'gnuplot.data' using 1:6 title \"10,000 block moving average\" with lines\n";
				fwrite($handle, $data);
				fclose($handle);
				exec("cat gnuplot.10.txt|gnuplot");
				exec("cat gnuplot.100.txt|gnuplot");
				exec("cat gnuplot.1000.txt|gnuplot");
				exec("cat gnuplot.all.txt|gnuplot");
			}
		}
		gnuplot();

//		Provided by Insti
//			# Setup some fake data
//		for ( $i = 0; $i < 5; $i++ ) {
//		    $block[$i] = $time;
//		    $time += $i;#rand( 60,1 );
//		}
//	
//		#print_r( $block );
//		for ( $key = 0; $key < 5; $key++ ) {
//		    $secsn = $block[$key] - $block[$key-1];
//		    $moving_average_buffer[] = $secsn;
//		    print "  1: ".moving_average( $moving_average_buffer, 1 )."\n";
//		    print "  2: ".moving_average( $moving_average_buffer, 2 )."\n";
//		    print "  3: ".moving_average( $moving_average_buffer, 3 )."\n";
//		}
//	
//		function moving_average( $buffer, $length ) {
//		    static $moving_average = array();
//		    $max = sizeof( $buffer )-1;
//		    $moving_average[$length] += ($buffer[$max]/$length);
//		    if ( $max-$length >= 0 ) {
//			$moving_average[$length] -= ($buffer[$max-$length]/$length);
//		    }
//		    return  $moving_average[$length];
//		}
	}
?>