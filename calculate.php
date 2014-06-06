<?php
	include ("account.php");
	
	echo "	<p>Missing totals calculated!</p>
	
		<form action='re_main.php'>
		<input type='submit' value='Back to Main Page'>
		</form>
	";
	
	$people = mysql_query("SELECT * FROM customers") or die(mysql_error());
	$products = mysql_query("SELECT * FROM hair") or die(mysql_error());
	
	
	while($person = mysql_fetch_array( $people )) {
		
		// create new column in db table. ignore when column is already made
		$column_name = "m" . $person['member_id'];
		
	/* HAIR PART */
		
		mysql_query("ALTER TABLE hair_total ADD " . $column_name . " MEDIUMINT NOT NULL");		
		
		$products = mysql_query("SELECT * FROM hair") or die(mysql_error());
		while($item = mysql_fetch_array( $products )) {
			
			$total = 0;
			$conflict = FALSE;
			
			// show product values
			for ($i=1; $i<26; $i++) {
				
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
				// insert total of each product on customer's column in db table. negative sign is also inserted to keep track of conflicts
				mysql_query("UPDATE hair_total SET " . $column_name . "='-" . $total . "' WHERE product_name='" . $item['name'] . "'");
			}
			
			else {			
				// insert total of each product on customer's column in db table
				mysql_query("UPDATE hair_total SET " . $column_name . "='" . $total . "' WHERE product_name='" . $item['name'] . "'");				
			}
		}
		
	/* END OF HAIR PART */
		
		
	/* COSMETICS PART */
		
		mysql_query("ALTER TABLE cosmetics_total ADD " . $column_name . " MEDIUMINT NOT NULL");		
		
		$products = mysql_query("SELECT * FROM cosmetics") or die(mysql_error());
		while($item = mysql_fetch_array( $products )) {
			
			$total = 0;
			$conflict = FALSE;
			
			// show product values
			for ($i=1; $i<50; $i++) {
				
				// check for conflict for relaxed and natural
				if (mysql_field_name($products, $i) == "dry_skin" || mysql_field_name($products, $i) == "oily_skin/large_pores") {
					if (($person[mysql_field_name($products, $i)] + $item[mysql_field_name($products, $i)] == 0) && $person[mysql_field_name($products, $i)] != 0) {
						$conflict = TRUE;
					}
				}
				
				// NOTE! total is added by the sum of customer and product value and is converted in absolute value
				$total = $total + abs($person[mysql_field_name($products, $i)] + $item[mysql_field_name($products, $i)]);
			}
			
			if ($conflict == TRUE) {
				// insert total of each product on customer's column in db table. negative sign is also inserted to keep track of conflicts
				mysql_query("UPDATE cosmetics_total SET " . $column_name . "='-" . $total . "' WHERE product_name='" . $item['name'] . "'");
			}
			
			else {			
				// insert total of each product on customer's column in db table
				mysql_query("UPDATE cosmetics_total SET " . $column_name . "='" . $total . "' WHERE product_name='" . $item['name'] . "'");				
			}
		}
		
	/* END OF COSMETICS PART */
	
	
	/* SKIN PART */
		
		mysql_query("ALTER TABLE skin_total ADD " . $column_name . " MEDIUMINT NOT NULL");		
		
		$products = mysql_query("SELECT * FROM skin") or die(mysql_error());
		while($item = mysql_fetch_array( $products )) {
			
			$total = 0;
			$conflict = FALSE;
			
			// show product values
			for ($i=1; $i<35; $i++) {
				
				// check for conflict for relaxed and natural
				if (mysql_field_name($products, $i) == "dry_skin" || mysql_field_name($products, $i) == "oily_skin/large_pores") {
					if (($person[mysql_field_name($products, $i)] + $item[mysql_field_name($products, $i)] == 0) && $person[mysql_field_name($products, $i)] != 0) {
						$conflict = TRUE;
					}
				}
				
				// NOTE! total is added by the sum of customer and product value and is converted in absolute value
				$total = $total + abs($person[mysql_field_name($products, $i)] + $item[mysql_field_name($products, $i)]);
			}
			
			if ($conflict == TRUE) {
				// insert total of each product on customer's column in db table. negative sign is also inserted to keep track of conflicts
				mysql_query("UPDATE skin_total SET " . $column_name . "='-" . $total . "' WHERE product_name='" . $item['name'] . "'");
			}
			
			else {			
				// insert total of each product on customer's column in db table
				mysql_query("UPDATE skin_total SET " . $column_name . "='" . $total . "' WHERE product_name='" . $item['name'] . "'");				
			}
		}
		
	/* END OF SKIN PART */
	
	
	/* LIFESTYLE PART */
		
		mysql_query("ALTER TABLE lifestyle_total ADD " . $column_name . " MEDIUMINT NOT NULL");		
		
		$products = mysql_query("SELECT * FROM lifestyle") or die(mysql_error());
		while($item = mysql_fetch_array( $products )) {
			
			$total = 0;
			
			// show product values
			for ($i=1; $i<94; $i++) {
				
				if (($person[mysql_field_name($products, $i)] + $item[mysql_field_name($products, $i)] == 0) && $person[mysql_field_name($products, $i)] != 0) {
					$conflict = TRUE;
				}
				
				// NOTE! total is added by the sum of customer and product value and is converted in absolute value
				$total = $total + abs($person[mysql_field_name($products, $i)] + $item[mysql_field_name($products, $i)]);
			}
			

			// insert total of each product on customer's column in db table
			mysql_query("UPDATE lifestyle_total SET " . $column_name . "='" . $total . "' WHERE product_name='" . $item['name'] . "'");				
		}
		
	/* END OF LIFESTYLE PART */
	
	
	/* ADVERTISING PART */
		
		mysql_query("ALTER TABLE advertising_total ADD " . $column_name . " MEDIUMINT NOT NULL");		
		
		$products = mysql_query("SELECT * FROM advertising") or die(mysql_error());
		while($item = mysql_fetch_array( $products )) {
			
			$total = 0;
			
			// show product values
			for ($i=1; $i<94; $i++) {
				
				if (($person[mysql_field_name($products, $i)] + $item[mysql_field_name($products, $i)] == 0) && $person[mysql_field_name($products, $i)] != 0) {
					$conflict = TRUE;
				}
				
				// NOTE! total is added by the sum of customer and product value and is converted in absolute value
				$total = $total + abs($person[mysql_field_name($products, $i)] + $item[mysql_field_name($products, $i)]);
			}
			

			// insert total of each product on customer's column in db table
			mysql_query("UPDATE advertising_total SET " . $column_name . "='" . $total . "' WHERE product_name='" . $item['name'] . "'");				
		}
		
	/* END OF ADVERTISING PART */		
        }	
?>
    