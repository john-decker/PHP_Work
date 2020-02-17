<!DOCTYPE html>
	<html lang="en">	
		<head>
			<meta charset="UTF-8">
			<link rel="stylesheet" type="text/css" href="hw_2.css">
		</head>	

		<body>

		<?php
			//flips virtual coin 1,3,5,7,9 times
			echo"<div class = 'odd_number_flip_head'>";
			echo"<table>";
				echo"<tr>";
					echo"<th></th>";
					echo"<th>Heads</th>";
					echo"<th>Tails</th>";
				echo"</tr>";
				echo"<tr>";
					echo"<td class = 'title'><h2>Coin Flip Generator</h2></td>";
					echo"<td class = 'inner'><image src='moai.png'></td>";
					echo"<td class = 'inner'><image src='tails.png'></td>";
				echo"</tr>";
			echo"</table>";
			echo"</div>";

			echo"<div class = 'odd_number_flip'>";
			# sets specific intervals in an array
			$flips = array(1,3,5,7,9);
			# uses a for each loop to iterate each array index and get the appropriate number
			foreach($flips as $value){
				for($k=0; $k<$value; ++$k){
					echo"<img src =" . single_trial() . ">";
				}
				# detect if value is one and adjust output accordingly
				if($value==1){
					echo "<h3>$value flip</h3>";
				}
				else{
					echo "<h3>$value flips</h3>";
				}
			}

			//simulates flipping a coin betwee x and y times
			echo"</div>";
			# eventually make start and stop user inputs
			$start_val = 2;
			$end_val = 10; 
			echo"<div class = 'random_flip'>";
			echo"<h3>Random Flips (between $start_val and $end_val)</h3>";
			# generate a number of flips
			$iterations = rand($start_val,$end_val);
			# loop through the number of iterations generated
			for($j=0; $j<$iterations; ++$j){
				echo"<img src =" . single_trial() . ">";
			}
			echo"<h3>$iterations flips</h3>";
			echo"</div>";


			//tosses a virtual coin until it reaches 2 in a row
			//could use a while loop with condition set to wile $head_counter != 2 but chose a self-refreshing loop instead
			echo"<div class = 'two_heads'>";
			$heads="moai.png";
			$tails="tails.png";
			$cycles = 10;
			$stop_number = 2;
			$head_counter = 0;

			echo"<h3>Trying for $stop_number heads in a row ...</h3>";

			for($j=0; $j<$cycles; ++$j){
				$coin_side = toss_it();
				if($head_counter==$stop_number){
					echo"<h3> Took $j tries!</h3>";
					break;
				}

				else if($coin_side == "heads"){
					$result = $heads;
					$head_counter += 1;
				}

				else{
					$result = $tails;
					$head_counter = 0;
					# replenish $cycles count to keep loop going intil stop condition is met
					$cycles += 10;
				}

				echo"<img src =" . $result . ">";
			}
			echo"</div>";

			//Functions Section

			//simulates tossing a single coin, returns value of 0 or 1
			function toss_it(){
				$outcome = mt_rand(0,1);
				$coin_face = "tails";
				if($outcome==1){
					$coin_face = "heads";
				}
				return $coin_face;
			}

			//simulates a single trial flip of a coin, returns the string "heads" or "tails";
			function single_trial(){
				$tails = "tails.png";
				$heads = "moai.png";
				$coin_side = toss_it();

				if($coin_side=="heads"){
					$coin_image = $heads;
					return $coin_image;
				}

				else{
					$coin_image = $tails;
					return $coin_image;
				}
			
			}
		?>
		</body>
	</html>