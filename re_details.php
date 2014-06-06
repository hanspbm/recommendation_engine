<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>RE: Details</title>
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.1.1/css/bootstrap.min.css">
	</head>	
</html>

<?php
	include ("account.php");
	
	$memberID = $_POST['memberID'];
	
	$people = mysql_query("SELECT * FROM customers WHERE member_id='$memberID'") or die(mysql_error());
	$person = mysql_fetch_array($people);
	
	echo "<h2>Recommendation Engine: for ". $person['name'] ."</h2>";
	
	echo "	<p>
		<form method='post' action='re_main.php'>
		<input type='submit' class='btn btn-primary'  value='Back to Main Page'>
		</form>
		</p>
		
		<br>
	";

/* HAIR PART */
	echo "	
		<h3>Hair</h3>
		<p> * in total implies conflict between customer and product</p>
	";	
	
	$products = mysql_query("SELECT * FROM hair") or die(mysql_error());
	
	echo"<table class='table table-bordered'>";
	
	// show table headers NAME(ID)
	echo "<tr><th>identity</th><th> name (id)</th>";
	
	// show the rest of table headers using product table's columns
	for ($i=2; $i<26; $i++) {
		echo "<th>" . mysql_field_name($products, $i) . "</th>";
	}
	echo "<th>total</th></tr>";
	
	// show customer name and member ID
	echo "<tr class='info'><td>Customer</td><td><b>" . $person['name'] . " (" . $person['member_id'] . ")". "</b></td>";		
	
	// show customer values
	// REMEMBER: $person['straight'];
	for ($i=2; $i<26; $i++) {	
		echo "<td>" . $person[mysql_field_name($products, $i)] . "</td>";
	}
	echo "<td>-</td></tr>";
	
	$products = mysql_query("SELECT * FROM hair") or die(mysql_error());
	while($item = mysql_fetch_array( $products )) {
		
		$total = 0;
		$conflict = FALSE;
		
		echo "	<tr><td>Item</td>";
		
		// show product values
		for ($i=1; $i<26; $i++) {
			echo "<td>" . $item[mysql_field_name($products, $i)] . "</td>";
			//echo "<td>" . mysql_field_name($products, $i) . "</td>";
			
			// check for conflict for relaxed and natural
			if (mysql_field_name($products, $i) == "relaxed" || mysql_field_name($products, $i) == "natural") {
				if (($person[mysql_field_name($products, $i)] + $item[mysql_field_name($products, $i)] == 0) && $person[mysql_field_name($products, $i)] != 0) {
					$conflict = TRUE;
				}
			}
			
			// NOTE! total is added by the sum of customer and product value and is converted in absolute value
			$total = $total + abs($person[mysql_field_name($products, $i)] + $item[mysql_field_name($products, $i)]);
		}
		
		if ($conflict == TRUE) {
			echo "<td><b>$total*</b></td></tr>";
		}
		
		else {
			echo "<td><b>$total</b></td></tr>";			
		}
	}
	
	echo "</table><hr/><br>";
/* END OF HAIR PART */


/* COSMETICS PART */
	echo "	
		<h3>Cosmetics</h3>		
	";
	
	$products = mysql_query("SELECT * FROM cosmetics") or die(mysql_error());

	echo"<table class='table table-bordered'>";
	
	// show table headers NAME(ID)
	echo "<tr><th>identity</th><th>" . mysql_field_name($people, 1) . " (id)</th>";
	
	// show the rest of table headers using product table's columns
	for ($i=2; $i<50; $i++) {
		echo "<th>" . mysql_field_name($products, $i) . "</th>";
	}
	echo "<th>total</th></tr>";
	
	// show customer name and member ID
	echo "<tr class='info'><td>Customer</td><td><b>" . $person['name'] . " (" . $person['member_id'] . ")". "</b></td>";
	
	// show customer values
	// REMEMBER: $person['straight'];
	for ($i=2; $i<50; $i++) {	
		echo "<td>" . $person[mysql_field_name($products, $i)] . "</td>";
	}
	echo "<td>-</td></tr>";
	
	$products = mysql_query("SELECT * FROM cosmetics") or die(mysql_error());
	while($item = mysql_fetch_array( $products )) {
		
		$total = 0;
		$conflict = FALSE;
		
		echo "	<tr><td>Item</td>";
		
		// show product values
		for ($i=1; $i<50; $i++) {
			echo "<td>" . $item[mysql_field_name($products, $i)] . "</td>";
			//echo "<td>" . mysql_field_name($products, $i) . "</td>";
			
			// check for conflict for dry skin and oily skin
			if (mysql_field_name($products, $i) == "dry_skin" || mysql_field_name($products, $i) == "oily_skin/large_pores") {
				// REMEMBER: $person['magazines] = $item['magazines'];
				if (($person[mysql_field_name($products, $i)] + $item[mysql_field_name($products, $i)] == 0) && $person[mysql_field_name($products, $i)] != 0) {					
					$conflict = TRUE;
				}
			}
			
			// NOTE! total is added by the sum of customer and product value and is converted in absolute value
			// REMEMBER: $person['magazines] = $item['magazines'];
			$total = $total + abs($person[mysql_field_name($products, $i)] + $item[mysql_field_name($products, $i)]);
		}
		
		if ($conflict == TRUE) {
			echo "<td><b>$total*</b></td></tr>";
		}
		
		else {
			echo "<td><b>$total</b></td></tr>";			
		}
	}
	
	echo "</table><hr/><br>";
/* END OF COSMETICS PART */


/* SKIN PART */
	echo "	
		<h3>Skin</h3>		
	";
	
	$products = mysql_query("SELECT * FROM skin") or die(mysql_error());

	echo"<table class='table table-bordered'>";
	
	// show table headers NAME(ID)
	echo "<tr><th>identity</th><th>" . mysql_field_name($people, 1) . " (id)</th>";
	
	// show the rest of table headers using product table's columns
	for ($i=2; $i<35; $i++) {
		echo "<th>" . mysql_field_name($products, $i) . "</th>";
	}
	echo "<th>total</th></tr>";
	
	// show customer name and member ID
	echo "<tr class='info'><td>Customer</td><td><b>" . $person['name'] . " (" . $person['member_id'] . ")". "</b></td>";	
	
	// show customer values
	// REMEMBER: $person['straight'];
	for ($i=2; $i<35; $i++) {	
		echo "<td>" . $person[mysql_field_name($products, $i)] . "</td>";
	}
	echo "<td>-</td></tr>";
	
	$products = mysql_query("SELECT * FROM skin") or die(mysql_error());
	while($item = mysql_fetch_array( $products )) {
		
		$total = 0;
		$conflict = FALSE;
		
		echo "	<tr><td>Item</td>";
		
		// show product values
		for ($i=1; $i<35; $i++) {
			echo "<td>" . $item[mysql_field_name($products, $i)] . "</td>";
			//echo "<td>" . mysql_field_name($products, $i) . "</td>";
			
			// check for conflict for dry skin and oily skin
			if (mysql_field_name($products, $i) == "dry_skin" || mysql_field_name($products, $i) == "oily_skin/large_pores") {
				// REMEMBER: $person['magazines] = $item['magazines'];
				if (($person[mysql_field_name($products, $i)] + $item[mysql_field_name($products, $i)] == 0) && $person[mysql_field_name($products, $i)] != 0) {						
					$conflict = TRUE;
				}
			}
			
			// NOTE! total is added by the sum of customer and product value and is converted in absolute value
			// REMEMBER: $person['magazines] = $item['magazines'];
			$total = $total + abs($person[mysql_field_name($products, $i)] + $item[mysql_field_name($products, $i)]);
		}
		
		if ($conflict == TRUE) {
			echo "<td><b>$total*</b></td></tr>";
		}
		
		else {
			echo "<td><b>$total</b></td></tr>";			
		}
	}
	
	echo "</table><hr/><br>";
/* END OF SKIN PART */


/* LIFESTYLE PART */
	echo "	
		<h3>Lifestyle</h3>		
	";
	
	$products = mysql_query("SELECT * FROM lifestyle") or die(mysql_error());

	echo"<table class='table table-bordered'>";
	
	// show table headers NAME(ID)
	echo "<tr><th>identity</th><th>" . mysql_field_name($people, 1) . " (id)</th>";
	
	// show the rest of table headers using product table's columns
	for ($i=2; $i<94; $i++) {
		echo "<th>" . mysql_field_name($products, $i) . "</th>";
	}
	echo "<th>total</th></tr>";
	
	// show customer name and member ID
	echo "<tr class='info'><td>Customer</td><td><b>" . $person['name'] . " (" . $person['member_id'] . ")". "</b></td>";	
	
	// show customer values
	// REMEMBER: $person['straight'];
	for ($i=2; $i<94; $i++) {	
		echo "<td>" . $person[mysql_field_name($products, $i)] . "</td>";
	}
	echo "<td>-</td></tr>";
	
	$products = mysql_query("SELECT * FROM lifestyle") or die(mysql_error());
	while($item = mysql_fetch_array( $products )) {
		
		$total = 0;
		
		echo "<tr><td>Item</td>";
		
		// show product values
		for ($i=1; $i<94; $i++) {
			echo "<td>" . $item[mysql_field_name($products, $i)] . "</td>";
			//echo "<td>" . mysql_field_name($products, $i) . "</td>";
			
			// NOTE! total is added by the sum of customer and product value and is converted in absolute value
			// REMEMBER: $person['magazines] = $item['magazines'];
			$total = $total + abs($person[mysql_field_name($products, $i)] + $item[mysql_field_name($products, $i)]);
		}
	
		echo "<td><b>$total</b></td></tr>";			
	}
	
	echo "</table><hr/><br>";
/* END OF LIFESTYLE PART */


/* ADVERTISING PART */
	echo "	
		<h3>Advertising</h3>		
	";
	
	$products = mysql_query("SELECT * FROM advertising") or die(mysql_error());

	echo"<table class='table table-bordered'>";
	
	// show table headers NAME(ID)
	echo "<tr><th>identity</th><th>" . mysql_field_name($people, 1) . " (id)</th>";
	
	// show the rest of table headers using product table's columns
	for ($i=2; $i<94; $i++) {
		echo "<th>" . mysql_field_name($products, $i) . "</th>";
	}
	echo "<th>total</th></tr>";
	
	// show customer name and member ID
	echo "<tr class='info'><td>Customer</td><td><b>" . $person['name'] . " (" . $person['member_id'] . ")". "</b></td>";	
	
	// show customer values
	// REMEMBER: $person['straight'];
	for ($i=2; $i<94; $i++) {	
		echo "<td>" . $person[mysql_field_name($products, $i)] . "</td>";
	}
	echo "<td>-</td></tr>";
	
	$products = mysql_query("SELECT * FROM advertising") or die(mysql_error());
	while($item = mysql_fetch_array( $products )) {
		
		$total = 0;
		
		echo "<tr><td>Item</td>";
		
		// show product values
		for ($i=1; $i<94; $i++) {
			echo "<td>" . $item[mysql_field_name($products, $i)] . "</td>";
			//echo "<td>" . mysql_field_name($products, $i) . "</td>";
			
			// NOTE! total is added by the sum of customer and product value and is converted in absolute value
			// REMEMBER: $person['magazines] = $item['magazines'];
			$total = $total + abs($person[mysql_field_name($products, $i)] + $item[mysql_field_name($products, $i)]);
		}
	
		echo "<td><b>$total</b></td></tr>";			
	}
	
	echo "</table><hr/><br>";
/* END OF ADVERTISING PART */
?>