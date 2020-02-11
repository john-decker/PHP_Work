<! DOCTYPE html>
<html>
<!--a php script for calculating change due by type of bill and coin-->
	<head>
		<meta charset=UTF-8>
		<title>Homework 1 Change Making Assignment</title>
		<style>
			div.display {
				width: 400px;
				background-color: #a0b4c5;
				color: #4e5049
				outline-style: solid;
				outline-width: 2px;
				padding: 10px;
			}

			div.error {
				width: 350px;
				background-color: red;
				outline-style: solid;
				outline-width: 2px;
				padding: 10px;
			}

			div.neutral {
				width: 350px;
				background-color: lightblue;
				outline-style: solid;
				outline-width: 2px;
				padding: 10px;
			}

			h2 {
				color: #4e5049;
			}

			td.empty{
				background-color: #a0b4c5;
				outline-style: none;
				padding-left: 15px;
			}

			td.info{
				background-color: #bccad6;
				outline-style: none;
			}
				
			td.twenty{
				background-color: #B5CBB7;
				outline-color: #a0b4c5;
				outline-style: solid;
				outline-width: 1px;
				padding: 10px
			}

			td.ten{
				background-color: #D2E4C4;
				outline-color: #a0b4c5;
				outline-style: solid;
				outline-width: 1px;
				padding: 10px
			}

			td.five{
				background-color: #E4E9B2;
				outline-color: #a0b4c5;
				outline-style: solid;
				outline-width: 1px;
				padding: 10px
			}

			td.single{
				background-color: #E7E08B;
				outline-color: #a0b4c5;
				outline-style: solid;
				outline-width: 1px;
				padding: 10px
			}

			td.quarter{
				background-color: #7ea6b4;
				outline-color: #a0b4c5;
				outline-style: solid;
				outline-width: 1px;
				color: black;
				padding: 10px
			}

			td.dime{
				background-color: #9fbcc6;
				outline-color: #a0b4c5;
				outline-style: solid;
				outline-width: 1px;
				color: black;
				padding: 10px
			}

			td.nickle{
				background-color: #afc8d0;
				outline-color: #a0b4c5;
				outline-style: solid;
				outline-width: 1px;
				color: black;
				padding: 10px
			}

			td.penny{
				background-color: #cfdee3;
				outline-color: #a0b4c5;
				outline-style: solid;
				outline-width: 1px;
				color: black;
				padding: 10px
			}

		</style>
	</head>
	<body>
		<div class='display'>

		<?php 
		#declare variables - eventually make $starting_amount a user or system input
		$starting_amount = 36.41;
		$dollar=0;
		$twenty=0;
		$ten=0;
		$five=0;
		$single=0;
		$cent=0;
		$quarter=0;
		$dime=0;
		$nickle=0;
		$penny=0;
		$count_bills=0;
		$count_coins=0;

		#expands precision to 3 decimal place to avoid rounding errors and help keep coin count correct
		$sum_in_cents = round(($starting_amount * 100),3);

		#check to make sure that the change amount is not negative (i.e. that money isn't due)
		if($sum_in_cents < 0) {
			echo"<div class='error'>Warning $starting_amount is not a valid amount</div>";
			$sum_in_cents=0;

		}

		#check to see if any change is due at all
		elseif($sum_in_cents == 0) {
			echo"<div class='neutral'>No Change Due</div>";
			$sum_in_cents=0;

		}

		#calculate change
		else{
			if($sum_in_cents >= 100){
				$dollar = (int)($sum_in_cents/100);
				#calcultes bills needed for change over $5
				$twenty = (int)($dollar/20);
				$ten = (int)(($dollar-($twenty*20))/10);
				$five = (int)(($dollar-($twenty*20)-($ten*10))/5);
				$single = (int)(($dollar-($twenty*20)-($ten*10)-($five*5))/1);
				$cent = (int)($sum_in_cents-($dollar*100)); #accounts for totals above one dollar
				#calculates coin portion of change
				$quarter = (int)($cent/25);
				$dime = (int)(($cent-($quarter*25))/10);
				$nickle = (int)(($cent-($quarter*25)-($dime*10))/5);
				$penny = (int)(($cent-($quarter*25)-($dime*10)-($nickle*5))/1);
			}
			else{ 
				$cent = (int)($sum_in_cents);
				$quarter = (int)($cent/25);
				$dime = (int)(($cent-($quarter*25))/10);
				$nickle = (int)(($cent-($quarter*25)-($dime*10))/5);
				$penny = (int)(($cent-($quarter*25)-($dime*10)-($nickle*5))/1);
			}
		}

		#set variables to get a count on the number of bills and coins due in change
		$count_bills=($twenty+$ten+$five+$single);
		$count_coins=($quarter+$dime+$nickle+$penny);

		#print result in a table structure
		echo"<h2>Change Due: $starting_amount</h2>";
		echo"<table>";
		echo"<tr>";
		echo"<td class='info'>Bills <sub>($count_bills)</sub></td>";

		#handles case where there are no bills due as change
		if($sum_in_cents <=100){
			echo"<td class='empty'>---</td>";
		}

		#handles cases where one or more bills are due as change
		else{
			if($twenty==1){
				echo"<td class='twenty'>$twenty twenty</td>";
			}
			else{
				echo"<td class='twenty'>$twenty twenties</td>";
			}

			if($ten==1){
				echo"<td class='ten'>$ten ten</td>";
			}
			else{
				echo"<td class='ten'>$ten tens</td>";
			}
			if($five==1){
				echo"<td class='five'>$five five</td>";
			}
			else{
				echo"<td class='five'>$five fives</td>";
			}

			if($single==1){
				echo"<td class='single'>$single one</td>";
			}
			else{
				echo"<td class='single'>$single ones</td>";
			}
		}
		echo"</tr>";

		echo"<tr>";
		echo"<td class='info'>Coins<sub>($count_coins)</sub></td>";
		
		#handles cases where no coins are due
		if($cent == 0){
			echo"<td class='empty'>---</td>";
		}

		#handles cases where one or more coin(s) is/are due
		else{
			if($quarter == 1){
				echo"<td class='quarter'>$quarter quarter</td>";
			}
			else{
				echo"<td class='quarter'>$quarter quarters</td>";
			}
			if($dime == 1){
				echo"<td class='dime'>$dime dime</td>";
			}
			else{
				echo"<td class='dime'>$dime dimes</td>";
			}
			if($nickle == 1){
				echo"<td class='nickle'>$nickle nickle</td>";
			}
			else{
				echo"<td class='nickle'>$nickle nickles</td>";
			}
			if($penny == 1){
				echo"<td class='penny'>$penny penny</td>";
			}
			else{
				echo"<td class='penny'>$penny pennies</td>";
			}
		}
		echo"</tr>";
		echo"</table>";
		?>

		</div>
	</body>
</html>