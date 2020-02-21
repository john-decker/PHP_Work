<!DOCTYPE html>
<html lan='en'>
	<head>
		<meta charset="UTF-8">
		<title>A Coin Flip Generator</title>
		<link rel="stylesheet" type="text/css" href="hw_2.css">
	</head>
	<body>
 
		<h3>Welcome to the coin-flip generator</h3>

		<!--create form to take user input to set number of heads to try for-->
		<form action ="" method="GET">
			Enter number of heads to try for (whole numbers only)
			<input name="number" type ="text">
			<input name="submit" value="submit" type="submit"> 
		</form>

		<?php 
		# test to see if input has been set
		if((isset($_GET["number"]))){
			$input = $_GET["number"];
		}

		else{
			$input = 0;
		}
		# test to see if the input is numeric, give an error output and set to 0
		if(!is_numeric($input)){
			echo"<div class = 'isbn_cannot_verify'>I'm sorry, $input is not a valid number. Please try again.</div>";
			$input = 0;
		}

		else if(($_GET["number"]) <0){
			echo"<div class = 'isbn_cannot_verify'>I'm sorry, $input is not valid. Your number should be positive. Please try again.</div>";
			$input = 0;
		}


		# set relative path to image files
		$tails = "tails.png alt='tails'";
		$heads = "moai.png alt='heads'";

		$long_outcome = multiple_flips($input);

		echo "<div class = 'random_flip'>";
		echo"<h3>Trying for $input heads</h3>";

		foreach($long_outcome as $result){
			if($result == "heads"){
				$image = $heads;
			}
			else{
				$image = $tails;
			}
			echo"<img src =" . $image . ">";
		}

		if(count($long_outcome) == 1){
			echo "<h4>... took " . count($long_outcome) . " try. </h4>";
		}
		else{
			echo "<h4>... took " . count($long_outcome) . " tries. </h4>";
		}

		function multiple_flips($number){
			$head_counter = 0;
			$stop_number = $number;
			$flip_record = array();
			$cycles = 10;

			for($j=0; $j<$cycles; ++$j){
				$coin_side = toss_it();

				if($head_counter==$stop_number){
					return $flip_record;
					break;
				}

				else if($coin_side == 1){
					$result = "heads";
					$head_counter += 1;
				}

				else{
					$result = "tails";
					$head_counter = 0;
					# replenish $cycles count to keep loop going intil stop condition is met
					$cycles += 10;
				}

				array_push($flip_record, $result);
				}
		}

		//simulates tossing a single coin, returns value of 0 or 1
			function toss_it(){
				$outcome = mt_rand(0,1);
				return $outcome;
			}

		?>
		</div>

	</body>
</html>