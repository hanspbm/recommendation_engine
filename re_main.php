<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>RE: Main</title>
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.1.1/css/bootstrap.min.css">		
	</head>	
</html>

<?php
	include ("account.php");

	$countingMax = mysql_query("SELECT COUNT(*) as maxCustomers FROM customers") or die(mysql_error());
	$count_table = mysql_fetch_array( $countingMax );

	echo "<h2>Recommendation Engine: Main Page</h2>";

	echo "	<p>
		<form method='post' action='calculate.php'>
		<input type='submit' class='btn btn-primary'  value='Calculate Missing Totals'>
		</form>
		</p>
		
		<p>
		No. of Customers = " . $count_table['maxCustomers'] . "
		</p>
		<br>
	";
	
        echo "
		<table class='table table-hover'>
		<tr>
			<th>Customer</th>		
			<th>MemberID</th>
			<th>Hair</th>
			<th>Cosmetics</th>
			<th>Skin</th>
			<th>Lifestyle</th>
			<th>Advertising</th>
		</tr>
	";

	$people = mysql_query("SELECT * FROM customers") or die(mysql_error());
	
	while($person = mysql_fetch_array( $people )) {		
		$member_column = "m" . $person['member_id'];
		
		$hair_products 			= mysql_query("SELECT * FROM hair_total ORDER BY " . $member_column . " DESC");
		$cosmetics_products 	= mysql_query("SELECT * FROM cosmetics_total ORDER BY " . $member_column . " DESC");
		$skin_products 			= mysql_query("SELECT * FROM skin_total ORDER BY " . $member_column . " DESC");
		$lifestyle_products 	= mysql_query("SELECT * FROM lifestyle_total ORDER BY " . $member_column . " DESC");
		$advertising_products 	= mysql_query("SELECT * FROM advertising_total ORDER BY " . $member_column . " DESC");
		
		// If member column exists in any total table
		if ($hair_products) {
			$hair_item 			= mysql_fetch_array( $hair_products );
			$cosmetics_item 	= mysql_fetch_array( $cosmetics_products );
			$skin_item 			= mysql_fetch_array( $skin_products );
			$lifestyle_item 	= mysql_fetch_array( $lifestyle_products );
			$advertising_item 	= mysql_fetch_array( $advertising_products );		
			
			echo "	
				<form method='post' action='re_details.php'>
				<tr>			
				<td><input type='submit' class='btn btn-link' name='memberID' value='" . $person['name']  . "'></td>
				<td>" . $person['member_id'] . "</td>
				<td>" . $hair_item['product_name'] . 		" (" . $hair_item[$member_column] . 		")</td>
				<td>" . $cosmetics_item['product_name'] . 	" (" . $cosmetics_item[$member_column] . 	")</td>
				<td>" . $skin_item['product_name'] . 		" (" . $skin_item[$member_column] . 		")</td>
				<td>" . $lifestyle_item['product_name'] . 	" (" . $lifestyle_item[$member_column] . 	")</td>
				<td>" . $advertising_item['product_name'] . " (" . $advertising_item[$member_column] . 	")</td>
				</tr>
				<input type='hidden' name='memberID' value='" . $person['member_id'] . "'>
				</form>
			";
		}
		
		else {
			echo "	<tr>
				<td><input type='submit' class='btn btn-link' name='memberID' value='" . $person['name']  . "'></td>
				<td>" . $person['member_id'] . "</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				</tr>
			";
		}
	}

	echo 	"</table>";
?>