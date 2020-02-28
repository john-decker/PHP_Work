<!DOCTYPE>
<html lang='en'>
	<head>
		<meta charset="UTF-8">
		<title>two_dice_with_odds</title>

		<!-- <form action ="" method="GET">
			Enter a number of sides (whole numbers)
			<input name="number" type ="text">
			<input name="submit" value="submit" type="submit">
		</form> -->
		<style>
			body{
				background-color: silver;
			}

			div.odds_output{
				background-color: white;
				border-style: groove;
				padding: 20px;
				width: 600px;
			}

			td{
				padding: 20px;
				outline-style: solid;
				background-color: white;
			}

			td.top{
				border-style: groove;
				background-color: lightblue;
			}

			td.highlight{
				background-color: green;
			}
			
		</style>

	</head>
	<body>
		<?php 

		// if(isset($_GET["number"])){
		// 	echo "You entered " . ($_GET["number"]);
		// };

		
		# modify this so that each die is either randomly generated or else is a user input
		# put in validations to ensure inputs that make sense (i.e. no one-sided die, no negative die, no float die, etc.)
		$die1 = 8;
		$die2 = 8;
		$roll_total = 0;
		$number_counter = 0;
		# randomly roll a number achievable by the combination of dice
		$rand_num = random_int(2, ($die1+$die2));
		$roll_number = $rand_num;

		#print table
		echo"<table>";
		echo"<td class = 'top'>[X]</td>";
		
		for($h=1; $h<=$die2; ++$h){
			echo"<td class='top'>"; 
			echo $h;
			echo"</td>";
		}

		for($j=1; $j<=$die1; $j++){
			echo"<tr class = 'top'>";
			echo"<td class= 'top'>" . $j . "</td>";
			for($k=1; $k<=$die2; $k++){
				$roll_total = $j + $k;
				if($roll_total == $roll_number){
					echo"<td class= 'highlight'>";
					echo "(" . $j . "," . $k . ")";
					echo"</td>";
					$number_counter++;
				}
				else{
					echo"<td>";
					echo "(" . $j . "," . $k . ")";
					echo"</td>";
				}
			}
			echo"</tr>";
		}
		echo"</table>";

		#calculate final odds
		$odds = ($number_counter/($die1*$die2)*100);
		$display_odds = round($odds,2);

		echo"<div class='odds_output'>";
		if($die1 == $die2){
			echo"Rolling two $die1 sided die ...<br />";
			echo"You rolled ... $roll_number<br />";
		}

		else{
			echo"Rolling one $die1 sided die and one $die2 sided die ...<br />";
			echo"You rolled ... $roll_number<br />";
		}

		if($number_counter>1){
			echo"There are $number_counter ways to roll $roll_number <br />";
			echo"The chances of rolling $roll_number are: $display_odds %";
		}
		else{
			echo"There is $number_counter way to roll $roll_number <br />";
			echo"The chances of rolling $roll_number are: $display_odds %";
		}
		echo"</div";

		?>


	</body>

</html>