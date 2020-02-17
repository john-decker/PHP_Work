<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="UTF-8">
			<link rel="stylesheet" type="text/css" href="hw_2.css">
		</head>
		<body>
		<?php 
		//list of candidates for testing, eventually make this user input
		//will need a function to test input for proper type before passing to validator function
		# $candidate = "0747532699";
		$candidate = "156881111X";
		# $candidate = "123456789";
		# $candidate = "1568X11110";

		$decision = is_valid_isbn($candidate);
		$message = "IS NOT";
		echo "<div class = 'isbn'>";
		echo "<div class='isbn_head'><h2>ISBN Validator</h2><p>(Only validates 10-digit ISBN numbers)</p></div>";
		
		// validated isbn with link to isbn look up site
		if ($decision == 1){
			$message = "IS ";
			echo "<div class='isbn_message'><p>The ISBN: " . $candidate . " " . $message . "valid.</p></div>";
			echo "<div class='isbn_link'><button><a href = https://isbnsearch.org/isbn/" . $candidate . ">Click Here</a></button> for more information</div>";
		}

		//check for length, if not 10 output warning/error messages
		else if(strlen($candidate)!=10){
			echo "<div class='isbn_alert'><p>Sorry, the number provided is <strong>not</strong> 10 digits</p></div>";
			echo "<div class='isbn_cannot_verify'><p>The ISBN: " . $candidate . " could no be validated</p></div>";
		}

		//message for invalid isbn
		else {
			echo "<div class='isbn_message_negative'><p>The ISBN: " . $candidate . " " . $message . "valid.</p></div>";
		}

		echo "</div>";

		//Functions area		
		function is_valid_isbn($isbn){
			$isbn_length = strlen($isbn);
			$current_index = 0;
			$counter=10;
			$running_total=0;
			$is_valid = false;

			//loop through string element by element
			for($i=0; $i<$isbn_length; ++$i){
			$current_index = substr($isbn, $i, 1);
				# test for X and convert to 10
				if($current_index == "X"){
					$current_index = "10";
					$multiple=$current_index*$counter;
					$running_total += $multiple;
					--$counter;
				}
				# multiplication for validation
				else{
				$multiple=$current_index*$counter;
				--$counter;
				$running_total += $multiple;
				}
			}

			# modulo division for final check
			if(($running_total%11)==0){
				$is_valid = true;
			}
			
			return $is_valid;
		}

		?>

		</body>
	</html>